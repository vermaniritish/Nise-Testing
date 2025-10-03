@extends('layouts.partneradminlayout')
@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">My Profile</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <form method="post" action="{{ route('partnerAdmin.profile.update',['id'=> $user->id]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    @if ($errors->any())
	                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
	                        <ul class="mb-0">
	                            @foreach ($errors->getMessages() as $field => $messages)
	                                @foreach ($messages as $message)
	                                    <li><strong>{{ ucfirst(str_replace('_', ' ', $field)) }}:</strong> {{ $message }}</li>
	                                @endforeach
	                            @endforeach
	                        </ul>
	                    </div>
	                @endif
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Update Profile</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">                    
                        <h6 class="heading-small text-muted mb-4">User Information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Organisation Name</label>
                                        <input type="text" class="form-control" name="organisation_name" value="{{ old('organisation_name', $user->organisation_name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Organisation File</label>
                                        <input type="file" class="form-control" name="organisation_file">
                                        <!-- @if($user->organisation_file)
                                            <small class="text-success">Already uploaded: {{ $user->organisation_file }}</small>
                                        @endif -->
                                        @if($user->organisation_file)
                                          <a href="{{ asset('uploads/profile/'.$user->organisation_file) }}" target="_blank">View</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" readonly>
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <!-- <input type="text" class="form-control" name="mobile" value="{{ old('mobile', $user->mobile) }}"> -->
                                        <input 
                                        name="mobile" 
                                        class="form-control" 
                                        value="{{ old('mobile', $user->mobile) }}" 
                                        id="phone" 
                                        placeholder="Registered Phone No. *"  
                                        type="tel" 
                                        minlength="10" 
                                        maxlength="10" 
                                        pattern="[0-9]{10}" 
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                        @error('mobile') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- PAN File Handling -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>PAN</label>
                                        <!-- <input type="text" class="form-control" name="pan" value="{{ old('pan', $user->pan) }}"> -->
                                        <input 
                                        name="pan" 
                                        class="form-control" 
                                        id="pan" 
                                        placeholder="PAN No.*" 
                                        value="{{ old('pan', $user->pan) }}" 
                                        type="text" 
                                        minlength="10" 
                                        maxlength="10" 
                                        pattern="[A-Za-z0-9]{1,10}" 
                                        oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>PAN File</label>
                                        <input type="file" class="form-control" name="pan_file">
                                        @if($user->pan_file)
                                          <a href="{{ asset('uploads/profile/'.$user->pan_file) }}" target="_blank">View</a>
                                        @endif
                                        <!-- @if($user->pan_file)
                                            <small class="text-success">Already uploaded: {{ $user->pan_file }}</small>
                                        @endif -->
                                    </div>
                                </div>
                            </div>

                            <!-- GST File Handling -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>GST</label>
                                        <!-- <input type="text" class="form-control" name="gst" value="{{ old('gst', $user->gst) }}"> -->
                                        <input 
                                        name="gst" 
                                        class="form-control" 
                                        id="gst" 
                                        placeholder="GST No.*" 
                                        value="{{ old('gst', $user->gst) }}" 
                                        type="text" 
                                        minlength="15" 
                                        maxlength="15" 
                                        pattern="[A-Za-z0-9]{1,15}" 
                                        oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>GST File</label>
                                        <input type="file" class="form-control" name="gst_file">
                                        <!-- @if($user->gst_file)
                                            <small class="text-success">Already uploaded: {{ $user->gst_file }}</small>
                                        @endif -->
                                        @if($user->gst_file)
                                          <a href="{{ asset('uploads/profile/'.$user->gst_file) }}" target="_blank">View</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Address, Gender, State, District -->
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address">{{ old('address', $user->address) }}</textarea>
                            </div>

                            <!-- Profile Image -->
                            <div class="form-group">
                                <label>Profile Image</label>
                                <input type="file" class="form-control" name="image">
                                <!-- @if($user->image)
                                    <img src="{{ asset('uploads/users/'.$user->image) }}" width="100" class="mt-2">
                                @endif -->
                                @if($user->image)
                                  <a href="{{ asset('uploads/profile/'.$user->image) }}" target="_blank">View</a>
                                @endif
                            </div>

                        </div>
                        <hr class="my-4" />
                        <button class="btn btn-sm py-2 px-3 btn-primary float-right">
                            <i class="fa fa-save"></i> Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
