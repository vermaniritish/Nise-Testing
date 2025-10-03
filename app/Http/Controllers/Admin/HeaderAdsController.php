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
use App\Models\Admin\HeaderAds;
use App\Models\Admin\SliderMenu;

class HeaderAdsController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    function index(Request $request)
    {
        if (!Permissions::hasPermission('header_ads', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $where = [];
        if ($request->get('search')) {
            $search = $request->get('search');
            $search = '%' . $search . '%';
            $where['(header_ads.id LIKE ? or header_ads.title LIKE ?)'] = [$search, $search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0]))
                $where['header_ads.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            if (isset($createdOn[1]) && !empty($createdOn[1]))
                $where['header_ads.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
        }

        $listing = HeaderAds::getListing($request, $where);
        if ($request->ajax()) {
            $html = view(
                "admin/headerAds/listingLoop",
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
                "admin/headerAds/index",
                [
                    'listing' => $listing,
                ]
            );
        }
    }

    function add(Request $request)
    {
        if (!Permissions::hasPermission('header_ads', 'create')) {
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

            if (!$validator->fails()) {
                $headerAds  = HeaderAds::create($data);
                if ($headerAds) {
                    $request->session()->flash('success', 'Header Ads created succesfully.');
                    return redirect()->route('admin.headerAds');
                } else {
                    $request->session()->flash('error', 'Information could not be save. Please try again.');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            } else {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        return view("admin/headerAds/add");
    }

    function edit(Request $request, $id)
    {
        if (!Permissions::hasPermission('header_ads', 'update')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $headerAds  = HeaderAds::get($id);
        if ($headerAds) {
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

                if (!$validator->fails()) {
                    unset($data['_token']);
                    if (HeaderAds::modify($id, $data)) {
                        $request->session()->flash('success', 'Header Ads menu  inforamtion updated.');
                        return redirect()->route('admin.headerAds');
                    } else {
                        $request->session()->flash('error', 'Information could not be save. Please try again.');
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                } else {
                    $request->session()->flash('error', 'Please provide valid inputs.');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
            return view("admin/headerAds/edit", [
                'page' => $headerAds,
            ]);
        } else {
            abort(404);
        }
    }

    public function view(Request $request, $id)
    {
        $headerAds = HeaderAds::with('owner')->find($id);
        if ($headerAds) {
            return view("admin/headerAds/view", [
                'page' => $headerAds,
            ]);
        } else {
            abort(404);
        }
    }


    public function delete(Request $request, $id)
    {
        if (!Permissions::hasPermission('header_ads', 'delete')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $headerAds = HeaderAds::find($id);
        if ($headerAds) { // This removes the pivot table entries
            if ($headerAds->delete()) {
                $request->session()->flash('success', 'Header Ads deleted successfully.');
                return redirect()->route('admin.headerAds');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('admin.headerAds');
            }
        } else {
            abort(404);
        }
    }


    function bulkActions(Request $request, $action)
    {
        if (($action != 'delete' && !Permissions::hasPermission('header_ads', 'update')) || ($action == 'delete' && !Permissions::hasPermission('header_ads', 'delete'))) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $ids = $request->get('ids');
        if (is_array($ids) && !empty($ids)) {
            switch ($action) {
                case 'delete':
                    foreach ($ids as $id) {
                        $headerAds = HeaderAds::find($id);
                        if ($headerAds) {
                            $headerAds->categories()->detach(); // Detach categories from the Header Ads
                        }
                    }
                    HeaderAds::removeAll($ids);
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
}
