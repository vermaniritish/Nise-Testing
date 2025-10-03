@extends('layouts.adminlayout')
@section('content')

<section>

    <div class="header bg-primary pb-6">

        <div class="container-fluid">

            <div class="header-body">

                <div class="row align-items-center py-4">

                    <div class="col-lg-6 col-7">

                        <h6 class="h2 text-white d-inline-block mb-0">Center Management</h6>

                    </div>

                    <div class="col-lg-6 col-5 text-right">

                        <a href="{{route('admin.manageCenter.add')}}" class="btn btn-neutral"><i class="fas fa-plus"></i>New</a>

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
                      <form action="javascript:void(0);" method="get" id="filterForm">
                        <div class="box box-solid">
                          <div class="box-body">
                            <div class="box-group" id="accordion">
                              <div class="row">

                                <div class="col-lg-3 col-md-3 col-xs-12">
                                  <label>State <span class="text-danger">*</span></label>
                                  <select name="state" id="state_id" class="form-control">
                                    <option value="">~~Select State~~</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ request('state') == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                  </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-xs-12">
                                  <label>District <span class="text-danger">*</span></label>
                                  <select name="district" id="district_id" class="form-control">
                                    <option value="">~~Select District~~</option>
                                  </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-xs-12">
                                  <label>Select Institutes <span class="text-danger">*</span></label>
                                  <select name="institute" id="institute" class="form-control">
                                    <option value="">~~Select Institute~~</option>
                                    @foreach($institutes as $institute)
                                        <option value="{{ $institute->id }}" {{ request('institute') == $institute->id ? 'selected' : '' }}>
                                            {{ $institute->organisation_name }}
                                        </option>
                                    @endforeach
                                  </select>
                                </div>
                                <!-- <div class="col-lg-3 col-md-3 col-xs-12">
                                    <input class="submit btn btn-success " style="margin-right:5px" name="submit" type="button" onclick="getDataReport()" value="Search">
                                    <span id="loader"></span>
                                </div> -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="card-header border-0">
                      <div class="heading">
                        <h3 class="mb-0">Here Is Your Batchs!</h3>
                      </div>
                      <div class="actions">
                        <div class="input-group input-group-alternative input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                          </div>
                          <input id="search" class="form-control" placeholder="Search" type="text" value="">
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

                                        Center Name/e-Mail

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Center ID

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Contact No.

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

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

                                        City

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

                            <tbody class="list" id="listing-container">

                                <?php if(!empty($listing->items())): ?>
                                    @include('admin.manageCenter.listingLoop')
                                <?php else: ?>
                                    <td align="left" colspan="7">
                                        No records found!
                                    </td>
                                <?php endif; ?>

                            </tbody>

                            <tfoot>
                              <tr>
                                <th align="left" colspan="20">
                                  {{-- ❗️pagination container का id --}}
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

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){

    function fetchListing(page = 1) {
        let search = $('#search').val();
        let state = $('#state_id').val();
        let district = $('#district_id').val();
        let institute = $('#institute').val();

        $.ajax({
            url: "{{ route('admin.manageCenter') }}?page=" + page,
            type: 'GET',
            data: { search: search, state: state, district:district, institute: institute },
            success: function(response) {
                if(response.status === 'success') {
                    $('#listing-container').html(response.html);
                    $('#pagination-links').html(response.pagination);
                }
            }
        });
    }

    // 🔍 Search
    $('#search').on('keyup', function() {
        fetchListing();
    });

    // 🏢 / 📍 Filters
    $('#state_id, #district_id, #institute').on('change', function() {
        fetchListing();
    });

    // 📄 Pagination
    $(document).on('click', '#pagination-links a', function(e){
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchListing(page);
    });

});
</script>
@endsection