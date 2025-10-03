<?php

namespace App\Models\Admin;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\FileSystem;
use Illuminate\Support\Str;
use App\Libraries\General;

class Enrollments extends AppModel
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function slot()
    {
        return $this->belongsTo(Slots::class, 'slot_id', 'id');
    }

    public function training()
    {
        return $this->belongsTo(Trainings::class, 'training_id', 'id');
    }

    public function batch()
    {
        return $this->belongsTo(Batches::class, 'batch_id', 'id');
    }

	public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public static function getListing(Request $request, $where = [])
    {
    	$orderBy = $request->get('sort') ? $request->get('sort') : 'enrollments.id';
    	$direction = $request->get('direction') ? $request->get('direction') : 'desc';
    	$page = $request->get('page') ? $request->get('page') : 1;
    	$limit = self::$paginationLimit;
    	$offset = ($page - 1) * $limit;

    	$listing = Enrollments::select([
	    		'enrollments.*',
                'owner.first_name as owner_first_name',
                'owner.last_name as owner_last_name'
	    	])
            ->leftJoin('admins as owner', 'owner.id', '=', 'enrollments.created_by')
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
    public static function getAll($select = [], $where = [], $orderBy = 'enrollments.id desc', $limit = null)
    {
    	$listing = Enrollments::orderByRaw($orderBy);

    	if(!empty($select))
    	{
    		$listing->select($select);
    	}
    	else
    	{
    		$listing->select([
    			'enrollments.*'
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
    	$record = Enrollments::where('id', $id)
            ->first();

	    return $record;
    }

    /**
    * To get single row by conditions
    * @param $where
    * @param $orderBy
    */
    public static function getRow($where = [], $orderBy = 'enrollments.id desc')
    {
    	$record = Enrollments::orderByRaw($orderBy);
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
    	$service = new Enrollments();

    	foreach($data as $k => $v)
    	{
    		$service->{$k} = $v;
    	}

    	$service->created = date('Y-m-d H:i:s');
    	$service->modified = date('Y-m-d H:i:s');
	    if($service->save())
	    {
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
    	$service = Enrollments::find($id);
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
    		return Enrollments::whereIn('enrollments.id', $ids)
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
    	$service = Enrollments::find($id);
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
    		return Enrollments::whereIn('enrollments.id', $ids)
		    		->delete();
	    }
	    else
	    {
	    	return null;
	    }

    }
}
