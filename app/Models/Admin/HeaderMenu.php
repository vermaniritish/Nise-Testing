<?php

namespace App\Models\Admin;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\FileSystem;
use Illuminate\Support\Str;
use App\Libraries\General;

class HeaderMenu extends AppModel
{
    protected $table = 'header_menu';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public static function getListing(Request $request, $where = [])
    {
        $orderBy = $request->get('sort') ? $request->get('sort') : 'header_menu.id';
        $direction = $request->get('direction') ? $request->get('direction') : 'desc';
        $page = $request->get('page') ? $request->get('page') : 1;
        $limit = self::$paginationLimit;
        $offset = ($page - 1) * $limit;

        $listing = HeaderMenu::select([
            'header_menu.*',
        ])
        ->orderBy($orderBy, $direction);
        if (!empty($where)) {
            foreach ($where as $query => $values) {
                if (is_array($values))
                    $listing->whereRaw($query, $values);
                elseif (!is_numeric($query))
                    $listing->where($query, $values);
                else
                    $listing->whereRaw($values);
            }
        }

        // Put offset and limit in case of pagination
        if ($page !== null && $page !== "" && $limit !== null && $limit !== "") {
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
    public static function getAll($select = [], $where = [], $orderBy = 'header_menu.id desc', $limit = null)
    {
        $listing = HeaderMenu::orderByRaw($orderBy);

        if (!empty($select)) {
            $listing->select($select);
        } else {
            $listing->select([
                'header_menu.*'
            ]);
        }

        if (!empty($where)) {
            foreach ($where as $query => $values) {
                if (is_array($values))
                    $listing->whereRaw($query, $values);
                elseif (!is_numeric($query))
                    $listing->where($query, $values);
                else
                    $listing->whereRaw($values);
            }
        }

        if ($limit !== null && $limit !== "") {
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
        $record = HeaderMenu::where('id', $id)
            ->first();

        return $record;
    }



    /**
     * To insert
     * @param $where
     * @param $orderBy
     */
    public static function create($data)
    {
        $headerMenu = new HeaderMenu();

        // Populate the properties from the provided data
        foreach ($data as $k => $v) {
            $headerMenu->{$k} = $v;
        }
        if ($headerMenu->save()) {
            return $headerMenu;
        } else {
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
        $headerMenu = HeaderMenu::find($id);
        if (!$headerMenu) {
            return null;
        }
        foreach ($data as $k => $v) {
            $headerMenu->{$k} = $v;
        }
        if ($headerMenu->save()) {
            return $headerMenu;
        } else {
            return null;
        }
    }



    /**
     * To delete
     * @param $id
     */
    public static function remove($id)
    {
        $headerMenu = HeaderMenu::find($id);
        return $headerMenu->delete();
    }

    /**
     * To delete all
     * @param $id
     * @param $where
     */
    public static function removeAll($ids)
    {
        if (!empty($ids)) {
            return HeaderMenu::whereIn('header_menu.id', $ids)
                ->delete();
        } else {
            return null;
        }
    }

}
