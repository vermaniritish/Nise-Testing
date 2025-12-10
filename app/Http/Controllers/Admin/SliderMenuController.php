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
use App\Models\Admin\SliderMenu;

class SliderMenuController extends AppController
{
	function __construct()
	{
		parent::__construct();
	}

    function index(Request $request)
    {
    	if(!Permissions::hasPermission('slider_menu', 'listing'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$where = [];
    	if($request->get('search'))
    	{
    		$search = $request->get('search');
    		$search = '%' . $search . '%';
    		$where['(slider_menu.id LIKE ? or slider_menu.heading LIKE ? or slider_menu.description LIKE ?)'] = [$search ,$search , $search];
    	}

		$categories = $request->get('category');
    if ($categories && is_array($categories)) {
        $where[] = ['slider_menu.category', 'in', $categories];
    }

    	if($request->get('created_on'))
    	{
    		$createdOn = $request->get('created_on');
    		if(isset($createdOn[0]) && !empty($createdOn[0]))
    			$where['slider_menu.created >= ?'] = [
    				date('Y-m-d 00:00:00', strtotime($createdOn[0]))
    			];
    		if(isset($createdOn[1]) && !empty($createdOn[1]))
    			$where['slider_menu.created <= ?'] = [
    				date('Y-m-d 23:59:59', strtotime($createdOn[1]))
    			];
    	}

    	// if($request->get('admins'))
    	// {
    	// 	$admins = $request->get('admins');
    	// 	$admins = $admins ? implode(',', $admins) : 0;
    	// 	$where[] = 'slider_menu .created_by IN ('.$admins.')';
    	// }

    	$listing = SliderMenu::getListing($request, $where);
    	if($request->ajax())
    	{
		    $html = view(
	    		"admin/sliderMenu/listingLoop",
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
		}
		else
		{
	    	return view(
	    		"admin/sliderMenu/index",
	    		[
	    			'listing' => $listing,
                    'categories' => $categories 	    		]
	    	);
	    }
    }

    function add(Request $request)
    {
    	if(!Permissions::hasPermission('slider_menu', 'create'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	if($request->isMethod('post'))
    	{
    		$data = $request->toArray();
    		unset($data['_token']);
            // dd($data);
    		$validator = Validator::make(
	            $request->toArray(),
				[
                    'heading' => ['required'],
                    'heading_hi' => ['required'],
                    'image' => ['required'],
				]
	        );

	        if(!$validator->fails())
	        {
	        	$sliderMenu  = SliderMenu::create($data);
	        	if($sliderMenu )
	        	{
	        		$request->session()->flash('success', 'Slider menu  created.');
	        		// return redirect()->route('admin.sliderMenu');
                    return redirect()->route('admin.sliderMenu');
	        	}
	        	else
	        	{
	        		$request->session()->flash('error', 'Information could not be save. Please try again.');
		    		return redirect()->back()->withErrors($validator)->withInput();
	        	}
		    }
		    else
		    {
		    	$request->session()->flash('error', 'Please provide valid inputs.');
		    	return redirect()->back()->withErrors($validator)->withInput();
		    }
		}
	    return view("admin/sliderMenu/add");
    }

    function edit(Request $request, $id)
    {
    	if(!Permissions::hasPermission('slider_menu', 'update'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$sliderMenu  = SliderMenu::get($id);
    	if($sliderMenu )
    	{
	    	if($request->isMethod('post'))
	    	{
	    		$data = $request->toArray();
	    		$validator = Validator::make(
                    $request->toArray(),
                    [
                        'heading' => ['required'],
                        'heading_hi' => ['required'],
                        'image' => ['required'],
                    ]
                );
		        if(!$validator->fails())
		        {
					if(isset($data['image']) && $data['image'])
		        	{
		        		$oldImage = $sliderMenu ->image;
		        	}
		        	else
		        	{
		        		unset($data['image']);

		        	}
		        	unset($data['_token']);
		        	if(SliderMenu::modify($id, $data))
		        	{
		        		$request->session()->flash('success', 'Slider menu  inforamtion updated.');
                        return redirect()->route('admin.sliderMenu');

		        	}
		        	else
		        	{
		        		$request->session()->flash('error', 'Information could not be save. Please try again.');
			    		return redirect()->back()->withErrors($validator)->withInput();
		        	}
			    }
			    else
			    {
			    	$request->session()->flash('error', 'Please provide valid inputs.');
			    	return redirect()->back()->withErrors($validator)->withInput();
			    }
			}
		    return view("admin/sliderMenu/edit", [
		    		'page' => $sliderMenu
	    		]);
		}
		else
		{
			abort(404);
		}
    }

    function view(Request $request, $id)
    {
        if(!Permissions::hasPermission('slider_menu', 'listing'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}
        $sliderMenu = SliderMenu::find($id);
        if($sliderMenu)
        {
            return view("admin/sliderMenu/view", [
                'page' => $sliderMenu,
            ]);
        }
        else
        {
            abort(404);
        }
    }

    function delete(Request $request, $id)
    {
    	if(!Permissions::hasPermission('slider_menu', 'delete'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$admin = SliderMenu::find($id);
    	if($admin->delete())
    	{
    		$request->session()->flash('success', 'Slider menu  deleted successfully.');
    		return redirect()->route('admin.sliderMenu');
    	}
    	else
    	{
    		$request->session()->flash('error', 'Record could not be delete.');
    		return redirect()->route('admin.sliderMenu');
    	}
    }

    function bulkActions(Request $request, $action)
    {
    	if( ($action != 'delete' && !Permissions::hasPermission('slider_menu', 'update')) || ($action == 'delete' && !Permissions::hasPermission('slider_menu', 'delete')) )
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$ids = $request->get('ids');
    	if(is_array($ids) && !empty($ids))
    	{
    		switch ($action) {
    			case 'delete':
    				SliderMenu::removeAll($ids);
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
