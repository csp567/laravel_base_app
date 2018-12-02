<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ config('app.app_name') }} | @yield('title')</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<link rel="stylesheet" href="{!! asset('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}" media="all" type="text/css" />
		<link rel="stylesheet" href="{!! asset('bower_components/font-awesome/css/font-awesome.min.css') !!}">
		<link rel="stylesheet" href="{!! asset('bower_components/Ionicons/css/ionicons.min.css') !!}">
		<link rel="stylesheet" href="{!! asset('css/AdminLTE.css') !!}">

		@section('head')
		@show
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<style>
		body {
			font-family: 'Lato';
		}

		.fa-btn {
			margin-right: 6px;
		}
	</style>
	</head>

	<body class="@yield('body-class')">
		@section('sidebar')

		@show

		<!-- <div class = ""> -->
			@yield('content')
		<!-- </div> -->

		<script type="text/javascript" src="{!! asset('bower_components/jquery/dist/jquery.min.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}" ></script>
		@section('page_scripts')
		@show
	</body>
</html>