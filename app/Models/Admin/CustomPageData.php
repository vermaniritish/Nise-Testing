<?php

namespace App\Models\Admin;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Libraries\General;

class CustomPageData extends AppModel
{
    protected $table = 'custom_page_data';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $guraded=[];


    public static function create($data)
    {
    	$service = new CustomPageData();

    	foreach($data as $k => $v)
    	{
    		$service->{$k} = $v;
    	}

        // $service->created_by = AdminAuth::getLoginId();
    	// $service->created = date('Y-m-d H:i:s');
    	// $service->modified = date('Y-m-d H:i:s');
	    if($service->save())
	    {
            // if(isset($data['heading']) && $data['heading'])
            // {
            //     $service->slug = Str::slug($service->title) . '-' . General::encode($service->id);
            //     $service->save();
            // }
	    	// return $service;
	    }
	    else
	    {
	    	return null;
	    }
    }

	public static function get($key)
    {
    	return self::where('key', $key)->limit(1)->pluck('value')->first();
    }

}
