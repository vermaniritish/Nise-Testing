@extends('layouts.adminlayout')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0"><?php echo $testServ->title ?? ''; ?></h6>
                    </div>
                    <!-- <div class="col-lg-6 col-5 text-right">
                        <a href="<?php echo route('admin.testingService'); ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- testServ content -->
    <div class="container-fluid mt--6">
        <form method="post" action="<?php echo route('admin.testingServiceContent.edit', $testServ->slug); ?>" class="form-validation">
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
                                    <h3 class="mb-0">English Content</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Enter information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Main Heading</label>
                                            <input type="text" maxlength="150" value="<?php echo $testServ->main_heading ?? ''; ?>" required class="form-control"
                                                name="main_heading" placeholder="Text">
                                            <small>You can enter up to 150 characters only.</small>
                                            @error('main_heading')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Content Editor --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Description</label>
                                            <textarea rows="2" id="editor1" class="form-control" placeholder="Description" name="description">{{ old('description', $testServ->description ?? '') }}</textarea>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    @php
                                        $selectedTypes = $testServ->type_id ?? [];

                                        // Case 1: JSON stored (e.g. ["1","3"])
                                        if (is_string($selectedTypes) && str_starts_with(trim($selectedTypes), '[')) {
                                            $selectedTypes = json_decode($selectedTypes, true) ?? [];
                                        }
                                        // Case 2: Comma separated string: "1,3,5"
                                        elseif (is_string($selectedTypes)) {
                                            $selectedTypes = explode(',', $selectedTypes);
                                        }
                                        // Case 3: Single integer
                                        elseif (is_int($selectedTypes)) {
                                            $selectedTypes = [$selectedTypes];
                                        }

                                        // Ensure final result is array
                                        if (!is_array($selectedTypes)) {
                                            $selectedTypes = [];
                                        }
                                    @endphp
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-type">Type</label>
                                            <select name="type_id[]" class="form-control" multiple required>
                                                <option value="" disabled>Select Type</option>
                                                @foreach($testServiceCategories as $serviceCatWiseTest)
                                                    <option value="{{ $serviceCatWiseTest->id }}" 
                                                        @if(in_array($serviceCatWiseTest->id, $selectedTypes)) selected @endif>
                                                        {{ $serviceCatWiseTest->test_category_title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
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
                <div class="col-xl-6">
                    <div class="card">
                        <!--!! FLAST MESSAGES !!-->
                        @include('admin.partials.flash_messages')
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Hindi Content</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Enter information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Main Heading</label>
                                            <input type="text" maxlength="150" value="<?php echo $testServ->main_heading_hi ?? ''; ?>" required class="form-control"
                                                name="main_heading_hi" placeholder="Text">
                                            <small>You can enter up to 150 characters only.</small>
                                            @error('main_heading_hi')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Content Editor --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Description</label>
                                            <textarea rows="2" id="editor2" class="form-control" placeholder="Description" name="description_hi">{{ old('description_hi', $testServ->description_hi ?? '') }}</textarea>
                                            @error('description_hi')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
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
            </div>
        </form>
    </div>
@endsection
