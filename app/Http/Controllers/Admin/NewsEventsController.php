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
use App\Models\Admin\NewsEvent;

class NewsEventsController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    function index(Request $request)
    {
        if (!Permissions::hasPermission('news_events', 'listing')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $where = [];
        if ($request->get('search')) {
            $search = $request->get('search');
            $search = '%' . $search . '%';
            $where['(news_events.id LIKE ? or news_events.title LIKE ? or news_events.description LIKE ?)'] = [$search, $search, $search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0]))
                $where['news_events.created >= ?'] = [
                    date('Y-m-d 00:00:00', strtotime($createdOn[0]))
                ];
            if (isset($createdOn[1]) && !empty($createdOn[1]))
                $where['news_events.created <= ?'] = [
                    date('Y-m-d 23:59:59', strtotime($createdOn[1]))
                ];
        }

        $listing = NewsEvent::getListing($request, $where);
        if ($request->ajax()) {
            $html = view(
                "admin/newsEvents/listingLoop",
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
                "admin/newsEvents/index",
                [
                    'listing' => $listing,
                ]
            );
        }
    }

    function add(Request $request){
        if (!Permissions::hasPermission('news_events', 'create')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        if ($request->isMethod('post')) {
            $data = $request->except('_token');

            $validator = Validator::make(
                $data,
                [
                    'title'     => ['required'],
                    'title_hi'  => ['required'],
                    // 'pdf_file'  => ['nullable', 'mimes:pdf', 'max:20480'], // 20MB max
                ]
            );

            if ($validator->fails()) {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // File Upload
            if ($request->hasFile('pdf_file')) {
                $file = $request->file('pdf_file');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;
                $path = $file->storeAs('uploads/news_events', $filename, 'public');
                $data['pdf_file'] = '/storage/' . $path;
            }

            $newsEvents = NewsEvent::create($data);
            if ($newsEvents) {
                $request->session()->flash('success', 'News event created successfully.');
                return redirect()->route('admin.newsEvents');
            } else {
                $request->session()->flash('error', 'Information could not be saved. Please try again.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        return view("admin/newsEvents/add");
    }
    
    function edit(Request $request, $id){
        if (!Permissions::hasPermission('news_events', 'update')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $newsEvents = NewsEvent::get($id);
        if (!$newsEvents) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $data = $request->except('_token');

            $validator = Validator::make(
                $data,
                [
                    'title'     => ['required'],
                    'date'      => ['required'],
                    'title_hi'  => ['required'],
                    // 'pdf_file'  => ['nullable', 'mimes:pdf', 'max:20480'],
                ]
            );

            if ($validator->fails()) {
                $request->session()->flash('error', 'Please provide valid inputs.');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // File Upload (optional)
            if ($request->hasFile('pdf_file')) {
                $file = $request->file('pdf_file');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;
                $path = $file->storeAs('uploads/news_events', $filename, 'public');
                $data['pdf_file'] = '/storage/' . $path;
            }

            if (NewsEvent::modify($id, $data)) {
                $request->session()->flash('success', 'News event updated successfully.');
                return redirect()->route('admin.newsEvents');
            } else {
                $request->session()->flash('error', 'Information could not be saved. Please try again.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        return view("admin/newsEvents/edit", [
            'newsEvents' => $newsEvents,
        ]);
    }

    // function edit(Request $request, $id)
    // {
    //     if (!Permissions::hasPermission('news_events', 'update')) {
    //         $request->session()->flash('error', 'Permission denied.');
    //         return redirect()->route('admin.dashboard');
    //     }

    //     $newsEvents  = NewsEvent::get($id);
    //     if ($newsEvents) {
    //         if ($request->isMethod('post')) {
    //             $data = $request->toArray();
    //             $validator = Validator::make(
    //                 $data,
    //                 [
    //                     'title' => ['required'],
    //                     'date' => ['required'],
    //                     // 'description' => ['required'],
    //                     'title_hi' => ['required'],
    //                     // 'description_hi' => ['required'],
    //                 ]
    //             );

    //             if (!$validator->fails()) {
    //                 unset($data['_token']);
    //                 if (NewsEvent::modify($id, $data)) {
    //                     $request->session()->flash('success', 'Slider menu  inforamtion updated.');
    //                     return redirect()->route('admin.newsEvents');
    //                 } else {
    //                     $request->session()->flash('error', 'Information could not be save. Please try again.');
    //                     return redirect()->back()->withErrors($validator)->withInput();
    //                 }
    //             } else {
    //                 $request->session()->flash('error', 'Please provide valid inputs.');
    //                 return redirect()->back()->withErrors($validator)->withInput();
    //             }
    //         }
    //         return view("admin/newsEvents/edit", [
    //             'newsEvents' => $newsEvents,
    //         ]);
    //     } else {
    //         abort(404);
    //     }
    // }

    public function view(Request $request, $id)
    {
        $newsEvents = NewsEvent::with('owner')->find($id);
        if ($newsEvents) {
            return view("admin/newsEvents/view", [
                'newsEvents' => $newsEvents,
            ]);
        } else {
            abort(404);
        }
    }


    public function delete(Request $request, $id)
    {
        if (!Permissions::hasPermission('news_events', 'delete')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $newsEvents = NewsEvent::find($id);
        if ($newsEvents) {
            if ($newsEvents->delete()) {
                $request->session()->flash('success', 'News event deleted successfully.');
                return redirect()->route('admin.newsEvents');
            } else {
                $request->session()->flash('error', 'Record could not be deleted.');
                return redirect()->route('admin.newsEvents');
            }
        } else {
            abort(404);
        }
    }

    function bulkActions(Request $request, $action)
    {
        if (($action != 'delete' && !Permissions::hasPermission('news_events', 'update')) || ($action == 'delete' && !Permissions::hasPermission('news_events', 'delete'))) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $ids = $request->get('ids');
        if (is_array($ids) && !empty($ids)) {
            switch ($action) {
                case 'delete':
                    foreach ($ids as $id) {
                        $newsEvents = NewsEvent::find($id);
                    }
                    NewsEvent::removeAll($ids);
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
