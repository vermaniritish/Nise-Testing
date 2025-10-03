<?php

namespace App\Models\Admin;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\FileSystem;
use Illuminate\Support\Str;
use App\Libraries\General;

class VideoGallery extends AppModel
{
    protected $table = 'video_gallery';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function getListing(Request $request, $where = [])
    {
    	$orderBy = $request->get('sort') ? $request->get('sort') : 'video_gallery.id';
    	$direction = $request->get('direction') ? $request->get('direction') : 'desc';
    	$page = $request->get('page') ? $request->get('page') : 1;
    	$limit = self::$paginationLimit;
    	$offset = ($page - 1) * $limit;

    	$listing = VideoGallery::select([
	    		'video_gallery.*',
                'owner.first_name as owner_first_name',
                'owner.last_name as owner_last_name',
	    	])
            ->leftJoin('admins as owner', 'owner.id', '=', 'video_gallery.created_by')
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
    public static function getAll($select = [], $where = [], $orderBy = 'video_gallery.id desc', $limit = null)
    {
    	$listing = VideoGallery::orderByRaw($orderBy);

    	if(!empty($select))
    	{
    		$listing->select($select);
    	}
    	else
    	{
    		$listing->select([
    			'video_gallery.*'
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
    * To get all records
    * @param $where
    * @param $orderBy
    * @param $limit
    */

    /**
    * To get single record by id
    * @param $id
    */
    public static function get($id)
    {
    	$record = VideoGallery::where('id', $id)

            ->first();

	    return $record;
    }

    /**
    * To get single row by conditions
    * @param $where
    * @param $orderBy
    */
    public static function getRow($where = [], $orderBy = 'video_gallery.id desc')
    {
    	$record = VideoGallery::orderByRaw($orderBy);
        $record->with([
                'parent' => function($query) {
                    $query->select(['id', 'title']);
                }
            ]);
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
    	$gallery = new VideoGallery();

    	foreach($data as $k => $v)
    	{
    		$gallery->{$k} = $v;
    	}

        $gallery->created_by = AdminAuth::getLoginId();
    	$gallery->created = date('Y-m-d H:i:s');
    	$gallery->modified = date('Y-m-d H:i:s');
	    if($gallery->save())
	    {

	    	return $gallery;
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
    	$gallery = VideoGallery::find($id);
    	foreach($data as $k => $v)
    	{
    		$gallery->{$k} = $v;
    	}

    	$gallery->modified = date('Y-m-d H:i:s');
	    if($gallery->save())
	    {

	    	return $gallery;
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
    		return VideoGallery::whereIn('video_gallery.id', $ids)
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
    	$gallery = VideoGallery::find($id);
    	return $gallery->delete();
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
    		return VideoGallery::whereIn('video_gallery.id', $ids)
		    		->delete();
	    }
	    else
	    {
	    	return null;
	    }

    }
}
