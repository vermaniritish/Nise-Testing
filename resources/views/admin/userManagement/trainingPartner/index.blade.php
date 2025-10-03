@extends('layouts.adminlayout')
@section('content')

<section>

    <div class="header bg-primary pb-6">

        <div class="container-fluid">

            <div class="header-body">

                <div class="row align-items-center py-4">

                    <div class="col-lg-6 col-7">

                        <h6 class="h2 text-white d-inline-block mb-0">Partner Training Management</h6>

                    </div>

                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('admin.userManagement.partnerTraining.add')}}" class="btn btn-neutral"><i class="fas fa-plus"></i>Add New </a>
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

                        <div class="heading">

                            <h3 class="mb-0">Here Is Your Partner Trainings!</h3>

                        </div>

                        <div class="actions">

                            <div class="input-group input-group-alternative input-group-merge">

                                <div class="input-group-prepend">

                                    <span class="input-group-text"><i class="fas fa-search"></i></span>

                                </div>

                                <input type="text" class="form-control listing-search" placeholder="Search..." />

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

                                    <th class="sort" width="5%">

                                        <!--- MAKE SURE TO USE PROPOER FIELD IN data-field AND PROPOER DIRECTION IN data-sort -->

                                        S.no

                                        <i class="fas fa-sort" data-field="slider_menu.id" data-sort="asc"></i>

                                    </th>

                                    <th class="sort" width="">

                                        INST. NAME

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Total Center

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Total SM

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        SM Pass

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        Contact No.

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        State

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        City

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        Batch Allocation

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        Status

                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>

                                    </th>

                                    <th class="text-center" width="10%">

                                        Actions

                                    </th>

                                </tr>

                            </thead>

                            <tbody class="list">

                                <?php if(!empty($listing->items())): ?>
                                    @include('admin.userManagement.trainingPartner.listingLoop')
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
</script>
@endsection