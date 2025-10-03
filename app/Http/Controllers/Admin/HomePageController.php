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
use App\Models\Admin\HomePage;
use App\Models\Admin\CustomPageData;

class HomePageController extends AppController
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
                $homePageEntry = CustomPageData::where('key', $key)->first();
                if ($homePageEntry) {
                    // Update the existing record
                    $homePageEntry->value = $value;
                    $homePageEntry->save();
                } else {
                    CustomPageData::create([
                        'key' => $key,
                        'value' => $value
                    ]);
                }
            }

            $request->session()->flash('success', 'Home page updated successfully.');
            return redirect()->back();
        }

        // Prepare custom page data for rendering
        $homePageData = CustomPageData::all()->pluck('value', 'key')->toArray();
        $dataArray = [];
        foreach ($homePageData as $key => $value) {
            $dataArray[$key] = [
                'value' => $value,
            ];
        }

        return view("admin/homePage/edit", [
            'customPageData' => $dataArray
        ]);

    }

}
