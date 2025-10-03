<?php

namespace App\Models\PartnerAdmin;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\FileSystem;
use Illuminate\Support\Str;
use App\Models\Admin\State;
use App\Models\Admin\District;
use App\Models\Admin\Users;
use App\Libraries\General;

class Center extends AppModel
{
    protected $table = 'centers';
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
    public function owner()
    {
        return $this->belongsTo(Admins::class, 'created_by', 'id');
    }

    public function states()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function institude()
    {
        return $this->belongsTo(Users::class, 'institute_id', 'id');
    }

    /**
    * To search and get pagination listing
    * @param Request $request
    * @param $limit
    */

    public static function generateUsername(int $centerId, ?string $stateCode = null): string
    {
        // normalize state code: fallback to center id if not provided
        $statePart = $stateCode ? strtoupper(substr($stateCode, 0, 3)) : 'ST';

        // pad center id to 3 digits (change length as required)
        $idPart = str_pad($centerId, 3, '0', STR_PAD_LEFT);

        do {
            // 7-digit random (you can change to timestamp or other pattern)
            $randomPart = mt_rand(1000000, 9999999);
            $username = "INST-CEN-{$randomPart}/CEN/{$statePart}/{$idPart}";
            // keep looping if username already exists
        } while (self::where('username', $username)->exists());

        return $username;
    }

    public static function getListing(Request $request, $where = [])
    {
    	$orderBy = $request->get('sort') ? $request->get('sort') : 'centers.id';
    	$direction = $request->get('direction') ? $request->get('direction') : 'desc';
    	$page = $request->get('page') ? $request->get('page') : 1;
    	$limit = self::$paginationLimit;
    	$offset = ($page - 1) * $limit;

    	$listing = Center::select([
	    		'centers.*',
                'owner.first_name as owner_first_name',
                'owner.last_name as owner_last_name'
	    	])
            ->leftJoin('admins as owner', 'owner.id', '=', 'centers.created_by')
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
    public static function getAll($select = [], $where = [], $orderBy = 'centers.id desc', $limit = null)
    {
    	$listing = Center::orderByRaw($orderBy);

    	if(!empty($select))
    	{
    		$listing->select($select);
    	}
    	else
    	{
    		$listing->select([
    			'centers.*'
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
    	$record = Center::where('id', $id)
            ->first();

	    return $record;
    }

    /**
    * To get single row by conditions
    * @param $where
    * @param $orderBy
    */
    public static function getRow($where = [], $orderBy = 'centers.id desc')
    {
    	$record = Center::orderByRaw($orderBy);
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
    // public static function create($data)
    // {
    // 	$service = new Center();

    // 	foreach($data as $k => $v)
    // 	{
    // 		$service->{$k} = $v;
    // 	}

    //     $service->created_by = Auth::user()->id;
    // 	$service->created = date('Y-m-d H:i:s');
    // 	$service->modified = date('Y-m-d H:i:s');
	//     if($service->save())
	//     {
    //         if(isset($data['title']) && $data['title'])
    //         {
    //             $service->slug = Str::slug($service->name) . '-' . General::encode($service->id);
    //             $service->save();
    //         }
	//     	return $service;
	//     }
	//     else
	//     {
	//     	return null;
	//     }
    // }

    public static function create($data)
    {
        $service = new self();

        foreach($data as $k => $v)
        {
            // sirf string/number assign karo, array skip
            if (is_array($v)) continue;
            $service->{$k} = $v;
        }

        $service->created_by = Auth::id();
        $service->created = now();
        $service->modified = now();

        if($service->save()) {
            if(isset($data['title']) && $data['title']) {
                $service->slug = Str::slug($service->title) . '-' . General::encode($service->id);
                $service->save();
            }
            return $service;
        }
        return null;
    }

    /**
    * To update
    * @param $id
    * @param $where
    */
    public static function modify($id, $data)
    {
    	$service = Center::find($id);
    	foreach($data as $k => $v)
    	{
    		$service->{$k} = $v;
    	}

    	$service->modified = date('Y-m-d H:i:s');
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
    		return Center::whereIn('centers.id', $ids)
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
    	$service = Center::find($id);
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
    		return Center::whereIn('centers.id', $ids)
		    		->delete();
	    }
	    else
	    {
	    	return null;
	    }

    }
}
