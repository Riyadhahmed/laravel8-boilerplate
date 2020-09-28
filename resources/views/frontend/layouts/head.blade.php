<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title> @yield('title') | {{ config('app.name') }} </title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="Description" lang="en" content="ADD SITE DESCRIPTION">
<meta name="author" content="ADD AUTHOR INFORMATION">
<meta name="robots" content="index, follow">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Favicons -->
<link rel="shortcut icon" href="{{asset('/assets/images/favicon.png')}}">


<link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">

<!-- Override CSS file - add your own CSS rules -->
<link rel="stylesheet" href="{{ asset('/assets/css/custom_admin_style.css') }}">


<!-- jQuery 3.4.1 -->
<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>

