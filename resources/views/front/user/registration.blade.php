<?php use App\Models\Admin\CustomPageData; ?>
@extends('layouts.frontendlayout')
@section('content')

<!-- START PAGE BANNER AND BREADCRUMBS -->
	<section id="page-banner">
		
		<div class="single-page-title-area-bottom">
			<div class="auto-container">
				<div class="row">
					<div class="col-12 text-center">
						<div id="ost-container">
							<div class="ost-multi-header">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active">EOI Enrollment</li>
								</ol>
							</div>
						</div>
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
            <div class="row d-flex justify-content-center align-items-center">
                <!-- Registration Form -->
                <div class="home-p-form d-flex justify-content-center">
                
                <div class="col-lg-7 col-md-7 col-12 pr-lg-5 pr-md-5 pr-0 mb-4">
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

                    <div class="section-title-2">
                        <h3>Please Register for <span>EOI Enrollment</span></h3>
                    </div>

                    <div class="home-p-form-wrapper">
                        <form method="POST" action="{{ route('registration.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $verification->id }}">
                                <div class="form-group col-lg-12 mb-3">
                                    <label for="name">Name of the Organisation</label>
                                    <input name="organisation_name" class="form-control" id="orgname" placeholder="Enter Organisation Name *" required type="text">
                                </div>
                                <div class="form-group col-lg-12 mb-3">
                                    <label for="name">Certificate of establishment *</label>
                                    <div class="upload-image-section">
                                        <div class="upload-section">
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
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="pan">PAN</label>
                                    <input 
                                        name="pan" 
                                        class="form-control" 
                                        id="pan" 
                                        placeholder="PAN No.*" 
                                        required 
                                        type="text" 
                                        minlength="10" 
                                        maxlength="10" 
                                        pattern="[A-Za-z0-9]{1,10}" 
                                        oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">

                                    <br>
                                    <div class="upload-image-section">
                                        <div class="upload-section">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button" onclick="document.getElementById('pan_file_input').click()">
                                                    <span class="btn-inner--icon" style="font-size: 13px;"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text" style="font-size: 13px;">Upload Pan Scan Copy</span>
                                                </button>
                                            </div>

                                            <!-- HIDDEN FILE INPUT -->
                                            <input type="file" id="pan_file_input" name="pan_file" class="d-none" onchange="panPreviewFile(this)">
                                            
                                            <!-- PREVIEW SECTION -->
                                            <div id="pan_file_preview" class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 mb-3">
                                    <label for="gst">GST</label>
                                    <!-- <input name="gst" class="form-control" id="gst" placeholder="GST No." required type="text"> -->
                                    <input 
                                        name="gst" 
                                        class="form-control" 
                                        id="gst" 
                                        placeholder="GST No.*" 
                                        required 
                                        type="text" 
                                        minlength="15" 
                                        maxlength="15" 
                                        pattern="[A-Za-z0-9]{1,15}" 
                                        oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">
                                    <br/>
                                    <div class="upload-image-section">
                                        <div class="upload-section">
                                            <div class="button-ref mb-3">
                                                <button class="btn btn-icon btn-primary btn-lg" type="button" onclick="document.getElementById('gst_file_input').click()">
                                                    <span class="btn-inner--icon" style="font-size: 13px;"><i class="fas fa-upload"></i></span>
                                                    <span class="btn-inner--text" style="font-size: 13px;">Upload GST Certificate</span>
                                                </button>
                                            </div>

                                            <!-- HIDDEN FILE INPUT -->
                                            <input type="file" id="gst_file_input" name="gst_file" class="d-none" onchange="gstPreviewFile(this)">
                                            
                                            <!-- PREVIEW SECTION -->
                                            <div id="gst_file_preview" class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 mb-3">
                                    <label for="email">Email</label>
                                    <input name="email" class="form-control" value="{{ $verification->email }}" readonly>
                                </div>

                                <div class="form-group col-lg-6 mb-3">
                                    <label for="phone">Phone No.</label>
                                    <input name="mobile" class="form-control" value="{{ $verification->mobile }}" readonly>
                                </div>

                                <div class="form-group col-lg-6 mb-3">
                                    <label>Address</label>
                                    <textarea rows="2" name="address" class="form-control" placeholder="Address Here..." required></textarea>
                                </div>

                                <div class="form-group col-lg-6 mb-3">
                                    <label>Pin code</label>
                                    <input name="pin" class="form-control" placeholder="Pin code *" required type="text" minlength="6" maxlength="6" pattern="[0-9]{6}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                </div>

                                <div class="form-group col-lg-6 mb-3">
                                    <label for="state">State</label>
                                    <select class="form-control" name="state_id" id="state_id" onchange="getDistrictList(this.value)">
                                        <option value="">---Select State---</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-6 mb-3">
                                    <label for="district">District</label>
                                    <select class="form-control" name="district_id" id="district_id">
                                        <option value="">---Select District---</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6 mb-3">
                                    <button type="submit" class="btn-style btn-filled btn-filled-2">SUBMIT</button>
                                </div>
                            </div>
                        </form>                             
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function getDistrictList(state_id) {
        if(state_id) {
            $.ajax({
                url: "{{ url('get-districts') }}/" + state_id,   // Route URL
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#district_id').empty(); // clear old options
                    $('#district_id').append('<option value="">---Select District---</option>');
                    $.each(data, function(key, district){
                        $('#district_id').append('<option value="'+ district.id +'">'+ district.name +'</option>');
                    });
                },
                error: function() {
                    alert("Something went wrong while fetching districts!");
                }
            });
        } else {
            $('#district_id').empty();
            $('#district_id').append('<option value="">---Select District---</option>');
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
    function panPreviewFile(input) {
        let previewDiv = document.getElementById('pan_file_preview');
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

    function gstPreviewFile(input) {
        let previewDiv = document.getElementById('gst_file_preview');
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

    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.style.transition = "opacity 0.5s ease";
            el.style.opacity = "0";
            setTimeout(() => el.remove(), 500); // fade-out ke baad remove
        });
    }, 2000);
</script>

    <!-- END NOTICE-LOGIN SECTION -->
@endsection