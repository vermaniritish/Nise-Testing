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
use App\Models\Admin\ContactUs;

class ContactUsController extends AppController
{
	function __construct()
	{
		parent::__construct();
	}

    function index(Request $request)
    {
    	if(!Permissions::hasPermission('contact_us', 'listing'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$where = [];
    	if($request->get('search'))
    	{
    		$search = $request->get('search');
    		$search = '%' . $search . '%';
    		$where['(contact_us.id LIKE ? or contact_us.name LIKE ? or contact_us.email LIKE ? or contact_us.phone_number LIKE ? or contact_us.message LIKE ?)'] = [$search ,$search , $search, $search, $search];
    	}

    	if($request->get('created_on'))
    	{
    		$createdOn = $request->get('created_on');
    		if(isset($createdOn[0]) && !empty($createdOn[0]))
    			$where['contact_us.created >= ?'] = [
    				date('Y-m-d 00:00:00', strtotime($createdOn[0]))
    			];
    		if(isset($createdOn[1]) && !empty($createdOn[1]))
    			$where['contact_us.created <= ?'] = [
    				date('Y-m-d 23:59:59', strtotime($createdOn[1]))
    			];
    	}

    	// if($request->get('admins'))
    	// {
    	// 	$admins = $request->get('admins');
    	// 	$admins = $admins ? implode(',', $admins) : 0;
    	// 	$where[] = 'contact_us.created_by IN ('.$admins.')';
    	// }

    	$listing = ContactUs::getListing($request, $where);
    	if($request->ajax())
    	{
		    $html = view(
	    		"admin/contactUs/listingLoop",
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
	    		"admin/contactUs/index",
	    		[
	    			'listing' => $listing,
				]
	    	);
	    }
    }

    function add(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->toArray();
    		unset($data['_token']);
            unset($data['submit']);
    		$validator = Validator::make(
                $data,
                [
                    'name' => ['required', 'regex:/^\S.*$/'],
                    'email' => ['required', 'email:rfc,dns'],
                    'phone_number' => ['required', 'regex:/^\d{10}$/'], // Exactly 10 digits
                    'message' => ['required'],
                    'subject' => ['required'],
                ],
                [
                    'name.regex' => 'The name must not start with whitespace.',
                    'email.email' => 'The email must be a valid email address.',
                    'phone_number.regex' => 'The phone number must be exactly 10 digits.',
                    'message.required' => 'The message field is required.',
                    'subject.required' => 'The subject field is required.',
                ]
            );

	        if(!$validator->fails())
	        {
	        	$record = ContactUs::create($data);
	        	if($record)
	        	{
                    $request->session()->flash('success', 'Thank you for contacting us. We will contact you within 24-48 hours.');
                    return redirect()->back();
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

	    return view("admin/contactUs/add", [
	    		// 'constituencies' => $constituencies
    		]);
    }

    function edit(Request $request, $id)
    {
    	if(!Permissions::hasPermission('contact_us', 'update'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$contactUs = ContactUs::get($id);
    	if($contactUs)
    	{
	    	if($request->isMethod('post'))
	    	{
	    		$data = $request->toArray();
	    		$validator = Validator::make(
					$request->toArray(),
				   [
	                 'name' => ['required', 'regex:/^\S.*$/', Rule::unique('contact_us', 'name')->ignore($contactUs)],
                     'designation' => ['required', 'regex:/^\S.*$/'],
					 'rating' => ['required', 'numeric', 'between:1,5'],
                     'description' => ['required', 'regex:/^\S.*$/'],
                     'image' => ['required', 'regex:/^\S.*$/']
	               ]
		        );
		        if(!$validator->fails())
		        {
		        	unset($data['_token']);
		        	if(ContactUs::modify($id, $data))
		        	{
		        		$request->session()->flash('success', 'Contact us inforamtion updated.');
		        		return redirect()->route('admin.contact_us.view', ['id' => $id]);
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
		    return view("admin/contactUs/edit", [
		    		'page' => $contactUs
	    		]);
		}
		else
		{
			abort(404);
		}
    }

    function view(Request $request, $id)
    {
        if(!Permissions::hasPermission('contact_us', 'listing'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}
        $contactUs = ContactUs::find($id);
        if($contactUs)
        {
            return view("admin/contactUs/view", [
                'page' => $contactUs,
            ]);
        }
        else
        {
            abort(404);
        }
    }

    function delete(Request $request, $id)
    {
    	if(!Permissions::hasPermission('contact_us', 'delete'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$contactUs = ContactUs::find($id);
    	if($contactUs->delete())
    	{
    		$request->session()->flash('success', 'contact_us deleted successfully.');
    		return redirect()->route('admin.contactUs');
    	}
    	else
    	{
    		$request->session()->flash('error', 'Record could not be delete.');
    		return redirect()->route('admin.contactUs');
    	}
    }

    function bulkActions(Request $request, $action)
    {
    	if( ($action != 'delete' && !Permissions::hasPermission('contact_us', 'update')) || ($action == 'delete' && !Permissions::hasPermission('contact_us', 'delete')) )
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$ids = $request->get('ids');
    	if(is_array($ids) && !empty($ids))
    	{
    		switch ($action) {
    			case 'delete':
    				ContactUs::removeAll($ids);
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
