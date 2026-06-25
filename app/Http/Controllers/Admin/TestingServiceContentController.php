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
use App\Http\Controllers\Admin\AppController;
use App\Models\Admin\TestingService;
use App\Models\Admin\ServiceCategoryWiseTest;
use App\Models\Admin\TestServiceCategory;

class TestingServiceContentController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    function edit(Request $request, $slug)
    {
        if (!Permissions::hasPermission('testing_service_contents', 'update')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        $testServ  = TestingService::where('slug',$slug)->first();

        if ($testServ) {
            if ($request->isMethod('post')) {
                $data = $request->toArray();
                

                $validator = Validator::make(
                    $data,
                    [
                        'main_heading' => ['required'],
                        'main_heading_hi' => ['required'],
                        // 'title_hi' => ['required'],
                    ]
                );

                if (!$validator->fails()) {
                    unset($data['_token']);
                    if (isset($data['type_id']) && is_array($data['type_id'])) {
                        $data['type_id'] = json_encode($data['type_id']);
                    }
                    if (TestingService::modify($slug, $data)) {
                        $request->session()->flash('success', 'Testing service Content inforamtion updated.');
                        return redirect()->route('admin.testingServiceContent.edit',['slug' => $slug]);
                    } else {
                        $request->session()->flash('error', 'Information could not be save. Please try again.');
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                } else {
                    $request->session()->flash('error', 'Please provide valid inputs.');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
            $testServiceCategories = TestServiceCategory::getAll();
            return view("admin/testingServiceContent/edit", [
                'testServ' => $testServ,
                'testServiceCategories' => $testServiceCategories
            ]);
        } else {
            abort(404);
        }
    }
}
