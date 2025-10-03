<?php

namespace App\Models\PartnerAdmin;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\FileSystem;
use Illuminate\Support\Str;
use App\Libraries\General;

class Batche extends AppModel
{
    protected $table = 'batches';
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

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id', 'id');
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
    	$orderBy = $request->get('sort') ? $request->get('sort') : 'batches.id';
    	$direction = $request->get('direction') ? $request->get('direction') : 'desc';
    	$page = $request->get('page') ? $request->get('page') : 1;
    	$limit = self::$paginationLimit;
    	$offset = ($page - 1) * $limit;

    	$listing = Batche::select([
	    		'batches.*',
                'owner.first_name as owner_first_name',
                'owner.last_name as owner_last_name',
                'center.title as center_title',
                'user.organisation_name as user_organisation_name',
	    	])
            ->leftJoin('admins as owner', 'owner.id', '=', 'batches.created_by')
            ->leftJoin('centers as center', 'center.id', '=', 'batches.center_id')
            ->leftJoin('users as user', 'user.id', '=', 'batches.institute_id')
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
    public static function getAll($select = [], $where = [], $orderBy = 'batches.id desc', $limit = null)
    {
    	$listing = Batche::orderByRaw($orderBy);

    	if(!empty($select))
    	{
    		$listing->select($select);
    	}
    	else
    	{
    		$listing->select([
    			'batches.*'
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
    	$record = Batche::where('id', $id)
            ->first();

	    return $record;
    }

    /**
    * To get single row by conditions
    * @param $where
    * @param $orderBy
    */
    public static function getRow($where = [], $orderBy = 'batches.id desc')
    {
    	$record = Batche::orderByRaw($orderBy);
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
    	$service = new Batche();

    	foreach($data as $k => $v)
    	{
    		$service->{$k} = $v;
    	}

        $service->created_by = Auth::user()->id;
    	$service->created = date('Y-m-d H:i:s');
    	$service->updated = date('Y-m-d H:i:s');
	    if($service->save())
	    {
            if(isset($data['name']) && $data['name'])
            {
                $service->slug = Str::slug($service->name) . '-' . General::encode($service->id);
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
    	$service = Batche::find($id);
    	foreach($data as $k => $v)
    	{
    		$service->{$k} = $v;
    	}

    	$service->updated = date('Y-m-d H:i:s');
	    if($service->save())
	    {
            if(isset($data['name']) && $data['name'])
            {
                $service->slug = Str::slug($service->name) . '-' . General::encode($service->id);
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
    		return Batche::whereIn('batches.id', $ids)
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
    	$service = Batche::find($id);
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
    		return Batche::whereIn('batches.id', $ids)
		    		->delete();
	    }
	    else
	    {
	    	return null;
	    }

    }
}
