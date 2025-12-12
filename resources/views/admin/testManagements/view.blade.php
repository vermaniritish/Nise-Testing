@extends('layouts.adminlayout')
@section('content')

<?php use App\Models\Admin\Admins;?>
<section>

    <div class="header bg-primary pb-6">

        <div class="container-fluid">

            <div class="header-body">

                <div class="row align-items-center py-4">

                    <div class="col-lg-6 col-7">

                        <h6 class="h2 text-white d-inline-block mb-0">Order Details</h6>

                    </div>

                    <div class="col-lg-6 col-5 text-right">
						@if($admin->role == 'cse' || $admin->role == 'labadmin')
							@if(!$orderTest->mark_disclose)
							<form action="{{ route('admin.mark.disclose') }}" method="POST">
								@csrf
								<input type="hidden" name="order_test_id" value="{{ $orderTest->id }}">
								<button type="submit" class="btn btn-neutral">
									Mark Close
								</button>
							</form>
							@endif
						@endif
						@if($orderTest->mark_disclose)
						<button type="button" class="btn btn-primary">
							<i class="fa fa-check"></i> Mark Closed
						</button>
						@endif
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

                    </div> 
					
					<!-- Card header -->
					
					<div class="card-header border-0">
					
					</div>
                    
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6 text-success">
								<h4>Test Job Id: {{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->order_number : ''}}</h4>
							</div>
							@if(AdminAuth::isAdmin())
								<div class="col-md-12 text-success">
								    <div class="d-flex align-items-center" style="gap:650px;">
								        <h5 class="m-0"><strong>Company Details</strong></h5>
								    </div>
								    <hr>
								</div>
								<div class="col-md-6">
									<div class="col-lg-12 col-md-12 col-xs-12">
										<label class="control-label" for="meta_title"> Company Name : </label> {{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->company_name : ''}}.
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
										<label class=" control-label" for="meta_title"> Address : </label>{{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->address_1.''.$orderTest->order_data->users->address_2 : ''}}.
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
										<label class=" control-label" for="meta_title"> PAN : </label> {{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->pan : ''}} <a href="{{isset($orderTest->order_data) && $orderTest->order_data ? asset($orderTest->order_data->users->pan_file) : ''}}" target="_blank">View</a>
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
										<label class=" control-label" for="meta_title"> Registration Number : </label> {{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->registration_number : ''}}
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Authorize Person Name : </label>
									{{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->person_name : ''}}                       		</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> E-mail : </label>
									{{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->email : ''}}                       		</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Mobile : </label>
									{{isset($orderTest->order_data) && $orderTest->order_data ? $orderTest->order_data->users->mobile : ''}}                        		</div>		
								</div>
								
								<div class="col-md-12 text-success"><h5><strong>Payment Details</strong></h5><hr></div>
								<div class="col-md-12">
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Total fee : </label>
									Rs. <strong>{{ isset($orderTest->order_data) && $orderTest->order_data ? number_format($orderTest->order_data->total_fee, 2).'/-' : '' }}</strong>
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title">  Paid fee with GST : </label>
									Rs. <strong>{{ isset($orderTest->order_data) && $orderTest->order_data ? number_format($orderTest->order_data->grand_total_fee, 2).'/-' : '' }}</strong>                                    </div>
								</div>
								@endif
								<div class="col-md-12 text-success"><h5><strong>Test Details</strong></h5><hr></div>	
								<div class="col-md-6">
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class="control-label" for="meta_title"> Test Service : </label> {{isset($orderTest->service_category_wise_test) && $orderTest->service_category_wise_test ? $orderTest->service_category_wise_test->service->title : ''}} 
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Test Type : </label> {{isset($orderTest->service_category_wise_test) && $orderTest->service_category_wise_test ? $orderTest->service_category_wise_test->serviceCategory->test_category_title : ''}}
																	</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Order Date : </label> {{ isset($orderTest->order_date) && $orderTest->order_date ? \Carbon\Carbon::parse($orderTest->order_date)->format('d M, Y') : '' }} 
									</div>
									<?php
										$assignJob = Admins::find($orderTest->assign_job)
									?>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Assign Job : </label>
									{{isset($assignJob->first_name) && $assignJob->first_name ? $assignJob->first_name.' '.$assignJob->last_name : ''}}</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Assigned date : </label>
									{{ isset($orderTest->assigned_date) && $orderTest->assigned_date ? \Carbon\Carbon::parse($orderTest->assigned_date)->format('d/m/Y') : '' }}</div>
								</div>
								<div class="col-md-6">
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Test Status : </label>
									Sample Accepted                        		</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Test start date : </label>
									01/09/2023                        		</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Test Job Completion Date : </label>
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Actual completion date : </label>
									</div>
									@if($orderTest->close_at)
									<div class="col-lg-12 col-md-12 col-xs-12">
										<label class=" control-label" for="meta_title"> Close At : {{ _dt($orderTest->close_at) }} </label>
									</div>
									@endif
								</div>
								<div class="col-md-12">
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Uploaded Documents : </label>
									<p style="font-size:13px;"><strong>PV Module Details</strong> – <a href="{{ $orderTest->order_data->upload_pv_module_docs ? asset($orderTest->order_data->upload_pv_module_docs) : '#' }}" target="_blank">View File</a><br/>
									<?php
									   $detailOfDocuments = $orderTest->documents;
									?>
									@if(isset($detailOfDocuments) && $detailOfDocuments)
										@foreach($detailOfDocuments as $detOfDocs)
											<strong>{{isset($detOfDocs['title']) && $detOfDocs['title'] ? $detOfDocs['title'] : ''}}</strong> – <a href="{{ asset($detOfDocs['name_of_doc_ssi']) }}">View file</a><br/>
											<strong>{{isset($detOfDocs['sub_title']) && $detOfDocs['sub_title'] ? $detOfDocs['sub_title'] : ''}}</strong> – <a href="{{ asset($detOfDocs->name_of_doc_billmat) }}">View file</a>
											<br/>
										@endforeach
									@endif
									<strong>Internal Test Report (optional)</strong> – <a href="{{isset($orderTest->order_data->internal_test_report) && $orderTest->order_data->internal_test_report ? asset($orderTest->order_data->internal_test_report) : ''}}">View file</a></p> 
										
									</div>
								</div>
								<div class="col-md-12 text-success"><h5><strong>Tech Details</strong></h5><hr></div>
								<div class="col-md-6">
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Test Status : </label>
									{{ isset($orderTest->test_status) && $orderTest->test_status ? ucwords(str_replace('_', ' ', $orderTest->test_status)) : '' }}                        		
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Test start date : </label>
									{{ isset($orderTest->test_start_date) && $orderTest->test_start_date ? \Carbon\Carbon::parse($orderTest->test_start_date)->format('d/m/Y') : '' }}                        		
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Test Job Completion Date : </label>
										{{ isset($orderTest->test_job_completion_date) && $orderTest->test_job_completion_date ? \Carbon\Carbon::parse($orderTest->test_job_completion_date)->format('d/m/Y') : '' }}
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12">
									<label class=" control-label" for="meta_title"> Actual completion date : </label>
										{{ isset($orderTest->actual_completion_date) && $orderTest->actual_completion_date ? \Carbon\Carbon::parse($orderTest->actual_completion_date)->format('d/m/Y') : '' }}
									</div>
								</div>
							@if(isset($orderRemarks) && count($orderRemarks) > 0)
							<div class="col-md-12 text-success"><h5><strong>Progress Timeline</strong></h5><hr></div>
							<div class="col-md-12">
								<div class="card-body">
									<ul class="timeline ml-1 mb-0">
										@if(isset($orderRemarks) && $orderRemarks)
											@foreach($orderRemarks as $kk => $ordRem)
											<li class="timeline-item timeline-item-transparent">
												<span class="timeline-point timeline-point-primary"></span> 
												@php
												    $first = $ordRem->assign_first_name ?? '';
												    $last = $ordRem->assign_last_name ?? '';

												    $initials = strtoupper(substr($first, 0, 1) . substr($last, 0, 1));
												@endphp
												<div class="timeline-event">
													<div class="timeline-header">
														<p class="mb-0 text-primary">
															<!-- <img src="https://placehold.jp/30/dd6699/ffffff/64x64.png?text=TS" height="24" width="24" class="rounded-circle mr-1"> -->
															<img src="https://placehold.jp/30/dd6699/ffffff/64x64.png?text={{ isset($initials) && $initials ? $initials : 'TS' }}" height="24" width="24" class="rounded-circle mr-1">
															 {{isset($ordRem->test_status) && $ordRem->test_status ? ucwords(str_replace('_', ' ', $ordRem->test_status)) : ''}}
														</p> 
														<small class="text-muted">Date: {{isset($ordRem->created) && $ordRem->created ? _dt($ordRem->created) : ''}}</small>
													</div> 
													<p class="my-1"></p>
													<p class="text-xs my-1">
														<!-- <strong>Job Assigned to:</strong> {{isset($ordRem->user_person_name) && $ordRem->user_person_name ? $ordRem->user_person_name : ''}}<br> -->
														<strong>Job Assigned to:</strong> {{ !empty($ordRem->assign_first_name) || !empty($ordRem->assign_last_name) ? ucfirst(trim($ordRem->assign_first_name . ' ' . $ordRem->assign_last_name)) : '' }}<br>
														<strong>Job Assigned by:</strong> {{isset($ordRem->owner_first_name) && $ordRem->owner_first_name ? $ordRem->owner_first_name.' '.$ordRem->owner_last_name : ''}}<br>
														<strong>Remarks:</strong> {{isset($ordRem->test_remark) && $ordRem->test_remark ? $ordRem->test_remark : ''}}<br>
														<strong>Files Upload:</strong>
														<?php
															$refDocFiles = isset($ordRem->reference_document_file) && $ordRem->reference_document_file ? json_decode($ordRem->reference_document_file, true) : [];
														?>
														@if(isset($refDocFiles) && $refDocFiles)
														 	@foreach($refDocFiles as $ke => $refDocFile) 
																<a href="{{isset($refDocFile) && $refDocFile ? asset($refDocFile) : ''}}" target="_blank">File {{$ke + 1}}</a> |
															@endforeach
														@endif
														<br>
													</p>
												</div>
											</li>
											@endforeach
										@endif											
									</ul>
								</div>
							</div>
							@endif
						</div>
						@if(!$orderTest->mark_disclose)
						<form method="post" action="{{route('admin.testOrder.remark')}}" class="form-validation" novalidate="novalidate">
						{{ @csrf_field() }}
						<div class="row">
							<input type="hidden" name="order_test_id" value="{{isset($orderTest->id) && $orderTest->id ? $orderTest->id : ''}}">
							<div class="col-md-12 text-success"><h5><strong>Actions</strong></h5><hr></div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-control-label" for="input-test-status">Test Status</label>
										<select name="test_status" id="test_status" class="form-control">
				                            <option value="">Select</option>
				                            <option value="sample_accepted">Sample accepted</option>
				                            <option value="sample_rejected">Sample rejected</option>
				                            <option value="job_started">Job Started</option>
				                            <option value="more_info_required">More info required</option>
				                            <option value="test_completed">Test Completed</option>
				                        </select>
										
										<br/>
										@php
									        $serviceId = $orderTest->service_category_wise_test->service->id ?? null;
									        $filteredAdmins = $admins->filter(function ($admin) use ($serviceId) {
									            $labTesting = json_decode($admin->lab_testing, true);
									            if (!is_array($labTesting)) {
									                return false;
									            }
									            return in_array($serviceId, $labTesting);
									        });
									    @endphp
										@if(!AdminAuth::isAdmin())
											<label class="form-control-label" for="input-test-status">Sent To</label>
											<select name="assign_to" id="assign_to">
												<option value="" selected disabled>Select</option>
												@foreach($filteredAdmins as $admin)
					                                <option value="{{ $admin->id }}"
					                                    {{ $orderTest->assign_job == $admin->id ? 'selected' : '' }}>
					                                    {{ $admin->first_name.' '.$admin->last_name }}
					                                </option>
					                            @endforeach
												<!-- <option value="labassociate">Lab Associate</option>
												<option value="labadmin">Lab Admin</option>
												<option value="Q&A">Q&A</option>
												<option value="cse">CSE</option>
												<option value="client">Client</option> -->
											</select>
											@endif
										<br/>
										<label class="form-control-label" for="input-first-name">Reference Document </label>
										
										<div class="upload-image-section" 
                                            data-type="file" 
                                            data-multiple="true" 
                                            data-path="testManagement" 
                                            data-resize-large="551*356"
                                        >
                                            <div class="upload-section">
                                                <div class="button-ref mt-4">
                                                    <button class="btn btn-icon btn-primary btn-sm" type="button">
                                                        <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                        <span class="btn-inner--text">Upload File</span>
                                                    </button>
                                                </div>
                                                <div class="progress d-none">
                                                  <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <!-- INPUT WITH FILE URL -->
                                            <textarea class="d-none" required name="reference_document_file"><?php echo old('reference_document_file') ?></textarea>
                                            <div class="show-section <?php echo !old('reference_document_file') ? 'd-none' : "" ?>">
                                                @include('admin.partials.previewFileRender', ['file' => old('reference_document_file') ])
                                            </div>
                                        </div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Test Remarks</label>
										<textarea id="testremarks" name="test_remark" type="text" class="form-control" style="height:170px;"></textarea>
									</div>
								</div>
								<div class="col-lg-12 col-12" style="padding-bottom:10px;">	
									<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
		                                <i class="fa fa-save"></i> Submit
		                            </button>
								</div>	
							</div>
						</form>
						@endif

						@if($admin->role == 'labadmin' && !$orderTest->mark_disclose)
						<form method="post" action="{{route('admin.mark.disclose.uploadFile')}}" class="form-validation" novalidate="novalidate">
						{{ @csrf_field() }}
						<div class="row">
							<div class="col-md-12 text-success"><h5><strong>Upload Report </strong></h5><hr></div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="hidden" name="order_test_id" value="{{ $orderTest->id }}">
										<label class="form-control-label" for="input-first-name">Please upload your report before mark it close.</label>
										
										<div class="upload-image-section" 
                                            data-type="file" 
                                            data-multiple="false" 
                                            data-path="report_upload" 
                                            data-resize-large="551*356"
                                        >
                                            <div class="upload-section">
                                                <div class="button-ref mt-4">
                                                    <button class="btn btn-icon btn-primary btn-sm" type="button">
                                                        <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                        <span class="btn-inner--text">Upload File</span>
                                                    </button>
                                                </div>
                                                <div class="progress d-none">
                                                  <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <!-- INPUT WITH FILE URL -->
                                            <textarea class="d-none" required name="report_upload"><?php echo old('report_upload') ?></textarea>
                                            <div class="show-section <?php echo !old('report_upload') ? 'd-none' : "" ?>">
                                                @include('admin.partials.previewFileRender', ['file' => old('report_upload') ])
                                            </div>
                                        </div>
									</div>
								</div>
								<div class="col-lg-12 col-12" style="padding-bottom:10px;">	
									<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
		                                <i class="fa fa-save"></i> Submit
		                            </button>
								</div>	
							</div>
						</form>
						@endif
						@if(!empty($orderTest->report_upload))
						    <div class="row mt-4">
						        <div class="col-md-12 text-info">
						            <h5><strong>Uploaded Report</strong></h5>
						            <hr>
						        </div>

						        <div class="col-md-6">
						            <div class="card shadow p-3">

						                {{-- Show file name --}}
						                <p><strong>Report File:</strong> {{ basename($orderTest->report_upload) }}</p>

						                {{-- Preview for PDF / Image --}}
						                @php
						                    $file = $orderTest->report_upload;
						                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
						                @endphp

						                @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
						                    <img src="{{ asset($file) }}" alt="Report File" class="img-fluid">
						                @elseif($ext == 'pdf')
						                    <iframe src="{{ asset($file) }}" width="100%" height="400px"></iframe>
						                @else
						                    <p class="text-danger">Preview not available for this file type.</p>
						                @endif

						                {{-- Download Button --}}
						                <a href="{{ asset($file) }}" download class="btn btn-success mt-3">
						                    <i class="fa fa-download"></i> Download Report
						                </a>

						            </div>
						        </div>
						    </div>
						@endif

					</div>
                </div>

            </div>

        </div>

    </div>

    <!-- Modal -->

</section>
@endsection
