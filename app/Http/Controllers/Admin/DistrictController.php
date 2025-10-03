<?php

/**
 * district Class
 *
 * @package    DistrictController
 * @copyright  2023
 * @author     Irfan Ahmad <irfanahmed1555@gmail.com>
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Admin\Permissions;
use App\Models\Admin\State;
use App\Models\Admin\District;

use App\Trait\Location;

class DistrictController extends AppController
{

	function __construct()
	{
		parent::__construct();
	}

    function index(Request $request)
    {
    	if(!Permissions::hasPermission('district', 'listing'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$where = [];
    	if($request->get('search'))
    	{
    		$search = $request->get('search');
    		$search = '%' . $search . '%';
    		$where['( 
    			states.name LIKE ? 
    			or 
    			district.title LIKE ?
    		)'] = [$search,$search,$search];
    	}

    	if($request->get('status') !== "" && $request->get('status') !== null)
    	{    		
    		$where['district.status'] = $request->get('status');
    	}

    	if($request->get('created_on'))
    	{
    		$createdOn = $request->get('created_on');
    		if(isset($createdOn[0]) && !empty($createdOn[0]))
    			$where['district.created_at >= ?'] = [
    				date('Y-m-d 00:00:00', strtotime($createdOn[0]))
    			];
    		if(isset($createdOn[1]) && !empty($createdOn[1]))
    			$where['district.created_at <= ?'] = [
    				date('Y-m-d 23:59:59', strtotime($createdOn[1]))
    			];
    	}

    	$listing = District::getListing($request, $where);

    	if($request->ajax())
    	{
		    $html = view(
	    		"admin/district/listingLoop", 
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
	    	return view(
	    		"admin/district/index", 
	    		[
	    			'listing' => $listing
	    		]
	    	);
	    }
    }

    function add(Request $request)
    {
    	if(!Permissions::hasPermission('district', 'create'))
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
	                'name' => [
                        'required'
                    ]	 
	            ]
	        );

	        if(!$validator->fails())
	        {
	        	$district = District::create($data);
	        	if($district)
	        	{
	        		$request->session()->flash('success', 'District created successfully.');
	        		return redirect()->route('admin.district');
	        	}
	        	else
	        	{
	        		$request->session()->flash('error', 'District could not be save. Please try again.');
		    		return redirect()->back()->withErrors($validator)->withInput();
	        	}
		    }
		    else
		    {
		    	$request->session()->flash('error', current( current( $validator->errors()->getMessages() ) ));
		    	return redirect()->back()->withErrors($validator)->withInput();
		    }
		}

		$states = State::getAll();

	    return view("admin/district/add", [
	    	'states' => $states
	    ]);
    }

    function view(Request $request, $id)
    {
    	if(!Permissions::hasPermission('district', 'listing'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$district = District::get($id);
    	if($district)
    	{
	    	return view("admin/district/view", [
    			'district' => $district
    		]);
		}
		else
		{
			abort(404);
		}
    }

    function edit(Request $request, $id)
    {
    	if(!Permissions::hasPermission('district', 'update'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$district = District::get($id);

    	if($district)
    	{
	    	if($request->isMethod('post'))
	    	{
	    		$data = $request->toArray();
	    		$validator = Validator::make(
		            $request->toArray(),
		            [
		                'name' => [
	                        'required'
	                    ]	 		                
		            ]
		        );

		        if(!$validator->fails())
		        {
		        	unset($data['_token']);

		        	if(District::modify($id, $data))
		        	{
		        		$request->session()->flash('success', 'District updated successfully.');
		        		return redirect()->route('admin.district');
		        	}
		        	else
		        	{
		        		$request->session()->flash('error', 'district could not be save. Please try again.');
			    		return redirect()->back()->withErrors($validator)->withInput();
		        	}
			    }
			    else
			    {
			    	$request->session()->flash('error', current( current( $validator->errors()->getMessages() ) ));
			    	return redirect()->back()->withErrors($validator)->withInput();
			    }
			}
			$states = State::getAll();

			return view("admin/district/edit", [
    			'district' => $district,
    			'states' => $states,

    		]);
		}
		else
		{
			abort(404);
		}
    }

    function delete(Request $request, $id)
    {
    	if(!Permissions::hasPermission('district', 'delete'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$admin = District::find($id);
    	if($admin->delete())
    	{
    		$request->session()->flash('success', 'district deleted successfully.');
    		return redirect()->route('admin.district');
    	}
    	else
    	{
    		$request->session()->flash('error', 'district could not be delete.');
    		return redirect()->route('admin.district');
    	}
    }

    function bulkActions(Request $request, $action)
    {
    	if( ($action != 'delete' && !Permissions::hasPermission('district', 'update')) || ($action == 'delete' && !Permissions::hasPermission('district', 'delete')) )
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$ids = $request->get('ids');
    	if(is_array($ids) && !empty($ids))
    	{
    		switch ($action) {
    			case 'active':
    				District::modifyAll($ids, [
    					'status' => 1
    				]);
    				$message = count($ids) . ' records has been published.';
    			break;
    			case 'inactive':
    				District::modifyAll($ids, [
    					'status' => 0
    				]);
    				$message = count($ids) . ' records has been unpublished.';
    			break;
    			case 'delete':
    				District::removeAll($ids);
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
