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
use App\Models\Admin\TestingService;
use App\Models\Admin\SliderMenu;
use PHPUnit\Framework\Error\Notice;

class TestingServicesController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    function index(Request $request)
    {
        if (!Permissions::hasPermission('testing_services', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $where = [];
        if ($request->get('search')) {
            $search = $request->get('search');
            $search = '%' . $search . '%';
            $where['(testing_services.id LIKE ? or testing_services.title LIKE ? or testing_services.description LIKE ?)'] = [$search, $search, $search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0]))
                $where['testing_services.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            if (isset($createdOn[1]) && !empty($createdOn[1]))
                $where['testing_services.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
        }

        $listing = TestingService::getListing($request, $where);
        if ($request->ajax()) {
            $html = view(
                "admin/testingServices/listingLoop",
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
                "admin/testingServices/index",
                [
                    'listing' => $listing,
                ]
            );
        }
    }

    function add(Request $request)
    {
        if (!Permissions::hasPermission('testing_services', 'create')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }
        if ($request->isMethod('post')) {
            $data = $request->toArray();
            unset($data['_token']);
            $validator = Validator::make(
                $request->toArray(),
                [
                    'title' => ['required'],
                    // 'description' => ['required'],
                    'title_hi' => ['required'],
                    // 'description_hi' => ['required'],
                ]
            );

            if ($request->hasFile('pdf_file')) {
                $file = $request->file('pdf_file');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;
                $path = $file->storeAs('uploads/notices', $filename, 'public');
                $data['pdf_file'] = '/storage/' . $path;
            }

            if (!$validator->fails()) {
                $notice  = TestingService::create($data);
                if ($notice) {
                    $request->session()->flash('success', 'Testing service created succesfully.');
                    return redirect()->route('admin.testingService');
                } else {
                    $request->session()->flash('error', 'Information could not be save. Please try again.');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            } else {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        return view("admin/testingServices/add");
    }

    function edit(Request $request, $id)
    {
        if (!Permissions::hasPermission('testing_services', 'update')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $notice  = TestingService::get($id);
        if ($notice) {
            if ($request->isMethod('post')) {
                $data = $request->toArray();
                $validator = Validator::make(
                    $data,
                    [
                        'title' => ['required'],
                        // 'description' => ['required'],
                        'title_hi' => ['required'],
                        // 'description_hi' => ['required'],
                    ]
                );

                if ($request->hasFile('pdf_file')) {
                    $file = $request->file('pdf_file');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '-' . uniqid() . '.' . $extension;
                    $path = $file->storeAs('uploads/notices', $filename, 'public');
                    $data['pdf_file'] = '/storage/' . $path;
                }

                if (!$validator->fails()) {
                    unset($data['_token']);
                    if (TestingService::modify($id, $data)) {
                        $request->session()->flash('success', 'Testing service menu  inforamtion updated.');
                        return redirect()->route('admin.testingService');
                    } else {
                        $request->session()->flash('error', 'Information could not be save. Please try again.');
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                } else {
                    $request->session()->flash('error', 'Please provide valid inputs.');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
            return view("admin/testingServices/edit", [
                'page' => $notice,
            ]);
        } else {
            abort(404);
        }
    }
    
    public function view(Request $request, $id)
    {
        $notice = TestingService::with('owner')->find($id);
        if ($notice) {
            return view("admin/testingServices/view", [
                'page' => $notice,
            ]);
        } else {
            abort(404);
        }
    }


    public function delete(Request $request, $id)
    {
        if (!Permissions::hasPermission('testing_services', 'delete')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $notice = TestingService::find($id);
        if ($notice) { // This removes the pivot table entries
            if ($notice->delete()) {
                $request->session()->flash('success', 'Testing service deleted successfully.');
                return redirect()->route('admin.testingService');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('admin.testingService');
            }
        } else {
            abort(404);
        }
    }


    function bulkActions(Request $request, $action)
    {
        if (($action != 'delete' && !Permissions::hasPermission('testing_services', 'update')) || ($action == 'delete' && !Permissions::hasPermission('testing_services', 'delete'))) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $ids = $request->get('ids');
        if (is_array($ids) && !empty($ids)) {
            switch ($action) {
                case 'delete':
                    foreach ($ids as $id) {
                        $notice = TestingService::find($id);
                        if ($notice) {
                            $notice->categories()->detach(); // Detach categories from the notice
                        }
                    }
                    TestingService::removeAll($ids);
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
        $records = TestingService::query()
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->where('title', 'like', '%' . $searchQuery . '%');
            })
            ->where('status', 1)
            ->orderBy('created', 'desc')
            ->limit(10)
            ->get();

        // Fetch the specific notice if $id is provided, or null if no notice is selected
        $notice = $id ? TestingService::where('id', $id)->first() : null;

        return view('notices.noticeDetail', [
            'records' => $records,
            'notice' => $notice,
            'searchQuery' => $searchQuery, // Pass search query back to the view
        ]);
    }
}
