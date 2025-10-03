<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Permissions;
use Illuminate\Support\Facades\Validator;
use App\Models\PartnerAdmin\Center;
use App\Models\PartnerAdmin\Batche;
use App\Models\Admin\State;
use App\Models\Admin\Users;
use App\Models\Admin\BatchAllocation;
use Illuminate\Support\Facades\DB;

class BatchesController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    function index(Request $request)
    {
        if (!Permissions::hasPermission('batches', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $where = [];
        if ($request->get('search')) {
            $search = $request->get('search');
            $search = '%' . $search . '%';
            $where['(batches.id LIKE ? or batches.batch_title LIKE ? or batches.batch_strength LIKE ?)'] = [$search, $search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0]))
                $where['batches.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            if (isset($createdOn[1]) && !empty($createdOn[1]))
                $where['batches.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
        }

        if ($request->filled('academic_session')) {
            $where['batches.academic_session = ?'] = [$request->academic_session];
        }

        if ($request->filled('institute')) {
            $where['batches.institute_id = ?'] = [$request->institute];
        }

        if ($request->filled('center')) {
            $where['batches.center_id = ?'] = [$request->center];
        }

        if ($request->filled('state') && $request->state !== 'all') {
            $where['batches.state_id = ?'] = [$request->state];
        }

        $startYear = 2017;
        $currentYear = date('Y'); 
        $sessions = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }
        $states = State::where('status',1)->get();
        $institutes = Users::where('status',1)->get();
        $listing = Batche::getListing($request, $where);
        if ($request->ajax()) {
            $html = view(
                "admin/batches/listingLoop",
                [
                    'listing' => $listing,
                ]
            )->render();

            return Response()->json([
                'status' => 'success',
                'html' => $html,
                'page' => $listing->currentPage(),
                'counter' => $listing->perPage(),
                'count' => $listing->total(),
                'pagination_counter' => $listing->currentPage() * $listing->perPage()
            ], 200);
        } else {
            return view(
                "admin/batches/index",
                [
                    'listing' => $listing,
                    'sessions' => $sessions,
                    'states'  => $states,
                    'institutes' => $institutes
                ]
            );
        }
    }
    
    public function batchAllocation(Request $request)
    {
        if (!Permissions::hasPermission('batches', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $where = [];
        if ($request->get('search')) {
            $search = $request->get('search');
            $search = '%' . $search . '%';
            $where['(batches.id LIKE ? or batches.batch_title LIKE ? or batches.batch_strength LIKE ?)'] = [$search, $search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0]))
                $where['batches.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            if (isset($createdOn[1]) && !empty($createdOn[1]))
                $where['batches.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
        }

        if ($request->filled('academic_session')) {
            $where->where('academic_session', $request->academic_session);
        }

        if ($request->filled('state')) {
            if ($request->state !== 'all') {
                $where->where('state', $request->state);
            }
        }

        if ($request->filled('center')) {
            $where->where('center_id', $request->center);
        }
        $states = State::all();
        $centers = Center::all();
        $startYear = 2017;
        $currentYear = date('Y'); 
        $sessions = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        $listing = Batche::getListing($request, $where);
        if ($request->ajax()) {
            $html = view(
                "admin/batches/allocation/listingLoop",
                [
                    'listing' => $listing,
                ]
            )->render();

            return Response()->json([
                'status' => 'success',
                'html' => $html,
                'page' => $listing->currentPage(),
                'counter' => $listing->perPage(),
                'count' => $listing->total(),
                'pagination_counter' => $listing->currentPage() * $listing->perPage()
            ], 200);
        } else {
            return view(
                "admin/batches/allocation/index",
                [
                    'listing' => $listing,
                    'sessions' => $sessions,
                    'states' => $states,
                    'centers' => $centers
                ]
            );
        }
    }

    public function saveBatchAllocation(Request $request)
    {
        $selected = $request->input('selected_rows', []);

        if (empty($selected)) {
            return back()->with('error', 'Please select at least one batch.');
        }

        foreach ($selected as $batchId) {
            // ✅ Sirf ticked row ka data uthao
            $centerId = $request->input("center_id.$batchId");
            $instituteId = $request->input("institute_id.$batchId");
            $strength = $request->input("batch_strength.$batchId");
            $state = $request->input("state.$batchId");
            $city = $request->input("city.$batchId");
            $sanctionDate = $request->input("sanction_date.$batchId");
            $status = $request->input("status.$batchId");

            // ✅ File upload sirf ticked row ki
            $allocatedDoc = null;
            if ($request->hasFile("allocated_doc.$batchId")) {
                $file = $request->file("allocated_doc.$batchId");
                $allocatedDoc = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/allocated_docs'), $allocatedDoc);
            }

            $data = BatchAllocation::create([
                'batch_id' => $batchId,
                'center_id' => $centerId,
                'institute_id' => $instituteId,
                'batch_strength' => $strength,
                // 'state' => $state,
                // 'city' => $city,
                'sanction_date' => $sanctionDate,
                'status' => $status,
                'allocated_doc' => $allocatedDoc,
            ]);
        }

        return back()->with('success', 'Selected batches allocated successfully.');
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->toArray();
            unset($data['_token']);
            $validator = Validator::make(
                $request->toArray(),
                [
                    'center_id' => 'required|integer',
                    'academic_session' => 'required|string',
                    'sanction_year' => 'required|string',
                    'batch_strength' => 'required|string|max:255',
                    'batch_title' => 'required|string|max:255',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after_or_equal:batchStart'
                ]
            );

            if (!$validator->fails()) {
                $batch = Batche::create($data);
                if ($batch) {
                    if ($request->hasFile('gallery')) {
                        foreach ($request->file('gallery') as $file) {
                            if ($file->isValid()) {
                                $filename = time() . '_' . $file->getClientOriginalName();
                                $file->move(public_path('uploads/batches'), $filename);

                                BatchGallery::create([
                                    'batch_id' => $batch->id,
                                    'image' => $filename
                                ]);
                            }
                        }
                    }

                    $request->session()->flash('success', 'Batch created successfully.');
                    return redirect()->route('admin.manageBatche'); // Replace with your route
                } else {
                    $request->session()->flash('error', 'Failed to create batch. Please try again.');
                    return redirect()->back()->withInput();
                }
            } else {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $userId = auth()->id();
        $assignedCenterIds = DB::table('user_centers')
            ->where('user_id', $userId)
            ->pluck('center_id')
            ->toArray();
        // $centers = Center::where('status', 1)->get();
        $centers = Center::where('status', 1)
            // ->whereIn('id', $assignedCenterIds)
            ->get();
        $startYear = 2017;
        $currentYear = date('Y'); 
        $sessions = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        // ✅ Sanctions ke liye correct array me push karo
        $startSYear = 2017;
        $currentSYear = date('Y') + 1; 
        $sanctions = [];
        $states = State::where('states.status',1)->get();
        for ($years = $startSYear; $years <= $currentSYear; $years++) {
            $sanctions[] = $years . '-' . ($years + 1);
        }

        return view('admin.batches.add', compact('centers', 'sessions','sanctions','states'));
    }

    public function edit(Request $request, $id)
    {

        $batch = Batche::find($id);
        if ($request->isMethod('post')) {
            $data = $request->toArray();
            unset($data['_token']);

            $validator = Validator::make(
                $request->toArray(),
                [
                    'center_id' => 'required|integer',
                    'academic_session' => 'required|string',
                    'sanction_year' => 'required|string',
                    'batch_strength' => 'required|string|max:255',
                    'batch_title' => 'required|string|max:255',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after_or_equal:start_date'
                ]
            );

            if (!$validator->fails()) {
                $update = Batche::modify($id, $data);

                if ($update) {
                    if ($request->hasFile('gallery')) {
                        foreach ($request->file('gallery') as $file) {
                            if ($file->isValid()) {
                                $filename = time() . '_' . $file->getClientOriginalName();
                                $file->move(public_path('uploads/batches'), $filename);

                                BatchGallery::create([
                                    'batch_id' => $batch->id,
                                    'image' => $filename
                                ]);
                            }
                        }
                    }

                    $request->session()->flash('success', 'Batch updated successfully.');
                    return redirect()->route('admin.manageBatche');
                } else {
                    $request->session()->flash('error', 'Failed to update batch. Please try again.');
                    return redirect()->back()->withInput();
                }
            } else {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        // $centers = Center::where('status', 1)->get();
        $userId = auth()->id();
        $assignedCenterIds = DB::table('user_centers')
            ->where('user_id', $userId)
            ->pluck('center_id')
            ->toArray();

        $centers = Center::where('status', 1)
            // ->whereIn('id', $assignedCenterIds)
            ->get();
        $startYear = 2017;
        $currentYear = date('Y'); 
        $sessions = [];
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }

        $startSYear = 2017;
        $currentSYear = date('Y') + 1; 
        $sanctions = [];

        for ($years = $startSYear; $years <= $currentSYear; $years++) {
            $sanctions[] = $years . '-' . ($years + 1);
        }
        $states = State::where('states.status',1)->get();
        return view('admin.batches.edit', compact('batch', 'centers', 'sessions','sanctions','states'));
    }

}
