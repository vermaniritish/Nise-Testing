<?php

/**
 * Constituency Class
 *
 * @package    ConstituencyController


 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */


namespace App\Http\Controllers\Admin;
use App\Models\Admin\AdminAuth;
use App\Models\Admin\Gallery;
use App\Models\Admin\StatusActivities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Permissions;
use App\Models\Admin\Admins;
use Illuminate\Validation\Rule;
use App\Libraries\FileSystem;
use App\Http\Controllers\Admin\AppController;
use App\Models\Admin\Notices;
use App\Models\Admin\Grievances;
use PHPUnit\Framework\Error\Notice;


class GalleryController extends AppController
{
	function __construct()
	{
		parent::__construct();
	}

    function index(Request $request)
    {
    	if(!Permissions::hasPermission('gallery', 'listing'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$where = [];
    	if($request->get('search'))
    	{
    		$search = $request->get('search');
    		$search = '%' . $search . '%';
    		$where['(gallery.id LIKE ? or gallery.title LIKE ? or owner.first_name LIKE ? or owner.last_name LIKE ?)'] = [$search, $search, $search, $search];
    	}

    	if($request->get('created_on'))
    	{
    		$createdOn = $request->get('created_on');
    		if(isset($createdOn[0]) && !empty($createdOn[0]))
    			$where['gallery.created >= ?'] = [
    				date('Y-m-d 00:00:00', strtotime($createdOn[0]))
    			];
    		if(isset($createdOn[1]) && !empty($createdOn[1]))
    			$where['gallery.created <= ?'] = [
    				date('Y-m-d 23:59:59', strtotime($createdOn[1]))
    			];
    	}



    	if($request->get('admins'))
    	{
    		$admins = $request->get('admins');
    		$admins = $admins ? implode(',', $admins) : 0;
    		$where[] = 'gallery.created_by IN ('.$admins.')';
    	}

    	$listing = Gallery::getListing($request, $where);
    	if($request->ajax())
    	{
		    $html = view(
	    		"admin/gallery/listingLoop",
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
		}
		else
		{


	    	$admins = Admins::getAll(
	    		[
	    			'admins.id',
	    			'admins.first_name',
	    			'admins.last_name'
	    		],
	    		[
	    			'admins.status' => 1
	    		],
	    		'concat(admins.first_name, admins.last_name) desc'
	    	);
	    	/** Filter Data **/

	    	return view(
	    		"admin/gallery/index",
	    		[
	    			'listing' => $listing,

	    			'admins' => $admins
	    		]
	    	);
	    }
    }
    function add(Request $request)
    {
    	if(!Permissions::hasPermission('gallery', 'create'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	if($request->isMethod('post'))
    	{
    		$data = $request->toArray();
    		unset($data['_token']);

    		$validator = Validator::make(
	            $request->toArray(),
	            [
	                'title' => 'required|unique:gallery,title',
	                'image' => 'required'

	            ]
	        );

	        if(!$validator->fails())
	        {
	        	$gallery = Gallery::create($data);
	        	if($gallery)
	        	{
	        		$request->session()->flash('success', 'Video gallery created successfully.');
	        		return redirect()->route('admin.gallery');
	        	}
	        	else
	        	{
	        		$request->session()->flash('error', 'Video could not be save. Please try again.');
		    		return redirect()->back()->withErrors($validator)->withInput();
	        	}
		    }
		    else
		    {
		    	$request->session()->flash('error', 'Please provide valid inputs.');
		    	return redirect()->back()->withErrors($validator)->withInput();
		    }
		}



	    return view("admin/gallery/add");
    }

    function edit(Request $request, $id)
    {
    	if(!Permissions::hasPermission('gallery', 'update'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$gallery = Gallery::get($id);
    	if($gallery)
    	{
	    	if($request->isMethod('post'))
	    	{
	    		$data = $request->toArray();
	    		$validator = Validator::make(
		            $request->toArray(),
		            [
		                'title' => [
		                	'required',
		                	Rule::unique('gallery')->ignore($gallery->id)
		                ]
		            ]
		        );

		        if(!$validator->fails())
		        {
		        	unset($data['_token']);


		        	if(Gallery::modify($id, $data))
		        	{

		        		$request->session()->flash('success', 'Video gallery updated successfully.');
		        		return redirect()->route('admin.gallery');
		        	}
		        	else
		        	{
		        		$request->session()->flash('error', 'Category could not be save. Please try again.');
			    		return redirect()->back()->withErrors($validator)->withInput();
		        	}
			    }
			    else
			    {
			    	$request->session()->flash('error', 'Please provide valid inputs.');
			    	return redirect()->back()->withErrors($validator)->withInput();
			    }
			}


		    return view("admin/gallery/edit", [
		    		'gallery' => $gallery
	    		]);
		}
		else
		{
			abort(404);
		}
    }

    function delete(Request $request, $id)
    {
    	if(!Permissions::hasPermission('gallery', 'delete'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$gallery = Gallery::find($id);
    	if($gallery)
    	{
            $gallery->delete();
    		$request->session()->flash('success', 'Gallery deleted successfully.');
    		return redirect()->route('admin.gallery');
    	}
    	else
    	{
    		$request->session()->flash('error', 'Gallery could not be delete.');
    		return redirect()->route('admin.gallery');
    	}
    }

    function bulkActions(Request $request, $action)
    {
    	if( ($action != 'delete' && !Permissions::hasPermission('gallery', 'update')) || ($action == 'delete' && !Permissions::hasPermission('gallery', 'delete')) )
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$ids = $request->get('ids');
    	if(is_array($ids) && !empty($ids))
    	{
    		switch ($action) {
    			case 'delete':
    				Gallery::removeAll($ids);
    				$message = count($ids) . ' records has been deleted.';
    			break;
    		}

    		$request->session()->flash('success', $message);

    		return Response()->json([
    			'status' => 'success',
	            'message' => $message,
	        ], 200);
    	}
    	else
    	{
    		return Response()->json([
    			'status' => 'error',
	            'message' => 'Please select atleast one record.',
	        ], 200);
    	}
    }
}
