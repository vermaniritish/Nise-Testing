@extends('layouts.adminlayout')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Manage Gallery</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="<?php echo route('admin.gallery'); ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <form method="post" action="{{ route('admin.gallery.add') }}" class="form-validation" novalidate="novalidate">
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
                            <h6 class="heading-small text-muted mb-4">General information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Title<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" required=""
                                                placeholder="Title" value="{{ old('title') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="custom-control">
                                                <label class="custom-toggle">
                                                    <input type="hidden" name="status" value="0">
                                                    <input type="checkbox" name="status" value="1" checked="">
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Yes"></span>
                                                </label>
                                                <label class="custom-control-label">Do you want to publish this page
                                                    ?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(Permissions::hasPermission('gallery', 'create')): ?>
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
                            <h6 class="heading-small text-muted mb-4">General information - Hindi</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Title<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title_hi" required=""
                                                placeholder="Title" value="{{ old('title_hi') }}">
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-xl-12 ">
                    <div class="card">
                        <!--!! FLAST MESSAGES !!-->
                        @include('admin.partials.flash_messages')
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Images</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Images section</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="upload-image-section" data-type="image" data-multiple="true"
                                            data-path="gallery" data-resize-large="900*600" data-resize-small="400*310">
                                            <div class="upload-section">
                                                <div class="button-ref mb-3">
                                                    <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                        <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                        <span class="btn-inner--text">Upload Images</span>
                                                    </button>
                                                </div>
                                                <!-- PROGRESS BAR -->
                                                <div class="progress d-none">
                                                    <div class="progress-bar bg-default" role="progressbar"
                                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 0%;"></div>
                                                </div>
                                            </div>

                                            {{-- @dd($image) --}}
                                            <p>Recomended size 900px * 600px</p>
                                            <!-- INPUT WITH FILE URL -->
                                            <textarea class="d-none" name="image">{{ $image ?? '' }}</textarea>


                                            <div class="show-section <?php echo !old('image') ? 'd-none' : ''; ?>">
                                                @include('admin.partials.previewFileRender', [
                                                    'file' => old('image'),
                                                ])
                                            </div>

                                            <div class="fixed-edit-section">
                                                @include('admin.partials.previewFileRender', [
                                                    'file' => $image ?? '',
                                                    'relationType' => 'setting.gallery',
                                                    'relationId' => $data ?? '',
                                                ])
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(Permissions::hasPermission('gallery', 'create')): ?>
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
