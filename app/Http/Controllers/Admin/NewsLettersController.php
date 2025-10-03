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
use App\Models\Admin\NewsLetter;

class NewsLettersController extends AppController
{
	function __construct()
	{
		parent::__construct();
	}

    function index(Request $request)
    {
    	if(!Permissions::hasPermission('news_letters', 'listing'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$where = [];
    	if($request->get('search'))
    	{
    		$search = $request->get('search');
    		$search = '%' . $search . '%';
    		$where['(news_letters.id LIKE ? or news_letters.email LIKE ?)'] = [$search, $search];
    	}

    	if($request->get('created_on'))
    	{
    		$createdOn = $request->get('created_on');
    		if(isset($createdOn[0]) && !empty($createdOn[0]))
    			$where['news_letters.created >= ?'] = [
    				date('Y-m-d 00:00:00', strtotime($createdOn[0]))
    			];
    		if(isset($createdOn[1]) && !empty($createdOn[1]))
    			$where['news_letters.created <= ?'] = [
    				date('Y-m-d 23:59:59', strtotime($createdOn[1]))
    			];
    	}

    	// if($request->get('admins'))
    	// {
    	// 	$admins = $request->get('admins');
    	// 	$admins = $admins ? implode(',', $admins) : 0;
    	// 	$where[] = 'news_letters.created_by IN ('.$admins.')';
    	// }

    	$listing = NewsLetter::getListing($request, $where);
    	if($request->ajax())
    	{
		    $html = view(
	    		"admin/newsLetter/listingLoop",
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
	    		"admin/newsLetter/index",
	    		[
	    			'listing' => $listing,
				]
	    	);
	    }
    }

    function add1(Request $request)
    {
        dd('hitting');
    	if(!Permissions::hasPermission('news_letters', 'create'))
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
					'email' => ['required', 'regex:/^\S.*$/'],

				]
	        );

	        if(!$validator->fails())
	        {
	        	$news_letters = NewsLetter::create($data);
	        	if($news_letters)
	        	{
                 return response()->json("Created", 200, []);

	        	}
	        	else
	        	{
                 return response()->json("Information could not be save. Please try again.", 200, []);

	        	}
		    }
		    else
		    {
                 return response()->json([], 200, []);
		    }

            return response()->json("Done", 200, []);
    }
}
function add(Request $request)
{


    // Process only POST method requests
    if ($request->isMethod('post')) {
        // Validate the input data
        $validator = Validator::make(
            $request->toArray(),
            [
                'email' => ['required', 'regex:/^\S.*$/', 'email', 'unique:news_letters,email'],
            ],
            [
                'email.unique' => 'You have already subscribed.',
            ]
        );

        if ($validator->fails()) {
            // If validation fails, return the error messages
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }

        // If validation passes, create the record
        $news_letters = NewsLetter::create($request->only('email'));

        if ($news_letters) {
            return response()->json([
                'status' => true,
                'message' => 'Thank you for subscribe.',
            ], 201); // 201 Created
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Information could not be saved. Please try again.',
            ], 500); // 500 Internal Server Error
        }
    }

    // Return a default response if the request is not a POST request
    return response()->json([
        'status' => false,
        'message' => 'Invalid request method.',
    ], 405); // 405 Method Not Allowed
}


    function edit(Request $request, $id)
    {
    	if(!Permissions::hasPermission('news_letters', 'update'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$news_letters = NewsLetter::get($id);
    	if($news_letters)
    	{
	    	if($request->isMethod('post'))
	    	{
	    		$data = $request->toArray();
	    		$validator = Validator::make(
					$request->toArray(),
				   [
                    'name' => ['required', 'regex:/^\S.*$/'],
					//'image' => ['required']
	               ]
		        );
		        if(!$validator->fails())
		        {
					if(isset($data['image']) && $data['image'])
		        	{
		        		$oldImage = $news_letters->image;
		        	}
		        	else
		        	{
		        		unset($data['image']);

		        	}
		        	unset($data['_token']);
		        	if(NewsLetter::modify($id, $data))
		        	{
		        		$request->session()->flash('success', 'About us inforamtion updated.');
		        		return redirect()->route('admin.newsLetter.view', ['id' => $id]);
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
		    return view("admin/newsLetter/edit", [
		    		'page' => $news_letters
	    		]);
		}
		else
		{
			abort(404);
		}
    }

    function view(Request $request, $id)
    {
        $news_letters = NewsLetter::find($id);
        if($news_letters)
        {
            return view("admin/newsLetter/view", [
                'page' => $news_letters,
            ]);
        }
        else
        {
            abort(404);
        }
    }

    function delete(Request $request, $id)
    {
    	if(!Permissions::hasPermission('news_letters', 'delete'))
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$admin = NewsLetter::find($id);
    	if($admin->delete())
    	{
    		$request->session()->flash('success', 'About us deleted successfully.');
    		return redirect()->route('admin.newsLetter');
    	}
    	else
    	{
    		$request->session()->flash('error', 'Record could not be delete.');
    		return redirect()->route('admin.newsLetter');
    	}
    }

    function bulkActions(Request $request, $action)
    {
    	if( ($action != 'delete' && !Permissions::hasPermission('news_letters', 'update')) || ($action == 'delete' && !Permissions::hasPermission('news_letters', 'delete')) )
    	{
    		$request->session()->flash('error', 'Permission denied.');
    		return redirect()->route('admin.dashboard');
    	}

    	$ids = $request->get('ids');
    	if(is_array($ids) && !empty($ids))
    	{
    		switch ($action) {
    			case 'delete':
    				NewsLetter::removeAll($ids);
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
