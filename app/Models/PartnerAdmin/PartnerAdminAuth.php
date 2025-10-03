<?php

namespace App\Models\PartnerAdmin;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Libraries\FileSystem;

class PartnerAdminAuth extends User
{

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**** ONLY USE FOR MAIN TALBLES NO NEED TO USE FOR RELATION TABLES OR DROPDOWNS OR SMALL SECTIONS ***/
    use SoftDeletes;

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
    * To get single row by conditions
    * @param $where
    * @param $orderBy
    */
    public static function getRow($where = [], $orderBy = 'users.id desc')
    {
        $record = PartnerAdminAuth::orderByRaw($orderBy);

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
    * To make admin login
    * @param Request $request
    */
    public static function attemptLogin(Request $request)
    {
    	//Get user
    	$user = PartnerAdminAuth::where('email', 'LIKE', $request->get('email'))
    		->where('status', 1)
    		->first();
        if($user)
        {
            if(Hash::check( $request->get('password'), $user->password))
            {
            	return $user;
            }
        }

        return null;
    }

    public static function makeLoginSession(Request $request, $user)
    {
        //Make login
        if($user)
        {
            Auth::guard('partner-admin')->login($user);
            if(Auth::guard('partner-admin')->check())
            {
                $request->session()->regenerate();

                //Update last login
                $user->last_login = date('Y-m-d H:i:s');
                $user->save();
                return $user;
            }
        }

        return null;
    }

    public static function isLogin()
    {
        return Auth::guard('partner-admin')->check();
    }

    public static function isAdmin()
    {
        return Auth::guard('partner-admin')->user()->is_admin;
    }

    public static function getLoginId()
    {
        $user = Auth::guard('partner-admin')->user();
        return $user ? $user->id : null;
    }

    public static function getLoginUserName()
    {
        $user = Auth::guard('partner-admin')->user();
        return $user ? $user->first_name . ' ' . $user->last_name : null;
    }

    public static function getLoginUser()
    {
        $user = Auth::guard('partner-admin')->user();
        return $user ? $user : null;
    }

    public static function logout()
    {
        return Auth::guard('partner-admin')->logout();
    }
}
