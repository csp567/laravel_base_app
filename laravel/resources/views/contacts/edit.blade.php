@extends('layouts.master')
@section('title', 'Edit Contact')
@section('body-class', 'hold-transition skin-blue sidebar-mini')
@section('head')
	@parent
	@include('includes/home_css_loader')
@endsection
@section('content')
	<div class="wrapper">
		@include('includes/header')
		@include('includes/sidebar')
		<div class="content-wrapper">
			@include('includes/page_details')
			<section class="content">
				<div class="row">
					<div class="col-md-5">
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">Edit Contact</h3>
							</div>
							<div class="box-body">
								<?php echo Form::open( [ 'url' => url('/') . '/contact/' . $contact->id . '/edit', 'files'=>'true' ] ); ?>
								{{ csrf_field() }}
								<div class="form-group has-{{ $errors->has('first_name') ? 'error' : 'feedback' }}">
									<label>First Name</label>
									<?php echo Form::text( 'first_name', $contact->first_name, [ 'class' => 'form-control', 'placeholder' => 'First Name (Required)' ] ); ?>
									<span class="glyphicon glyphicon-user form-control-feedback"></span>
									@if ($errors->has('first_name'))
										<span class="help-block">
											<strong>{{ $errors->first('first_name') }}</strong>
										</span>
									@endif
								</div>

								<div class="form-group has-{{ $errors->has('middle_name') ? 'error' : 'feedback' }}">
									<label>Middle Name</label>
									<?php echo Form::text( 'middle_name', $contact->middle_name, [ 'class' => 'form-control', 'placeholder' => 'Middle Name' ] ); ?>
									<span class="glyphicon glyphicon-user form-control-feedback"></span>
									@if ($errors->has('middle_name'))
										<span class="help-block">
											<strong>{{ $errors->first('middle_name') }}</strong>
										</span>
									@endif
								</div>

								<div class="form-group has-{{ $errors->has('last_name') ? 'error' : 'feedback' }}">
									<label>Last Name</label>
									<?php echo Form::text( 'last_name', $contact->last_name, [ 'class' => 'form-control', 'placeholder' => 'Last Name (Required)' ] ); ?>
									<span class="glyphicon glyphicon-user form-control-feedback"></span>
									@if ($errors->has('last_name'))
										<span class="help-block">
											<strong>{{ $errors->first('last_name') }}</strong>
										</span>
									@endif
								</div>

								<div class="form-group has-{{ $errors->has('primary_phone') ? 'error' : 'feedback' }}">
									<label>Primary Phone</label>
									<?php echo Form::tel( 'primary_phone', $contact->primary_number, [ 'class' => 'form-control', 'placeholder' => 'Primary Phone (Required)' ] ); ?>
									<span class="glyphicon glyphicon-phone form-control-feedback"></span>
									@if ($errors->has('primary_phone'))
										<span class="help-block">
											<strong>{{ $errors->first('primary_phone') }}</strong>
										</span>
									@endif
								</div>

								<div class="form-group has-{{ $errors->has('secondary_phone') ? 'error' : 'feedback' }}">
									<label>Secondary Phone</label>
									<?php echo Form::tel( 'secondary_phone', $contact->secondary_number, [ 'class' => 'form-control', 'placeholder' => 'Secondary Phone' ] ); ?>
									<span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
									@if ($errors->has('secondary_phone'))
										<span class="help-block">
											<strong>{{ $errors->first('secondary_phone') }}</strong>
										</span>
									@endif
								</div>

								<div class="form-group has-{{ $errors->has('email') ? 'error' : 'feedback' }}">
									<label>Email</label>
									<?php echo Form::text( 'email', $contact->email, [ 'class' => 'form-control', 'placeholder' => 'Email (Required)' ] ); ?>
									<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>

								<div class="form-group has-{{ $errors->has('contact_image') ? 'error' : 'feedback' }}">
									<label>Contact Image</label>
									<?php echo Form::file( 'contact_image', old('contact_image'), [ 'class' => 'form-control', 'placeholder' => 'Contact Image' ] ); ?>
									@if ($errors->has('contact_image'))
										<span class="help-block">
											<strong>{{ $errors->first('contact_image') }}</strong>
										</span>
									@endif
								</div>

								<div class="row">
									<div class="col-xs-4">
										<?php echo Form::button( 'Create', [ 'class' => 'btn btn-primary btn-block btn-flat', 'type' => 'submit' ] ); ?>
									</div>
								</div>
								<?php echo Form::close(); ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		@include('includes/footer')
	</div>
@endsection
@section('page_scripts')
	@parent
	@include('includes/home_script_loader')
@endsection