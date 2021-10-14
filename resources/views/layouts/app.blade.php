<!DOCTYPE html>
<html lang="en">
<head>
	<title>RealTime ChatApp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>
    <link rel="icon" href="{{asset('images/messenger.ico')}}" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animate/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/css-hamburgers/hamburgers.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animsition/css/animsition.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/select2/select2.min.css')}}">	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/daterangepicker/daterangepicker.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
</head>
<body>
    <style>
        .error{
            color: red !important;
            font-weight: 500;
        }
    </style>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				@yield('content')
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<script href="{{asset('assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script href="{{asset('assets/vendor/animsition/js/animsition.min.js')}}"></script>
	<script href="{{asset('assets/vendor/bootstrap/js/popper.js')}}"></script>
	<script href="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script href="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
	<script href="{{asset('assets/vendor/daterangepicker/moment.min.js')}}"></script>
	<script href="{{asset('assets/vendor/daterangepicker/daterangepicker.js')}}"></script>
	<script href="{{asset('assets/vendor/countdowntime/countdowntime.js')}}"></script>
	<script href="{{asset('assets/js/main.js')}}"></script>

</body>
</html>
