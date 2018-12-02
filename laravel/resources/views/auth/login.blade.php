@extends('layouts.master')
@section('title', 'Login')
@section('body-class', 'hold-transition login-page')
@section('head')
	@parent
		<link rel="stylesheet" href="{!! asset('plugins/iCheck/square/blue.css') !!}">
	@endsection

	@section('content')
		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b>{{ config('app.app_name') }}</a>
			</div>
			<div class="login-box-body">
				<p class="login-box-msg">Sign in to start your session</p>

				<?php echo Form::open( [ 'url' => 'login' ] ); ?>
					{{ csrf_field() }}
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
					<div class="row">
						<div class="col-xs-8">
							<div class="checkbox icheck">
							<label>
								<?php echo Form::checkbox( 'remember_me' ); ?> Remember Me
							</label>
							</div>
						</div>
						<div class="col-xs-4">
							<?php echo Form::button( 'Sign In', [ 'class' => 'btn btn-primary btn-block btn-flat', 'type' => 'submit' ] ); ?>
						</div>
					</div>
				<?php echo Form::close(); ?>

				<div class="social-auth-links text-center">
					<p>- OR -</p>
					<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
					Facebook</a>
					<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
					Google+</a>
				</div>

				<a href="{{ url('/password/reset') }}">I forgot my password</a><br>
				<a href="{{ url('/register') }}" class="text-center">Register a new membership</a>

			</div>
		</div>

	@endsection

@section('page_scripts')
@parent
	<script src="{!! asset('plugins/iCheck/icheck.min.js') !!}"></script>
	<script>
		$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' /* optional */
		});
		});
	</script>
@endsection