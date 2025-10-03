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
                        <a href="{{ route('admin.userManagement.partnerTraining') }}" class="btn btn-neutral">
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
                        <h3 class="mb-0">Add New Center Here.</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.userManagement.partnerTraining.add') }}" enctype="multipart/form-data">
                            @csrf 
                            <div class="row">
								<div class="col-lg-6 col-md-6 col-xs-12">
								  <label for="icon">Center Name <span class="text-danger">*</span></label>
								  <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" placeholder="Please enter name of center">
								  <span class="text-danger err-msg" id="err-title"></span>
								</div>
								<div class="col-lg-6 col-md-6 col-xs-12">
								  <label for="icon">User Name </label>
								  <input type="text" value="INST-CEN-1111106/CEN/BR/462" class="form-control" readonly="">
								</div>
							</div>
                            {{-- Address --}}
                            <div class="form-group">
                                <label>Address with Pin Code <span class="text-danger">*</span></label>
                                <textarea name="address" rows="5" class="form-control">{{ old('address') }}</textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- State, District, City --}}
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>State <span class="text-danger">*</span></label>
                                    <select name="state_id" class="form-control" onchange="fetchDistrict(this.value)">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>District <span class="text-danger">*</span></label>
                                    <select name="district_id" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ old('district_id') == $district->id ? 'selected' : '' }} >{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control"
                                           value="{{ old('city') }}">
                                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Contact & Email & Session --}}
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Contact No <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control"
                                           value="{{ old('phone') }}">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email Id <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ old('email') }}">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
								    <label>Academic Session <span class="text-danger">*</span></label>
								    <select name="academic_session" class="form-control">
								        <option value="">Select</option>
								        @foreach($sessions as $session)
								            <option value="{{ $session }}" {{ old('academic_session') == $session ? 'selected' : '' }}>
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
								    <tr>
						                <td><input type="text" name="person_name[]" class="form-control" value="{{ old('person_name.0') }}"></td>
						                <td><input type="text" name="person_contact[]" class="form-control" value="{{ old('person_contact.0') }}"></td>
						                <td><input type="email" name="person_email[]" class="form-control" value="{{ old('person_email.0') }}"></td>
						                <td><button type="button" class="btn btn-danger remove-row">X</button></td>
						            </tr>
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
                            <div class="form-group">
								  <div class="row">
								  <div class="col-lg-12 col-md-12 col-xs-12">
									<label class="control-label">Center Afflilation Certificate <span class="text-danger">*</span></label>
									<input type="file" name="center_afflilation_doc" id="center_afflilation_doc_File" class="form-control checkFile" style="width:80%">
									<small><span id="center_afflilation_doc" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-center_afflilation_doc_File"></span>
								  </div>
								  </div>
								  </div>
								  <div class="form-group">
								  <div class="row">
								  <div class="col-lg-6 col-md-12 col-xs-12">
									<label class="control-label">Trainer Certificate <span class="text-danger">*</span></label>
									<input type="file" name="traner_certificate" id="traner_certificate_File" class="form-control checkFile" style="width:80%">
									<small><span id="traner_certificate" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-traner_certificate_File"></span>
								  </div>
								  <div class="col-lg-6 col-md-6 col-xs-12">
									<label class="control-label">Proof of registration on AEBAS portal <span class="text-danger">*</span></label>
									<input type="file" name="on_boarding_file" id="on_boardinge_file" class="form-control checkFile" style="width:80%">
									<small><span id="on_boarding_file" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-onBoardinge_File"></span>
								  </div>
								  </div>
								  </div>
								  
								  <div class="form-group">
								  <div class="row">
								  <div class="col-lg-6 col-md-12 col-xs-12">
									<label class="control-label">CCTV Camera's Login Details <span class="text-danger">*</span></label>
									<input type="file" name="cctv_camera_file" id="cctv_camera_file" class="form-control checkFile" style="width:80%">
									<small><span id="cctv_camera_file" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-cctvCamera_File"></span>
								  </div>
								  <div class="col-lg-6 col-md-6 col-xs-12">
									<label class="control-label">Center Afflilation Certificate Valid From <span class="text-danger">*</span></label>
									<input type="text" name="affiliation_valid_from" id="affiliation_valid_from" class="form-control datepicker" placeholder="Enter valid date in MM/DD/YYY format" readonly="" value="{{ old('affiliation_valid_from') }}">
									<span class="text-danger err-msg" id="err-affiliation_valid_from"></span>
								  </div>
								  </div>
								  </div>
								  <div class="form-group">
								  <div class="row">
								  <div class="col-lg-6 col-md-12 col-xs-12">
									<label class="control-label">Center Afflilation Certificate Valid To <span class="text-danger">*</span></label>
									<input readonly="" type="text" name="affiliation_valid_to" id="affiliation_valid_to" class="form-control datepicker" placeholder="Enter valid date in MM/DD/YYY format" value="{{ old('affiliation_valid_to') }}">
									<span class="text-danger err-msg" id="err-affiliation_valid_to"></span>
								  </div>
								  <div class="col-lg-6 col-md-6 col-xs-12">
									<label for="icon">SIP Registration ID <span class="text-danger">*</span></label>
									<input type="text" name="sip_id" id="sip_id" value="{{ old('sip_id') }}" class="form-control" placeholder="Skill india portal id">
									<span class="text-danger err-msg" id="err-FullName"></span>
								  </div>
								  </div>
								  </div>
								  <div class="form-group">
								  <div class="row">
								  <div class="col-lg-6 col-md-12 col-xs-12">
									<label class="control-label">Proof of advertisement for mobilisation <span class="text-danger">*</span></label>
									<input type="file" name="mobilisation" id="mobilisation" class="form-control checkFile" style="width:80%">
									<small><span id="mobilisation_file" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-mobilisation_file"></span>
								  </div>
								  <div class="col-lg-6 col-md-6 col-xs-12">
									<label class="control-label">Proof of registration on SIP portal <span class="text-danger">*</span></label>
									<input type="file" name="sip_id_proof" id="sip_id_proof" class="form-control checkFile" style="width:80%">
									<small><span id="sipidproof" class="text-danger"></span></small>
									<span class="text-danger err-msg" id="err-sipidproof"></span>
								  </div>
								  </div>
								  </div>
								<hr class="my-4" />
		                        <div class="form-group text-right">
									<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
										<i class="fa fa-save"></i> Submit
									</button>
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
    document.getElementById('addOfficer').addEventListener('click', function(){
        const tbody = document.getElementById('officer_body');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="person_name[]" class="form-control"></td>
            <td><input type="text" name="person_contact[]" class="form-control"></td>
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
