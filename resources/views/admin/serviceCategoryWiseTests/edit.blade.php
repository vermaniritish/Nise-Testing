@extends('layouts.adminlayout')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Manage Service Category Wise Tests</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="<?php echo route('admin.serviceCategoryWiseTests'); ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <form method="post" action="<?php echo route('admin.serviceCategoryWiseTests.edit', $page->id); ?>" class="form-validation">
            <!--!! CSRF FIELD !!-->
            {{ @csrf_field() }}
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card">
                        <!--!! FLAST MESSAGES !!-->
                        @include('admin.partials.flash_messages')
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Create New Service Category Wise Test Here.</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Service Category Wise Test information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-type">Testing Service</label>
                                            <select name="service_id" id="test_service_id" class="form-control" required>
                                                <option value="" selected disabled>Select Testing Service</option>
                                                @foreach($testingServices as $testingServices)
                                                    <option value="{{ $testingServices['id'] }}" {{ isset($page->service_id) && $page->service_id == $testingServices->id ? 'selected' : '' }}>{{ $testingServices->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('service_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-type">Testing Service</label>
                                            <select name="service_category_id" id="service_category_id" class="form-control" required>
                                                <option value="" selected disabled>Select Testing Service</option>
                                                @foreach($testServiceCategories as $testServiceCategory)
                                                    <option value="{{ $testServiceCategory['id'] }}" {{ isset($page->service_category_id) && $page->service_category_id == $testServiceCategory->id ? 'selected' : '' }}>{{ $testServiceCategory->test_category_title }}</option>
                                                @endforeach
                                            </select>
                                            @error('service_category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Title</label>
                                            <input type="text" maxlength="150" value="{{ old('title', $page->title) }}" required class="form-control"
                                                name="title" placeholder="Title">
                                            <small>You can enter up to 150 characters only.</small>
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Fee</label>
                                            <input type="text" value="{{ old('fee', $page->fee) }}" required class="form-control"
                                                name="fee" placeholder="Fee">
                                            @error('fee')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" />
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="custom-control">
                                                <label class="custom-toggle">
                                                    <input type="hidden" name="status" value="0">
                                                    <input type="checkbox" name="status" value="1"
                                                       <input type="checkbox" name="status" value="1" <?php echo ($page->status != '0' ? 'checked' : '') ?>>
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
