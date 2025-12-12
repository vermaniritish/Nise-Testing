<?php

/**
 * Constituency Class
 *
 * @package    ConstituencyController


 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Permissions;
use App\Models\Admin\Admins;
use Illuminate\Validation\Rule;
use App\Libraries\FileSystem;
use App\Http\Controllers\Admin\AppController;
use App\Models\Admin\TestManagement;
use App\Models\Admin\TestServiceCategory;
use App\Models\Admin\TestingService;
use App\Models\Admin\Order;
use App\Models\Admin\OrderTest;
use App\Models\Admin\OrderRemark;
use App\Models\Admin\Users;
use App\Models\Admin\AdminAuth;
use PHPUnit\Framework\Error\Notice;
use Illuminate\Support\Facades\Storage;

class TestManagementsController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        if (!Permissions::hasPermission('order_tests', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $where = [];
        if ($request->get('search')) {
            $search = '%' . $request->get('search') . '%';
            $where['(order_tests.id LIKE ?)'] = [$search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (!empty($createdOn[0])) {
                $where['order_tests.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            }
            if (!empty($createdOn[1])) {
                $where['order_tests.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
            }
        }
        
        if ($request->isMethod('post')) {

            $data = $request->except('_token', 'test_id');

            // --- Convert all date fields ---
            $dateFields = [
                'order_date',
                'assigned_date',
                'test_start_date',
                'test_job_completion_date',
                'actual_completion_date'
            ];

            foreach ($dateFields as $field) {
                if (!empty($data[$field])) {
                    $data[$field] = date('Y-m-d', strtotime($data[$field]));
                }
            }

            // --- If NOT admin → remove assign_job
            // if (!AdminAuth::isAdmin()) {
            //     unset($data['assign_job']);
            // }

            // --- If assign_job exists → validate admin
            if (isset($data['assign_job']) && !empty($data['assign_job'])) {
                $adminExists = Admins::where('id', $data['assign_job'])->exists();
                if (!$adminExists) {
                    return back()->with('error', 'Selected admin does not exist.');
                }
            }

            $data['status'] = 1;

            if (OrderTest::modify($request->test_id, $data)) {
                return redirect()->route('admin.testManagements')
                    ->with('success', 'Test Management updated successfully.');
            }

            return back()->with('error', 'Information could not be saved. Please try again.');
        }
        
        $listing = OrderTest::getListing($request, $where);
        $admins = Admins::getAll();
        $testingServices = TestingService::getAll();
        
        if ($request->ajax()) {
            $html = view(
                "admin/testManagements/listingLoop",
                [
                    'listing' => $listing,
                    'admins' => $admins,
                    'testingServices' => $testingServices
                ]
            )->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
                'page' => $listing->currentPage(),
                'counter' => $listing->perPage(),
                'count' => $listing->total(),
                'pagination_counter' => $listing->currentPage() * $listing->perPage()
            ]);
        }

        return view(
            "admin/testManagements/index",
            [
                'listing' => $listing,
                'admins'  => $admins,
                'testingServices' => $testingServices
            ]
        );
    }

    // function index(Request $request)
    // {
    //     if (!Permissions::hasPermission('order_tests', 'listing')) {
    //         $request->session()->flash('error', 'Permission denied.');
    //         return redirect()->route('admin.dashboard');
    //     }

    //     $where = [];
    //     if ($request->get('search')) {
    //         $search = $request->get('search');
    //         $search = '%' . $search . '%';
    //         $where['(order_tests.id LIKE ?)'] = [$search];
    //     }
    //     if ($request->get('created_on')) {
    //         $createdOn = $request->get('created_on');
    //         if (isset($createdOn[0]) && !empty($createdOn[0]))
    //             $where['order_tests.created >= ?'] = [
    //                 date('Y-m-d 00:00:00', strtotime($createdOn[0]))
    //             ];
    //         if (isset($createdOn[1]) && !empty($createdOn[1]))
    //             $where['order_tests.created <= ?'] = [
    //                 date('Y-m-d 23:59:59', strtotime($createdOn[1]))
    //             ];
    //     }

    //     if ($request->isMethod('post')) {

    //         $data = $request->except('_token', 'test_id');  // <-- test_id remove

    //         $validator = Validator::make($data, [
    //             // 'name' => 'required'
    //         ]);

    //         $data['status'] = 1;

    //         if (!$validator->fails()) {
    //             if (OrderTest::modify($request->test_id, $data)) {
    //                 return redirect()->route('admin.testManagements')
    //                     ->with('success', 'Test Management information updated successfully.');
    //             }

    //             return back()->with('error', 'Information could not be saved. Please try again.')->withInput();
    //         }

    //         return back()->withErrors($validator)->with('error', 'Please provide valid inputs.')->withInput();
    //     }
    //     // $userId = AdminAuth::getLoginId();
    //     // $orderIds = Order::where('user_id', $userId)->pluck('id')->toArray();
    //     // $whereIn['order_tests.order_id'] = $orderIds;
        
    //     $listing = OrderTest::getListing($request, $where);
    //     $admins = Users::getAll();
    //     $testingServices = TestingService::getAll();
    //     if ($request->ajax()) {
    //         $html = view(
    //             "admin/testManagements/listingLoop",
    //             [
    //                 'listing' => $listing,
    //                 'admins' => $admins,
    //                 'testingServices' => $testingServices
    //             ]
    //         )->render();

    //         return Response()->json([
    //             'status' => 'success',
    //             'html' => $html,
    //             'page' => $listing->currentPage(),
    //             'counter' => $listing->perPage(),
    //             'count' => $listing->total(),
    //             'pagination_counter' => $listing->currentPage() * $listing->perPage()
    //         ], 200);
    //     } else {
    //         return view(
    //             "admin/testManagements/index",
    //             [
    //                 'listing' => $listing,
    //                 'admins'  => $admins,
    //                 'testingServices' => $testingServices
    //             ]
    //         );
    //     }
    // }

    function add(Request $request)
    {
        if (!Permissions::hasPermission('test_managements', 'create')) {
            return redirect()->route('admin.dashboard')->with('error', 'Permission denied.');
        }

        if ($request->isMethod('post')) {

            $data = $request->except('_token');

            $validator = Validator::make($data, [
                'name' => 'required'
            ]);

            if (!$validator->fails()) {
                if (TestManagement::create($data)) {
                    return redirect()->route('admin.testManagements')
                                     ->with('success', 'Service category wise test created successfully.');
                }
                return back()->with('error','Information could not be saved.')->withInput();
            }

            return back()->withErrors($validator)->with('error','Please provide valid inputs.');
        }

        $testingService = TestingService::getAll();
        return view("admin/testManagements/add", ['testingServices' => $testingService]);
    }

    function edit(Request $request, $id)
    {
        if (!Permissions::hasPermission('test_managements', 'update')) {
            return redirect()->route('admin.dashboard')->with('error', 'Permission denied.');
        }

        $testingServiceCategory = TestManagement::get($id);
        if (!$testingServiceCategory) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $data = $request->except('_token');

            $validator = Validator::make($data, [
                'name' => 'required'
            ]);

            if (!$validator->fails()) {
                if (TestManagement::modify($id, $data)) {
                    return redirect()->route('admin.testManagements')
                        ->with('success', 'Service category wise test information updated successfully.');
                }

                return back()->with('error', 'Information could not be saved. Please try again.')->withInput();
            }

            return back()->withErrors($validator)->with('error', 'Please provide valid inputs.')->withInput();
        }

        $testingServices = TestingService::getAll();
        $testServiceCategories = TestServiceCategory::getAll();

        return view("admin/testManagements/edit", [
            'page' => $testingServiceCategory,
            'testingServices' => $testingServices,
            'testServiceCategories' => $testServiceCategories,
        ]);
    }

    public function view(Request $request, $id)
    {
        $orderTest = OrderTest::with('documents')->find($id);
        $orderRemarks = OrderRemark::select([
            'order_remarks.*',
            'owner.first_name as owner_first_name',
            'owner.last_name as owner_last_name',
            'assign.first_name as assign_first_name',
            'assign.last_name as assign_last_name',
            'user.person_name as user_person_name',
        ])
        ->leftJoin('admins as owner', 'owner.id', '=', 'order_remarks.created_by')
        ->leftJoin('admins as assign', 'assign.id', '=', 'order_remarks.assign_to')
        ->leftJoin('users as user', 'user.id', '=', 'order_remarks.user_id')
        ->where('order_remarks.order_test_id',$id)->get();
        $admins = Admins::getAll();
        $admin = AdminAuth::getLoginUser();
        if ($orderTest) {
            return view("admin/testManagements/view", [
                'orderTest' => $orderTest,
                'orderRemarks' => $orderRemarks,
                'admins' => $admins,
                'admin' => $admin
            ]);
        } else {
            abort(404);
        }
    }

    public function testOrderRemark(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->except('_token');

            $validator = Validator::make($data, [
                // 'name' => 'required'
            ]);

            if ($request->hasFile('reference_document_file')) {
                $file = $request->file('reference_document_file');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;
                $path = $file->storeAs('uploads/reference_document_file', $filename, 'public');
                $data['reference_document_file'] = '/storage/' . $path;
            }
            $data['created_by'] = AdminAuth::getLoginId();
            $data['assign_to'] = $request->assign_to;
            $data['order_test_id'] = $request->order_test_id;
            if (!$validator->fails()) {
                if (OrderRemark::create($data)) {
                    return back()->with('success', 'Test Remarks saved successfully in order_remarks!');;
                }
                return back()->with('error','Information could not be saved.')->withInput();
            }

            return back()->withErrors($validator)->with('error','Please provide valid inputs.');
        }
    }


    public function delete(Request $request, $id)
    {
        if (!Permissions::hasPermission('test_managements', 'delete')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $notice = TestManagement::find($id);
        if ($notice) { // This removes the pivot table entries
            if ($notice->delete()) {
                $request->session()->flash('success', 'Service category wise test deleted successfully.');
                return redirect()->route('admin.testManagements');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('admin.testManagements');
            }
        } else {
            abort(404);
        }
    }


    function bulkActions(Request $request, $action)
    {
        if (($action != 'delete' && !Permissions::hasPermission('test_managements', 'update')) || ($action == 'delete' && !Permissions::hasPermission('test_managements', 'delete'))) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $ids = $request->get('ids');
        if (is_array($ids) && !empty($ids)) {
            switch ($action) {
                case 'delete':
                    foreach ($ids as $id) {
                        $notice = TestManagement::find($id);
                        if ($notice) {
                            $notice->categories()->detach(); // Detach categories from the notice
                        }
                    }
                    TestManagement::removeAll($ids);
                    $message = count($ids) . ' records has been deleted.';
                    break;
            }

            $request->session()->flash('success', $message);

            return Response()->json([
                'status' => 'success',
                'message' => $message,
            ], 200);
        } else {
            return Response()->json([
                'status' => 'error',
                'message' => 'Please select atleast one record.',
            ], 200);
        }
    }


    public function noticesDetails(Request $request, $id = null)
    {
        // Check for search query
        $searchQuery = $request->input('search');

        // Fetch recent notices based on search or default condition
        $records = TestManagement::query()
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->where('name', 'like', '%' . $searchQuery . '%');
            })
            ->where('status', 1)
            ->orderBy('created', 'desc')
            ->limit(10)
            ->get();

        // Fetch the specific notice if $id is provided, or null if no notice is selected
        $notice = $id ? TestManagement::where('id', $id)->first() : null;

        return view('testManagements.noticeDetail', [
            'records' => $records,
            'notice' => $notice,
            'searchQuery' => $searchQuery, // Pass search query back to the view
        ]);
    }

    public function markDisclose(Request $request)
    {
        $orderTest = OrderTest::find($request->order_test_id);

        if(!$orderTest){
            return back()->with('error', 'Order Test not found');
        }

        $orderTest->mark_disclose = 1;
        $orderTest->save();

        return back()->with('success', 'Company details marked as disclosed successfully.');
    }

    public function markDiscloseUploadFile(Request $request)
    {
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
            ]);

            $orderTest = OrderTest::find($request->order_test_id);

            if (!$orderTest) {
                return back()->with('error', 'Order test not found.');
            }
            if (!empty($orderTest->report_upload)) {

                $oldFile = str_replace('/storage/', '', $orderTest->report_upload);

                if (Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
            if ($request->hasFile('report_upload')) {

                $file = $request->file('report_upload');
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . '-' . uniqid() . '.' . $ext;

                $path = $file->storeAs('uploads/report_upload', $fileName, 'public');

                $orderTest->report_upload = '/storage/' . $path;
            }

            if (!empty($request->report_upload) && !$request->hasFile('report_upload')) {
                $orderTest->report_upload = $request->report_upload;
            }

            $orderTest->save();

            return back()->with('success', 'Report updated successfully!');
        }
    }

    // public function markDiscloseUploadFile(Request $request)
    // {
    //     if ($request->isMethod('post')) {

    //         $data = $request->except('_token');

    //         $validator = Validator::make($data, [
    //             // Add validation if needed
    //         ]);

    //         // Find the OrderTest
    //         $orderTest = OrderTest::find($request->order_test_id);

    //         if (!$orderTest) {
    //             return back()->with('error', 'Order test not found.');
    //         }

    //         // Upload File (same as your working function)
    //         if ($request->hasFile('report_upload')) {

    //             $file = $request->file('report_upload');
    //             $extension = $file->getClientOriginalExtension();
    //             $filename = time() . '-' . uniqid() . '.' . $extension;

    //             $path = $file->storeAs('uploads/report_upload', $filename, 'public');

    //             // Save to DB
    //             $orderTest['report_upload'] = '/storage/' . $path;
    //         }


    //         if (!empty($request->report_upload)) {

    //             $orderTest->report_upload = $request->report_upload; // This is URL written by JS

    //             if($orderTest->save()) {
    //                 return back()->with('success', 'Report updated successfully!');
    //             }
    //         }

    //         return back()->withErrors($validator)->with('error', 'Please provide valid inputs.');
    //     }
    // }

}
