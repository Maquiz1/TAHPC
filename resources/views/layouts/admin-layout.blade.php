<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>TAHPC - BACKEND</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/css/admin/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/css/admin/jquery.min.js')}}"></script>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/toast/toastr.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/admin/admin-custom.css')}}">
</head>
<body class="sidebar-is-reduced">
<header class="l-header">
    <div class="l-header__inner clearfix">
        <div class="c-header-icon js-hamburger">
            <div class="hamburger-toggle"><span class="bar-top"></span><span class="bar-mid"></span><span class="bar-bot"></span></div>
        </div>
        <div class="c-header-icon has-dropdown"><span class="c-badge c-badge--header-icon animated shake" id="display-counter"></span><i class="fa fa-bell"></i>
            <div class="c-dropdown c-dropdown--notifications">
                <div class="c-dropdown__header"></div>
                <div class="c-dropdown__content"></div>
            </div>
        </div>
        <div class="c-search">
            <input class="c-search__input u-input" placeholder="Search..." type="text"/>
        </div>
        <div class="header-icons-group">
            <div class="c-header-icon logout" onclick="signOutAccount()"><i class="fa fa-power-off"></i></div>
        </div>
    </div>
</header>
<div class="l-sidebar">
    <div class="logo">
        <div class="logo__txt"><img src="{{asset('storage/images/council-logo.svg')}}" alt="logo" style="width:40px"></div>
    </div>
    <div class="l-sidebar__content">
        <nav class="c-menu js-menu">
            <ul class="u-list">
                <li class="c-menu__item menu-item" data-toggle="tooltip" title="Dashboard">
                    <a href="{{route('dashboard')}}">
                        <div class="c-menu__item__inner"><i class="fa fa-home"></i>
                            <div class="c-menu-item__title"><span>Dashboard</span></div>
                        </div>
                    </a>
                </li>
                <li class="c-menu__item menu-item" data-toggle="tooltip" title="Contact Us">
                    <a href="{{route('contact-us-admin')}}">
                        <div class="c-menu__item__inner"><i class="fa fa-envelope"></i>
                            <div class="c-menu-item__title"><span>Contact Us</span></div>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<main class="l-main">
    <div class="content-wrapper content-wrapper--with-bg">
        @yield('main-content')
    </div>
</main>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src="{{asset('assets/css/admin/dashboard-script.js')}}"></script>
<script src='https://use.fontawesome.com/2188c74ac9.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src="{{asset('assets/toast/toastr.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@include('required_files.system_modals')
@include('required_files.dashboard-js')
</body>
</html>
