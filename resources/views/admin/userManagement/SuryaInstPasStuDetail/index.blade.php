@extends('layouts.adminlayout')
@section('content')

<section>

    <div class="header bg-primary pb-6">

        <div class="container-fluid">

            <div class="header-body">

                <div class="row align-items-center py-4">

                    <div class="col-lg-6 col-7">

                        <h6 class="h2 text-white d-inline-block mb-0">Suryamitra Institute Passed Students Details</h6>

                    </div>

                    <div class="col-lg-6 col-5 text-right">

                        <a href="{{route('admin.participant.add')}}" class="btn btn-neutral"><i class="fas fa-plus"></i>New</a>
                        <div id="poViewTooltip"  data-placement="top" data-original-title="" title="" class="dropdown">
                            <button type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-neutral dropdown-toggle">
                                Export
                            </button>
                            <div aria-labelledby="statusDropdown" class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(8px, 32px, 0px);">
                                <a href="{{ route('participant.export.excel') }}" class="dropdown-item">
                                    <span class="badge badge-dot mr-4"><i class="bg-orange"></i> <span class="status">Excel</span></span>
                                </a>
                                <a href="{{ route('participant.export.csv') }}" class="dropdown-item">
                                    <span class="badge badge-dot mr-4"><i class="bg-orange"></i> <span class="status">CSV</span></span>
                                </a>
                                <a href="{{ route('participant.export.pdf') }}" class="dropdown-item">
                                    <span class="badge badge-dot mr-4"><i class="bg-orange"></i> <span class="status">PDF</span></span>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Page content -->

    <div class="container-fluid mt--6">

        <div class="row">

            <div class="col">

                <div class="card listing-block">

                    <div class="flash-message"></div>

                    <div class="card-header border-0">
                        <form id="filterForm" method="GET">
                            <div class="box box-solid">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="box-group" id="accordion">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label for="icon">Financial Year <span class="text-danger">*</span></label>
                                        <select id="academic_session" name="academic_session" class="form-control">
                                            <option value="">Select Session</option>
                                            @foreach($sessions as $session)
                                                <option value="{{ $session }}" {{ request('academic_session') == $session ? 'selected' : '' }}>
                                                    {{ $session }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>  
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label>Institutes Name</label>
                                        <select id="institute" name="institute" class="form-control">
                                            <option value="">Select Institute</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ request('institute') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->organisation_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label>Center Name</label>
                                        <select id="center" name="center" class="form-control">
                                            <option value="">Select Center</option>
                                            @foreach($centers as $center)
                                                <option value="{{ $center->id }}" {{ request('center') == $center->id ? 'selected' : '' }}>
                                                    {{ $center->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">   
                                    <div class="col-lg-8 col-md-8 col-xs-12">
                                        <label for="icon">Batch Name<span class="text-danger">*</span></label>
                                        <select name="batchId[]" id="batchId" class="form-control" multiple>
                                            <option value="">Select Batch</option>
                                            @foreach($batches as $batch)
                                                <option value="{{ $batch->id }}" {{ in_array($batch->id, (array)request('batchId')) ? 'selected' : '' }}>
                                                    {{ $batch->batch_title }}({{ $batch->batch_id }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12"><br>
                                        <input type="submit" name="btn" class="btn btn-primary" value="Search">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">&nbsp;</div>
                                    <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="actions">
                                        <div class="input-group input-group-alternative input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input class="form-control listing-search" placeholder="Search" type="text" value="">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        <input type="hidden" name="csrf" value="F0fEIT3S9PF50i9DV2srMb5dBo50I3rRlAi">
                        </form>
                    </div>

                    <div class="table-responsive">

                        <table class="table align-items-center table-flush listing-table">

                            <thead class="thead-light">

                                <tr>

                                    <th class="sort" width="2%">

                                        S.No

                                        <i class="fas fa-sort" data-field="slider_menu.id" data-sort="asc"></i>

                                    </th>

                                    <th class="sort" width="25%">

                                        SM Name 

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Father Name

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        Center

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>
                                    <th class="sort">

                                        Contact Detail

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        Address

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>
                                    <th class="sort" width="10%">

                                        Aadhaar No.

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>
                                    <th class="sort" width="5%">

                                        Category

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="5%">

                                        State

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="5%">

                                        District

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="5%">

                                        Gender

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="5%">

                                        Result

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="5%">

                                        Trained Status

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="5%">

                                        Placement Status

                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>

                                    </th>

                                    <th class="sort" width="5%">

                                        Company Name

                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>

                                    </th>                                    

                                    <th class="text-center" width="5%">

                                        Actions

                                    </th>

                                </tr>

                            </thead>

                            <tbody class="list">
                                <div id="participant-list">
                                <?php if(!empty($listing->items())): ?>
                                    @include('admin.userManagement.SuryaInstPasStuDetail.listingLoop')
                                <?php else: ?>
                                    <td align="left" colspan="7">
                                        No records found!
                                    </td>
                                <?php endif; ?>
                                </div>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th align="left" colspan="20">
                                        <div id="pagination-links">
                                            {{ $listing->links('pagination::bootstrap-4') }}
                                        </div>

                                    </th>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Modal -->

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script>
    // function filterParticipants(page = 1) {
    //     $.ajax({
    //         url: "?page=" + page,
    //         type: "GET",
    //         data: {
    //             search: $('.listing-search').val(),
    //             academic_session: $('#academic_session').val(),
    //             batchId: $('#batchId').val(),
    //             created_on: $('#created_on').val() ? $('#created_on').val().split(' - ') : []
    //         },
    //         success: function(response) {
    //             $('.listing-table tbody').html(response.html);
    //         }
    //     });
    // }

    function filterParticipants(page = 1) {
        $.ajax({
            url: "?page=" + page,
            type: "GET",
            data: {
                search: $('.listing-search').val(),
                academic_session: $('#academic_session').val(),
                batchId: $('#batchId').val(),
                center: $('#center').val(),
                created_on: $('#created_on').val() ? $('#created_on').val().split(' - ') : []
            },
            success: function(response) {
                $('.listing-table tbody').html(response.html);
            }
        });
    }

    // Search on keyup
    $('.listing-search').on('keyup', function () {
        filterParticipants();
    });

    // Pagination click
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        filterParticipants(page);
    });

</script>
@endsection