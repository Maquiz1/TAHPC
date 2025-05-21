<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TAHPC - {{$title}}</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="{{asset('assets/css/templatemo-kind-heart-charity.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
</head>
<body id="section_1">

<div class="container">
    <div style=" box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff;">
        <header class="site-header">
            <div class="container">
                <div class="row">
                    @if(isset($left))
                        <div class="col-lg-2 col-12 d-flex flex-wrap">
                            <img src="{{asset('storage/'.$left->data)}}" class="logo img-fluid" alt="logo">
                        </div>
                    @endif
                    @if(isset($center))
                        <div class="col-lg-8 col-12 ms-auto d-lg-block d-none text-center" id="titles">
                            @if(!empty($center[0]))
                                <h3 style="color: #ffffff;">{{ $center[0]->data }}</h3>
                            @endif

                            @if(!empty($center[1]))
                                <h5 style="color: #ffffff;">{{ $center[1]->data }}</h5>
                            @endif
                        </div>
                    @endif
                    @if(isset($right))
                        <div class="col-lg-2 col-12 ms-auto d-lg-block d-none ">
                            <img src="{{asset('storage/'.$right->data)}}" class="logo img-fluid float-lg-end" alt="logo">
                        </div>
                    @endif
                </div>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg bg-light shadow-lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="{{ route('welcome') }}" @class(['nav-link', 'active' => request()->routeIs('welcome')]) aria-current="{{ request()->routeIs('welcome') ? 'page' : '' }}">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle {{ request()->routeIs('about-us', 'mission-vision', 'council-members', 'management-team') ? 'active' : '' }}" href="#section_5"
                                       id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false" >
                                        About Us <i class="fas fa-caret-down ms-1"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                        <li>
                                            <a href="{{ route('about-us') }}"
                                               class="dropdown-item {{ request()->routeIs('about-us') ? 'active' : '' }}"
                                               aria-current="{{ request()->routeIs('about-us') ? 'page' : '' }}">
                                                About Us
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('mission-vision') }}"
                                               class="dropdown-item {{ request()->routeIs('mission-vision') ? 'active' : '' }}"
                                               aria-current="{{ request()->routeIs('mission-vision') ? 'page' : '' }}">
                                                Mission And Vision
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('council-members') }}"
                                               class="dropdown-item {{ request()->routeIs('council-members') ? 'active' : '' }}"
                                               aria-current="{{ request()->routeIs('council-members') ? 'page' : '' }}">
                                                Council Members
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('management-team') }}"
                                               class="dropdown-item {{ request()->routeIs('management-team') ? 'active' : '' }}"
                                               aria-current="{{ request()->routeIs('management-team') ? 'page' : '' }}">
                                                Management Team
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('registration') }}" @class(['nav-link', 'active' => request()->routeIs('registration')]) aria-current="{{ request()->routeIs('registration') ? 'page' : '' }}">
                                        Registrations
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('licensing') }}" @class(['nav-link', 'active' => request()->routeIs('licensing')]) aria-current="{{ request()->routeIs('licensing') ? 'page' : '' }}">
                                        Licencing
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#section_7"
                                       id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false" >
                                        Staff Section <i class="fas fa-caret-down ms-1"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#restricted-area-modal"
                                               class="dropdown-item">
                                                Login
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://mail.afya.go.tz/" target="_blank" class="dropdown-item">
                                                Government Email
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://eoffice.gov.go.tz/login" target="_blank" class="dropdown-item">
                                                E-Office
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item" style="white-space: nowrap;">
                                    <a href="{{ route('contact-us') }}" @class(['nav-link', 'active' => request()->routeIs('contact-us')]) aria-current="{{ request()->routeIs('contact-us') ? 'page' : '' }}">
                                        Contact Us
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </nav>
        <div>
            @yield('main-content')
        </div>
        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-12 mb-4 text-center">
                        @if(isset($right))
                            <img src="{{asset('storage/'.$right->data)}}" class="logo img-fluid float-lg-center" alt="logo">
                        @endif
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 mb-4 mx-auto">
                        <h5 class="site-footer-title mb-3">Kurasa za Karibu</h5>

                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="https://hprs.moh.go.tz" target="_blank" class="footer-menu-link">HPRS Login</a></li>

                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 mb-4 mx-auto">
                        <h5 class="site-footer-title mb-3">Tovuti Mashuhuri</h5>

                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="https://www.moh.go.tz/" target="_blank" class="footer-menu-link">Wizara Ya Afya</a></li>
                            <li class="footer-menu-item"><a href="https://www.ikulu.go.tz/" target="_blank" class="footer-menu-link">President's Office-State House</a></li>
                            <li class="footer-menu-item"><a href="https://hprs.moh.go.tz" target="_blank" class="footer-menu-link">HPRS Login</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mx-auto">
                        <h5 class="site-footer-title mb-3">ANWANI</h5>
                        <p class="text-white d-flex mb-2">
                            <i class="fa fa-location-arrow me-2"></i>
                            Wizara ya Afya
                        </p>
                        <p class="text-white d-flex">

                            <i class="bi-geo-alt me-2"></i>
                            S.L.P 743, Dodoma
                        </p>
                        <p class="text-white d-flex">
                            <i class="fa fa-phone-alt me-2"></i>

                            Simu: +255-26-2323267/5
                        </p>

                        <p class="text-white d-flex mt-3">
                            <i class="fa fa-envelope me-2"></i>
                            Barua pepe: ps@afya.go.tz
                        </p>

                    </div>
                </div>
            </div>

            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-md-7 col-12">
                            <p class="copyright-text mb-0">Hakimiliki © {{date('Y')}} TAHPC. Haki zote zimehifadhiwa.</p>
                        </div>

                        <div class="col-lg-4 col-md-5 col-12 d-flex justify-content-center float-lg-right mx-auto">
                            <ul class="social-icon float-lg-right">
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-facebook"></a>
                                </li>
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
    </div>

</div>
<script src="{{asset('assets/js/web/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/web/popper.min.js')}}"></script>
<script src="{{asset('assets/js/web/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.sticky.js')}}"></script>
<script src="{{asset('assets/js/click-scroll.js')}}"></script>
<script src="{{asset('assets/js/counter.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>


@include('required_files.system_modals')
@include('required_files.welcome-js')
</body>
</html>
