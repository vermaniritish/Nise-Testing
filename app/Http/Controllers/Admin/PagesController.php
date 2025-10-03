<?php

/**
 * Pages Class
 *
 * @package    PagesController


 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Settings;
use App\Models\Admin\Permissions;
use App\Models\Admin\AdminAuth;
use App\Libraries\General;
use App\Models\Admin\Pages;
use App\Models\Admin\Admins;
use App\Models\Admin\PageData;
use App\Models\Admin\BlogCategories;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Libraries\FileSystem;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Admin\AppController;

class PagesController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    function index(Request $request)
    {
        if (!Permissions::hasPermission('pages', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $where = [];
        if ($request->get('search')) {
            $search = $request->get('search');
            $search = '%' . $search . '%';
            $where['(pages.id LIKE ? or pages.title LIKE ? or owner.first_name LIKE ? or owner.last_name LIKE ?)'] = [$search, $search, $search,$search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0]))
                $where['pages.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            if (isset($createdOn[1]) && !empty($createdOn[1]))
                $where['pages.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
        }

        if ($request->get('admins')) {
            $admins = $request->get('admins');
            $admins = $admins ? implode(',', $admins) : 0;
            $where[] = 'pages.created_by IN (' . $admins . ')';
        }

        if ($request->get('status') !== "" && $request->get('status') !== null) {
            $where['pages.status'] = $request->get('status');
        }

        $listing = Pages::getListing($request, $where);


        if ($request->ajax()) {
            $html = view(
                "admin/pages/listingLoop",
                [
                    'listing' => $listing
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
            $filters = $this->filters($request);
            return view(
                "admin/pages/index",
                [
                    'listing' => $listing,
                    'admins' => $filters['admins']
                ]
            );
        }
    }

    function filters(Request $request)
    {
        $admins = [];
        $adminIds = Pages::distinct()->whereNotNull('created_by')->pluck('created_by')->toArray();
        if ($adminIds) {
            $admins = Admins::getAll(
                [
                    'admins.id',
                    'admins.first_name',
                    'admins.last_name',
                    'admins.status',
                ],
                [
                    'admins.id in (' . implode(',', $adminIds) . ')'
                ],
                'concat(admins.first_name, admins.last_name) desc'
            );
        }
        return [
            'admins' => $admins
        ];
    }

    function add(Request $request)
    {
        if (!Permissions::hasPermission('pages', 'create')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        if ($request->isMethod('post')) {
            $data = $request->toArray();
            // dd($data);
            unset($data['_token']);

            $validator = Validator::make(
                $request->toArray(),
                [
                    'title' => 'required|unique:pages,title',
                    'description' => 'required'
                ]
            );

            if (!$validator->fails())
             {

                $records['title']=$data['title'];
                $records['title_hi']=$data['title_hi'];

                // $records['meta_title']=$data['meta_title'];
                $records['description']=$data['description'];
                $records['description_hi']=$data['description_hi'];

                // $records['meta_description']=$data['meta_description'];
                // $records['meta_keywords']=$data['meta_keywords'];
                $records['image']=$data['image'];
                $records['status']=1;


                unset($data['_token']);
                // dd($data);
                $page = Pages::create($records);
                if ($page) {
                    $this->createPage($page,$data);
                    $request->session()->flash('success', 'Page created successfully.');
                    return redirect()->route('admin.pages');
                } else {
                    $request->session()->flash('error', 'Page could not be save. Please try again.');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            } else {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        return view("admin/pages/add", []);
    }

    function createPage($page,$payload)
    {
        $page_id = $page->id;

        foreach ($payload as $key => $value) {
            PageData::updateOrCreate(
                ['page_id' => $page_id, 'key' => $key],
                ['page_id' => $page_id, 'key' => $key, 'value' => $value]
            );
        }
    }

    function view(Request $request, $id)
    {
        if (!Permissions::hasPermission('pages', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $page = Pages::get($id);
        if ($page) {
            return view("admin/pages/view", [
                'page' => $page
            ]);
        } else {
            abort(404);
        }
    }



    function edit(Request $request, $id)
    {
        if (!Permissions::hasPermission('pages', 'update')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $page = Pages::get($id);
        if ($page) {
            if ($request->isMethod('post')) {
                $payload = $request->toArray();
                //  dd($data);
                $data = [
                    '_token'           => $payload['_token'] ?? null,
                    'title'            => $payload['title'] ?? null,
                    'title_hi'            => $payload['title_hi'] ?? null,
                    'description_hi'      => $payload['description_hi'] ?? null,
                    'description'      => $payload['description'] ?? null,
                    'meta_title'       => $payload['meta_title'] ?? null,
                    'meta_description' => $payload['meta_description'] ?? null,
                    'meta_keywords'    => $payload['meta_keywords'] ?? null,
                    'image'    => $payload['image'] ?? null,
                ];
                unset($payload['_token'], $payload['title'], $payload['status'], $payload['image'], $payload['description'], $payload['meta_title'], $payload['meta_description'], $payload['meta_keywords']);
                $validator = Validator::make(
                    $request->toArray(),
                    [
                        'title' => [
                            'required',
                            Rule::unique('pages')->ignore($page->id)
                        ],
                    ]
                );

                if (!$validator->fails()) {
                    unset($data['_token']);

                    /** IN CASE OF SINGLE UPLOAD **/
                    if (isset($data['image']) && $data['image']) {
                        $oldImage = $page->image;
                    } else {
                        unset($data['image']);
                    }
                    /** IN CASE OF SINGLE UPLOAD **/
                    $categories = [];
                    if (isset($data['category']) && $data['category']) {
                        $categories = $data['category'];
                    }
                    unset($data['category']);
                    $record = Pages::modify($id, $data);
                    if ($record) {
                        if ($page->slug != "terms-conditions" && $page->slug === "privacy-policy")
                        {
                            if($record->slug == "home"){
                                $this->updateHomePageDetails($id, $payload);
                            }
                            if($record->slug == "about-us"){
                                $this->updateAboutUsDetails($id, $payload);
                            }
                            $this->updateContent($id, $payload);

                            /** IN CASE OF SINGLE UPLOAD **/
                            if (isset($oldImage) && $oldImage) {
                                FileSystem::deleteFile($oldImage);
                            }
                            /** IN CASE OF SINGLE UPLOAD **/

                            if (!empty($categories)) {
                                Pages::handleCategories($page->id, $categories);
                            }
                        }

                        $request->session()->flash('success', 'Page updated successfully.');
                        return redirect()->back();
                    } else {
                        $request->session()->flash('error', 'Page could not be save. Please try again.');
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                } else {
                    $request->session()->flash('error', 'Please provide valid inputs.');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }

            return view("admin/pages/edit", [
                'page' => $page,
            ]);
        } else {
            abort(404);
        }
    }

    function updateAboutUsDetails($page_id, $payload)
    {
        foreach ($payload as $key => $value) {
            PageData::updateOrCreate(
                ['page_id' => $page_id, 'key' => $key],
                ['page_id' => $page_id, 'key' => $key, 'value' => $value]
            );
        }
    }


    function updateHomePageDetails($page_id, $payload)
    {

        foreach ($payload as $key => $value) {
            PageData::updateOrCreate(
                ['page_id' => $page_id, 'key' => $key],
                ['page_id' => $page_id, 'key' => $key, 'value' => $value]
            );
        }
    }

    function updateContent($page_id, $payload)
    {
        foreach ($payload as $key => $value) {
            PageData::updateOrCreate(
                ['page_id' => $page_id, 'key' => $key],
                ['page_id' => $page_id, 'key' => $key, 'value' => $value]
            );
        }
    }


    function delete(Request $request, $id)
    {
        if (!Permissions::hasPermission('pages', 'delete')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $admin = Pages::find($id);
        if ($admin->delete()) {
            $request->session()->flash('success', 'Page deleted successfully.');
            return redirect()->route('admin.pages');
        } else {
            $request->session()->flash('error', 'Page could not be delete.');
            return redirect()->route('admin.pages');
        }
    }

    function bulkActions(Request $request, $action)
    {
        if (($action != 'delete' && !Permissions::hasPermission('pages', 'update')) || ($action == 'delete' && !Permissions::hasPermission('pages', 'delete'))) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $ids = $request->get('ids');
        if (is_array($ids) && !empty($ids)) {
            switch ($action) {
                case 'active':
                    Pages::modifyAll($ids, [
                        'status' => 1
                    ]);
                    $message = count($ids) . ' records has been published.';
                    break;
                case 'inactive':
                    Pages::modifyAll($ids, [
                        'status' => 0
                    ]);
                    $message = count($ids) . ' records has been unpublished.';
                    break;
                case 'delete':
                    Pages::removeAll($ids);
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

    function show($slug){
        $record = Pages::where('slug', $slug)->where('status', 1)->first();
        // if ($record) {
        //     $records = [];
        //     foreach ($record->customPageData as $data) {
        //         $records[$data->key] = $data->value;
        //     }
        // }
        if (!$record) {
            abort(404);
        }
        return view('content',['page'=>$record]);
    }
}
