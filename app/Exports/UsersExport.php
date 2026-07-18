<?php

namespace App\Exports;

use App\Models\Admin\Users;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
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
            $where['(id LIKE ? or person_name LIKE ? or company_name LIKE ? or registration_number LIKE ? or email LIKE ? or mobile LIKE ?)'] = [$search, $search, $search, $search, $search, $search];
        }

        if ($request->get('last_login')) {
            $lastLogin = $request->get('last_login');
            if (isset($lastLogin[0]) && !empty($lastLogin[0])) {
                $where['last_login >= ?'] = [date('Y-m-d 00:00:00', strtotime($lastLogin[0]))];
            }
            if (isset($lastLogin[1]) && !empty($lastLogin[1])) {
                $where['last_login <= ?'] = [date('Y-m-d 23:59:59', strtotime($lastLogin[1]))];
            }
        }

        if ($request->get('created_on')) {
            $created = $request->get('created_on');
            if (isset($created[0]) && !empty($created[0])) {
                $where['created >= ?'] = [date('Y-m-d 00:00:00', strtotime($created[0]))];
            }
            if (isset($created[1]) && !empty($created[1])) {
                $where['created <= ?'] = [date('Y-m-d 23:59:59', strtotime($created[1]))];
            }
        }

        if ($request->get('role')) {
            switch ($request->get('role')) {
                case 'customer':
                    $where['seller'] = 0;
                    break;
                case 'seller':
                    $where['seller'] = 1;
                    break;
            }
        }

        if ($request->get('status')) {
            switch ($request->get('status')) {
                case 'active':
                    $where['status'] = 1;
                    break;
                case 'non_active':
                    $where[] = '(status = 0 or status is null)';
                    break;
            }
        }

        $listing = Users::select([
                'users.id',
                'users.person_name',
                'users.company_name',
                'users.registration_number',
                'users.email',
                'users.mobile',
                'users.status',
                'users.last_login',
                'users.created'
            ])
            ->orderBy('users.id', 'desc');

        if (!empty($where)) {
            foreach ($where as $query => $values) {
                if (is_array($values)) {
                    $listing->whereRaw($query, $values);
                } elseif (!is_numeric($query)) {
                    $listing->where($query, $values);
                } else {
                    $listing->whereRaw($values);
                }
            }
        }

        return $listing->get()->map(function ($row) {
            return [
                'ID' => $row->id,
                'Person Name' => $row->person_name,
                'Company Name' => $row->company_name,
                'Registration Number' => $row->registration_number,
                'Email' => $row->email,
                'Mobile' => $row->mobile,
                'Role' => $row->seller ? 'Seller' : 'Customer',
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
            'Person Name',
            'Company Name',
            'Registration Number',
            'Email',
            'Mobile',
            'Role',
            'Status',
            'Last Login',
            'Created'
        ];
    }
}
