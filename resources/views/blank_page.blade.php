@extends('layouts.master')
@section('title', 'Blank page') <!-- This should a page title -->
@section('body-class', 'hold-transition skin-blue sidebar-mini') <!-- If you want to specify body class then it will goes here -->
@section('head')
	@parent
		@include('includes/home_css_loader') <!-- This file includes common header files -->
		<!-- You can add additional header files here -->
	@endsection
	@section('content')
		<div class="wrapper">
			@include('includes/header') <!-- This includes header part of page -->
			@include('includes/sidebar') <!-- This includes sidebar of page -->
			<div class="content-wrapper">
				@include('includes/page_details') <!-- this includes page title and breadcumbs -->
				<section class="content">
					<div class="row">
						<!-- Page code will goas here -->
					</div>
				</section>
			</div>
			@include('includes/footer') <!-- This includes common footer -->
		</div>
	@endsection
@section('page_scripts') <!-- this includes common script to footer -->
@parent
	@include('includes/home_script_loader')
	<!-- Here we can add extra script for page -->
@endsection