<?php

namespace App\Http\Controllers\Admin;
use App\Models\PartnerAdmin\Center;
use App\Models\Admin\State;
use App\Models\Admin\District;
use App\Models\PartnerAdmin\Participant;
use App\Models\PartnerAdmin\Batche;
use App\Models\Admin\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class userManagementController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }


    public function index(Request $request)
    {
        $query = Center::query()->with('states','district');
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
            $html = view('admin.userManagement.trainingPartner.listingLoop', [
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
        return view('admin.userManagement.trainingPartner.index', [
            'listing' => $listing,
        ]);
    }

    public function approveCenter(Request $request)
    {
        $query = Center::query()->where('status',1)->with('states','district');
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
            $html = view('admin.userManagement.approveCenter.listingLoop', [
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
        return view('admin.userManagement.approveCenter.index', [
            'listing' => $listing,
        ]);
    }

    public function pendingCenter(Request $request)
    {
        $query = Center::query()->where('status',0)->with('states','district');
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
            $html = view('admin.userManagement.pendingCenter.listingLoop', [
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
        return view('admin.userManagement.pendingCenter.index', [
            'listing' => $listing,
        ]);
    }

    public function stateWiseCenter(Request $request)
    {
        $query = Center::query()->with('states','district','institude');

        // 🔎 Search filter
        if ($request->get('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('title', 'LIKE', "%{$search}%");
            });
        }

        // 📅 Date filter
        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0])) {
                $query->where('created', '>=', date('Y-m-d 00:00:00', strtotime($createdOn[0])));
            }
            if (isset($createdOn[1]) && !empty($createdOn[1])) {
                $query->where('created', '<=', date('Y-m-d 23:59:59', strtotime($createdOn[1])));
            }
        }

        // 🌍 State filter
        if ($request->get('stateFilter') && $request->get('stateFilter') !== 'all') {
            $query->where('state_id', $request->get('stateFilter'));
        }

        $listing = $query->orderBy('id', 'desc')->paginate(10);
        $states = State::all();

        if ($request->ajax()) {
            $html = view('admin.userManagement.stateWiseCenter.listingLoop', [
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

        return view('admin.userManagement.stateWiseCenter.index', [
            'listing' => $listing,
            'states' => $states
        ]);
    }

    public function SuryaInstPasStuDetails(Request $request)
    {
        $query = Participant::with(['center', 'batch','states','district']);

        // 🔎 Search filter
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

        if ($request->filled('batchId') && is_array($request->batchId)) {
            $query->whereIn('batch_id', $request->batchId);
        }

        if ($request->filled('center')) {
            $query->where('center_id', $request->center);
        }

        if ($request->filled('institute')) {
            $query->where('created_by', $request->institute);
        }

        $query->orderBy('id', 'desc');
        $listing = $query->paginate(10);

        // Sessions array generate
        $startYear = 2017;
        $currentYear = date('Y');
        $sessions = [];
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        $batches = Batche::select('id', 'batch_title','batch_id')->orderBy('batch_title')->get();
        $centers = Center::all();
        $users = Users::all();

        // 🔁 AJAX request ke liye JSON return
        if ($request->ajax()) {
            $html = view("admin.userManagement.SuryaInstPasStuDetail.listingLoop", compact('listing'))->render();
            return response()->json([
                'status' => 'success',
                'html' => $html,
                'page' => $listing->currentPage(),
                'counter' => $listing->perPage(),
                'count' => $listing->total(),
                'pagination_counter' => $listing->currentPage() * $listing->perPage()
            ]);
        }

        // Normal page load
        return view("admin.userManagement.SuryaInstPasStuDetail.index", compact('listing', 'batches', 'sessions','centers','users'));
    }


    public function CenterWiseBatchDetails(Request $request)
    {
        $query = Participant::with(['center', 'batch','states','district']);

        // 🔎 Search filter
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('mobile', 'LIKE', "%{$search}%")
                  ->orWhere('aadhar_number', 'LIKE', "%{$search}%");
            });
        }

        // 📅 Date filter
        if ($request->has('created_on') && is_array($request->created_on)) {
            $createdOn = $request->created_on;

            if (!empty($createdOn[0])) {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($createdOn[0])));
            }
            if (!empty($createdOn[1])) {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($createdOn[1])));
            }
        }

        // 📚 Academic session filter
        if ($request->filled('academic_session')) {
            $query->where('academic_session', $request->academic_session);
        }

        // 🎓 Batch filter
        if ($request->filled('batchId') && is_array($request->batchId)) {
            $query->whereIn('batch_id', $request->batchId);
        }

        // 🏫 Center filter (FIXED - galti thi)
        if ($request->filled('center')) {
            $query->where('center_id', $request->center);
        }

        $query->orderBy('id', 'desc');
        $listing = $query->paginate(10);

        // Sessions array generate
        $startYear = 2017;
        $currentYear = date('Y');
        $sessions = [];
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        $batches = Batche::select('id', 'batch_title')->orderBy('batch_title')->get();
        $centers = Center::all();

        // 🔁 AJAX request ke liye JSON return
        if ($request->ajax()) {
            $html = view("admin.userManagement.centerWiseBatchDetails.listingLoop", compact('listing'))->render();
            return response()->json([
                'status' => 'success',
                'html' => $html,
                'page' => $listing->currentPage(),
                'counter' => $listing->perPage(),
                'count' => $listing->total(),
                'pagination_counter' => $listing->currentPage() * $listing->perPage()
            ]);
        }

        // Normal page load
        return view("admin.userManagement.centerWiseBatchDetails.index", compact('listing', 'batches', 'sessions','centers'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $centerData = [
                'title'                  => $data['title'] ?? null,
                'address'                => $data['address'] ?? null,
                'state_id'               => $data['state_id'] ?? null,
                'district_id'            => $data['district_id'] ?? null,
                'city'                   => $data['city'] ?? null,
                'phone'                  => $data['phone'] ?? null,
                'email'                  => $data['email'] ?? null,
                'academic_session'       => $data['academic_session'] ?? null,
                'affiliation_valid_from' => $data['affiliation_valid_from'] ?? null,
                'affiliation_valid_to'   => $data['affiliation_valid_to'] ?? null,
                'sip_id'                 => $data['sip_id'] ?? null,
            ];

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
                    $centerData[$field] = $filename;
                }
            }

            // ✅ अब सिर्फ clean data insert होगा
            $centerId = Center::insertGetId($centerData);

            // ✅ Officers save (applications table में)
            if (isset($data['person_name'])) {
                foreach ($data['person_name'] as $key => $name) {
                    if (empty($name) && empty($data['person_contact'][$key]) && empty($data['person_email'][$key])) {
                        continue;
                    }

                    DB::table('applications')->insert([
                        'user_id'        => auth()->id(),
                        'center_id'      => $centerId,
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

            return redirect()->route('admin.userManagement.partnerTraining')
                ->with('success', 'Center created successfully!');
        }

        // GET request → form show
        return view('admin.userManagement.trainingPartner.add');
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
                    'phone' => 'required|string|max:20',
                    'email' => 'required|email',
                    'academic_session' => 'required|string',
                    'person_name.*' => 'nullable|string|max:255',
                    'person_contact.*' => 'nullable|string|max:20',
                    'person_email.*' => 'nullable|email',
                    'center_afflilation_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'traner_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'on_boarding_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'cctv_camera_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'mobilisation' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'sip_id_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
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
                        return redirect()->route('admin.manageCenter');
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
            return view('admin.manageCenter.edit', [
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

    public function delete(Request $request, $id)
    {
        $center = Center::find($id);
        if ($center) { // This removes the pivot table entries
            if ($center->delete()) {
                $request->session()->flash('success', 'Center deleted successfully.');
                return redirect()->route('admin.manageCenter');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('admin.manageCenter');
            }
        } else {
            abort(404);
        }
    }
}
