<?php

namespace App\Exports;

use App\Models\Admin\Admins;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $request = $this->request;
        $where = [];

        if ($request->get('search')) {
            $search = '%' . $request->get('search') . '%';
            $where['(concat(first_name, last_name) LIKE ? or email LIKE ? or phonenumber LIKE ?)'] = [str_replace(' ', '', $search), $search, $search];
        }

        if ($request->get('last_login')) {
            $lastLogin = $request->get('last_login');
            if (isset($lastLogin[0]) && !empty($lastLogin[0])) {
                $where['last_login >= ?'] = [date('Y-m-d', strtotime($lastLogin[0]))];
            }
            if (isset($lastLogin[1]) && !empty($lastLogin[1])) {
                $where['last_login <= ?'] = [date('Y-m-d', strtotime($lastLogin[1]))];
            }
        }

        if ($request->get('admins')) {
            switch ($request->get('admins')) {
                case 'admin':
                    $where['is_admin'] = 0;
                    break;
                case 'super_admin':
                    $where['is_admin'] = 1;
                    break;
            }
        }

        if ($request->has('status') && $request->get('status') !== "") {
            $where['status'] = $request->get('status');
        }

        $records = Admins::select([
                'admins.id',
                'admins.first_name',
                'admins.last_name',
                'admins.email',
                'admins.phonenumber',
                'admins.is_admin',
                'admins.status',
                'admins.last_login',
                'admins.created'
            ])
            ->orderBy('admins.id', 'desc');

        if (!empty($where)) {
            foreach ($where as $query => $values) {
                if (is_array($values)) {
                    $records->whereRaw($query, $values);
                } elseif (!is_numeric($query)) {
                    $records->where($query, $values);
                } else {
                    $records->whereRaw($values);
                }
            }
        }

        return $records->get()->map(function ($row) {
            return [
                'ID' => $row->id,
                'Name' => trim($row->first_name . ' ' . $row->last_name),
                'Email' => $row->email,
                'Phone' => $row->phonenumber,
                'Role' => $row->is_admin ? 'Super Admin' : 'Admin',
                'Status' => $row->status ? 'Active' : 'Inactive',
                'Last Login' => $row->last_login ? date('Y-m-d H:i:s', strtotime($row->last_login)) : '',
                'Created' => $row->created ? date('Y-m-d H:i:s', strtotime($row->created)) : '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Role',
            'Status',
            'Last Login',
            'Created'
        ];
    }
}
