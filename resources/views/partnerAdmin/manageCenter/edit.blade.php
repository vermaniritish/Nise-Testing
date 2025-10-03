@extends('layouts.partneradminlayout')
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
                        <a href="{{ route('partnerAdmin.manageCenter') }}" class="btn btn-neutral">
                            <i class="ni ni-bold-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
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
                    <div class="card-header">
                        <h3 class="mb-0">Edit/Update Center Here.</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('partnerAdmin.manageCenter.edit', $center->id) }}" enctype="multipart/form-data">
                            @csrf 
                            <div class="row">
								<div class="col-lg-6 col-md-6 col-xs-12">
								  <label for="icon">Center Name <span class="text-danger">*</span></label>
								  <input type="text" name="title" id="title" value="{{ old('title', $center->title) }}" class="form-control" placeholder="Please enter name of center">
								  <span class="text-danger err-msg" id="err-title"></span>
								</div>
								<div class="col-lg-6 col-md-6 col-xs-12">
								  <label for="icon">Center Id </label>
								  <input type="text" value="INST-CEN-1111106/CEN/BR/462" class="form-control" readonly="">
								</div>
							</div>
                            {{-- Address --}}
                            <div class="form-group">
                                <label>Address with Pin Code <span class="text-danger">*</span></label>
                                <textarea name="address" rows="5" class="form-control">{{ old('address', $center->address ?? '') }}</textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- State, District, City --}}
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>State <span class="text-danger">*</span></label>
                                    <select name="state_id" class="form-control" >
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ old('state_id', $center->state_id) == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>District <span class="text-danger">*</span></label>
                                    <select name="district_id" id="district_id" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ old('district_id', $center->district_id) == $district->id ? 'selected' : '' }} >{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control"
                                           value="{{ old('city', $center->city ?? '') }}">
                                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Contact & Email & Session --}}
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Contact No <span class="text-danger">*</span></label>
                                    <!-- <input type="text" name="phone" class="form-control"
                                           value="{{ old('phone', $center->phone ?? '') }}"> -->
                                    <input name="phone" class="form-control" value="{{ old('phone', $center->phone ?? '') }}" id="phone" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email Id <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ old('email', $center->email ?? '') }}">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
								    <label>Academic Session <span class="text-danger">*</span></label>
								    <select name="academic_session" class="form-control">
								        <option value="">Select</option>
								        @foreach($sessions as $session)
								            <option value="{{ $session }}" 
								                {{ old('academic_session', $center->academic_session) == $session ? 'selected' : '' }}>
								                {{ $session }}
								            </option>
								        @endforeach
								    </select>
								    @error('academic_session')
								        <span class="text-danger">{{ $message }}</span>
								    @enderror
								</div>

                            </div>
                            <h5>Institute Officer Details</h5>
							<table class="table">
							    <thead>
							        <tr><th>Name</th><th>Contact</th><th>Email</th><th></th></tr>
							    </thead>
							    <tbody id="officer_body">
							    	@if(isset($applications) && count($applications) > 0)
								        @foreach($applications as $app)
								            <tr>
								                <td>
								                    <input type="text" name="person_name[]" class="form-control" value="{{ $app->person_name }}">
								                </td>
								                <td>
								                	<!-- <input type="text" name="person_contact[]" class="form-control" value="{{ $app->person_contact }}"> -->
								                	<input name="person_contact[]" class="form-control" value="{{ $app->person_contact }}" id="phone" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
								                </td>
								                <td><input type="email" name="person_email[]" class="form-control" value="{{ $app->person_email }}"></td>
								                <td><button type="button" class="btn btn-danger remove-row">X</button></td>
								            </tr>
								        @endforeach
								    @else
									    <tr>
							                <td>
							                    <input type="text" name="person_name[]" class="form-control" value="{{ old('person_name') }}">
							                </td>
							                <td><input name="person_contact[]" class="form-control" value="{{ old('person_contact.0') }}" id="phone" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');"></td>
							                <td><input type="email" name="person_email[]" class="form-control" value="{{ old('person_email') }}"></td>
							                <td><button type="button" class="btn btn-danger remove-row">X</button></td>
							            </tr>
								    @endif
							    </tbody>
							    <tfoot>
							        <tr>
							            <td colspan="4">
							                <button type="button" class="btn btn-primary" id="addOfficer">+ Add</button>
							            </td>
							        </tr>
							    </tfoot>
							</table>

                            {{-- File Upload Fields --}}
                            @php
                                $files = [
                                    'center_affiliation'=>'Center Affiliation Certificate',
                                    'trainer_certificate'=>'Trainer Certificate',
                                    'onboard_proof'=>'AEBAS Registration Proof',
                                    'cctv_docs'=>'CCTV Camera Login Proof',
                                    'affiliation_valid_from'=>'Valid From',
                                    'affiliation_valid_to'=>'Valid To',
                                    'sip_registration_id'=>'SIP Registration ID',
                                    'mobilisation_proof'=>'Proof of Participant Mobilisation',
                                    'sipid_proof'=>'SIP portal Registration Proof',
                                ];
                            @endphp

                            <div class="form-group">
								  <div class="row">
								  <div class="col-lg-12 col-md-12 col-xs-12">
									<label class="control-label" for="linkname">Center Afflilation Certificate <span class="text-danger">*</span></label>
									<input type="file" name="center_afflilation_doc" id="center_afflilation_doc" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile" style="width:80%">
									@if($center->center_afflilation_doc)
									  <a href="{{ asset('uploads/centers/'.$center->center_afflilation_doc) }}" target="_blank">View</a>
									@endif
									<small><span id="center_afflilation_doc" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-center_afflilation_doc"></span>
								  </div>
								  </div>
								  </div>
								  <div class="form-group">
								  <div class="row">
								  <div class="col-lg-6 col-md-12 col-xs-12">
									<label class="control-label" for="linkname">Trainer Certificate <span class="text-danger">*</span></label>
									<input type="file" name="traner_certificate" id="traner_certificate" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile" style="width:80%">
									@if($center->traner_certificate)
									  <a href="{{ asset('uploads/centers/'.$center->traner_certificate) }}" target="_blank">View</a>
									@endif
									<small><span id="traner_certificate" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-traner_certificate"></span>
								  </div>
								  <div class="col-lg-6 col-md-6 col-xs-12">
									<label class="control-label" for="linkname">Proof of registration on AEBAS portal (Screenshot of the registered participants on central.nise.res.in) <!--<small>(<a href="https://suryamitra.nise.res.in/uploads/centers/gallery/notice/5ce8c7fdc56517cbceb38edeb650e151.pdf" target="_blank">Click To download Format</a>)</small>--> <span class="text-danger">*</span></label>
									<input type="file" name="on_boarding_file" id="on_boardinge_file" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile" style="width:80%">
									@if($center->on_boarding_file)
									  <a href="{{ asset('uploads/centers/'.$center->on_boarding_file) }}" target="_blank">View</a>
									@endif
									<small><span id="on_boarding_file" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-on_boarding_file"></span>
								  </div>
								  </div>
								  </div>
								  
								  <div class="form-group">
								  <div class="row">
								  <div class="col-lg-6 col-md-12 col-xs-12">
									<label class="control-label" for="linkname">CCTV Camera's Login Details [Classroom, Laboratory and Hostel, M  ess]<span class="text-danger">*</span></label>
									<input type="file" name="cctv_camera_file" id="cctv_camera_file" accept=".pdf, .jpg, .jpeg, .png" class="form-control checkFile" style="width:80%">
									@if($center->cctv_camera_file)
									  <a href="{{ asset('uploads/centers/'.$center->cctv_camera_file) }}" target="_blank">View</a>
									@endif
									<small><span id="cctv_camera_file" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-cctv_camera_file"></span>
								  </div>
								  <div class="col-lg-6 col-md-6 col-xs-12">
									<label class="control-label" for="linkname">Center Afflilation Certificate Valid From <span class="text-danger">*</span></label>
									<input type="date" name="affiliation_valid_from" id="affiliation_valid_from" class="form-control datepicker " placeholder="Enter valid date in MM/DD/YYY format" readonly="" value="{{$center->affiliation_valid_from}}">
									<span class="text-danger err-msg" id="err-affiliation_valid_from"></span>
								  </div>
								  </div>
								  </div>
								  <div class="form-group">
								  <div class="row">
								  <div class="col-lg-6 col-md-12 col-xs-12">
									<label class="control-label" for="linkname">Center Afflilation Certificate Valid To <span class="text-danger">*</span></label>
									<input readonly="" type="date" name="affiliation_valid_to" id="affiliation_valid_to" class="form-control datepicker " placeholder="Enter valid date in MM/DD/YYY format" value="{{$center->affiliation_valid_to}}">
									<span class="text-danger err-msg" id="err-affiliation_valid_to"></span>
								  </div>
								  <div class="col-lg-6 col-md-6 col-xs-12">
									<label for="icon">SIP Registration ID <span class="text-danger">*</span></label>
									<input type="text" name="sip_id" id="sip_id" value="{{$center->sip_id}}" class="form-control" placeholder="Skill india portal id">
									
									<span class="text-danger err-msg" id="err-FullName"></span>
								  </div>
								  </div>
								  </div>
								  <div class="form-group">
								  <div class="row">
								  <div class="col-lg-6 col-md-12 col-xs-12">
									<label class="control-label" for="linkname">Proof of advertisement for mobilisation of participants<span class="text-danger">*</span></label>
									<input type="file" name="mobilisation" id="mobilisation" class="form-control checkFile" accept=".pdf, .jpg, .jpeg, .png" style="width:80%">
									@if($center->mobilisation)
									  <a href="{{ asset('uploads/centers/'.$center->mobilisation) }}" target="_blank">View</a>
									@endif
									<small><span id="mobilisation" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-mobilisation"></span>
								  </div>
								  <div class="col-lg-6 col-md-6 col-xs-12">
									<label class="control-label" for="linkname">Proof of registration on SIP portal (Screenshot of the registered participants on SIP portal)<span class="text-danger">*</span></label>
									<input type="file" name="sip_id_proof" id="sip_id_proof" class="form-control checkFile" accept=".pdf, .jpg, .jpeg, .png" style="width:80%">
									@if($center->sip_id_proof)
									  <a href="{{ asset('uploads/centers/'.$center->sip_id_proof) }}" target="_blank">View</a>
									@endif
									<small><span id="sip_id_proof" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-sip_id_proof"></span>
								  </div>
								  </div>
								  </div>

                            <div class="form-group text-right">
                                <a href="{{ route('partnerAdmin.manageCenter') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- JavaScript for dynamic officer rows --}}
@push('scripts')
<script>
	function validateFile(inputId, errorId) {
        const input = document.getElementById(inputId);
        input.addEventListener('change', function () {
            let file = this.files[0];
            let allowedExtensions = /(\.pdf|\.jpg|\.jpeg|\.png)$/i;
            let errorElement = document.getElementById(errorId);

            if (file) {
                // check file type
                if (!allowedExtensions.test(file.name)) {
                    errorElement.textContent = "The file type must be pdf, jpg, jpeg, png";
                    this.value = "";
                    return;
                }

                // check file size (<= 5MB)
                let fileSizeMB = file.size / 1024 / 1024; // convert bytes → MB
                if (fileSizeMB > 5) {
                    errorElement.textContent = "File size must not exceed 5 MB";
                    this.value = "";
                    return;
                }
            }
            errorElement.textContent = "";
        });
    }

    // Call function for each file input
    validateFile('center_afflilation_doc', 'err-center_afflilation_doc');
    validateFile('traner_certificate', 'err-traner_certificate');
    validateFile('on_boarding_file', 'err-on_boarding_file');
    validateFile('mobilisation', 'err-mobilisation');
    validateFile('cctv_camera_file', 'err-cctv_camera_file');
    validateFile('sip_id_proof', 'err-sip_id_proof');


    document.getElementById('addOfficer').addEventListener('click', function(){
        const tbody = document.getElementById('officer_body');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="person_name[]" class="form-control"></td>
            <td><input name="person_contact[]" class="form-control" value="{{ old('person_contact.0') }}" id="phone" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');"></td>
            <td><input type="email" name="person_email[]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger remove-row">X</button></td>
        `;
        tbody.appendChild(row);
    });
    document.addEventListener('click', function(e){
        if (e.target && e.target.matches('.remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endpush

@endsection