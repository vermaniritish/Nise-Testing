<?php

namespace App\Exports;

use App\Models\Admin\TestingService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TestingServicesExport implements FromCollection, WithHeadings
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
            $where['(testing_services.id LIKE ? or testing_services.title LIKE ? or testing_services.description LIKE ?)'] = [$search, $search, $search];
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (isset($createdOn[0]) && !empty($createdOn[0])) {
                $where['testing_services.created >= ?'] = [date('Y-m-d 00:00:00', strtotime($createdOn[0]))];
            }
            if (isset($createdOn[1]) && !empty($createdOn[1])) {
                $where['testing_services.created <= ?'] = [date('Y-m-d 23:59:59', strtotime($createdOn[1]))];
            }
        }

        $listing = TestingService::select([
                'testing_services.id',
                'testing_services.title',
                'testing_services.description',
                'testing_services.status',
                'testing_services.created'
            ])
            ->orderBy('testing_services.id', 'desc');

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
                'Title' => $row->title,
                'Description' => $row->description,
                'Status' => $row->status ? 'Active' : 'Inactive',
                'Created On' => $row->created ? date('Y-m-d H:i:s', strtotime($row->created)) : '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Description',
            'Status',
            'Created On'
        ];
    }
}
