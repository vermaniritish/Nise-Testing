<?php

namespace App\Http\Controllers\PartnerAdmin;
use App\Models\PartnerAdmin\Center;
use App\Models\Admin\State;
use App\Models\Admin\District;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CenterController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }


    public function index(Request $request)
    {
        $query = Center::query()->where('centers.institute_id', Auth::id());
        if ($request->get('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('title', 'LIKE', "%{$search}%");
            });
        }
        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0])) {
                $query->where('created', '>=', date('Y-m-d 00:00:00', strtotime($createdOn[0])));
            }
            if (isset($createdOn[1]) && !empty($createdOn[1])) {
                $query->where('created', '<=', date('Y-m-d 23:59:59', strtotime($createdOn[1])));
            }
        }
        $listing = $query->orderBy('id', 'desc')->paginate(10);
        if ($request->ajax()) {
            $html = view('partnerAdmin.manageCenter.listingLoop', [
                'listing' => $listing,
            ])->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
                'page' => $listing->currentPage(),
                'counter' => $listing->perPage(),
                'count' => $listing->total(),
                'pagination_counter' => $listing->currentPage() * $listing->perPage()
            ], 200);
        }
        return view('partnerAdmin.manageCenter.index', [
            'listing' => $listing,
        ]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Validation
            $validator = Validator::make($data, [
                'title' => 'required|string|max:255',
                'address' => 'required|string',
                'state_id' => 'required|integer',
                'city' => 'required|string|max:255',
                'phone' => 'required|string|max:10',
                'email' => 'required|email',
                'academic_session' => 'required|string',
                'person_name.*' => 'nullable|string|max:255',
                'person_contact.*' => 'nullable|string|max:10',
                'person_email.*' => 'nullable|email',
                'center_afflilation_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'traner_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'on_boarding_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'cctv_camera_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'mobilisation' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'sip_id_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'affiliation_valid_from' => 'nullable|date',
                'affiliation_valid_to' => 'nullable|date',
                'sip_id' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Handle file uploads (ensure directory exists)
            $uploadDir = public_path('uploads/centers');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileFields = [
                'center_afflilation_doc',
                'traner_certificate',
                'on_boarding_file',
                'cctv_camera_file',
                'mobilisation',
                'sip_id_proof'
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $file->move($uploadDir, $filename);
                    $data[$field] = $filename;
                }
            }

            $data['status'] = 0;
            $data['institute_id'] = Auth::id();

            // Prepare center data (exclude person fields)
            $centerData = $data;
            unset($centerData['_token'], $centerData['person_name'], $centerData['person_contact'], $centerData['person_email'], $centerData['application_id']);

            // Create center record (Eloquent)
            // Ensure Center::$fillable includes the fields you're inserting
            $center = Center::create($centerData);

            if (!$center) {
                $request->session()->flash('error', 'Center could not be created. Please try again.');
                return redirect()->back()->withInput();
            }

            // Get state code for username generation
            $stateCode = null;
            if (!empty($center->state_id)) {
                $state = State::find($center->state_id);
                if ($state) {
                    $stateCode = $state->code ?? strtoupper(substr($state->name, 0, 2));
                }
            }

            // Generate unique username now that $center->id exists
            $username = Center::generateUsername($center->id, $stateCode);

            // Update center with generated username
            $center->username = $username;
            $center->save();

            // Insert officer/application rows if provided
            if (!empty($data['person_name']) && is_array($data['person_name'])) {
                foreach ($data['person_name'] as $key => $name) {
                    if (empty($name) && empty($data['person_contact'][$key]) && empty($data['person_email'][$key])) {
                        continue;
                    }

                    DB::table('applications')->insert([
                        'user_id'        => auth()->id(),
                        'center_id'      => $center->id,
                        'username'       => auth()->user()->name ?? '',
                        'person_name'    => $name,
                        'person_email'   => $data['person_email'][$key] ?? '',
                        'person_contact' => $data['person_contact'][$key] ?? '',
                        'status'         => 'pending',
                        'created'        => now(),
                        'modified'       => now(),
                    ]);
                }
            }

            $request->session()->flash('success', 'Center created successfully with username: ' . $username);
            return redirect()->route('partnerAdmin.manageCenter');
        }

        // Dropdowns and session values for GET
        $states = State::all();
        $districts = [];
        $startYear = 2017;
        $currentYear = date('Y');
        $sessions = [];
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        return view('partnerAdmin.manageCenter.add', [
            'states' => $states,
            'districts' => $districts,
            'sessions' => $sessions,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $center = Center::get($id);

        if ($center) {
            if ($request->isMethod('post')) {
                $data = $request->all();

                // ✅ Validation rules
                $validator = Validator::make($data, [
                    'title' => 'required|string|max:255',
                    'address' => 'required|string',
                    'state_id' => 'required|integer',
                    'city' => 'required|string|max:255',
                    'phone' => 'required|string|max:10',
                    'email' => 'required|email',
                    'academic_session' => 'required|string',
                    'person_name.*' => 'nullable|string|max:255',
                    'person_contact.*' => 'nullable|string|max:10',
                    'person_email.*' => 'nullable|email',
                    'center_afflilation_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                    'traner_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                    'on_boarding_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                    'cctv_camera_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                    'mobilisation' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                    'sip_id_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                    'affiliation_valid_from' => 'nullable|date',
                    'affiliation_valid_to' => 'nullable|date',
                    'sip_id' => 'nullable|string|max:255',
                ]);

                if (!$validator->fails()) {
                    unset($data['_token']);

                    // ✅ Handle file uploads
                    $fileFields = [
                        'center_afflilation_doc',
                        'traner_certificate',
                        'on_boarding_file',
                        'cctv_camera_file',
                        'mobilisation',
                        'sip_id_proof'
                    ];

                    foreach ($fileFields as $field) {
                        if ($request->hasFile($field)) {
                            $file = $request->file($field);
                            $filename = time() . '_' . $file->getClientOriginalName();
                            $file->move(public_path('uploads/centers'), $filename);
                            $data[$field] = $filename;
                        }
                    }

                    if (isset($data['person_name'])) {

                        // Get all existing officer IDs for this center
                        $existingIds = DB::table('applications')
                            ->where('center_id', $id)
                            ->where('user_id', auth()->id())
                            ->pluck('id')
                            ->toArray();

                        $submittedIds = [];

                        foreach ($data['person_name'] as $key => $name) {
                            $appId = $data['application_id'][$key] ?? null;

                            // Skip empty rows
                            if (empty($name) && empty($data['person_contact'][$key]) && empty($data['person_email'][$key])) {
                                continue;
                            }

                            if ($appId) {
                                $submittedIds[] = $appId;

                                // ✅ Update existing record
                                DB::table('applications')->where('id', $appId)->update([
                                    'username'       => auth()->user()->name ?? '',
                                    'person_name'    => $name,
                                    'person_email'   => $data['person_email'][$key] ?? '',
                                    'person_contact' => $data['person_contact'][$key] ?? '',
                                    'modified'       => now(),
                                ]);
                            } else {
                                // ✅ Insert new record
                                $newId = DB::table('applications')->insertGetId([
                                    'user_id'        => auth()->id(),  
                                    'center_id'      => $id,
                                    'username'       => auth()->user()->name ?? '',
                                    'person_name'    => $name,
                                    'person_email'   => $data['person_email'][$key] ?? '',
                                    'person_contact' => $data['person_contact'][$key] ?? '',
                                    'status'         => 'pending',
                                    'created'        => now(),
                                    'modified'       => now(),
                                ]);
                                $submittedIds[] = $newId;
                            }
                        }

                        // ✅ Delete officers that were removed in the form
                        $idsToDelete = array_diff($existingIds, $submittedIds);
                        if (!empty($idsToDelete)) {
                            DB::table('applications')->whereIn('id', $idsToDelete)->delete();
                        }
                    }
                    
                    unset($data['person_name'], $data['person_contact'], $data['person_email']);
                    // ✅ Save updated center info
                    if (Center::modify($id, $data)) {
                        $request->session()->flash('success', 'Center information updated successfully.');
                        return redirect()->route('partnerAdmin.manageCenter');
                    } else {
                        $request->session()->flash('error', 'Information could not be saved. Please try again.');
                        return redirect()->back()->withInput();
                    }
                } else {
                    $request->session()->flash('error', 'Please provide valid inputs.');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }

            // ✅ Dropdowns and session values
            $states = State::all();
            $districts = District::where('state_id', $center->state_id)->get();
            
            $startYear = 2017;
            $currentYear = date('Y');
            $sessions = [];
            for ($year = $startYear; $year <= $currentYear; $year++) {
                $sessions[] = $year . '-' . ($year + 1);
            }
            $applications = DB::table('applications')
                ->where('center_id', $id)
                ->where('user_id', auth()->id())
                ->get();
            return view('partnerAdmin.manageCenter.edit', [
                'center' => $center,
                'states' => $states,
                'districts' => $districts,
                'sessions' => $sessions,
                'applications' => $applications
            ]);
        } else {
            abort(404);
        }
    }

    // public function districtsByState($stateId)
    // {
    //     $districts = District::where('state_id', $stateId)
    //                          ->where('status', 1)
    //                          ->orderBy('name')
    //                          ->get(['id','name','slug']);

    //     return response()->json($districts);
    // }

    public function delete(Request $request, $id)
    {
        $center = Center::find($id);
        if ($center) { // This removes the pivot table entries
            if ($center->delete()) {
                $request->session()->flash('success', 'Center deleted successfully.');
                return redirect()->route('partnerAdmin.manageCenter');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('partnerAdmin.manageCenter');
            }
        } else {
            abort(404);
        }
    }
}
