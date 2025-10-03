<?php

namespace App\Http\Controllers\PartnerAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PartnerAdmin\Center;
use App\Models\PartnerAdmin\Batche;
use App\Models\PartnerAdmin\Participant;
use App\Models\Admin\State;
use App\Models\Admin\District;
use Illuminate\Support\Facades\DB;
use App\Exports\ParticipantsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ParticipantsController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    public function exportExcel()
    {
        return Excel::download(new ParticipantsExport, 'participants.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new ParticipantsExport, 'participants.csv');
    }

    public function exportPDF()
    {
        $participants = Participant::with(['center','batch'])->get();
        $pdf = PDF::loadView('partnerAdmin.participants.pdf', compact('participants'));
        return $pdf->download('participants.pdf');
    }

    public function index(Request $request)
    {
        $query = Participant::with(['center', 'batch','states','district']);
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('mobile', 'LIKE', "%{$search}%")
                  ->orWhere('aadhar_number', 'LIKE', "%{$search}%");
            });
        }
        if ($request->has('created_on') && is_array($request->created_on)) {
            $createdOn = $request->created_on;

            if (!empty($createdOn[0])) {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($createdOn[0])));
            }
            if (!empty($createdOn[1])) {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($createdOn[1])));
            }
        }
        if ($request->filled('academic_session')) {
            $query->where('academic_session', $request->academic_session);
        }
        // if ($request->filled('state')) {
        //     if ($request->state !== 'all') {
        //         $query->whereHas('center', function ($q) use ($request) {
        //             $q->where('state_id', $request->state);
        //         });
        //     }
        // }
        if ($request->filled('center')) {
            $query->where('center_id', $request->center);
        }

        if ($request->filled('batch')) {
            $query->where('batch_id', $request->batch);
        }
        $query->orderBy('id', 'desc');
        $listing = $query->paginate(10);
        $startYear = 2017;
        $currentYear = date('Y');
        $sessions = [];
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }
        $batches = Batche::select('id', 'batch_title')->orderBy('batch_title')->get();
        $states = State::all();
        $centers = Center::all();
        if ($request->ajax()) {
            $html = view("partnerAdmin.participants.listingLoop", compact('listing'))->render();
            return response()->json([
                'status' => 'success',
                'html' => $html,
                'page' => $listing->currentPage(),
                'counter' => $listing->perPage(),
                'count' => $listing->total(),
                'pagination_counter' => $listing->currentPage() * $listing->perPage()
            ]);
        }

        return view("partnerAdmin.participants.index", compact('listing', 'batches', 'sessions','states','centers'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'full_name' => 'required|string|max:255',
                'user_name' => 'nullable|string|max:255',
                'address' => 'required|string',
                'corresponding_address' => 'required|string',
                'state_id' => 'required|integer',
                'district_id' => 'required|integer',
                'city' => 'required|string',
                'mobile' => 'required|string|min:10|max:10',
                'email' => 'required|email',
                'date_of_birth' => 'required',
                'father_name' => 'required|string',
                'mother_name' => 'required|string',
                'gender' => 'required|in:Male,Female',
                'is_physical_handicap' => 'required|in:Yes,No',
                'caste_category' => 'required|in:Gen,SC,ST,OBC,Others',
                'aadhar_number' => 'required|string|min:12|max:12',
                'emergency_contact' => 'required|string|min:10|max:10',

                // File uploads
                'qualification' =>'required|string',
                'employment_status' =>'required|string',
                'organisation_name' =>'nullable|string',
                'organisation_email' =>'nullable|string',
                'company_name' =>'nullable|string',
                'company_email' =>'nullable|string',
                'company_phone' =>'nullable|string',

                'identity_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'candidate_image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
                'category_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'handicap_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'highe_education' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'salary_slip' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'id_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

                // Course details
                'academic_session' => 'required|string',
                'center_id' => 'required|integer',
                'batch_id' => 'required|integer',
                'course_duration' => 'required|integer',
                'status' => 'required|in:New,Under-Training,Trained',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $data = $request->except('_token');

            // Handle file uploads dynamically
            $fileFields = [
                'identity_proof', 'candidate_image', 'category_proof',
                'handicap_proof', 'highe_education', 'salary_slip', 'id_proof'
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/participants'), $filename);
                    $data[$field] = $filename;
                }
            }

            $participant = Participant::create($data);
            $uniqueNumber = str_pad($participant->id, 5, '0', STR_PAD_LEFT); // like 00001
            $participantId = 'SM-STU-' . $uniqueNumber;
            $participant->user_name = $participantId;
            $participant->save();

            return redirect()->route('partnerAdmin.participant')->with('success', 'Participant added successfully!');
        }

        // Load form data
        $userId = auth()->id();
        $assignedCenterIds = DB::table('user_centers')
            ->where('user_id', $userId)
            ->pluck('center_id')
            ->toArray();

        $centers = Center::where('status', 1)
            ->whereIn('id', $assignedCenterIds)
            ->get();
        $states = State::all();
        // $centers = Center::all();
        $batches = Batche::all();

        // Generate academic sessions dynamically
        $startYear = 2017;
        $currentYear = date('Y');
        $sessions = [];
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        return view('partnerAdmin.participants.add', compact('states', 'centers', 'batches', 'sessions'));
    }

    public function edit(Request $request, $id)
    {
        // Fetch the participant
        $participant = Participant::findOrFail($id);

        if ($request->isMethod('post')) {
            $data = $request->toArray();
            unset($data['_token']);

            $validator = Validator::make(
                $request->toArray(),
                [
                'full_name' => 'required|string|max:255',
                'user_name' => 'nullable|string|max:255',
                'address' => 'required|string',
                'corresponding_address' => 'required|string',
                'state_id' => 'required|integer',
                'district_id' => 'required|integer',
                'city' => 'required|string',
                'mobile' => 'required|string|min:10|max:10',
                'email' => 'required|email',
                'date_of_birth' => 'required',
                'father_name' => 'required|string',
                'mother_name' => 'required|string',
                'gender' => 'required|in:Male,Female',
                'is_physical_handicap' => 'required|in:Yes,No',
                'caste_category' => 'required|in:Gen,SC,ST,OBC,Others',
                'aadhar_number' => 'required|string|min:12|max:12',
                'emergency_contact' => 'required|string|min:10|max:10',

                // File uploads
                'qualification' =>'required|string',
                'employment_status' =>'required|string',
                'organisation_name' =>'nullable|string',
                'organisation_email' =>'nullable|string',
                'company_name' =>'nullable|string',
                'company_email' =>'nullable|string',
                'company_phone' =>'nullable|string',

                'identity_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'candidate_image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
                'category_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'handicap_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'highe_education' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'salary_slip' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'id_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

                // Course details
                'academic_session' => 'required|string',
                'center_id' => 'required|integer',
                'batch_id' => 'required|integer',
                'course_duration' => 'required|integer',
                'status' => 'required|in:New,Under-Training,Trained',
                ]
            );

            if (!$validator->fails()) {
                $fileFields = [
                    'identity_proof', 'candidate_image', 'category_proof',
                    'handicap_proof', 'highe_education', 'salary_slip', 'id_proof'
                ];

                foreach ($fileFields as $field) {
                    if ($request->hasFile($field)) {
                        $file = $request->file($field);
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/participants'), $filename);
                        $data[$field] = $filename;
                    }
                }

                $update = Participant::modify($id, $data);
                // $update = $participant->update($data);

                if ($update) {
                    $request->session()->flash('success', 'Participant updated successfully.');
                    return redirect()->route('partnerAdmin.participant');
                } else {
                    $request->session()->flash('error', 'Failed to update batch. Please try again.');
                    return redirect()->back()->withInput();
                }
            } else {
                $request->session()->flash('error', 'Validation failed. Please check your inputs.');
                return redirect()->back()->withInput();
            }
        }

        // Fetch data for dropdowns
        // $centers = Center::where('status', 1)->get();
        $userId = auth()->id();
        $assignedCenterIds = DB::table('user_centers')
            ->where('user_id', $userId)
            ->pluck('center_id')
            ->toArray();

        $centers = Center::where('status', 1)
            ->whereIn('id', $assignedCenterIds)
            ->get();
        $states = State::all();
        $districts = District::where('state_id', $participant->state_id)->get();
        $batches = Batche::where('center_id',$participant->center_id)->get();

        // Academic Sessions (2017 - current year)
        $sessions = $this->generateAcademicSessions();

        // Sanction Years (2017 - next year)
        $sanctions = $this->generateSanctionYears();

        return view('partnerAdmin.participants.edit', compact(
            'participant',
            'centers',
            'states',
            'districts',
            'sessions',
            'sanctions',
            'batches'
        ));
    }

    private function generateAcademicSessions()
    {
        $startYear = 2017;
        $currentYear = date('Y');
        $sessions = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        return $sessions;
    }

    private function generateSanctionYears()
    {
        $startYear = 2017;
        $currentYear = date('Y') + 1;
        $sanctions = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sanctions[] = $year . '-' . ($year + 1);
        }

        return $sanctions;
    }

    public function delete(Request $request, $id)
    {
        $participant = Participant::find($id);
        if ($participant) { // This removes the pivot table entries
            if ($participant->delete()) {
                $request->session()->flash('success', 'Participant deleted successfully.');
                return redirect()->route('partnerAdmin.participant');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('partnerAdmin.participant');
            }
        } else {
            abort(404);
        }
    }

    public function getDistricts($state_id)
    {
        $districts = District::where('state_id', $state_id)->get();
        return response()->json($districts);
    }

}
