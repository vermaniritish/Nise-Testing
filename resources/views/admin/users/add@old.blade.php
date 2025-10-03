@extends('layouts.adminlayout')
@section('content')
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Manage Institutes</h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="<?php echo route('admin.users') ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
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
				<!--!! FLAST MESSAGES !!-->
				<!-- @include('admin.partials.flash_messages') -->
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
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Create New Institute Here.</h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="{{ route('admin.users.add') }}" class="form-validation">
						@csrf
						<h6 class="heading-small text-muted mb-4">Enter information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Organisation Name</label>
										<input type="text" class="form-control" name="organisation_name" required placeholder="Organisation Name" value="{{ old('organisation_name') }}">
										@error('organisation_name')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>

								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-username">Gender</label>
										<select class="form-control" name="gender">
											<option value="male" <?php echo old('gender') == 'male' ? 'selected' : '' ?>>Male</option>
											<option value="female" <?php echo old('gender') == 'female' ? 'selected' : '' ?>>Female</option>
										</select>
										@error('gender')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-email">Date of Birth</label>
										<input type="date" id="input-email" class="form-control" name="dob"  value="{{ old('dob') }}" max="<?php echo date('Y-m-d') ?>">
										@error('dob')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-username">Email Address</label>
										<input type="email" id="input-username" class="form-control" placeholder="info@example.com" name="email"  value="{{ old('email') }}" required>
										@error('email')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>State <span class="text-danger">*</span></label>
                                        <select name="state_id" id="state_id" class="form-control" >
                                            <option value="">Select State</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>District <span class="text-danger">*</span></label>
                                        <select name="district_id" id="district_id" class="form-control">
                                            <option value="">Select District</option>
                                        </select>
                                        @error('district_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-email">Phone Number</label>
										<input name="mobile" class="form-control" value="{{ old('mobile') }}" id="phone" 
                                        placeholder="9988774455" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" 
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');">
										@error('mobile')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
                                    <label for="name">Certificate of Establishment *</label>
                                    <div class="upload-image-file">
                                        <div class="upload-file">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button" onclick="document.getElementById('organisation_file_input').click()">
                                                    <span class="btn-inner--icon" style="font-size: 13px;"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text" style="font-size: 13px;">Upload File</span>
                                                </button>
                                            </div>

                                            <!-- HIDDEN FILE INPUT -->
                                            <input type="file" id="organisation_file_input" name="organisation_file" class="d-none" onchange="previewFile(this)">
                                            
                                            <!-- PREVIEW SECTION -->
                                            <div id="file_preview" class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="pan">PAN</label>
                                    <input 
                                        name="pan" 
                                        class="form-control" 
                                        id="pan" 
                                        placeholder="PAN No.*" 
                                        required 
                                        value="{{ old('pan') }}"
                                        type="text" 
                                        minlength="10" 
                                        maxlength="10" 
                                        pattern="[A-Za-z0-9]{1,10}" 
                                        oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">

                                    <br>
                                    <div class="upload-image-file">
                                        <div class="upload-file">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button" onclick="document.getElementById('pan_file_input').click()">
                                                    <span class="btn-inner--icon" style="font-size: 13px;"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text" style="font-size: 13px;">Upload PAN Scan Copy</span>
                                                </button>
                                            </div>
                                            <input type="file" id="pan_file_input" name="pan_file" class="d-none" onchange="panPreviewFile(this)">
                                            <div id="pan_file_preview" class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="gst">GST</label>
                                    <input 
                                        name="gst" 
                                        class="form-control" 
                                        id="gst" 
                                        placeholder="GST No.*" 
                                        required 
                                        type="text" 
                                        value="{{ old('gst') }}"
                                        minlength="15" 
                                        maxlength="15" 
                                        pattern="[A-Za-z0-9]{1,15}" 
                                        oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">
                                    <br/>
                                    <div class="upload-image-file">
                                        <div class="upload-file">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button" onclick="document.getElementById('gst_file_input').click()">
                                                    <span class="btn-inner--icon" style="font-size: 13px;"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text" style="font-size: 13px;">Upload GST Certificate</span>
                                                </button>
                                            </div>
                                            <input type="file" id="gst_file_input" name="gst_file" class="d-none" onchange="gstPreviewFile(this)">
                                            <div id="gst_file_preview" class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
						<hr class="my-4" />
						<!-- Address -->
						<h6 class="heading-small text-muted mb-4">Other Information</h6>
						<div class="pl-lg-4">
							<div class="form-group">
								<label class="form-control-label">Address</label>
								<textarea rows="2" class="form-control" placeholder="Your address" name="address">{{ old('address') }}</textarea>
								@error('address')
								    <small class="text-danger">{{ $message }}</small>
								@enderror
							</div>
						</div>
						<hr class="my-4" />
						<button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
							<i class="fa fa-save"></i> Submit
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
     const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];

    function validateAndPreview(input, previewId) {
        let previewDiv = document.getElementById(previewId);
        previewDiv.innerHTML = "";
        
        if (input.files && input.files[0]) {
            let file = input.files[0];
            let fileType = file.type;

            // ✅ Check file type
            if (!allowedTypes.includes(fileType)) {
                alert("Invalid file type! Only PDF, JPG, JPEG, and PNG are allowed.");
                input.value = ""; // reset input
                return;
            }

            // ✅ If Image Preview
            if (fileType.startsWith("image/")) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail");
                    img.style.maxWidth = "200px";
                    img.style.marginTop = "10px";
                    previewDiv.appendChild(img);
                };
                reader.readAsDataURL(file);
            }

            // ✅ If PDF - show icon & name
            else if (fileType === "application/pdf") {
                previewDiv.innerHTML = `
                    <p class="text-info mt-2">
                        <i class="fas fa-file-pdf text-danger"></i> Selected PDF: <strong>${file.name}</strong>
                    </p>`;
            }
        }
    }

    // ✅ Call validation function for each field
    function previewFile(input) { validateAndPreview(input, 'file_preview'); }
    function panPreviewFile(input) { validateAndPreview(input, 'pan_file_preview'); }
    function gstPreviewFile(input) { validateAndPreview(input, 'gst_file_preview'); }

    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.style.transition = "opacity 0.5s ease";
            el.style.opacity = "0";
            setTimeout(() => el.remove(), 500); // fade-out ke baad remove
        });
    }, 2000);
</script>

@endsection