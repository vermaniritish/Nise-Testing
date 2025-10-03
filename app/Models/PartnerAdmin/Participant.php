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
use App\Libraries\General;

class Participant extends AppModel
{
    protected $table = 'participants';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'full_name', 'user_name', 'address', 'corresponding_address', 'state_id', 'city', 'mobile', 'email',
        'date_of_birth', 'father_name', 'mother_name', 'gender', 'is_physical_handicap', 'caste_category',
        'aadhar_number', 'emergency_contact', 'qualification', 'employment_status', 'organisation_name',
        'organisation_email', 'company_name', 'company_email', 'company_phone', 'identity_proof',
        'candidate_image', 'category_proof', 'handicap_proof', 'highe_education', 'salary_slip',
        'id_proof', 'academic_session', 'center_id', 'batch_id', 'course_duration', 'status'
    ];
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

    public function states()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function batch()
    {
        return $this->belongsTo(Batche::class, 'batch_id', 'id');
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
    	$orderBy = $request->get('sort') ? $request->get('sort') : 'participants.id';
    	$direction = $request->get('direction') ? $request->get('direction') : 'desc';
    	$page = $request->get('page') ? $request->get('page') : 1;
    	$limit = self::$paginationLimit;
    	$offset = ($page - 1) * $limit;

    	$listing = Participant::select([
	    		'participants.*',
                'owner.first_name as owner_first_name',
                'owner.last_name as owner_last_name',
                'center.title as center_title',
                'batche.batch_title as batche_batch_title',
                'state.name as state_name',
                'dist.name as dist_name',
                
	    	])
            ->leftJoin('admins as owner', 'owner.id', '=', 'participants.created_by')
            ->leftJoin('centers as center', 'center.id', '=', 'participants.center_id')
            ->leftJoin('batches as batche', 'batche.id', '=', 'participants.batch_id')
            ->leftJoin('states as state', 'state.id', '=', 'participants.state_id')
            ->leftJoin('district as dist', 'dist.id', '=', 'participants.batch_id')

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
    public static function getAll($select = [], $where = [], $orderBy = 'participants.id desc', $limit = null)
    {
    	$listing = Participant::orderByRaw($orderBy);

    	if(!empty($select))
    	{
    		$listing->select($select);
    	}
    	else
    	{
    		$listing->select([
    			'participants.*'
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
    	$record = Participant::where('id', $id)
            ->first();

	    return $record;
    }

    /**
    * To get single row by conditions
    * @param $where
    * @param $orderBy
    */
    public static function getRow($where = [], $orderBy = 'participants.id desc')
    {
    	$record = Participant::orderByRaw($orderBy);
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
    	$service = new Participant();

    	foreach($data as $k => $v)
    	{
    		$service->{$k} = $v;
    	}

        $service->created_by = Auth::user()->id;
    	$service->created = date('Y-m-d H:i:s');
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
    * To update
    * @param $id
    * @param $where
    */
    public static function modify($id, $data)
    {
    	$service = Participant::find($id);
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
    		return Participant::whereIn('participants.id', $ids)
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
    	$service = Participant::find($id);
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
    		return Participant::whereIn('participants.id', $ids)
		    		->delete();
	    }
	    else
	    {
	    	return null;
	    }

    }
}
