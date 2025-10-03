@extends('layouts.partneradminlayout')
@section('content')

<section>

    <div class="header bg-primary pb-6">

        <div class="container-fluid">

            <div class="header-body">

                <div class="row align-items-center py-4">

                    <div class="col-lg-6 col-7">

                        <h6 class="h2 text-white d-inline-block mb-0">Participant Management</h6>

                    </div>

                    <div class="col-lg-6 col-5 text-right">

                        <a href="{{route('partnerAdmin.participant.add')}}" class="btn btn-neutral"><i class="fas fa-plus"></i>New</a>
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

                <!--!!!!! DO NOT REMOVE listing-block CLASS. INCLUDE THIS IN PARENT DIV OF TABLE ON LISTING PAGES !!!!!-->

                <div class="card listing-block">

                    <!--!! FLAST MESSAGES !!-->

                    <div class="flash-message">

                    </div> <!-- Card header -->

                    <div class="card-header border-0">

                        <div class="heading">

                            <h3 class="mb-0">Here Is Your Participants!</h3>
                            
                            

                        </div>

                        <div class="actions">

                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control listing-search" placeholder="Search" type="text" value="">
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <!-- <div class="row">
                            <form action="" method="post" onsubmit="return validInstituteCenterAddForm()" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <lable class="form-control-label">Select Batch</label>
                                <select name="batchId" id="batchId" class="form-control" multiple>
                                    <option value="">Select Batch</option>
                                    <option value="1380">1. NISE TEST</option>
                                </select>
                            </div>
                            </form>
                        </div> -->
                        <div class="row">
                            <div class="col-md-3">
                                <label>Academic Session</label>
                                <select id="academic_session" name="academic_session" class="form-control">
                                    <option value="">Select Session</option>
                                    @foreach($sessions as $session)
                                        <option value="{{ $session }}" {{ request('academic_session') == $session ? 'selected' : '' }}>
                                            {{ $session }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- <div class="col-md-3">
                                <label>Select State</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ request('state') == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> -->
                            <div class="col-md-3">
                                <label>Select Center</label>
                                <select name="center" id="center_id" class="form-control">
                                    <option value="">Select Center</option>
                                    @foreach($centers as $center)
                                        <option value="{{ $center->id }}" {{ request('center') == $center->id ? 'selected' : '' }}>
                                            {{ $center->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Select Batch</label>
                                <select name="batch" id="batch_id" class="form-control">
                                    <option value="">Select Batch</option>
                                </select>
                            </div>

                            <!-- <div class="col-md-3">
                                <label>Date Range</label>
                                <input type="text" id="created_on" name="created_on[]" class="form-control" placeholder="YYYY-MM-DD - YYYY-MM-DD">
                            </div> -->

                            <div class="col-md-3">
                                <button class="btn btn-primary mt-4" onclick="filterParticipants()">Filter</button>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">

                        <!--!!!!! DO NOT REMOVE listing-table, mark_all  CLASSES. INCLUDE THIS IN ALL TABLES LISTING PAGES !!!!!-->

                        <table class="table align-items-center table-flush listing-table">

                            <thead class="thead-light">

                                <tr>

                                    <!--<th class="checkbox-th" width="5%">

                                        <div class="custom-control custom-checkbox">

                                            <input type="checkbox" class="custom-control-input mark_all" id="mark_all">

                                            <label class="custom-control-label" for="mark_all"></label>

                                        </div>

                                    </th>-->

                                    <th class="sort" width="2%">

                                        <!--- MAKE SURE TO USE PROPOER FIELD IN data-field AND PROPOER DIRECTION IN data-sort -->

                                        S.no

                                        <i class="fas fa-sort" data-field="slider_menu.id" data-sort="asc"></i>

                                    </th>

                                    <th class="sort" width="25%">

                                        Participant 

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Aadhaar<br/>Number

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        Center

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>
                                    <th class="sort">

                                        Academic Session

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        Batch

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>
                                    <th class="sort" width="10%">

                                        State/District

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>
                                    <th class="sort" width="5%">

                                        Image

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="5%">

                                        Status

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
                                    @include('partnerAdmin.participants.listingLoop')
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
                                        <!-- <div class="ajaxPaginationEnabled loader text-center hidden" data-url="https://pldcomp.ae/admin/slider-menu" data-page="1" data-counter="10" data-total="2">

                                            <div class="preloader pl-size-xs">

                                                <div class="spinner-layer pl-indigo">

                                                    <div class="circle-clipper left">

                                                        <div class="circle"></div>

                                                    </div>

                                                    <div class="circle-clipper right">

                                                        <div class="circle"></div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div> -->

                                    </th>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                    <!-- Card footer -->

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
    function filterParticipants(page = 1) {
        $.ajax({
            url: "?page=" + page,
            type: "GET",
            data: {
                search: $('.listing-search').val(),
                academic_session: $('#academic_session').val(),
                center: $('#center_id').val(),          // ✅ Add this line
                batch: $('#batch_id').val(), 
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