<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PartnerAdmin\Center;
use App\Models\PartnerAdmin\Batche;
use App\Models\PartnerAdmin\Participant;
use App\Models\Admin\State;
use App\Models\Admin\District;
use App\Models\Admin\Users;
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
        $pdf = PDF::loadView('admin.participants.pdf', compact('participants'));
        return $pdf->download('participants.pdf');
    }

public function index(Request $request)
    {
        $query = Participant::with(['center', 'batch','states','district']); 

        // 🔍 Search by id, title, username
        if ($request->filled('search')) {
            $search = "%{$request->search}%";
            $query->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', $search)
                  ->orWhere('full_name', 'LIKE', $search)
                  ->orWhere('user_name', 'LIKE', $search);
            });
        }

        if ($request->filled('academic_session')) {
            $query->where('academic_session', $request->academic_session);
        }
        // 🏢 Filter by institute
        if ($request->filled('institute')) {
            $query->where('created_by', $request->institute);
        }

        if ($request->filled('center')) {
            $query->where('center_id', $request->center);
        }

        if ($request->filled('batch')) {
            $query->where('batch_id', $request->batch);
        }

        // 📍 Filter by state
        if ($request->filled('state')) {
            $query->where('state_id', $request->state);
        }
        if ($request->filled('district')) {
            $query->where('district_id', $request->district);
        }

        $listing = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        $institutes = Users::where('status', 1)->get();
        $states = State::all();

        $startYear = 2017;
        $currentYear = date('Y');
        $sessions = [];
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        if ($request->ajax()) {
            $html = view('admin.participants.listingLoop', [
                'listing' => $listing
            ])->render();

            $pagination = (string) $listing->links('pagination::bootstrap-4');

            return response()->json([
                'status' => 'success',
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        return view('admin.participants.index', compact('listing','sessions', 'institutes', 'states'));
    }

    public function add(Request $request, $id = null)
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

                'identity_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'candidate_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'category_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'handicap_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'highe_education' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'salary_slip' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'id_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

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

            // Save data
            $participant = Participant::create($data);
            $uniqueNumber = str_pad($participant->id, 5, '0', STR_PAD_LEFT); // like 00001
            $participantId = 'SM-STU-' . $uniqueNumber;
            $participant->user_name = $participantId;
            $participant->save();
            return redirect()->route('admin.participant')->with('success', 'Participant added successfully!');
        }

        // Load form data
        $userId = auth()->id();
        $assignedCenterIds = DB::table('user_centers')
            ->where('user_id', $userId)
            ->pluck('center_id')
            ->toArray();

        $centers = Center::where('status', 1)
            // ->whereIn('id', $assignedCenterIds)
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

        return view('admin.participants.add', compact('states', 'centers', 'batches', 'sessions'));
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

                'identity_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'candidate_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'category_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'handicap_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'highe_education' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'salary_slip' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'id_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

                // Course details
                'academic_session' => 'required|string',
                'center_id' => 'required|integer',
                'batch_id' => 'required|integer',
                'course_duration' => 'required|integer',
                'status' => 'required|in:New,Under-Training,Trained',
                ]
            );

            if (!$validator->fails()) {
                // ✅ Move file upload block BEFORE update so $data has latest values
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
                    return redirect()->route('admin.participant');
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
            // ->whereIn('id', $assignedCenterIds)
            ->get();
        $states = State::all();
        $districts = District::where('state_id', $participant->state_id)->get();
        $batches = Batche::where('center_id',$participant->center_id)->get();

        // Academic Sessions (2017 - current year)
        $sessions = $this->generateAcademicSessions();

        // Sanction Years (2017 - next year)
        $sanctions = $this->generateSanctionYears();

        return view('admin.participants.edit', compact(
            'participant',
            'centers',
            'states',
            'districts',
            'sessions',
            'sanctions',
            'batches'
        ));
    }


    // Helper methods for academic sessions and sanction years
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

    // public function edit(Request $request, $id)
    // {
    //     if ($request->isMethod('post')) {
    //         $data = $request->toArray();
    //         unset($data['_token']);

    //         // Validation rules
    //         $validator = Validator::make(
    //         $request->toArray(),[
    //             'full_name' => 'required|string|max:255',
    //             'user_name' => 'nullable|string|max:255',
    //             'address' => 'required|string',
    //             'corresponding_address' => 'required|string',
    //             'state_id' => 'required|integer',
    //             'district_id' => 'required|integer',
    //             'city' => 'required|string|max:255',
    //             'mobile' => 'required|string|max:20',
    //             'email' => 'required|email|max:255',
    //             'date_of_birth' => 'required|date',
    //             'father_name' => 'required|string|max:255',
    //             'mother_name' => 'required|string|max:255',
    //             'gender' => 'required|in:Male,Female',
    //             'is_physical_handicap' => 'required|in:Yes,No',
    //             'caste_category' => 'required|in:Gen,SC,ST,OBC,Others',
    //             'aadhar_number' => 'required|string|max:20',
    //             'emergency_contact' => 'required|string|max:20',
    //             'academic_session' => 'required|string',
    //             'center_id' => 'required|integer',
    //             'batch_id' => 'required|integer',
    //             'course_duration' => 'required|integer',
    //             'status' => 'required|in:New,Under-Training,Trained'
    //         ]);

    //         if (!$validator->fails()) {
    //             $update = Participant::modify($id, $data);

    //             if ($update) {
    //                 $fileFields = ['identity_proof', 'candidate_image', 'category_proof', 'handicap_proof', 'highe_education', 'salary_slip', 'id_proof'];
    //                     foreach ($fileFields as $field) {
    //                         if ($request->hasFile($field)) {
    //                             $file = $request->file($field);
    //                             $filename = time() . '_' . $file->getClientOriginalName();
    //                             $file->move(public_path('uploads/participants'), $filename);
    //                             $data[$field] = $filename;
    //                         }
    //                     }

    //                 $request->session()->flash('success', 'Participant updated successfully.');
    //                 return redirect()->route('admin.participant');
    //             } else {
    //                 $request->session()->flash('error', 'Failed to update batch. Please try again.');
    //                 return redirect()->back()->withInput();
    //             }
    //         return redirect()->route('admin.participant')->with('success', 'Participant updated successfully.');
    //     }

    //     // Get dropdown data
    //     $centers = Center::where('status', 1)->get();
    //     $states = State::all();
    //     $districts = District::where('state_id', $participant->state_id)->get();

    //     // Academic Sessions
    //     $startYear = 2017;
    //     $currentYear = date('Y');
    //     $sessions = [];
    //     for ($year = $startYear; $year <= $currentYear; $year++) {
    //         $sessions[] = $year . '-' . ($year + 1);
    //     }

    //     // Sanction Years
    //     $startSYear = 2017;
    //     $currentSYear = date('Y') + 1;
    //     $sanctions = [];
    //     for ($years = $startSYear; $years <= $currentSYear; $years++) {
    //         $sanctions[] = $years . '-' . ($years + 1);
    //     }

    //     return view('admin.participants.edit', compact('participant', 'centers', 'states', 'districts', 'sessions', 'sanctions'));
    // }

    // public function edit(Request $request, $id)
    // {

    //     if ($request->isMethod('post')) {
    //         $data = $request->toArray();
    //         unset($data['_token']);

    //         $validator = Validator::make(
    //             $request->toArray(),
    //             [
    //                 'center_id' => 'required|integer',
    //                 'academic_session' => 'required|string',
    //                 'sanction_year' => 'required|string',
    //                 'batch_strength' => 'required|string|max:255',
    //                 'batch_title' => 'required|string|max:255',
    //                 'start_date' => 'required|date',
    //                 'end_date' => 'required|date|after_or_equal:start_date'
    //             ]
    //         );

    //         if (!$validator->fails()) {
    //             $update = Participant::modify($id, $data);

    //             if ($update) {
    //                 if ($request->hasFile('gallery')) {
    //                     foreach ($request->file('gallery') as $file) {
    //                         if ($file->isValid()) {
    //                             $filename = time() . '_' . $file->getClientOriginalName();
    //                             $file->move(public_path('uploads/batches'), $filename);

    //                             BatchGallery::create([
    //                                 'batch_id' => $batch->id,
    //                                 'image' => $filename
    //                             ]);
    //                         }
    //                     }
    //                 }

    //                 $request->session()->flash('success', 'Batch updated successfully.');
    //                 return redirect()->route('admin.manageBatche');
    //             } else {
    //                 $request->session()->flash('error', 'Failed to update batch. Please try again.');
    //                 return redirect()->back()->withInput();
    //             }
    //         } else {
    //             $request->session()->flash('error', 'Please provide valid inputs.');
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }
    //     }

    //     $centers = Center::where('status', 1)->get();
    //     $startYear = 2017;
    //     $currentYear = date('Y'); 
    //     $sessions = [];
    //     for ($year = $startYear; $year <= $currentYear; $year++) {
    //         $sessions[] = $year . '-' . ($year + 1);
    //     }

    //     $startSYear = 2017;
    //     $currentSYear = date('Y') + 1; 
    //     $sanctions = [];

    //     for ($years = $startSYear; $years <= $currentSYear; $years++) {
    //         $sanctions[] = $years . '-' . ($years + 1);
    //     }

    //     return view('admin.participants.edit', compact('batch', 'centers', 'sessions','sanctions'));
    // }

    public function delete(Request $request, $id)
    {
        $participant = Participant::find($id);
        if ($participant) { // This removes the pivot table entries
            if ($participant->delete()) {
                $request->session()->flash('success', 'Participant deleted successfully.');
                return redirect()->route('admin.participant');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('admin.participant');
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
