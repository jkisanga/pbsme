<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{Lang::get('site.sitename')}} </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="asset/js/html5.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/login.css')}}">    

</head>
<body>

<div class="container">
    <div class="row vertical-center-row">
	@include('notifications')
      @yield('content')
    </div>
</div>

</body>

   <!-- core js files -->
    <script src="{{asset('asset/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{asset('asset/js/bootstrap.min.js')}}"></script>

  
    <!-- core js files -->
</html>