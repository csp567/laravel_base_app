@extends('layouts.master')
@section('title', 'Show Contact')
@section('body-class', 'hold-transition skin-blue sidebar-mini')
@section('head')
	@parent
	@include('includes/home_css_loader')
	<style type="text/css">
		.img-full-width{
			width: 100%
		}
		.lb-same-width{
			width: 135px;
		}
	</style>
@endsection
@section('content')
	<div class="wrapper">
		@include('includes/header')
		@include('includes/sidebar')
		<div class="content-wrapper">
			@include('includes/page_details')
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">Contact Details of <b>{{ $contact->first_name }}</b></h3>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
										@if( file_exists( $contact->contact_image ) )
										<img class="img-thumbnail" src="{{ asset( $contact->contact_image ) }}" />
										@else
										<img class="img-thumbnail" src="{{ asset( 'img/' . 'defauilt-user.png' ) }}" />
										@endif
									</div>
									<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
										<div class="form-group">
											<span><label class="lb-same-width">First Name:</label></span>
											<span><label>{{$contact->first_name}}</label></span>
										</div>
										@if( isset( $contact->middle_name ) )
										<div class="form-group">
											<span><label class="lb-same-width">Middle Name:</label></span>
											<span><label>{{$contact->middle_name}}</label></span>
										</div>
										@endif
										<div class="form-group">
											<span><label class="lb-same-width">Last Name:</label></span>
											<span><label>{{$contact->last_name}}</label></span>
										</div>
										<div class="form-group">
											<span><label class="lb-same-width">Primary Phone:</label></span>
											<span><label>{{$contact->primary_number}}</label></span>
										</div>
										@if( isset( $contact->secondary_number ) )
										<div class="form-group">
											<span><label class="lb-same-width">Secondary Phone:</label></span>
											<span><label>{{$contact->secondary_number}}</label></span>
										</div>
										@endif
										<div class="form-group">
											<span><label class="lb-same-width">Email:</label></span>
											<span><label>{{$contact->email}}</label></span>
										</div>
										<div class="form-group">
											<a href="/contact/{{$contact->id}}/edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<a href="/contact/" class="btn btn-default">Back to All Contacts</a>
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