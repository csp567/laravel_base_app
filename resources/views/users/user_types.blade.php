@extends('layouts.master')
@section('title', 'User Types')
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
									<h3 class="box-title">Available User Types</h3>
								</div>
								<div class="box-body no-padding">
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
											<td>{{ $user->type }}</td>
											<td>{{ $user->created_at }}</td>
											<td><button type="button" data-id="{{$user->id}}" class="btn btn-sm btn-default">Update</button></td>
											<td><button type="button" data-id="{{$user->id}}" class="delete-user-type btn btn-sm btn-danger">Delete</button></td>
										</tr>
										@endforeach
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Create New</h3>
								</div>
								<div class="box-body">
									{{ Form::open( [ 'url' => 'create_user_type' ] ) }}
									<div class="form-group has-feedback {{ $errors->has('user_type') ? 'has-error' : '' }}">
										{{ Form::text( 'user_type', old('user_type'), [ 'class' => 'form-control', 'placeholder' => 'User Type' ] ) }}
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
										@if( $errors->has('user_type') )
											<span class="help-block">
												<strong>{{ $errors->first('user_type') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group">
										{{ Form::button( 'Create', [ 'class' => 'btn btn-primary btn-block btn-flat', 'type' => 'submit' ] ) }}
									</div>
									{{ Form::close() }}
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
	<script type="text/javascript">
		$(document).ready(function () {
			$('.delete-user-type').on('click', function() {
				var userTypeId = $(this).data("id");
				var result = confirm("Are you sure you want to delete this user type?");
				if (result) {
					$.ajax({
						type:'POST',
						url:'/delete-user-type',
						data: { "_token": "{{ csrf_token() }}", "user_typ_id": userTypeId },
						success:function(data){
							$("#alert-msg").html( '<div style="margin: 15px;" class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> ' + data.msg + '</div>');
							$('#idUserType_' + userTypeId).fadeOut(300, function(){ $(this).remove();});
						}
					});
				}

			});
		});
	</script>
@endsection