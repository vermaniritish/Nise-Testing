<?php

namespace App\Exports;

use App\Models\Admin\OrderTest;
use App\Models\Admin\AdminAuth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TestManagementsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $request = $this->request;
        $isAdmin = AdminAuth::isAdmin();
        $userId = AdminAuth::getLoginId();

        $listing = OrderTest::select(
                'order_tests.id',
                'orders.order_number',
                'testing_services.title as service_title',
                'service_category_wise_tests.title as category_title',
                'orders.created as order_date',
                'order_tests.assign_job',
                'order_tests.assigned_date',
                'order_tests.test_status',
                'order_tests.test_start_date',
                'order_tests.test_job_completion_date',
                'order_tests.actual_completion_date'
            )
            ->leftJoin('orders', 'orders.id', '=', 'order_tests.order_id')
            ->leftJoin('service_category_wise_tests', 'service_category_wise_tests.id', '=', 'order_tests.test_type_id')
            ->leftJoin('testing_services', 'testing_services.id', '=', 'service_category_wise_tests.service_id');

        if (!$isAdmin) {
            $listing->where('assign_job', $userId);
        }

        if ($request->has('test_service') && is_array($request->test_service)) {
            $listing->whereIn('testing_services.id', $request->test_service);
        }

        if ($request->get('search')) {
            $search = '%' . $request->get('search') . '%';
            $listing->whereRaw(
                '(orders.order_number LIKE ? or testing_services.title LIKE ? or service_category_wise_tests.title LIKE ?)',
                [$search, $search, $search]
            );
        }

        if ($request->get('created_on')) {
            $createdOn = $request->get('created_on');
            if (!empty($createdOn[0])) {
                $listing->where('orders.created', '>=', date('Y-m-d 00:00:00', strtotime($createdOn[0])));
            }
            if (!empty($createdOn[1])) {
                $listing->where('orders.created', '<=', date('Y-m-d 23:59:59', strtotime($createdOn[1])));
            }
        }

        $records = $listing->orderBy('order_tests.id', 'desc')->get();

        return $records->map(function ($row) {
            return [
                'Test Job ID' => $row->order_number ?? '',
                'Test Service' => $row->service_title ?? '',
                'Test Type' => $row->category_title ?? '',
                'Order Date' => $row->order_date ? date('Y-m-d', strtotime($row->order_date)) : '',
                'Assigned Date' => $row->assigned_date ? date('Y-m-d', strtotime($row->assigned_date)) : '',
                'Test Status' => $row->test_status ?? '',
                'Test Start Date' => $row->test_start_date ? date('Y-m-d', strtotime($row->test_start_date)) : '',
                'Test Job Completion Date' => $row->test_job_completion_date ? date('Y-m-d', strtotime($row->test_job_completion_date)) : '',
                'Actual Completion Date' => $row->actual_completion_date ? date('Y-m-d', strtotime($row->actual_completion_date)) : '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Test Job ID',
            'Test Service',
            'Test Type',
            'Order Date',
            'Assigned Date',
            'Test Status',
            'Test Start Date',
            'Test Job Completion Date',
            'Actual Completion Date'
        ];
    }
}
