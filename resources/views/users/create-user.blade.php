@extends('layouts.master')
@section('title', 'Users')
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
						<div class="col-md-7">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Users</h3>
								</div>
								<div class="box-body">
									<table class="table table-condensed">
										<tr>
											<th style="width: 10px">#</th>
											<th>User</th>
											<th>Created On</th>
											<th>Update</th>
											<th>Delete</th>
										</tr>
										@foreach( $users as $user )
										<tr id="idUserType_{{$user->id}}">
											<td>{{ $user->id }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td><button type="button" data-id="{{$user->id}}" disabled class="btn btn-sm btn-default">Update</button></td>
											<td><button type="button" data-id="{{$user->id}}" disabled class="delete-user-type btn btn-sm btn-danger">Delete</button></td>
										</tr>
										@endforeach
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Create New</h3>
								</div>
								<div class="box-body">
									<?php echo Form::open( [ 'url' => '/user/create-new-user' ] ); ?>
										{{ csrf_field() }}
										<div class="form-group has-{{ $errors->has('name') ? 'error' : 'feedback' }}">
											<?php echo Form::text( 'name', old('name'), [ 'class' => 'form-control', 'placeholder' => 'Full Name' ] ); ?>
											<span class="glyphicon glyphicon-user form-control-feedback"></span>
											@if ($errors->has('name'))
												<span class="help-block">
													<strong>{{ $errors->first('name') }}</strong>
												</span>
											@endif
										</div>

										<div class="form-group has-{{ $errors->has('email') ? 'error' : 'feedback' }}">
											<?php echo Form::text( 'email', old('email'), [ 'class' => 'form-control', 'placeholder' => 'Email' ] ); ?>
											<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
											@if ($errors->has('email'))
												<span class="help-block">
													<strong>{{ $errors->first('email') }}</strong>
												</span>
											@endif
										</div>
										<div class="form-group has-{{ $errors->has('password') ? 'error' : 'feedback' }}">
											<?php echo Form::password( 'password', [ 'class' => 'form-control', 'placeholder' => 'Password' ] ); ?>
											<span class="glyphicon glyphicon-lock form-control-feedback"></span>
											@if ($errors->has('password'))
												<span class="help-block">
													<strong>{{ $errors->first('password') }}</strong>
												</span>
											@endif
										</div>

										<div class="form-group has-{{ $errors->has('password_confirmation') ? 'error' : 'feedback' }}">
											<?php echo Form::password( 'password_confirmation', [ 'class' => 'form-control', 'placeholder' => 'Confirm Password' ] ); ?>
											<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
											@if ($errors->has('password_confirmation'))
												<span class="help-block">
													<strong>{{ $errors->first('password_confirmation') }}</strong>
												</span>
											@endif
										</div>

										<div class="form-group has-{{ $errors->has('user_types') ? 'error' : 'feedback' }}">
											{!! Form::select( 'user_types', $user_types, null, [ 'class' => 'form-control', 'placeholder' => 'Select User Type' ] ) !!}
											@if ($errors->has('user_types'))
												<span class="help-block">
													<strong>{{ $errors->first('user_types') }}</strong>
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