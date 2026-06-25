<?php 
use App\Models\Admin\CustomPageData; 
use App\Libraries\General;
?>
@extends('layouts.frontendlayout')
@section('content')

<section id="promondex2" class="section-padding" style="padding-top:50px;">
        <div class="container">  
      <div class="row mb-5">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-0 mb-sm-5 mb-5 faq-page-into">
          <h6>User Dashboard</h6>
          <h4>Welcome {{isset($user->company_name) && $user->company_name ? $user->company_name : ''}}!</h4><span style="display:inline-block;"><a href="{{route('logout')}}">Logout</a></span>
          <div class="steam-details-tab">
            <div class="row">
              <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" href="#" data-target="#srone" data-toggle="tab">My Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#" data-target="#srtwo" data-toggle="tab">My Orders</a></li>
                  
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane animated fadeInRight active show" id="srone">
                    <div class="row" style="margin:0;">
                     <form method="post" id="myprofile-form" class="register_form account-form" action="{{ route('profile.update',['id'=> $user->id]) }}">
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-12 col-sm-12">
                          <label>Download this FeedBack Form from here <a href="https://nise.res.in/wp-content/uploads/2023/10/FEEDBACK-FORM.pdf" target="_blank">Click Here</a></label>
                          <br/><br/>
                        </div>
                        
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6 col-sm-6">
                          <label>Registration Type:</label>
                          <input class="form-control" type="text" name="reg_type" value="{{isset($user->registration_type) && $user->registration_type ? $user->registration_type : ''}}" readonly required >
                        </div>
                        @if(isset($user->registration_type) && $user->registration_type == 'Company')
                        <div class="form-group col-md-6 col-sm-6">
                          <label>Name of Company:</label><br/>
                          <input class="form-control" value="{{isset($user->company_name) && $user->company_name ? $user->company_name : ''}}" type="text" readonly required name="company_name">
                        </div>
                        @else
                        <div class="form-group col-md-6 col-sm-6">
                          <label>Name:</label><br/>
                          <input class="form-control" value="{{isset($user->ind_contact_person_name) && $user->ind_contact_person_name ? $user->ind_contact_person_name : ''}}" type="text" required name="ind_contact_person_name">
                        </div>
                        @endif
                        
                      </div>

                      <br/>
                      <div class="row">
                        @if(isset($user->registration_type) && $user->registration_type == 'Company')
                        <div class="form-group col-md-4 col-sm-4">
                          <label>Name of Contact Person:</label>
                          <input class="form-control" value="{{isset($user->person_name) && $user->person_name ? $user->person_name : ''}}" type="text" required name="person_name" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                          <label>Contact No. of Person:</label>
                          <input class="form-control" value="{{isset($user->mobile) && $user->mobile ? $user->mobile : ''}}" readonly name="mobile" type="text" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                          <label>Authorized Email id:</label><br/>
                          <input class="form-control" type="email" name="email" value="{{isset($user->email) && $user->email ? $user->email : ''}}" required >
                        </div>
                        @else
                        <div class="form-group col-md-6 col-sm-6">
                          <label>Contact No. of Person:</label>
                          <input class="form-control" value="{{isset($user->mobile) && $user->mobile ? $user->mobile : ''}}" readonly name="mobile" type="text" >
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                          <label>Authorized Email id:</label><br/>
                          <input class="form-control" type="email" name="email" value="{{isset($user->email) && $user->email ? $user->email : ''}}" required >
                        </div>
                        @endif
                        
                      </div>

                      <br/>
                      @if(isset($user->registration_type) && $user->registration_type == 'Company')
                      <div class="row">
                        <div class="form-group col-md-12 col-sm-12">
                          <label>Address:</label>
                          <input class="form-control" value="{{isset($user->address_1) && $user->address_1 ? $user->address_1 : ''}}" type="text"  required name="address_1">
                          <input class="form-control" value="{{isset($user->address_2) && $user->address_2 ? $user->address_2 : ''}}" type="text"  required name="address_2"> 
                        </div>
                      </div>
                      @else
                      <div class="row">
                        <div class="form-group col-md-12 col-sm-12">
                          <label>Address:</label>
                          <input class="form-control" value="{{isset($user->ind_address_1) && $user->ind_address_1 ? $user->ind_address_1 : ''}}" type="text"  required name="ind_address_1">
                          <input class="form-control" value="{{isset($user->ind_address_2) && $user->ind_address_2 ? $user->ind_address_2 : ''}}" type="text"  required name="ind_address_2"> 
                        </div>
                      </div>
                      @endif
                      <br/>
                      @if(isset($user->registration_type) && $user->registration_type == 'Company')
                      <div class="row">
                          <div class="form-group col-md-4 col-sm-4">
                            <label>State:</label>
                            <select class="selectpicker show-tick form-control" required name="state_id" data-live-search="false" style="height: 36px;">
                              <option value="">Select</option>
                              @foreach($states as $state)
                                  <option value="{{ $state->id }}" 
                                      {{ old('state_id', $user->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                      {{ $state->name }}
                                  </option>
                              @endforeach
                            </select> 
                          </div>
                          <div class="form-group col-md-4 col-sm-4">
                            <label>City / District:</label>
                            <input class="form-control" value="{{isset($user->city) && $user->city ? $user->city : ''}}" type="text" required name="city" >
                          </div>
                          <div class="form-group col-md-4 col-sm-4">
                            <label>Pin Code</label>
                            <input class="form-control" value="{{isset($user->pincode) && $user->pincode ? $user->pincode : ''}}" required name="pincode" type="text" >
                          </div>
                      </div>
                      @else
                      <div class="row">
                          <div class="form-group col-md-4 col-sm-4">
                            <label>State:</label>
                            <select class="selectpicker show-tick form-control" required name="ind_state_id" data-live-search="false" style="height: 36px;">
                              <option value="">Select</option>
                              @foreach($states as $state)
                                  <option value="{{ $state->id }}" 
                                      {{ old('ind_state_id', $user->ind_state_id ?? '') == $state->id ? 'selected' : '' }}>
                                      {{ $state->name }}
                                  </option>
                              @endforeach
                            </select> 
                          </div>
                          <div class="form-group col-md-4 col-sm-4">
                            <label>City / District:</label>
                            <input class="form-control" value="{{isset($user->ind_city_or_district) && $user->ind_city_or_district ? $user->ind_city_or_district : ''}}" type="text" required name="ind_city_or_district" >
                          </div>
                          <div class="form-group col-md-4 col-sm-4">
                            <label>Pin Code</label>
                            <input class="form-control" value="{{isset($user->ind_pin_code) && $user->ind_pin_code ? $user->ind_pin_code : ''}}" required name="ind_pin_code" type="text" >
                          </div>
                      </div>
                      @endif
                        <br/>
                        @if(isset($user->registration_type) && $user->registration_type == 'Company')
                        <div class="row">
                          <div class="form-group col-md-4 col-sm-4">
                            <label>Company PAN Number</label>
                            <input class="form-control" value="{{isset($user->pan) && $user->pan ? $user->pan : ''}}" required name="pan" type="text" >
                          </div>
                          <div class="form-group col-md-4 col-sm-4">
                            <label>Company TIN Number</label>
                            <input class="form-control" value="{{isset($user->tin) && $user->tin ? $user->tin : ''}}" required minlength="11" maxlength="11" name="tin" type="text">
                          </div>
                          <div class="form-group col-md-4 col-sm-4">
                            <label>Company GST Number</label>
                            <input class="form-control" value="{{isset($user->gst) && $user->gst ? $user->gst : ''}}" required name="gst" type="text" >
                          </div>
                        </div>
                        <br>
                        @endif
                        <input value="Save" name="update_profile" class="btn btn-warning btn-save pull-right" type="submit">
                         
                        
                      </form>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInRight" id="srtwo">
                    <div class="row">
                      <div class="table-responsive"> 
                        <table id="example" class="table table-bordered order-table theme-table table-striped" cellspacing="0" width="100%"> 
                          <thead> 
                            <tr> 
                              <th>Order No</th> 
                              <th>Order Date</th> 
                              <th>Test Description</th> 
                              <th>Price</th> 
                              <th>Payment Details</th> 
                              <th>Status</th> 
                              <th>Reason for Cancellation/Rejection</th> 
                              <th>Order Completion Date</th> 
                              <th>Download Report</th> 
                              <th>Print</th> 
                            </tr> 
                          </thead> 
                          <?php
                            // pr($orders); die;
                          ?>
                          <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>

                                    <td>{{ \Carbon\Carbon::parse($order->created)->format('d-m-Y') }}</td>

                                    <td>{{ $order->service_title . ' (' . $order->category_title . ')' }}</td>

                                    <td>{{ number_format($order->grand_total_fee, 2) }}</td>

                                    <td>
                                        {{ $order->payment_method ?? 'N/A' }} <br>
                                        {{ $order->payment_status ?? '' }}
                                    </td>

                                    <td>
                                      <span>{{ ucfirst(str_replace('_', ' ', $order->test_status)) }}</span>
                                    </td>

                                    <td>{{ $order->cancel_reason ?? '---' }}</td>

                                    <td>
                                        @if($order->actual_completion_date)
                                            {{ \Carbon\Carbon::parse($order->actual_completion_date)->format('d-m-Y') }}
                                        @else
                                            ---
                                        @endif
                                    </td>

                                    <td>
                                        @if(!empty($order->report_upload ))
                                            <a href="{{ url($order->report_upload ) }}" target="_blank" class="btn btn-sm btn-primary">
                                                Download
                                            </a>
                                        @else
                                            ---
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('testpdf', ['id' => General::encrypt($order->id)]) }}" target="_blank" class="btn btn-sm btn-secondary">
                                            Print
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> 
                        </table> 
                      </div>
                    </div>
                    
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          
        </div>
                
      </div>
      <!-- end row -->          
    
    
      
  
  </div>
    </section>


@endsection