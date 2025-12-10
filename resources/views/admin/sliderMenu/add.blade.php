@extends('layouts.adminlayout')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Manage Slider</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="<?php echo route('admin.sliderMenu'); ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <form method="post" action="<?php echo route('admin.sliderMenu.add'); ?>" class="form-validation">
            <!--!! CSRF FIELD !!-->
            {{ @csrf_field() }}
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <!--!! FLAST MESSAGES !!-->
                        @include('admin.partials.flash_messages')
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">English</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Slider information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Title</label>
                                    <input type="text" maxlength="150" class="form-control" name="heading"
                                        value="{{ old('heading') }}" placeholder="Title">
                                    <small>You can enter up to 150 characters only.</small>
                                    @error('heading')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Sub Title</label>
                                    <input type="text" maxlength="150" class="form-control" name="title"
                                        value="{{ old('title') }}" placeholder="Sub Title">
                                    <small>You can enter up to 150 characters only.</small>
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Button Title</label>
                                    <input type="text" class="form-control" name="button_title"
                                        value="{{ old('button_title') }}" placeholder="Button Title">
                                    @error('button_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Button Link</label>
                                    <input type="text" class="form-control" name="button_link"
                                        value="{{ old('button_link') }}" placeholder="Button Link">
                                    @error('button_link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-4" />
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- FILE OR IMAGE UPLOAD. FOLDER PATH SET HERE in data-path AND CHANGE THE data-multiple TO TRUE SEE MAGIC. DO NOT REMOVE THE NESTED CALSSES -->
                                            <div class="upload-image-section" data-type="image" data-multiple="false"
                                                data-path="pages" data-resize-large="1440*597">
                                                <div class="upload-section">
                                                    <div class="button-ref mb-3">
                                                        <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                            <span class="btn-inner--icon"><i
                                                                    class="fas fa-upload"></i></span>
                                                            <span class="btn-inner--text">Upload Image</span>
                                                        </button>
                                                    </div>
                                                    <!-- PROGRESS BAR -->
                                                    <div class="progress d-none">
                                                        <div class="progress-bar bg-default" role="progressbar"
                                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <h6 class="heading-small text-muted mb-4">Upload Image Size Of 1440px *
                                                    597px</h6>
                                                <!-- INPUT WITH FILE URL -->
                                                <textarea class="d-none" name="image"></textarea>
                                                <div class="show-section <?php echo !old('image') ? 'd-none' : ''; ?>">
                                                    @include('admin.partials.previewFileRender', [
                                                        'file' => old('image'),
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="custom-control">
                                                <label class="custom-toggle">
                                                    <input type="hidden" name="status" value="0">
                                                    <input type="checkbox" name="status" value="1"
                                                        <?php echo old('status') != '0' ? 'checked' : ''; ?>>
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Yes"></span>
                                                </label>
                                                <label class="custom-control-label">Status</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(Permissions::hasPermission('slider_menu', 'create')): ?>
                                <hr class="my-4" />
                                <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                    <i class="fa fa-save"></i> Submit
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 ">
                    <div class="card">
                        <!--!! FLAST MESSAGES !!-->
                        @include('admin.partials.flash_messages')
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Hindi</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Slider information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Title</label>
                                    <input type="text" maxlength="150" class="form-control" name="heading_hi"
                                        value="{{ old('heading_hi') }}" placeholder="Title">
                                    <small>You can enter up to 150 characters only.</small>
                                    @error('heading_hi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Sub Title</label>
                                    <input type="text" maxlength="150" class="form-control" name="title_hi"
                                        value="{{ old('title_hi') }}" placeholder="Sub Title">
                                    <small>You can enter up to 150 characters only.</small>
                                    @error('title_hi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Button Title</label>
                                    <input type="text" class="form-control" name="button_title_hi"
                                        value="{{ old('button_title_hi') }}" placeholder="Button Title">
                                    @error('button_title_hi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <?php if(Permissions::hasPermission('slider_menu', 'create')): ?>
                                <hr class="my-4" />
                                <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                    <i class="fa fa-save"></i> Submit
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
