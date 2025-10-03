<?php

namespace App\Models\Admin;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\FileSystem;
use Illuminate\Support\Str;
use App\Libraries\General;

class FooterMenu extends AppModel
{
    protected $table = 'footer_menu';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public static function getListing(Request $request, $where = [])
    {
        $orderBy = $request->get('sort') ? $request->get('sort') : 'footer_menu.id';
        $direction = $request->get('direction') ? $request->get('direction') : 'desc';
        $page = $request->get('page') ? $request->get('page') : 1;
        $limit = self::$paginationLimit;
        $offset = ($page - 1) * $limit;

        $listing = FooterMenu::select([
            'footer_menu.*',
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
    public static function getAll($select = [], $where = [], $orderBy = 'footer_menu.id desc', $limit = null)
    {
        $listing = FooterMenu::orderByRaw($orderBy);

        if (!empty($select)) {
            $listing->select($select);
        } else {
            $listing->select([
                'footer_menu.*'
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
        $record = FooterMenu::where('id', $id)
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
        $footerMenu = new FooterMenu();

        // Populate the properties from the provided data
        foreach ($data as $k => $v) {
            $footerMenu->{$k} = $v;
        }
        if ($footerMenu->save()) {
            return $footerMenu;
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
        $footerMenu = FooterMenu::find($id);
        if (!$footerMenu) {
            return null;
        }
        foreach ($data as $k => $v) {
            $footerMenu->{$k} = $v;
        }
        if ($footerMenu->save()) {
            return $footerMenu;
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
        $footerMenu = FooterMenu::find($id);
        return $footerMenu->delete();
    }

    /**
     * To delete all
     * @param $id
     * @param $where
     */
    public static function removeAll($ids)
    {
        if (!empty($ids)) {
            return FooterMenu::whereIn('footer_menu.id', $ids)
                ->delete();
        } else {
            return null;
        }
    }

}
