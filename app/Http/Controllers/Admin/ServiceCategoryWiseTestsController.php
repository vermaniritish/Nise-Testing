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
use App\Models\Admin\ServiceCategoryWiseTest;
use App\Models\Admin\TestServiceCategory;
use App\Models\Admin\TestingService;
use PHPUnit\Framework\Error\Notice;

class ServiceCategoryWiseTestsController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    function index(Request $request)
    {
        if (!Permissions::hasPermission('service_category_wise_tests', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $where = [];
        if ($request->get('search')) {
            $search = $request->get('search');
            $search = '%' . $search . '%';
            $where['(service_category_wise_tests.id LIKE ? or service_category_wise_tests.title LIKE ?)'] = [$search, $search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0]))
                $where['service_category_wise_tests.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            if (isset($createdOn[1]) && !empty($createdOn[1]))
                $where['service_category_wise_tests.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
        }

        // if($request->get('admins'))
        // {
        // 	$admins = $request->get('admins');
        // 	$admins = $admins ? implode(',', $admins) : 0;
        // 	$where[] = 'notices .created_by IN ('.$admins.')';
        // }

        $listing = ServiceCategoryWiseTest::getListing($request, $where);
        if ($request->ajax()) {
            $html = view(
                "admin/serviceCategoryWiseTests/listingLoop",
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
                "admin/serviceCategoryWiseTests/index",
                [
                    'listing' => $listing,
                ]
            );
        }
    }

    function add(Request $request)
    {
        if (!Permissions::hasPermission('service_category_wise_tests', 'create')) {
            return redirect()->route('admin.dashboard')->with('error', 'Permission denied.');
        }

        if ($request->isMethod('post')) {

            $data = $request->except('_token');

            $validator = Validator::make($data, [
                'title' => 'required'
            ]);

            if (!$validator->fails()) {
                if (ServiceCategoryWiseTest::create($data)) {
                    return redirect()->route('admin.serviceCategoryWiseTests')
                                     ->with('success', 'Service category wise test created successfully.');
                }
                return back()->with('error','Information could not be saved.')->withInput();
            }

            return back()->withErrors($validator)->with('error','Please provide valid inputs.');
        }

        $testingService = TestingService::getAll();
        return view("admin/serviceCategoryWiseTests/add", ['testingServices' => $testingService]);
    }

    function edit(Request $request, $id)
    {
        if (!Permissions::hasPermission('service_category_wise_tests', 'update')) {
            return redirect()->route('admin.dashboard')->with('error', 'Permission denied.');
        }

        $testingServiceCategory = ServiceCategoryWiseTest::get($id);
        if (!$testingServiceCategory) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $data = $request->except('_token');

            $validator = Validator::make($data, [
                'title' => 'required'
            ]);

            if (!$validator->fails()) {
                if (ServiceCategoryWiseTest::modify($id, $data)) {
                    return redirect()->route('admin.serviceCategoryWiseTests')
                        ->with('success', 'Service category wise test information updated successfully.');
                }

                return back()->with('error', 'Information could not be saved. Please try again.')->withInput();
            }

            return back()->withErrors($validator)->with('error', 'Please provide valid inputs.')->withInput();
        }

        $testingServices = TestingService::getAll();
        $testServiceCategories = TestServiceCategory::getAll();

        return view("admin/serviceCategoryWiseTests/edit", [
            'page' => $testingServiceCategory,
            'testingServices' => $testingServices,
            'testServiceCategories' => $testServiceCategories,
        ]);
    }

    public function view(Request $request, $id)
    {
        $notice = ServiceCategoryWiseTest::with('owner')->find($id);
        if ($notice) {
            return view("admin/serviceCategoryWiseTests/view", [
                'page' => $notice,
            ]);
        } else {
            abort(404);
        }
    }


    public function delete(Request $request, $id)
    {
        if (!Permissions::hasPermission('service_category_wise_tests', 'delete')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $notice = ServiceCategoryWiseTest::find($id);
        if ($notice) { // This removes the pivot table entries
            if ($notice->delete()) {
                $request->session()->flash('success', 'Service category wise test deleted successfully.');
                return redirect()->route('admin.serviceCategoryWiseTests');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('admin.serviceCategoryWiseTests');
            }
        } else {
            abort(404);
        }
    }


    function bulkActions(Request $request, $action)
    {
        if (($action != 'delete' && !Permissions::hasPermission('service_category_wise_tests', 'update')) || ($action == 'delete' && !Permissions::hasPermission('service_category_wise_tests', 'delete'))) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $ids = $request->get('ids');
        if (is_array($ids) && !empty($ids)) {
            switch ($action) {
                case 'delete':
                    foreach ($ids as $id) {
                        $notice = ServiceCategoryWiseTest::find($id);
                        if ($notice) {
                            $notice->categories()->detach(); // Detach categories from the notice
                        }
                    }
                    ServiceCategoryWiseTest::removeAll($ids);
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
        $records = ServiceCategoryWiseTest::query()
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->where('title', 'like', '%' . $searchQuery . '%');
            })
            ->where('status', 1)
            ->orderBy('created', 'desc')
            ->limit(10)
            ->get();

        // Fetch the specific notice if $id is provided, or null if no notice is selected
        $notice = $id ? ServiceCategoryWiseTest::where('id', $id)->first() : null;

        return view('serviceCategoryWiseTests.noticeDetail', [
            'records' => $records,
            'notice' => $notice,
            'searchQuery' => $searchQuery, // Pass search query back to the view
        ]);
    }
}
