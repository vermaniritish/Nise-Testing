@extends('layouts.partneradminlayout')
@section('content')

<section>

    <div class="header bg-primary pb-6">

        <div class="container-fluid">

            <div class="header-body">

                <div class="row align-items-center py-4">

                    <div class="col-lg-6 col-7">

                        <h6 class="h2 text-white d-inline-block mb-0">Batch Management</h6>

                    </div>

                    <div class="col-lg-6 col-5 text-right">

                        <a href="{{route('partnerAdmin.manageBatche.add')}}" class="btn btn-neutral"><i class="fas fa-plus"></i>New</a>

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
                                  <label>Financial Year <span class="text-danger">*</span></label>
                                  <select id="academic_session" name="academic_session" class="form-control">
                                    <option value="">Select Session</option>
                                    @foreach($sessions as $session)
                                        <option value="{{ $session }}" {{ request('academic_session') == $session ? 'selected' : '' }}>
                                            {{ $session }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-xs-12">
                                  <label>State <span class="text-danger">*</span></label>
                                  <select name="state" id="state" class="form-control">
                                    <option value="">~~Select State~~</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ request('state') == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                  </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-xs-12">
                                  <label>Center <span class="text-danger">*</span></label>
                                  <select name="center" id="center_id" class="form-control">
                                    <option value="">~~Select Center~~</option>
                                    @foreach($centers as $center)
                                        <option value="{{ $center->id }}" {{ request('center') == $center->id ? 'selected' : '' }}>
                                            {{ $center->title }}
                                        </option>
                                    @endforeach
                                  </select>
                                </div>

                                <!-- <div class="col-lg-3 col-md-3 col-xs-12">
                                  <label>Select Institutes <span class="text-danger">*</span></label>
                                  <select name="institute" id="institute" class="form-control">
                                    <option value="">~~Select Institute~~</option>
                                    <option value="52706">NICT ATKOT</option>
                                    <option value="11313">Aadit Systems</option>
                                    {{-- बाकी options जस के तस --}}
                                  </select>
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

                                        Batch ID

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Batch Name

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>
                                    <th class="sort" width="">

                                        Batch Strength

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>

                                    <th class="sort" width="">

                                        Center.

                                        <i class="fas fa-sort" data-field="slider_menu.name"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        Start From

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        End To

                                        <i class="fas fa-sort" data-field="slider_menu.created"></i>

                                    </th>

                                    <th class="sort" width="15%">

                                        Acedemic Session

                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        Sanction Year

                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        Status

                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>

                                    </th>
                                    <th class="sort" width="15%">

                                        Sanctioned Letter

                                        <i class="fas fa-sort" data-field="slider_menu.status"></i>

                                    </th>

                                    

                                    <th class="text-center" width="10%">

                                        Actions

                                    </th>

                                </tr>

                            </thead>

                        {{-- ❗️tbody को id दिया ताकि JS पकड़ सके --}}
                        <tbody class="list" id="listing-container">
                          @if(!empty($listing->items()))
                            @include('partnerAdmin.batches.listingLoop')
                          @else
                            <tr><td align="left" colspan="12">No records found!</td></tr>
                          @endif
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

                    <!-- Card footer -->

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
            let academic_session = $('#academic_session').val();
            let state = $('#state').val();
            let institute = $('#institute').val();
            let center = $('#center_id').val();
            console.log(center,'center');
            console.log(state,'state');
            $.ajax({
                url: "{{ route('partnerAdmin.manageBatche') }}?page=" + page,
                type: 'GET',
                data: {
                    search: search,
                    academic_session: academic_session,
                    state: state,
                    institute: institute,
                    center: center
                },
                success: function(response) {
                    if(response.status === 'success') {
                        $('#listing-container').html(response.html);
                        $('#pagination-links').html(response.pagination);
                    }
                }
            });
        }
        $('#search').on('keyup', function(){
            fetchListing();
        });
        $('#academic_session, #state, #institute, #center_id').on('change', function(){
            fetchListing();
        });

        $(document).on('click', '#pagination-links a', function(e){
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchListing(page);
        });

    });

</script>
@endsection