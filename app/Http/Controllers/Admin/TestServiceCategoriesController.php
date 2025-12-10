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
use App\Models\Admin\TestServiceCategory;
use App\Models\Admin\TestingService;
use PHPUnit\Framework\Error\Notice;

class TestServiceCategoriesController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    function index(Request $request)
    {
        if (!Permissions::hasPermission('testing_service_categories', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $where = [];
        if ($request->get('search')) {
            $search = $request->get('search');
            $search = '%' . $search . '%';
            $where['(testing_service_categories.id LIKE ? or testing_service_categories.test_category_title LIKE ?)'] = [$search, $search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0]))
                $where['testing_service_categories.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            if (isset($createdOn[1]) && !empty($createdOn[1]))
                $where['testing_service_categories.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
        }

        // if($request->get('admins'))
        // {
        // 	$admins = $request->get('admins');
        // 	$admins = $admins ? implode(',', $admins) : 0;
        // 	$where[] = 'notices .created_by IN ('.$admins.')';
        // }

        $listing = TestServiceCategory::getListing($request, $where);
        if ($request->ajax()) {
            $html = view(
                "admin/testServiceCategories/listingLoop",
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
                "admin/testServiceCategories/index",
                [
                    'listing' => $listing,
                ]
            );
        }
    }

    private function handleFileUpload($request, $fieldName, &$data)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/testServiceCategory', $filename, 'public');
            $data[$fieldName] = '/storage/' . $path;
        }
    }

    function add(Request $request)
    {
        if (!Permissions::hasPermission('testing_service_categories', 'create')) {
            return redirect()->route('admin.dashboard')->with('error', 'Permission denied.');
        }

        if ($request->isMethod('post')) {
            $data = $request->except('_token');

            $validator = Validator::make($data, [
                'test_category_title' => 'required'
            ]);

            $fileFields = [
                'sample_file',
                'name_of_document_file_4'
            ];

            foreach ($fileFields as $field) {
                $this->handleFileUpload($request, $field, $data);
            }

            $documents = [];
            if (isset($request->detail_of_document['title'])) {
                foreach ($request->detail_of_document['title'] as $index => $title) {
                    $documents[] = [
                        'title' => $title,
                        'sub_title' => $request->detail_of_document['sub_title'][$index] ?? null,
                    ];
                }
            }

            $otherForms = [];

            if (isset($request->other_required_form['name'])) {
                foreach ($request->other_required_form['name'] as $index => $name) {
                    $filePath = null;

                    // Check if file was uploaded (as UploadedFile)
                    if (
                        isset($request->other_required_form['file'][$index]) &&
                        $request->other_required_form['file'][$index] instanceof \Illuminate\Http\UploadedFile
                    ) {
                        $file = $request->other_required_form['file'][$index];
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $filePath = $file->storeAs('uploads/testServiceCategory', $fileName, 'public');
                    }
                    // Otherwise, maybe file already uploaded (string URL/path)
                    elseif (!empty($request->other_required_form['file'][$index])) {
                        $filePath = $request->other_required_form['file'][$index];
                    }

                    $otherForms[] = [
                        'name' => $name,
                        'file' => $filePath,
                    ];
                }
            }

            $data['other_required_form'] = json_encode($otherForms);
            $data['detail_of_document'] = json_encode($documents);

            if (!$validator->fails()) {
                if (TestServiceCategory::create($data)) {
                    return redirect()->route('admin.testServiceCategories')
                                     ->with('success', 'Notice created successfully.');
                }
                return back()->with('error','Information could not be saved.')->withInput();
            }

            return back()->withErrors($validator)->with('error','Please provide valid inputs.');
        }

        $testingService = TestingService::getAll();
        return view("admin/testServiceCategories/add", ['testingServices' => $testingService]);
    }

    public function edit(Request $request, $id)
    {
        if (!Permissions::hasPermission('testing_service_categories', 'update')) {
            return redirect()->route('admin.dashboard')->with('error', 'Permission denied.');
        }

        $testingServiceCategory = TestServiceCategory::get($id);
        if (!$testingServiceCategory) abort(404);

        if ($request->isMethod('post')) {

            $data = $request->except('_token');

            $validator = Validator::make($data, [
                'test_category_title' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $stringFileFields = ['sample_file', 'name_of_document_file_4'];

            foreach ($stringFileFields as $field) {
                if (!empty($request->$field)) {
                    $data[$field] = $request->$field;     // URL save karega
                } else {
                    unset($data[$field]);                 // agar empty ho to overwrite mat karo
                }
            }
            $documents = [];
            if (isset($request->detail_of_document['title'])) {
                foreach ($request->detail_of_document['title'] as $i => $title) {
                    $documents[] = [
                        'title'      => $title,
                        'sub_title'  => $request->detail_of_document['sub_title'][$i] ?? null,
                    ];
                }
            }
            $data['detail_of_document'] = json_encode($documents);
            $otherForms = [];
            if (isset($request->other_required_form['name'])) {

                foreach ($request->other_required_form['name'] as $i => $name) {
                    $filePath = null;
                    if (isset($request->other_required_form['file'][$i]) &&
                        $request->other_required_form['file'][$i] instanceof \Illuminate\Http\UploadedFile) {
                        $file = $request->other_required_form['file'][$i];
                        $fileName = time().'_'.$file->getClientOriginalName();
                        $filePath = $file->storeAs('uploads/testServiceCategory', $fileName, 'public');
                    } elseif (!empty($request->other_required_form['file'][$i])) {
                        $filePath = $request->other_required_form['file'][$i];
                    }

                    $otherForms[] = [
                        'name' => $name,
                        'file' => $filePath,
                    ];
                }
            }

            $data['other_required_form'] = json_encode($otherForms);
            if (TestServiceCategory::modify($id, $data)) {
                return redirect()->route('admin.testServiceCategories')
                                 ->with('success', 'Testing service category updated successfully.');
            }

            return back()->with('error', 'Information could not be saved.')->withInput();
        }

        return view("admin/testServiceCategories/edit", [
            'page' => $testingServiceCategory,
            'testingServices' => TestingService::getAll()
        ]);
    }
    
    public function view(Request $request, $id)
    {
        $notice = TestServiceCategory::with('owner')->find($id);
        if ($notice) {
            return view("admin/testServiceCategories/view", [
                'page' => $notice,
            ]);
        } else {
            abort(404);
        }
    }


    public function delete(Request $request, $id)
    {
        if (!Permissions::hasPermission('testing_service_categories', 'delete')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $notice = TestServiceCategory::find($id);
        if ($notice) { // This removes the pivot table entries
            if ($notice->delete()) {
                $request->session()->flash('success', 'Notice deleted successfully.');
                return redirect()->route('admin.testServiceCategories');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('admin.testServiceCategories');
            }
        } else {
            abort(404);
        }
    }


    function bulkActions(Request $request, $action)
    {
        if (($action != 'delete' && !Permissions::hasPermission('testing_service_categories', 'update')) || ($action == 'delete' && !Permissions::hasPermission('testing_service_categories', 'delete'))) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $ids = $request->get('ids');
        if (is_array($ids) && !empty($ids)) {
            switch ($action) {
                case 'delete':
                    foreach ($ids as $id) {
                        $notice = TestServiceCategory::find($id);
                        if ($notice) {
                            $notice->categories()->detach(); // Detach categories from the notice
                        }
                    }
                    TestServiceCategory::removeAll($ids);
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
        $records = TestServiceCategory::query()
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->where('title', 'like', '%' . $searchQuery . '%');
            })
            ->where('status', 1)
            ->orderBy('created', 'desc')
            ->limit(10)
            ->get();

        // Fetch the specific notice if $id is provided, or null if no notice is selected
        $notice = $id ? TestServiceCategory::where('id', $id)->first() : null;

        return view('testServiceCategories.noticeDetail', [
            'records' => $records,
            'notice' => $notice,
            'searchQuery' => $searchQuery, // Pass search query back to the view
        ]);
    }
}
