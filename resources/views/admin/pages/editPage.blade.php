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
					<h6 class="h2 text-white d-inline-block mb-0">Manage {{ $page->title }}</h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="<?php echo route('admin.pages') ?>" class="btn btn-neutral"><i class="ni ni-bold-left"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">
		<div class="col-xl-12 order-xl-1">
            <form method="post" action="<?php echo route('admin.pages.edit', ['id' => $page->id]) ?>" class="form-validation">
                {{ @csrf_field() }}
			<div class="card">
				<!--!! FLAST MESSAGES !!-->
				@include('admin.partials.flash_messages')
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Update Page Details Here.</h3>
						</div>
					</div>
				</div>
				<div class="card-body">
					{{-- <form method="post" action="<?php echo route('admin.pages.edit', ['id' => $page->id]) ?>" class="form-validation">
						{{ @csrf_field() }} --}}
						<h6 class="heading-small text-muted mb-4">Page information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Title</label>
										<input type="text" class="form-control" name="title" required placeholder="Title" value="<?php echo $page->title ?>">
										@error('title')
										    <small class="text-danger">{{ $message }}</small>
										@enderror
									</div>

								</div>

							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label">Description</label>
										<textarea rows="2" id="editor1" class="form-control" required placeholder="Description" name="description"><?php echo $page->description ?></textarea>
										@error('description')
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
					{{-- </form> --}}
				</div>
			</div>
        </form>
		</div>
	</div>
</div>
@endsection
