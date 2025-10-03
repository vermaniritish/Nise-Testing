@extends('layouts.adminlayout')
@section('content')

<section>

    <div class="header bg-primary pb-6">

        <div class="container-fluid">

            <div class="header-body">

                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Center Wise Batch Details</h6>
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
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label for="icon">Financial Year <span class="text-danger">*</span></label>
                                        <select name="tranSession" id="tranSession" class="form-control" onchange="fetchBatchList(this.value)">
                                            <option value="">~~~~~~~Select Session ~~~~~~~</option><option value="2017-2018">2017-2018</option><option value="2018-2019">2018-2019</option><option value="2019-2020">2019-2020</option><option value="2020-2021">2020-2021</option><option value="2021-2022">2021-2022</option><option value="2022-2023">2022-2023</option><option value="2023-2024">2023-2024</option><option value="2024-2025" selected>2024-2025</option>
                                        </select>
                                    </div>  
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                      <label for="icon">Select Institutes <span class="text-danger">*</span></label>
                                       <select name="institute" id="institute" class="form-control" onchange="getCenterList(this.value)">
                                            <option value="">~~~Select Institute~~~</option>
                                            <option value="52706"> NICT ATKOT</option>
                                            <option value="11313">Aadit Systems</option>
                                            <option value="53447">Aarav Educational &amp; Employment Research Organization</option>
                                            <option value="52734">AARAV EDUCATIONAL &amp; EMPLOYMENT RESEARCH ORG.</option>
                                            <option value="11314">Aaruthal Foundation</option>
                                            <option value="41643">Academy for Computer Trainig (Guj.) Pvt. Ltd.</option>
                                            <option value="53398">Access Edutech Private Limited</option>
                                            <option value="53453">Adhishree Skills Private Limited</option>
                                            <option value="5362">ADS Foundation</option>
                                            <option value="41644">Afadul Hasan Welfare Society</option>
                                            <option value="5364">Agrasen Polytechnic College</option>
                                            <option value="11315">AISECT</option>
                                            <option value="52841">Rawat Bal Vidha Niketan Samittee</option>
                                            <option value="5356" selected>Salt lake Institute Of Engineering &amp; Management</option>
                                            <option value="46435">Yadupati Singhania Centre for Vocational Skill Development</option>
                                            <option value="5391">YouthNet</option>
                                            <option value="52945">ZRIMA EDUTECH PRIVATE LIMITED</option>
                                       </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12"><br/>
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
                    
                    <div class="modal-dialog1">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header" style="background-color: #3c8dbc; color:#fff">
                          <h4 class="modal-title" style="color:#fff"><b>Salt lake Institute Of Engineering &amp; Management</b></h4>
                        </div>
                        <div style="padding-bottom: 10px;">
                            <ul class="list-group1" style="list-style:none;padding-left:20px;">
                                <li><strong>Center Name</strong><span class="pull-right" style="padding-right: 10px;"><strong>Allocated Batch</strong></span></li></ul>
                                <ol>
                                    <li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM SILCHAR<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM DHANBAD<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM SILIGURI<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM JAMSHEDPUR<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM ASANSOL<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM BARASAT<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM BAREILLY<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM SOHRA<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">Salt lake Institute Of Engineering &amp; Managemen<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">NISE_2021-22_SLIEM SALTLAKE<span class="pull-right" style="margin-right:40px;">1</span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">Saltlake Institute of Engineering &amp; Management Limited<span class="pull-right" style="margin-right:40px;">1</span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM Barasat<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM Kandhamal<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM Mandi<span class="pull-right" style="margin-right:40px;"></span></li><li style="border-bottom:1px solid #ccc; margin-bottom : 8px;">SLIEM - GYALSHING<span class="pull-right" style="margin-right:40px;"></span></li>
                                </ol>
                                <ul class="list-group1" style="list-style:none;padding-left:20px;">
                                    <li><strong>Total Batch Allocated : 2</strong><span class="pull-right" style="padding-right: 10px;"><strong>Batch Created : 0</strong></span></li>
                                </ul>
                            </div>
                      </div>
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