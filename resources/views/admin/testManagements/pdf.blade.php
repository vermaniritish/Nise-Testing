<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test Job Details</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background: #f0f0f0;
            text-align: left;
        }

        .no-border td {
            border: none;
        }

        .header-table td {
            border: none;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
        }

        a {
            color: #0000EE;
            text-decoration: underline;
        }
    </style>
</head>

<body>

<!-- ================= HEADER ================= -->
<table class="header-table">
    <tr>
        <td width="25%">
            @if($logo)
            <img src="{{ public_path($logo) }}" width="130">
            @else
            <p>{{ $companyName }}</p>
            @endif
        </td>
        <td width="75%" align="right">
            <div class="title">Test Job Details</div>
            <strong>Test Job ID:</strong> {{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->order_number : ''}}
        </td>
    </tr>
</table>

<hr>

<!-- ================= COMPANY & INDIVIDUAL DETAILS ================= -->
<table>
    <tr>
        <th colspan="4">Company & Individual Details</th>
    </tr>

    <tr>
        <td><strong>Individual Name</strong></td>
        <td>
            @if($orderTest->order_data && $orderTest->order_data->users->registration_type == 'Company')
                {{isset($orderTest->order_data->users) && $orderTest->order_data->users ? $orderTest->order_data->users->ind_contact_person_name : ''}}
            @else
                {{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->person_name : ''}}
            @endif
        </td>
        <td><strong>Email</strong></td>
        <td>{{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->email : ''}}</td>
    </tr>

    <tr>
        <td><strong>Mobile</strong></td>
        <td>{{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->mobile : ''}}</td>
        <td><strong>Individual Address</strong></td>
        <td>{{isset($orderTest->order_data->users) && $orderTest->order_data->users->ind_address_1 && $orderTest->order_data->users->ind_address_2 ? $orderTest->order_data->users->ind_address_1.''.$orderTest->order_data->users->ind_address_2 : ''}}</td>
    </tr>

    <tr>
        <td><strong>Company Name</strong></td>
        <td>{{isset($orderTest->order_data->users) && $orderTest->order_data->users ? $orderTest->order_data->users->company_name : ''}}</td>
        <td><strong>Company Address</strong></td>
        <td>{{isset($orderTest->order_data->users) && $orderTest->order_data->users ? $orderTest->order_data->users->address_1.''.$orderTest->order_data->users->address_2 : ''}}</td>
    </tr>

    <tr>
        <td><strong>PAN</strong></td>
        <td>
            {{isset($orderTest->order_data->users) && $orderTest->order_data->users ? $orderTest->order_data->users->pan : ''}}
            @if(isset($orderTest->order_data->users) && $orderTest->order_data->users && $orderTest->order_data->users->pan_file)
            <br>
            <a href="{{url($orderTest->order_data->users->pan_file)}}">View</a>
            @endif
        </td>
        <td><strong>Registration No.</strong></td>
        <td>{{isset($orderTest->order_data->users) && $orderTest->order_data->users && $orderTest->order_data->users->registration_number ? $orderTest->order_data->users->registration_number : ''}}</td>
    </tr>

    <tr>
        <td><strong>Authorized Person</strong></td>
        <td>{{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->person_name : ''}}</td>
        <td><strong>Authorized Email</strong></td>
        <td>{{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->email : ''}}</td>
    </tr>

    <tr>
        <td><strong>Authorized Mobile</strong></td>
        <td colspan="3">{{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->mobile : ''}}</td>
    </tr>
</table>

<!-- ================= PAYMENT DETAILS ================= -->
<table>
    <tr>
        <th colspan="2">Payment Details</th>
    </tr>

    <tr>
        <td><strong>Total Fee</strong></td>
        <td>₹ {{ isset($orderTest->order_data) && $orderTest->order_data ? number_format($orderTest->order_data->total_fee, 2).'/-' : '' }}</td>
    </tr>

    <tr>
        <td><strong>Paid Fee with GST</strong></td>
        <td><strong>₹ {{ isset($orderTest->order_data) && $orderTest->order_data ? number_format($orderTest->order_data->total_fee, 2).'/-' : '' }}</strong></td>
    </tr>
</table>

<!-- ================= TEST DETAILS ================= -->
<table>
    <tr>
        <th colspan="4">Test Details</th>
    </tr>

    <tr>
        <td><strong>Test Service</strong></td>
        <td>{{isset($orderTest->service_category_wise_test) && $orderTest->service_category_wise_test ? $orderTest->service_category_wise_test->service->title : ''}}</td>
        <td><strong>Test Type</strong></td>
        <td>{{isset($orderTest->service_category_wise_test) && $orderTest->service_category_wise_test ? $orderTest->service_category_wise_test->serviceCategory->test_category_title : ''}}</td>
    </tr>

    <tr>
        <td><strong>Order Date</strong></td>
        <td>{{ isset($orderTest->order_date) && $orderTest->order_date ? \Carbon\Carbon::parse($orderTest->order_date)->format('d M, Y') : '' }}</td>
        <td><strong>Test Status</strong></td>
        <td>{{ isset($orderTest->test_status) && $orderTest->test_status ? ucwords(str_replace('_', ' ', $orderTest->test_status)) : '' }}</td>
    </tr>

    <tr>
        <td><strong>Test Start Date</strong></td>
        <td>{{ isset($orderTest->test_start_date) && $orderTest->test_start_date ? \Carbon\Carbon::parse($orderTest->test_start_date)->format('d/m/Y') : '' }}                        		</td>
        <td><strong>Completion Date</strong></td>
        <td>{{ isset($orderTest->test_job_completion_date) && $orderTest->test_job_completion_date ? \Carbon\Carbon::parse($orderTest->test_job_completion_date)->format('d/m/Y') : '' }}</td>
    </tr>
</table>

<!-- ================= UPLOADED DOCUMENTS ================= -->
<table>
    <tr>
        <th>Uploaded Documents</th>
    </tr>

    <tr>
        <td>
            <p style="font-size:13px;">
                <strong>PV Module Details</strong> 
                    @if($orderTest->order_data && isset($orderTest->order_data->upload_pv_module_docs) && $orderTest->order_data->upload_pv_module_docs)
                    – <a href="{{ $orderTest->order_data->upload_pv_module_docs ? url($orderTest->order_data->upload_pv_module_docs) : '#' }}" target="_blank">View File</a>
                    @endif
                <br/>
                <?php
                $detailOfDocuments = $orderTest->documents;
                ?>
                @if(isset($detailOfDocuments) && $detailOfDocuments)
                    @foreach($detailOfDocuments as $detOfDocs)
                        <strong>{{isset($detOfDocs['title']) && $detOfDocs['title'] ? $detOfDocs['title'] : ''}}</strong> – <a href="{{ url($detOfDocs['name_of_doc_ssi']) }}">View file</a><br/>
                        <strong>{{isset($detOfDocs['sub_title']) && $detOfDocs['sub_title'] ? $detOfDocs['sub_title'] : ''}}</strong> – <a href="{{ url($detOfDocs->name_of_doc_billmat) }}">View file</a>
                        <br/>
                    @endforeach
                @endif
                <strong>Internal Test Report (optional)</strong> 
                @if(isset($orderTest->order_data->internal_test_report) && $orderTest->order_data->internal_test_report)
                – <a href="{{isset($orderTest->order_data->internal_test_report) && $orderTest->order_data->internal_test_report ? url($orderTest->order_data->internal_test_report) : ''}}">View file</a>
                @endif
            </p> 
        </td>
    </tr>
</table>

</body>
</html>
