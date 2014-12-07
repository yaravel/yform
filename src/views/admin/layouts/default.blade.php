@extends('packages.yaravel.yform.admin.layouts.blank')
@section('contentMaster')
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ NAVURL::dsbase(Session::get('systemName') . '/profile/edit') }}">{{ strtoupper(Auth::user()->username) }}</a> 
			</div>
			<div style="color: white;
			padding: 15px 50px 5px 50px;
			float: right;
			font-size: 16px;"> <a href="{{ NAVURL::dsbase(Session::get('systemName') . '/profile/edit') }}" class="btn btn-danger square-btn-adjust" id="nav-editprofile"><i class="fa fa-user"></i> Perfil</a> <a href="{{ NAVURL::dsbase(Session::get('systemName') . '/login') }}" class="btn btn-danger square-btn-adjust"><i class="fa fa-times-circle-o"></i> Salir</a> </div>
		</nav>   
		<!-- /. NAV TOP  -->
		<nav class="navbar-default navbar-side" role="navigation">
			<div class="sidebar-collapse">
				@include('yform.admin.menu.' . Auth::user()->rowclient)
			</div>

		</nav>
		<!-- /. NAV SIDE  -->
		<div id="page-wrapper" >
			<div id="page-inner">
				@yield('content')
			</div>
		</div>
	</div>
@stop