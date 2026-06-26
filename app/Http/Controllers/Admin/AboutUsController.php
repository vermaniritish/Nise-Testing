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
use App\Models\Admin\AboutUs;
use App\Models\Admin\CustomPageData;

class AboutUsController extends AppController
{
	function __construct()
	{
		parent::__construct();
	}

    function edit(Request $request)
    {
        if (!Permissions::hasPermission('home_page', 'update')) {
            $request->session()->flash('error', 'Permission denied.');
            return redirect()->route('admin.dashboard');
        }

        if ($request->isMethod('post'))
        {
            $data = $request->except('_token');


            foreach ($data as $key => $value) {
                $aboutUsEntry = CustomPageData::where('key', $key)->first();
                if ($aboutUsEntry) {
                    // Update the existing record
                    $aboutUsEntry->value = $value;
                    $aboutUsEntry->save();
                } else {
                    // Create a new record
                    CustomPageData::create([
                        'key' => $key,
                        'value' => $value
                    ]);
                }
            }

            $request->session()->flash('success', 'About us page updated.');
            return redirect()->back();
        }

        // Prepare custom page data for rendering
        $aboutUsData = CustomPageData::all()->pluck('value', 'key')->toArray();
        $dataArray = [];
        foreach ($aboutUsData as $key => $value) {
            $dataArray[$key] = [
                'value' => $value,
            ];
        }

        return view("admin/aboutUs/edit", [
            'customPageData' => $dataArray
        ]);

    }

}
