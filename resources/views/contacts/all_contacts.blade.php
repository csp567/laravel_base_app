@extends('layouts.master')
@section('title', 'All Contacts')
@section('body-class', 'hold-transition skin-blue sidebar-mini')
@section('head')
	@parent
		@include('includes/home_css_loader')
		<style>
			.circle-image{
				width:50px;
			}
			.custom-control-label{
				margin-left: 5px;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
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
									<h3 class="box-title">All Contacts</h3>
									<div class="pull-right">
										<a href="/contact/create" class="btn btn-primary"><i class="fa fa-plus"></i> Create Contact</a>
									</div>
								</div>
								<div class="box-body no-padding">
									<table class="table table-condensed display" id="table_id">
										<thead>
											<tr>
												<th style="width: 10px">#</th>
												<th>Name</th>
												<th>Mobile No's</th>
												<th>Email</th>
												<th>Contact Image</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
										<?php $contactsCounter = 1; ?>
										@foreach( $contacts as $contact )
										<tr id="idContactRow_{{$contact->id}}">
											<td>{{ $contactsCounter }}</td>
											<td id="idContactName_{{$contact->id}}">{{ $contact->first_name }} {{ $contact->middle_name }} {{ $contact->last_name }}</td>
											<td>{{ $contact->primary_number }}</td>
											<td>{{ $contact->email }}</td>
											<td>
												@if( file_exists( $contact->contact_image ) )
												<img src="{{ asset( $contact->contact_image ) }}" class="img-thumbnail circle-image" />
												@else
												<img src="{{ asset( 'img/' . 'defauilt-user.png' ) }}" class="img-thumbnail circle-image" />
												@endif
											</td>
											<td>
												<a href="/contact/{{$contact->id}}" data-id="{{$contact->id}}" class="btn btn-sm btn-default">View</a>
												<a href="/contact/{{$contact->id}}/edit" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>
												<a data-id="{{$contact->id}}" class="btn btn-sm btn-warning share-contact"><i class="fa fa-share"></i></a>
												<a data-id="{{$contact->id}}" class="delete-contact btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
										<?php ++$contactsCounter; ?>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="modal fade" id="idShowUsers">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="idModalTitle"></h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div id="idDivModelAlert"></div>
								<input type="hidden" name="shared_contact_id" id="idSharedContactId" value="">
								<div class="col-md-12 col-lg-12" id="idLoadUserList">
									
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary share-contact-with">Share</button>
						</div>
					</div>
				</div>
			</div>

			@include('includes/footer')
		</div>
	@endsection
@section('page_scripts')
@parent
	@include('includes/home_script_loader')
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#table_id').DataTable();

			$('.delete-contact').on('click', function() {
				var contact_id = $(this).data("id");
				var contactName = $('#idContactName_' + contact_id).text();
				var result = confirm( 'Are you sure you want to delete ' + contactName + ' contact?');
				if (result) {
					$.ajax({
						type:'POST',
						url:'/contact/delete',
						data: { "_token": "{{ csrf_token() }}", "contact_id": contact_id },
						success:function(data){
							$("#alert-msg").html( '<div style="margin: 15px;" class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> ' + data.msg + '</div>');
							$('#idContactRow_' + contact_id).fadeOut(300, function(){ $(this).remove();});
						}
					});
				}
			});

			$('.share-contact').on( 'click', function() {
				var contact_id = $(this).data("id");
				var contact_name = $('#idContactName_' + contact_id).text();
				$('#idSharedContactId').val(contact_id);
				$('#idModalTitle').html('Share <b>' + contact_name + '</b> with:');
				$('#idShowUsers').modal('show');
				loadUsers(contact_id);
			});

			$('.share-contact-with').on( 'click', function() {
				var arrUserIds = [];
				var contact_id = $('#idSharedContactId').val();
				
				$('input[name="user_ids"]:checked').each(function() {
					arrUserIds.push(this.value);
				});

				$.ajax({
					type:'POST',
					url:'/contact/share',
					data: { "_token": "{{ csrf_token() }}", user_ids: arrUserIds, contact_id: contact_id },
					success:function(data){
						$("#idDivModelAlert").html( '<div style="margin: 15px;" class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> ' + data.msg + '</div>');
					}
				});

			} );

			function loadUsers(contact_id) {
				$.ajax({
					type:'POST',
					url:'/user/all',
					data: { "_token": "{{ csrf_token() }}", contact_id: contact_id },
					success:function(data){
						var strhtml = '<ul class="list-group">';
						$.each(data, function(key,val){
							var userId = val['id'];
							var userName = val['name'];
							var isShared = val['is_shared'];

							var isChecked = '';
							if( 1 == isShared ) {
								isChecked = 'checked';
							}
							strhtml += '<li data-id="' + userId + '" class="list-group-item">' 
								+ '<div class="custom-control custom-checkbox">'
								+ '<input ' + isChecked + ' type="checkbox" value="' + userId + '" name="user_ids" class="custom-control-input">'
								+ '<label class="custom-control-label" for="customCheck1"> ' + userName + '</label>'
								+ '</div></li>';
						});
						strhtml += '</ul>';
						$('#idLoadUserList').html(strhtml);
					}
				});
			}
		});
	</script>
@endsection