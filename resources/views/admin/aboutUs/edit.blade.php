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
                                        <input type="text" maxlength="150" class="form-control" name="about_us_title"
                                            placeholder="Title" value="<?php echo $customPageData['about_us_title']['value'] ?? ''; ?>">
                                        <small>You can enter up to 150 characters only.</small>
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
                            <h6 class="heading-small text-muted mb-2">Feedback Information</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">English</h6>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text" maxlength="150" class="form-control" name="feedback_title"
                                            placeholder="Title" value="<?php echo $customPageData['feedback_title']['value'] ?? ''; ?>">
                                        <small>You can enter up to 150 characters only.</small>
                                        @error('feedback_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea rows="2" id="editor3" class="form-control" placeholder="Description" name="feedback_description"><?php echo $customPageData['feedback_description']['value'] ?? ''; ?></textarea>
                                        @error('feedback_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text" maxlength="100" class="form-control" name="feedback_button_title"
                                            placeholder="Title" value="<?php echo $customPageData['feedback_button_title']['value'] ?? ''; ?>">
                                        <small>You can enter up to 100 characters only.</small>
                                        @error('feedback_button_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Url Link</label>
                                        <input type="text" class="form-control" name="feedback_button_link"
                                            placeholder="Url Link" value="<?php echo $customPageData['feedback_button_link']['value'] ?? ''; ?>">
                                        @error('feedback_button_link')
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
                                            <input type="text" maxlength="150" class="form-control" name="about_us_title_hi"
                                                placeholder="Title" value="<?php echo $customPageData['about_us_title_hi']['value'] ?? ''; ?>">
                                            <small>You can enter up to 150 characters only.</small>
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
                            <h6 class="heading-small text-muted mb-2">Feedback Information</h6>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-2">Hindi</h6>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Title</label>
                                        <input type="text" maxlength="150" class="form-control" name="feedback_title_hi"
                                            placeholder="Title" value="<?php echo $customPageData['feedback_title_hi']['value'] ?? ''; ?>">
                                        <small>You can enter up to 150 characters only.</small>
                                        @error('feedback_title_hi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea rows="2" id="editor4" class="form-control" placeholder="Description" name="feedback_description_hi"><?php echo $customPageData['feedback_description_hi']['value'] ?? ''; ?></textarea>
                                        @error('feedback_description_hi')
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
