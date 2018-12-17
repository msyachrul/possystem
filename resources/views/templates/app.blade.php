<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="{{ config('app.name') }} by msyachrul">
	<meta name="author" content="msyachrul">
	<!-- CSRF-TOKEN -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="icon" href="">

	<title>{{ config('app.name') }} | @stack('title')</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">

	<!-- Datatables -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ie10-viewport-bug-workaround.css') }}">

	<!-- Custom styles for laravel -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

	@stack('styles')

	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="{{ asset('assets/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<nav class="main-menu">
		<ul>
			<li>
				<a href="#"><i class="fa fa-shopping-cart fa-custom fa-2x"></i><span class="nav-text"><b>{{ config('app.name') }}</b></span></a>
			</li>
			<br>
			<li>
				<a href="{{ route('vendor.index') }}"><i class="fa fa-address-card fa-custom fa-2x"></i><span class="nav-text">Vendor</span></a>
			</li>
			<li>
				<a href="{{ route('good_category.index') }}"><i class="fa fa-list fa-custom fa-2x"></i><span class="nav-text">Kategori</span></a>
			</li>
			<li>
				<a href="{{ route('good.index') }}"><i class="fa fa-shopping-bag fa-custom fa-2x"></i><span class="nav-text">Barang</span></a>
			</li>
			<li>
				<a href="#"><i class="fa fa-calculator fa-custom fa-2x"></i><span class="nav-text">Perhitungan</span></a>
			</li>
			<li>

			</li>
		</ul>
		<ul class="logout">
			<li>
				<a href="#"><i class="fa fa-power-off fa-custom fa-2x"></i><span class="nav-text">Logout</span></a>
			</li>
		</ul>
	</nav>
	<div class="content-area">
		<div class="container-fluid">
			@yield('content')
		</div>
	</div>

	@include('templates._modal')

	<!-- Bootstrap core JavaScript -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>

	<!-- Sweetalert2 -->
	<script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="{{ asset('assets/js/ie10-viewport-bug-workaround.js') }}"></script>


	<script src="{{ asset('js/app.js') }}"></script>

	@stack('scripts')
</body>
</html>