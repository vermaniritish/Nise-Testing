<?php

namespace App\Models\Admin;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\FileSystem;
use Illuminate\Support\Str;
use App\Libraries\General;

class Testimonial extends AppModel
{
    protected $table = 'testimonial';
    protected $primaryKey = 'id';
    public $timestamps = false;


    /**
    * Get resize images
    *
    * @return array
    */
    public function getResizeImagesAttribute()
    {
        return $this->image ? FileSystem::getAllSizeImages($this->image) : null;
    }
    
    /**
    * Blogs -> Admins belongsTO relation
    * 
    * @return Admins
    */
    public function constituency()
    {
        return $this->belongsTo(Constituency::class, 'constituency_id', 'id');
    }

    public function station()
    {
        return $this->belongsTo(PollingStation::class, 'polling_station_id', 'id');
    }

    /**
    * Blogs -> Admins belongsTO relation
    * 
    * @return Admins
    */
    public function owner()
    {
        return $this->belongsTo(Admins::class, 'created_by', 'id');
    }
    
    /**
    * To search and get pagination listing
    * @param Request $request
    * @param $limit
    */

    public static function getListing(Request $request, $where = [])
    {
    	$orderBy = $request->get('sort') ? $request->get('sort') : 'testimonial.id';
    	$direction = $request->get('direction') ? $request->get('direction') : 'desc';
    	$page = $request->get('page') ? $request->get('page') : 1;
    	$limit = self::$paginationLimit;
    	$offset = ($page - 1) * $limit;
    	
    	$listing = Testimonial::select([
	    		'testimonial.*',
                'owner.first_name as owner_first_name',
                'owner.last_name as owner_last_name'
	    	])
            ->leftJoin('admins as owner', 'owner.id', '=', 'testimonial.created_by')
	    	->orderBy($orderBy, $direction);
        if(!empty($where))
	    {
	    	foreach($where as $query => $values)
	    	{
	    		if(is_array($values))
	    			$listing->whereRaw($query, $values);
	    		elseif(!is_numeric($query))
	    			$listing->where($query, $values);
                else
                    $listing->whereRaw($values);
	    	}
	    }

	    // Put offset and limit in case of pagination
	    if($page !== null && $page !== "" && $limit !== null && $limit !== "")
	    {
	    	$listing->offset($offset);
	    	$listing->limit($limit);
	    }

	    $listing = $listing->paginate($limit);

	    return $listing;
    }

    /**
    * To get all records
    * @param $where
    * @param $orderBy
    * @param $limit
    */
    public static function getAll($select = [], $where = [], $orderBy = 'testimonial.id desc', $limit = null)
    {
    	$listing = Testimonial::orderByRaw($orderBy);

    	if(!empty($select))
    	{
    		$listing->select($select);
    	}
    	else
    	{
    		$listing->select([
    			'testimonial.*'
    		]);	
    	}

	    if(!empty($where))
	    {
	    	foreach($where as $query => $values)
	    	{
	    		if(is_array($values))
	    			$listing->whereRaw($query, $values);
	    		elseif(!is_numeric($query))
                    $listing->where($query, $values);
                else
                    $listing->whereRaw($values);
	    	}
	    }
	    
	    if($limit !== null && $limit !== "")
	    {
	    	$listing->limit($limit);
	    }

        $listing->orderByRaw($orderBy);

	    $listing = $listing->get();

	    return $listing;
    }

    /**
    * To get single record by id
    * @param $id
    */
    public static function get($id)
    {
    	$record = Testimonial::where('id', $id)
            ->first();

	    return $record;
    }

    /**
    * To get single row by conditions
    * @param $where
    * @param $orderBy
    */
    public static function getRow($where = [], $orderBy = 'testimonial.id desc')
    {
    	$record = Testimonial::orderByRaw($orderBy);
	    foreach($where as $query => $values)
	    {
	    	if(is_array($values))
                $record->whereRaw($query, $values);
            elseif(!is_numeric($query))
                $record->where($query, $values);
            else
                $record->whereRaw($values);
	    }
	    
	    $record = $record->limit(1)->first();

	    return $record;
    }

    /**
    * To insert
    * @param $where
    * @param $orderBy
    */
    public static function create($data)
    {
    	$service = new Testimonial();

    	foreach($data as $k => $v)
    	{
    		$service->{$k} = $v;
    	}

        $service->created_by = AdminAuth::getLoginId();
    	$service->created = date('Y-m-d H:i:s');
    	$service->modified = date('Y-m-d H:i:s');
	    if($service->save())
	    {
            if(isset($data['title']) && $data['title'])
            {
                $service->slug = Str::slug($service->title) . '-' . General::encode($service->id);
                $service->save();
            }
	    	return $service;
	    }
	    else
	    {
	    	return null;
	    }
    }

    /**
    * To update
    * @param $id
    * @param $where
    */
    public static function modify($id, $data)
    {
    	$service = Testimonial::find($id);
    	foreach($data as $k => $v)
    	{
    		$service->{$k} = $v;
    	}

    	$service->modified = date('Y-m-d H:i:s');
	    if($service->save())
	    {
            if(isset($data['title']) && $data['title'])
            {
                $service->slug = Str::slug($service->title) . '-' . General::encode($service->id);
                $service->save();
            }
	    	return $service;
	    }
	    else
	    {
	    	return null;
	    }
    }

    
    /**
    * To update all
    * @param $id
    * @param $where
    */
    public static function modifyAll($ids, $data)
    {
    	if(!empty($ids))
    	{
    		return Testimonial::whereIn('testimonial.id', $ids)
		    		->update($data);
	    }
	    else
	    {
	    	return null;
	    }

    }

    /**
    * To delete
    * @param $id
    */
    public static function remove($id)
    {
    	$service = Testimonial::find($id);
    	return $service->delete();
    }

    /**
    * To delete all
    * @param $id
    * @param $where
    */
    public static function removeAll($ids)
    {
    	if(!empty($ids))
    	{
    		return Testimonial::whereIn('testimonial.id', $ids)
		    		->delete();
	    }
	    else
	    {
	    	return null;
	    }

    }
}