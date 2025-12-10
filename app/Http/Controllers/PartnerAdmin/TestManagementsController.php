<?php

/**
 * Constituency Class
 *
 * @package    ConstituencyController


 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */


namespace App\Http\Controllers\PartnerAdmin;

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
use App\Models\Admin\OrderTest;
use App\Models\Admin\OrderRemark;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Error\Notice;

class TestManagementsController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    function index(Request $request)
    {
        $where = [];
        if ($request->get('search')) {
            $search = $request->get('search');
            $search = '%' . $search . '%';
            $where['(order_tests.id LIKE ?)'] = [$search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0]))
                $where['order_tests.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            if (isset($createdOn[1]) && !empty($createdOn[1]))
                $where['order_tests.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
        }

        if ($request->isMethod('post')) {

            $data = $request->except('_token', 'test_id');  // <-- test_id remove

            $validator = Validator::make($data, [
                // 'name' => 'required'
            ]);

            $data['status'] = 1;

            if (!$validator->fails()) {
                if (OrderTest::modify($request->test_id, $data)) {
                    return redirect()->route('partnerAdmin.testManagements')
                        ->with('success', 'Test Management information updated successfully.');
                }

                return back()->with('error', 'Information could not be saved. Please try again.')->withInput();
            }

            return back()->withErrors($validator)->with('error', 'Please provide valid inputs.')->withInput();
        }

        $listing = OrderTest::getListing($request, $where);
        $admins = Admins::getAll();
        $testingServices = TestingService::getAll();
        if ($request->ajax()) {
            $html = view(
                "partnerAdmin/testManagements/listingLoop",
                [
                    'listing' => $listing,
                    'admins' => $admins,
                    'testingServices' => $testingServices
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
                "partnerAdmin/testManagements/index",
                [
                    'listing' => $listing,
                    'admins'  => $admins,
                    'testingServices' => $testingServices
                ]
            );
        }
    }

    function add(Request $request)
    {
        if (!Permissions::hasPermission('test_managements', 'create')) {
            return redirect()->route('partnerAdmin.dashboard')->with('error', 'Permission denied.');
        }

        if ($request->isMethod('post')) {

            $data = $request->except('_token');

            $validator = Validator::make($data, [
                'name' => 'required'
            ]);

            if (!$validator->fails()) {
                if (TestManagement::create($data)) {
                    return redirect()->route('partnerAdmin.testManagements')
                                     ->with('success', 'Service category wise test created successfully.');
                }
                return back()->with('error','Information could not be saved.')->withInput();
            }

            return back()->withErrors($validator)->with('error','Please provide valid inputs.');
        }

        $testingService = TestingService::getAll();
        return view("partnerAdmin/testManagements/add", ['testingServices' => $testingService]);
    }

    function edit(Request $request, $id)
    {
        if (!Permissions::hasPermission('test_managements', 'update')) {
            return redirect()->route('partnerAdmin.dashboard')->with('error', 'Permission denied.');
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
                    return redirect()->route('partnerAdmin.testManagements')
                        ->with('success', 'Service category wise test information updated successfully.');
                }

                return back()->with('error', 'Information could not be saved. Please try again.')->withInput();
            }

            return back()->withErrors($validator)->with('error', 'Please provide valid inputs.')->withInput();
        }

        $testingServices = TestingService::getAll();
        $testServiceCategories = TestServiceCategory::getAll();

        return view("partnerAdmin/testManagements/edit", [
            'page' => $testingServiceCategory,
            'testingServices' => $testingServices,
            'testServiceCategories' => $testServiceCategories,
        ]);
    }

    public function view(Request $request, $id)
    {
        $orderTest = OrderTest::get($id);
        $orderRemarks = OrderRemark::select([
            'order_remarks.*',
            'owner.first_name as owner_first_name',
            'owner.last_name as owner_last_name',
            'user.person_name as user_person_name',
        ])
        ->leftJoin('admins as owner', 'owner.id', '=', 'order_remarks.created_by')
        ->leftJoin('users as user', 'user.id', '=', 'order_remarks.user_id')
        ->where('order_remarks.order_test_id',$id)->get();
        if ($orderTest) {
            return view("partnerAdmin/testManagements/view", [
                'orderTest' => $orderTest,
                'orderRemarks' => $orderRemarks
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
            $data['user_id'] = Auth::user()->id;
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
            return redirect()->route('partnerAdmin.dashboard');
        }

        $notice = TestManagement::find($id);
        if ($notice) { // This removes the pivot table entries
            if ($notice->delete()) {
                $request->session()->flash('success', 'Service category wise test deleted successfully.');
                return redirect()->route('partnerAdmin.testManagements');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('partnerAdmin.testManagements');
            }
        } else {
            abort(404);
        }
    }


    function bulkActions(Request $request, $action)
    {
        if (($action != 'delete' && !Permissions::hasPermission('test_managements', 'update')) || ($action == 'delete' && !Permissions::hasPermission('test_managements', 'delete'))) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('partnerAdmin.dashboard');
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
}
