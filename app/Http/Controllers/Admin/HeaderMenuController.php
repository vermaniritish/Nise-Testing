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
use App\Models\Admin\HeaderMenu;

class HeaderMenuController extends AppController
{
	function __construct()
	{
		parent::__construct();
	}

    function index(Request $request)
    {
    	if(!Permissions::hasPermission('header_menu', 'listing'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$where = [];
    	if($request->get('search'))
    	{
    		$search = $request->get('search');
    		$search = '%' . $search . '%';
    		$where['(header_menu.id LIKE ? or header_menu.key LIKE ? or header_menu.value LIKE ?)'] = [ $search, $search, $search];
    	}

    	if($request->get('created_on'))
    	{
    		$createdOn = $request->get('created_on');
    		if(isset($createdOn[0]) && !empty($createdOn[0]))
    			$where['header_menu.created >= ?'] = [
    				date('Y-m-d 00:00:00', strtotime($createdOn[0]))
    			];
    		if(isset($createdOn[1]) && !empty($createdOn[1]))
    			$where['header_menu.created <= ?'] = [
    				date('Y-m-d 23:59:59', strtotime($createdOn[1]))
    			];
    	}

    	// if($request->get('admins'))
    	// {
    	// 	$admins = $request->get('admins');
    	// 	$admins = $admins ? implode(',', $admins) : 0;
    	// 	$where[] = 'header_menu.created_by IN ('.$admins.')';
    	// }

    	$listing = HeaderMenu::getListing($request, $where);
    	if($request->ajax())
    	{
		    $html = view(
	    		"admin/headerMenu/listingLoop",
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
	    		"admin/headerMenu/index",
	    		[
	    			'listing' => $listing,
				]
	    	);
	    }
    }

    function add(Request $request)
    {
    	if(!Permissions::hasPermission('header_menu', 'create'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	if($request->isMethod('post'))
    	{
    		$data = $request->toArray();
    		unset($data['_token']);
    		$validator = Validator::make(
                $data,
                [
                    'title' => ['required', 'regex:/^\S.*$/', Rule::unique('header_menu', 'key')],
                    'link' => ['required', 'regex:/^\S.*$/'],
                ]
	        );

	        if(!$validator->fails())
	        {
                $payload['key']=$data['title'];
                $payload['value']=$data['link'];
	        	$headerMenu = HeaderMenu::create($payload);
	        	if($headerMenu)
	        	{
                    $request->session()->flash('success', 'Footer mneu created successfully.');
	        		return redirect()->route('admin.headerMenu');
	        	}
	        	else
	        	{
                    $request->session()->flash('error', 'Footer mneu could not be save. Please try again.');
		    		return redirect()->back()->withErrors($validator)->withInput();
	        	}
		    }
		    else
		    {
                $request->session()->flash('error', 'Page could not be save. Please try again.');
                return redirect()->back()->withErrors($validator)->withInput();
		    }
		}
	    return view("admin/headerMenu/add");
    }

    function edit(Request $request, $id)
    {
    	if(!Permissions::hasPermission('header_menu', 'update'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$headerMenu = HeaderMenu::get($id);
    	if($headerMenu)
    	{
	    	if($request->isMethod('post'))
	    	{
	    		$data = $request->toArray();
	    		$validator = Validator::make(
					$request->toArray(),
				   [
	                 'title' => ['required', 'regex:/^\S.*$/', Rule::unique('header_menu', 'key')->ignore($headerMenu)],
                     'link' => ['required', 'regex:/^\S.*$/'],
	               ]
		        );
		        if(!$validator->fails())
		        {
		        	unset($data['_token']);
                    $payload['key']=$data['title'];
                    $payload['value']=$data['link'];
		        	if(HeaderMenu::modify($id, $payload))
		        	{
		        		$request->session()->flash('success', 'Header menu inforamtion updated.');
		        		return redirect()->route('admin.headerMenu.view', ['id' => $id]);
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
		    return view("admin/headerMenu/edit", [
		    		'page' => $headerMenu
	    		]);
		}
		else
		{
			abort(404);
		}
    }

    function view(Request $request, $id)
    {
        $headerMenu = HeaderMenu::find($id);
        if($headerMenu)
        {
            return view("admin/headerMenu/view", [
                'page' => $headerMenu,
            ]);
        }
        else
        {
            abort(404);
        }
    }

    function delete(Request $request, $id)
    {
    	if(!Permissions::hasPermission('header_menu', 'delete'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$headerMenu = HeaderMenu::find($id);
    	if($headerMenu->delete())
    	{
    		$request->session()->flash('success', 'Header menu deleted successfully.');
    		return redirect()->route('admin.headerMenu');
    	}
    	else
    	{
    		$request->session()->flash('error', 'Record could not be delete.');
    		return redirect()->route('admin.headerMenu');
    	}
    }

    function bulkActions(Request $request, $action)
    {
    	if( ($action != 'delete' && !Permissions::hasPermission('header_menu', 'update')) || ($action == 'delete' && !Permissions::hasPermission('header_menu', 'delete')) )
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$ids = $request->get('ids');
    	if(is_array($ids) && !empty($ids))
    	{
    		switch ($action) {
    			case 'delete':
    				HeaderMenu::removeAll($ids);
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
