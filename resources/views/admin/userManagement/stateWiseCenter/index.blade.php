@extends('layouts.adminlayout')
@section('content')

<section>

    <div class="header bg-primary pb-6">

        <div class="container-fluid">

            <div class="header-body">

                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">State Wise Center</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        
                        <div id="poViewTooltip"  data-placement="top" data-original-title="" title="" class="dropdown">
                            <button type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-neutral dropdown-toggle">
                                Export
                            </button>
                            <div aria-labelledby="statusDropdown" class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(8px, 32px, 0px);">
                                <a href="javascript:;" class="dropdown-item"><span class="badge badge-dot mr-4"><i class="bg-orange"></i> <span class="status">Excel</span></span></a>
                                <a href="javascript:;" class="dropdown-item"><span class="badge badge-dot mr-4"><i class="bg-orange"></i> <span class="status">CSV</span></span></a>
                                <a href="javascript:;" class="dropdown-item"><span class="badge badge-dot mr-4"><i class="bg-orange"></i> <span class="status">PDF</span></span></a>
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
                        <form action="" method="post">
                            <div class="box box-solid">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="box-group" id="accordion">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-xs-12">
                                        <label for="icon">State <span class="text-danger">*</span></label>
                                        <select name="stateFilter" id="stateFilter" class="form-control">
                                            <option value="">~~~ Select State ~~~</option>
                                            <option value="all">ALL</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        <i id="loader"></i>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12"><br>
                                        <input class="submit btn btn-success " style="margin-right:5px" name="submit" type="button" onclick="getDataReport()" value="Generate Report">
                                        <span id="loader"></span>
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

                                    <th class="sort" width="5%">

                                        <!--- MAKE SURE TO USE PROPOER FIELD IN data-field AND PROPOER DIRECTION IN data-sort -->

                                        S.no

                                        <i class="fas fa-sort" data-field="slider_menu.id" data-sort="asc"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Institude

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Center

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        Contact Detail

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        Address

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        State

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        District

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        Status

                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        Applided On

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                </tr>

                            </thead>

                            <tbody class="list">

                                <?php if(!empty($listing->items())): ?>
                                    @include('admin.userManagement.stateWiseCenter.listingLoop')
                                <?php else: ?>
                                    <td align="left" colspan="7">
                                        No records found!
                                    </td>
                                <?php endif; ?>

                            </tbody>

                            <tfoot>

                                <tr>

                                    <th align="left" colspan="20">

                                        <div class="ajaxPaginationEnabled loader text-center hidden" data-url="https://pldcomp.ae/admin/slider-menu" data-page="1" data-counter="10" data-total="2">

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

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('keyup', '.listing-search', function () {
        let search = $(this).val();
        let url = "{{ route('admin.manageCenter') }}";

        $.ajax({
            url: url,
            type: 'GET',
            data: { search: search },
            success: function (response) {
                if (response.status === 'success') {
                    $('.listing-table tbody.list').html(response.html);
                }
            }
        });
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                if (response.status === 'success') {
                    $('.listing-table tbody.list').html(response.html);
                }
            }
        });
    });

    function getDataReport() {
        let stateId = $("#stateFilter").val();
        let url = "{{ route('admin.userManagement.stateWiseCenter') }}";

        $.ajax({
            url: url,
            type: 'GET',
            data: { stateFilter: stateId },
            success: function (response) {
                if (response.status === 'success') {
                    $('.listing-table tbody.list').html(response.html);
                }
            }
        });
    }
</script>
@endsection