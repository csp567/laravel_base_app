<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
		<div class="pull-left image">
			<img src="{{ url('/') }}/img/defauilt-user.png" class="img-circle" alt="User Image">
		</div>
		<div class="pull-left info">
			<p><a href="{{ url( '/profile' ) }}">{{ Auth::user()->name }}</a></p>
			<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
		</div>
		<form action="#" method="get" class="sidebar-form">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Search...">
			<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
				</button>
				</span>
		</div>
		</form>
		<ul class="sidebar-menu" data-widget="tree">
		<li class="header">Navigation</li>
		<li class="active">
			<a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-address-book"></i>
				<span>Contacts</span>
				<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="{{ url( '/contact/create' ) }}"><i class="fa fa-user-plus"></i> Create</a></li>
				<li><a href="{{ url( '/contact/' ) }}"><i class="fa fa-circle-o"></i> All Contacts</a></li>
			</ul>
		</li>
		@if( UserTypes::ADMIN == Auth::user()->user_type || UserTypes::SUPER_ADMIN == Auth::user()->user_type )
		<li class="treeview">
			<a href="#">
			<i class="fa fa-users"></i>
			<span>Users</span>
			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="{{ url( '/user/user-types' ) }}"><i class="fa fa-user"></i> User Types</a></li>
				<li><a href="{{ url( '/user' ) }}"><i class="fa fa-circle-o"></i> Users</a></li>
			</ul>
		</li>
		@endif
		<li><a href="/blank-page"><i class="fa fa-circle-o text-green"></i> <span>Blank Page</span></a></li>
		</ul>
	</section>
</aside>