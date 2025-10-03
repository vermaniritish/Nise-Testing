<?php

namespace App\Http\Controllers\PartnerAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PartnerAdmin\Center;
use App\Models\PartnerAdmin\Batche;
use App\Models\Admin\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BatchesController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = Batche::query()->where('batches.institute_id', Auth::id())->with('center');
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('batch_title', 'LIKE', "%{$search}%")
                  ->orWhere('batch_strength', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('academic_session')) {
            $query->where('academic_session', $request->academic_session);
        }

        if ($request->filled('state')) {
            if ($request->state !== 'all') {
                $query->whereHas('center', function ($q) use ($request) {
                    $q->where('state_id', $request->state);
                });
            }
        }

        if ($request->filled('center')) {
            $query->where('center_id', $request->center);
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
        $query->orderBy('id', 'desc');
        $listing = $query->paginate(10);
        $startYear = 2017;
        $currentYear = date('Y'); 
        $sessions = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $sessions[] = $year . '-' . ($year + 1);
        }
        $states = State::all();
        $centers = Center::all();
        if ($request->ajax()) {
            $html = view("partnerAdmin/batches/listingLoop", compact('listing','sessions'))->render();
            $pagination = $listing->links('pagination::bootstrap-4')->toHtml();

            return response()->json([
                'status' => 'success',
                'html' => $html,
                'pagination' => $pagination, // ✅ ye add karo
                'page' => $listing->currentPage(),
                'counter' => $listing->perPage(),
                'count' => $listing->total(),
                'pagination_counter' => $listing->currentPage() * $listing->perPage()
            ]);
        }
        return view("partnerAdmin/batches/index", compact('listing','sessions','states','centers'));
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
                $data['institute_id'] = Auth::id();
                $batch = Batche::create($data);
                if ($batch) {

                    $uniqueNumber = str_pad($batch->id, 5, '0', STR_PAD_LEFT); // like 00001
                    $batchId = 'BCH/' . $data['academic_session'] . '/' . $uniqueNumber;
                    $batch->batch_id = $batchId;
                    $batch->save();
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
                    return redirect()->route('partnerAdmin.manageBatche'); // Replace with your route
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
            ->whereIn('center.id', $assignedCenterIds)
            ->get();

        // $instituteId = auth()->user()->institute_id;

        // // ✅ Assigned centers (admin ne ya kisi ne assign kiye)
        // $assignedCenterIds = DB::table('user_centers')
        //     ->where('user_id', $userId)
        //     ->pluck('center_id')
        //     ->toArray();

        // // ✅ Query
        // $centers = Center::where('status', 1)
        //     ->where(function ($q) use ($userId, $instituteId, $assignedCenterIds) {
        //         // 1. Agar assign kiya gaya hai
        //         if (!empty($assignedCenterIds)) {
        //             $q->whereIn('id', $assignedCenterIds);
        //         }

        //         // 2. Agar user ne khud banaya hai
        //         $q->orWhere('created_by', $userId);

        //         // 3. Agar same institute ka hai
        //         if ($instituteId) {
        //             $q->orWhere('institute_id', $instituteId)
        //               ->orWhere('created_by', $instituteId);
        //         }
        //     })
        //     ->get();
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

        for ($years = $startSYear; $years <= $currentSYear; $years++) {
            $sanctions[] = $years . '-' . ($years + 1);
        }
        $states = State::where('states.status',1)->get();
        return view('partnerAdmin.batches.add', compact('centers', 'sessions','sanctions','states'));
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
                    return redirect()->route('partnerAdmin.manageBatche');
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
            ->whereIn('id', $assignedCenterIds)
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
        return view('partnerAdmin.batches.edit', compact('batch', 'centers', 'sessions','sanctions','states'));
    }

}
