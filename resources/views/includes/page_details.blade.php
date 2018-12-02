<section class="content-header" style="padding-bottom: 15px; border-bottom: 1px solid #dcdcd4;">
	<h1>
		@yield('title') <small>@yield('page-sub-title')</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<?php $segments = ''; ?>
		@foreach(Request::segments() as $segment)
			<?php $segments .= '/'.$segment; ?>
			<li>
				<a class="text-capitalize" href="{{ $segments }}">{{$segment}}</a>
			</li>
		@endforeach
	</ol>
</section>
<div id="alert-msg"></div>
@if(Session::has('Success'))
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissible" style="margin:15px;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Success!</h4>
				{!! Session::get('Success') !!}
			</div>
		</div>
	</div>
@endif

@if(Session::has('Error'))
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger alert-dismissible" style="margin:15px;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Error!</h4>
				{!! Session::get('Error') !!}
			</div>
		</div>
	</div>
@endif

@if(Session::has('Info'))
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info alert-dismissible" style="margin:15px;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-info"></i> Info!</h4>
				{!! Session::get('Info') !!}
			</div>
		</div>
	</div>
@endif

@if(Session::has('Warning'))
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning alert-dismissible" style="margin:15px;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-warning"></i> Warning!</h4>
				{!! Session::get('Warning') !!}
			</div>
		</div>
	</div>
@endif