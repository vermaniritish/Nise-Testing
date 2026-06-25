<?php use App\Models\Admin\CustomPageData; ?>
@extends('layouts.frontendlayout')
@section('content')

<style>
    .error {
        color: red !important;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
</style>
<section id="page-banner">
        
        <div class="single-page-title-area-bottom">
            <div class="auto-container">
                <div class="row">
                    <div class="col-12 text-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('front.Home') }}</a></li>
                            <li class="breadcrumb-item active">Sign up</li>
                        </ol>
                    </div>
                </div>
                <!-- end row-->
            </div>
        </div>
    </section>
    <!-- END PAGE BANNER AND BREADCRUMBS -->
    
        
    <!-- START NOTICE-LOGIN SECTION -->
    <section id="promot" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 pr-lg-5 pr-md-5 pr-sm-0 pr-0 mb-lg-0 mb-md-4 mb-sm-4 mb-4">
                    <div class="row">
                        <div class="col-12 text-left">
                            <div class="section-title-2">
                                <h3>Please  <span>Register Here</span></h3>
                            </div>
                        </div>
                    </div>
                    <!-- end section title -->
                    <div class="home-p-form-wrapper">
                        <div class="home-p-form">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{ route('registration.store') }}" enctype="multipart/form-data" id="registrationForm" class="register_form" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Registration Type</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 noRightPadding">
                                                <select class="form-control" required="" name="registration_type" style="height: 31px;width: 46%;" class="selectpicker show-tick valid" data-live-search="false" onchange="chngtype(this);" aria-required="true" aria-invalid="false">
                                                    <option value="Company">Company</option>
                                                     <option value="Individual">Individual</option>                  
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div id="company" style="">
                                <br/>
                                <h5>Company Information</h5>
                                <br/>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" class="form-control"  placeholder="Company name" required="" name="company_name" aria-required="true">
                                    </div>
                                </div>
                                <br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" class="form-control"  name="address_1" placeholder="Address line 1" required="" aria-required="true">
                                        <input type="text" class="form-control"  name="address_2" placeholder="Address line 2" required="" aria-required="true">
                                        <br/><div class="row">
                                            <div class="col-md-6 col-sm-6 noRightPadding">
                                                <select class="form-control" required="" name="state_id" id="state_id" style="height: 31px;" class="selectpicker show-tick" title="Select State" data-live-search="false" aria-required="true">
                                                    <option value="">Select State</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" name="city" class="form-control"  placeholder="City / District" required="" aria-required="true">
                                            </div>
                                            <div class="col-md-6 col-sm-6 noRightPadding">
                                                <!-- <input type="text" name="pincode" class="form-control"  placeholder="Pin code" required="" aria-required="true"> -->
                                                <input name="pincode" class="form-control" placeholder="Pin code *" required type="text" minlength="6" maxlength="6" pattern="[0-9]{6}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                                <br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>PAN Number</label> <span class="text-danger">*</a>
                                    </div>
                                    <div class="col-md-9 col-sm-9">                                       
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 noRightPadding">
                                                <input 
                                                    name="pan" 
                                                    class="form-control" 
                                                    id="pan" 
                                                    placeholder="Company Pan No." 
                                                    required 
                                                    type="text" 
                                                    minlength="10" 
                                                    maxlength="10" 
                                                    pattern="[A-Za-z0-9]{1,10}" 
                                                    oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">
                                            </div>                                        
                                            <!-- <div class="col-md-6 col-sm-6">
                                                <input type="file" class="field-upload" placeholder="Company TIN number" required="" name="pan_file" aria-required="true">
                                            </div> -->
                                            <div class="col-md-6 col-sm-6">
                                                <div class="upload-image-section">
                                                    <div class="upload-section">
                                                        <div class="button-ref">
                                                            <button class="btn btn-icon btn-primary btn-lg" type="button" onclick="document.getElementById('pan_file_file').click()">
                                                                <span class="btn-inner--icon" style="font-size: 13px;"><i class="fas fa-upload"></i></span>
                                                                <span class="btn-inner--text" style="font-size: 13px;">Upload File</span>
                                                            </button>
                                                        </div>

                                                        <!-- HIDDEN FILE INPUT -->
                                                        <input type="file" required id="pan_file_file" name="pan_file" class="d-none" onchange="previewFile(this)">
                                                        
                                                        <!-- PREVIEW SECTION -->
                                                        <div id="file_preview" class="mt-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>TIN Number</label> <span class="text-danger">*</a>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" class="form-control"  placeholder="Company TIN number" required="" minlength="11" maxlength="11" name="tin" aria-required="true">
                                    </div>
                                </div>
                                <br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Registration Number</label> <span class="text-danger">*</a>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 noRightPadding">
                                                <input type="text" class="form-control"  placeholder="Company registration number" required="" minlength="21" maxlength="21" name="registration_number" aria-required="true">
                                            </div>                                        
                                            <div class="col-md-6 col-sm-6">
                                                <div class="upload-image-section">
                                                    <div class="upload-section">
                                                        <div class="button-ref">
                                                            <button class="btn btn-icon btn-primary btn-lg" type="button" 
                                                                onclick="document.getElementById('company_registration_file').click()">
                                                                <span class="btn-inner--icon" style="font-size: 13px;"><i class="fas fa-upload"></i></span>
                                                                <span class="btn-inner--text" style="font-size: 13px;">Upload File</span>
                                                            </button>
                                                        </div>

                                                        <!-- HIDDEN FILE INPUT -->
                                                        <input type="file" id="company_registration_file" required name="company_file" class="d-none" onchange="companyPreviewFile(this)">
                                                        
                                                        <!-- PREVIEW SECTION -->
                                                        <div id="company_registration_file_preview" class="mt-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h3 class="heading">Contact Person Information</h3>
                                <br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Authorize Person Name</label> <span class="text-danger">*</a>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" class="form-control"  placeholder="Your name" required="" name="person_name" aria-required="true">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Contact Number</label> <span class="text-danger">*</a>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <!-- <input type="text" class="form-control"  placeholder="Your contact number" required="" name="mobile" aria-required="true"> -->
                                        <input name="mobile" class="form-control" value="{{ old('mobile') }}" id="phone" placeholder="Mobile number" required type="tel" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                    </div>
                                </div>

                                <br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Email id</label> <span class="text-danger">*</a>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="email" class="form-control" placeholder="Company e-mail id" id="email" required name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                                    </div>
                                </div>

                                <!--<br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Passowrd</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="password" class="form-control"  placeholder="*********" required="" name="password" aria-required="true">
                                    </div>
                                </div>-->

                                </div>
                                <div id="individual" style="display: none;">
                                <br/>
                                <h5>Individual Information</h5>
                                <br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" class="form-control"  placeholder="Name" required="" name="ind_contact_person_name" aria-required="true">
                                    </div>
                                </div>

                                <br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" class="form-control"  name="ind_address_1" placeholder="Address line 1" required="" aria-required="true">
                                        <input type="text" class="form-control"  name="ind_address_2" placeholder="Address line 2" required="" aria-required="true">
                                        <br/><div class="row">
                                            <div class="col-md-6 col-sm-6 noRightPadding">
                                                <select class="form-control" required="" name="ind_state_id" style="height: 31px;" class="selectpicker show-tick" title="Select state" data-live-search="false" aria-required="true">
                                                    <option value="">Select State</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" name="ind_city_or_district" class="form-control"  placeholder="City / District" required="" aria-required="true">
                                            </div>
                                            <div class="col-md-6 col-sm-6 noRightPadding">
                                                <!-- <input type="text" name="ind_pin_code" class="form-control"  placeholder="Pin code" required="" aria-required="true"> -->
                                                <input name="ind_pin_code" class="form-control" placeholder="Ind Pin Code" required type="text" minlength="6" maxlength="6" pattern="[0-9]{6}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                 <br/>
                                 <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Contact Number</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <!-- <input type="text" class="form-control"  placeholder="Your contact number" required="" name="ind_mobile_number" aria-required="true"> -->
                                        <input name="ind_mobile_number" class="form-control" value="{{ old('ind_mobile_number') }}" id="phone_copy" placeholder="Mobile number" required type="tel" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                    </div>
                                </div>

                                <br/>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Email id</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="email" class="form-control" placeholder="Email id" id="ind_email" name="ind_email">
                                    </div>
                                </div>

                                <!-- <br/><div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>Passowrd</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="password" class="form-control"  placeholder="*********" required="" name="password" aria-required="true">
                                    </div>
                                </div> -->


                                </div>


                                <!--<input type="submit" value="Register" class="btn btn-warning pull-right">-->
                                <!-- <a href="thankyouregister.php" title="Click here to submit!" class="btn-style btn-filled btn-filled-2">Register</a> -->
                                <div class="form-group col-lg-6 mb-3">
                                    <button type="submit" title="Click here to submit!" class="btn-style btn-filled btn-filled-2">Register</button>
                                </div>
                                <div class="clearfix"></div>
                            </form>                         
                        </div>
                    </div>
                </div>
                <!-- end col -->                
            </div>
        </div>
        <!--- END CONTAINER -->
    </section>

<script>
    // $("#registrationForm").validate();
    function chngtype(all) {
        if(all.value == 'Company'){
         $("#company").show();
         $("#company input").attr('required', 'required');
         $("#individual").hide();    
        }else{
         $("#individual").show();
         $("#company input").attr('required', null);
         $("#company").hide();
        }
    }

    function previewFile(input) {
        let previewDiv = document.getElementById('file_preview');
        previewDiv.innerHTML = ""; // reset preview

        if (input.files && input.files[0]) {
            let file = input.files[0];
            let fileType = file.type;

            // Agar Image hai to preview image dikhao
            if (fileType.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail");
                    img.style.maxWidth = "200px";
                    img.style.marginTop = "10px";
                    previewDiv.appendChild(img);
                }
                reader.readAsDataURL(file);
            } 
            // Agar image nahi hai to sirf file name show kare
            else {
                previewDiv.innerHTML = `<p class="text-info mt-2">Selected File: ${file.name}</p>`;
            }
        }
    }

    function companyPreviewFile(input) {
        let previewDiv = document.getElementById('company_registration_file_preview');
        previewDiv.innerHTML = "";
        
        if (input.files && input.files[0]) {
            let file = input.files[0];
            let fileType = file.type;
            
            if (fileType.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail");
                    img.style.maxWidth = "200px";
                    img.style.marginTop = "10px";
                    previewDiv.appendChild(img);
                }
                reader.readAsDataURL(file);
            } else {
                previewDiv.innerHTML = `<p class="text-info mt-2">Selected File: ${file.name}</p>`;
            }
        }
    }


</script>

    <!-- END NOTICE-LOGIN SECTION -->
@endsection