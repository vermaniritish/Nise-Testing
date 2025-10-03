<?php
use Illuminate\Support\Arr;
?>
@extends('layouts.adminlayout')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">About us</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="<?php echo route('admin.dashboard'); ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <form method="post" action="<?php echo route('admin.editAaboutUs'); ?>" class="form-validation">
            {{ @csrf_field() }}
            <div class="row">
                <div class="col-xl-6 order-xl-1">
                    <div class="card">
                        @include('admin.partials.flash_messages')

                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">About us</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">English</h6>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text" class="form-control" name="about_us_title"
                                            placeholder="Title" value="<?php echo $customPageData['about_us_title']['value'] ?? ''; ?>">
                                        @error('about_us_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea rows="2" id="editor1" class="form-control" placeholder="Description" name="about_us_desc"><?php echo $customPageData['about_us_desc']['value'] ?? ''; ?></textarea>
                                        @error('about_us_desc')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                <i class="fa fa-save"></i> Submit
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">Director Information</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">English</h6>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text" class="form-control" name="director_title"
                                            placeholder="Title" value="<?php echo $customPageData['director_title']['value'] ?? ''; ?>">
                                        @error('director_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Sub Title</label>
                                        <input type="text" class="form-control" name="sub_title"
                                            placeholder="Sub Title" value="<?php echo $customPageData['sub_title']['value'] ?? ''; ?>">
                                        @error('sub_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea rows="2" id="editor3" class="form-control" placeholder="Description" name="director_desc"><?php echo $customPageData['director_desc']['value'] ?? ''; ?></textarea>
                                        @error('director_desc')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div
                                            class="upload-image-section"
                                            data-type="file"
                                            data-multiple="false"
                                            data-path="about_us"
                                            data-resize-large="551*356"
                                        >
                                            <div class="upload-section">
                                                <div class="button-ref mb-3">
                                                    <button class="btn btn-icon btn-primary btn-lg" type="button">
                                                        <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                        <span class="btn-inner--text">Upload Image</span>
                                                    </button>
                                                </div>
                                                <!-- PROGRESS BAR -->
                                                <div class="progress d-none">
                                                  <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <h6 class="heading-small text-muted mb-4">Upload Image Size Of 551x356</h6>
                                            <textarea class="d-none" required name="about_us_image"><?php echo old('about_us_image') ?></textarea>
                                            <div class="show-section <?php echo !old('about_us_image') ? 'd-none' : "" ?>">
                                                @include('admin.partials.previewFileRender', ['file' => old('about_us_image') ])
                                            </div>
                                            <div class="fixed-edit-section">
                                                @include('admin.partials.previewFileRender', [
                                                    'file' =>
                                                        $customPageData['about_us_image']['value'] ?? '',
                                                    'relationType' => null,
                                                    'relationId' => null,
                                                ])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                <i class="fa fa-save"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 order-xl-1">
                    <div class="card">
                        @include('admin.partials.flash_messages')

                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">About us</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">Hindi</h6>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Title</label>
                                            <input type="text" class="form-control" name="about_us_title_hi"
                                                placeholder="Title" value="<?php echo $customPageData['about_us_title_hi']['value'] ?? ''; ?>">
                                            @error('about_us_title_hi')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Description</label>
                                            <textarea rows="2" id="editor2" class="form-control" placeholder=""
                                                name="about_us_desc_hi"><?php echo $customPageData['about_us_desc_hi']['value'] ?? ''; ?></textarea>
                                            @error('about_us_desc_hi')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                    <i class="fa fa-save"></i> Submit
                                </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-2">Director Information</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">Hindi</h6>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text" class="form-control" name="director_title_hi"
                                            placeholder="Title" value="<?php echo $customPageData['director_title_hi']['value'] ?? ''; ?>">
                                        @error('director_title_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Sub Title</label>
                                        <input type="text" class="form-control" name="sub_title_hi"
                                            placeholder="Sub Title" value="<?php echo $customPageData['sub_title_hi']['value'] ?? ''; ?>">
                                        @error('sub_title_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea rows="2" id="editor4" class="form-control" placeholder="Description" name="director_desc_hi"><?php echo $customPageData['director_desc_hi']['value'] ?? ''; ?></textarea>
                                        @error('director_desc_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <button href="#" class="btn btn-sm py-2 px-3 btn-primary float-right">
                                <i class="fa fa-save"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection
