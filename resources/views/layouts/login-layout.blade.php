<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TAHPC</title>
    <link href="{{asset('assets/css/login/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="stylesheet" href="{{asset('assets/css/login-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/toast/toastr.min.css')}}" />
</head>
<body>

@yield('main-content')

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.sticky.js')}}"></script>
<script src="{{asset('assets/js/click-scroll.js')}}"></script>
<script src="{{asset('assets/js/counter.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/toast/toastr.min.js')}}"></script>
@include('required_files.main_js')
</body>
</html>
