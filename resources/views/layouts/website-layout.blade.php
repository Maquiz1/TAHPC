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
{{--                                <li class="nav-item dropdown">--}}
{{--                                    <a class="nav-link dropdown-toggle {{ request()->routeIs('traditional-citizen', 'traditional-noncitizen',--}}
{{--                                                    'alternatively-citizen', 'alternatively-noncitizen','massage-citizen',--}}
{{--                                                    'assistant-traditional','assistant-traditional','assistant-alternatively',--}}
{{--                                                    'traditional-medicine-seller') ? 'active' : '' }}" href="#section_5"--}}
{{--                                       id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"--}}
{{--                                       aria-expanded="false" >--}}
{{--                                        Registrations <i class="fas fa-caret-down ms-1"></i>--}}
{{--                                    </a>--}}
{{--                                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-4 mr-5">--}}
{{--                                                <ul>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('traditional-citizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('traditional-citizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('traditional-citizen') ? 'page' : '' }}">--}}
{{--                                                            Traditional health practitioner(citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('traditional-noncitizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('traditional-noncitizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('traditional-noncitizen') ? 'page' : '' }}">--}}
{{--                                                            Traditional health practitioner (Non citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('alternatively-citizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('alternatively-citizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('alternatively-citizen') ? 'page' : '' }}">--}}
{{--                                                            Alternatively health practitioner (citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('alternatively-noncitizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('alternatively-noncitizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('alternatively-noncitizen') ? 'page' : '' }}">--}}
{{--                                                            Alternatively practitioner (Non citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('massage-citizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('massage-citizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('massage-citizen') ? 'page' : '' }}">--}}
{{--                                                            Massage health practitioner (Citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('traditional-medicine-seller') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('traditional-medicine-seller') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('traditional-medicine-seller') ? 'page' : '' }}">--}}
{{--                                                            Traditional Medicine Seller--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('assistant-alternatively') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('assistant-alternatively') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('assistant-alternatively') ? 'page' : '' }}">--}}
{{--                                                            Assistant Alternatively health practitioner--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('assistant-traditional') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('assistant-traditional') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('assistant-traditional') ? 'page' : '' }}">--}}
{{--                                                            Assistant Traditional health practitioner--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <ul>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('traditional-citizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('traditional-citizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('traditional-citizen') ? 'page' : '' }}">--}}
{{--                                                            Traditional health practitioner(citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('traditional-noncitizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('traditional-noncitizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('traditional-noncitizen') ? 'page' : '' }}">--}}
{{--                                                            Traditional health practitioner (Non citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('alternatively-citizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('alternatively-citizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('alternatively-citizen') ? 'page' : '' }}">--}}
{{--                                                            Alternatively health practitioner (citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('alternatively-noncitizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('alternatively-noncitizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('alternatively-noncitizen') ? 'page' : '' }}">--}}
{{--                                                            Alternatively practitioner (Non citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('massage-citizen') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('massage-citizen') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('massage-citizen') ? 'page' : '' }}">--}}
{{--                                                            Massage health practitioner (Citizen)--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('traditional-medicine-seller') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('traditional-medicine-seller') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('traditional-medicine-seller') ? 'page' : '' }}">--}}
{{--                                                            Traditional Medicine Seller--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('assistant-alternatively') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('assistant-alternatively') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('assistant-alternatively') ? 'page' : '' }}">--}}
{{--                                                            Assistant Alternatively health practitioner--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('assistant-traditional') }}"--}}
{{--                                                           class="dropdown-item {{ request()->routeIs('assistant-traditional') ? 'active' : '' }}"--}}
{{--                                                           aria-current="{{ request()->routeIs('assistant-traditional') ? 'page' : '' }}">--}}
{{--                                                            Assistant Traditional health practitioner--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </ul>--}}
{{--                                </li>--}}

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle {{ request()->routeIs('traditional-citizen', 'traditional-noncitizen',
                                        'alternatively-citizen', 'alternatively-noncitizen','massage-citizen',
                                        'assistant-traditional','assistant-alternatively','traditional-medicine-seller') ? 'active' : '' }}"
                                       href="#" id="navbarMegaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Service <i class="fas fa-caret-down ms-1"></i>
                                    </a>

                                    <ul class="dropdown-menu p-4" style="width: 1000px;  border-radius: 0.5rem;
                                                     box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);" aria-labelledby="navbarMegaDropdown">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="dropdown-header" style=" font-weight: 600;
                                                    color: #444;
                                                    padding-bottom: 0.5rem;">Registration</h6>
                                                <a class="dropdown-item" href="{{ route('alternatively-citizen') }}">Alternatively health practitioner (Citizen)</a>
                                                <a class="dropdown-item" href="{{ route('alternatively-noncitizen') }}">Alternatively practitioner (Non citizen)</a>
                                                <a class="dropdown-item" href="{{ route('assistant-alternatively') }}">Assistant Alternatively health practitioner</a>
                                                <a class="dropdown-item" href="{{ route('massage-citizen') }}">Massage health practitioner (Citizen)</a>
                                                <a class="dropdown-item" href="{{ route('traditional-citizen') }}" style="padding: 0.35rem 0.75rem;  white-space: normal;">Traditional health practitioner (Citizen)</a>
                                                <a class="dropdown-item" href="{{ route('traditional-noncitizen') }}" style="padding: 0.35rem 0.75rem;  white-space: normal;">Traditional health practitioner (Non citizen)</a>
                                                <a class="dropdown-item" href="{{ route('assistant-traditional') }}" style="padding: 0.35rem 0.75rem;  white-space: normal;">Assistant Traditional health practitioner</a>
                                                <a class="dropdown-item" href="{{ route('traditional-medicine-seller') }}" style="padding: 0.35rem 0.75rem;  white-space: normal;">Traditional Medicine Seller</a>

                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="dropdown-header">Facilities</h6>
                                                <a href="{{ route('traditional-medicine-shrine') }}"
                                                   class="dropdown-item {{ request()->routeIs('traditional-medicine-shrine') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('traditional-medicine-shrine') ? 'page' : '' }}">
                                                    Traditional medicine Shrine
                                                </a>
                                                <a href="{{ route('traditional-medicine-shrine') }}"
                                                   class="dropdown-item {{ request()->routeIs('traditional-medicine-shrine') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('traditional-medicine-shrine') ? 'page' : '' }}">
                                                    Traditional medicine Shrine
                                                </a>
                                                <a href="{{ route('traditional-medicine-clinic') }}"
                                                   class="dropdown-item {{ request()->routeIs('traditional-medicine-clinic') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('traditional-medicine-clinic') ? 'page' : '' }}">
                                                    Traditional medicine Clinic
                                                </a>
                                                <a href="{{ route('alternatively-medicine-clinic') }}"
                                                   class="dropdown-item {{ request()->routeIs('alternatively-medicine-clinic') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('alternatively-medicine-clinic') ? 'page' : '' }}">
                                                    Alternatively medicine Clinic
                                                </a>
                                                <a href="{{ route('traditional-medicine-health-centre') }}"
                                                   class="dropdown-item {{ request()->routeIs('traditional-medicine-health-centre') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('traditional-medicine-health-centre') ? 'page' : '' }}">
                                                    Traditional Medicine Health Centre
                                                </a>
                                                <a href="{{ route('alternatively-medicine-health-centre') }}"
                                                   class="dropdown-item {{ request()->routeIs('alternatively-medicine-health-centre') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('alternatively-medicine-health-centre') ? 'page' : '' }}">
                                                    Alternatively Medicine Health Centre
                                                </a>
                                                <a href="{{ route('traditional-medicine-hospital') }}"
                                                   class="dropdown-item {{ request()->routeIs('traditional-medicine-hospital') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('traditional-medicine-hospital') ? 'page' : '' }}">
                                                    Traditional Medicine Hospital
                                                </a>
                                                <a href="{{ route('alternative-medicine-hospital') }}"
                                                   class="dropdown-item {{ request()->routeIs('alternative-medicine-hospital') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('alternative-medicine-hospital') ? 'page' : '' }}">
                                                    Alternative medicine Hospital
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="dropdown-header">Medicines</h6>
                                                <a href="{{ route('registration-traditional-medicine') }}"
                                                   class="dropdown-item {{ request()->routeIs('registration-traditional-medicine') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('registration-traditional-medicine') ? 'page' : '' }}">
                                                    Registration Of Traditional Medicines
                                                </a>
                                                <a href="{{ route('registration-alternative-medicine') }}"
                                                   class="dropdown-item {{ request()->routeIs('registration-alternative-medicine') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('registration-alternative-medicine') ? 'page' : '' }}">
                                                    Registration Of Alternative Medicines
                                                </a>
                                                <a href="{{ route('enlisting-traditional-medicines') }}"
                                                   class="dropdown-item {{ request()->routeIs('enlisting-traditional-medicines') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('enlisting-traditional-medicines') ? 'page' : '' }}">
                                                    Enlisting Traditional Medicines
                                                </a>
                                                <a href="{{ route('importing-medicines') }}"
                                                   class="dropdown-item {{ request()->routeIs('importing-medicines') ? 'active' : '' }}"
                                                   aria-current="{{ request()->routeIs('importing-medicines') ? 'page' : '' }}">
                                                    Importing Medicines
                                                </a>
                                            </div>
                                        </div>
                                    </ul>
                                </li>

{{--                                <li class="nav-item dropdown">--}}
{{--                                    <a class="nav-link dropdown-toggle {{ request()->routeIs('traditional-medicine-shrine','traditional-medicine-clinic',--}}
{{--                                                                'alternatively-medicine-clinic','traditional-medicine-health-centre',--}}
{{--                                                                'alternatively-medicine-health-centre',--}}
{{--                                                                'traditional-medicine-hospital','alternative-medicine-hospital',--}}
{{--                                                                'traditional-medicine-store') ? 'active' : '' }}" href="#section_5"--}}
{{--                                       id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"--}}
{{--                                       aria-expanded="false" >--}}
{{--                                        Facilities <i class="fas fa-caret-down ms-1"></i>--}}
{{--                                    </a>--}}
{{--                                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">--}}
{{--                                        --}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('traditional-medicine-store') }}"--}}
{{--                                               class="dropdown-item {{ request()->routeIs('traditional-medicine-store') ? 'active' : '' }}"--}}
{{--                                               aria-current="{{ request()->routeIs('traditional-medicine-store') ? 'page' : '' }}">--}}
{{--                                                Traditional Medicine Store--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item dropdown">--}}
{{--                                    <a class="nav-link dropdown-toggle {{ request()->routeIs('registration-traditional-medicine',--}}
{{--                                                         'registration-alternative-medicine','importing-medicines',--}}
{{--                                                         'enlisting-traditional-medicines','exporting-medicines') ? 'active' : '' }}" href="#section_5"--}}
{{--                                       id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"--}}
{{--                                       aria-expanded="false" >--}}
{{--                                        Medicines <i class="fas fa-caret-down ms-1"></i>--}}
{{--                                    </a>--}}
{{--                                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('exporting-medicines') }}"--}}
{{--                                               class="dropdown-item {{ request()->routeIs('exporting-medicines') ? 'active' : '' }}"--}}
{{--                                               aria-current="{{ request()->routeIs('exporting-medicines') ? 'page' : '' }}">--}}
{{--                                               Exporting Medicines--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
                                <li class="nav-item">
                                    <a href="{{ route('licensing') }}" @class(['nav-link', 'active' => request()->routeIs('licensing')]) aria-current="{{ request()->routeIs('licensing') ? 'page' : '' }}">
                                        Publication
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('library') }}" @class(['nav-link', 'active' => request()->routeIs('library')]) aria-current="{{ request()->routeIs('library') ? 'page' : '' }}">
                                        Library
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
                            <li class="footer-menu-item"><a href="https://nimr.or.tz" target="_blank" class="footer-menu-link">NIMR</a></li>
                            <li class="footer-menu-item"><a href="https://www.tmda.go.tz/" target="_blank" class="footer-menu-link">TMDA</a></li>
                            <li class="footer-menu-item"><a href="https://www.gcla.go.tz/" target="_blank" class="footer-menu-link">GCLA</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 mb-4 mx-auto">
                        <h5 class="site-footer-title mb-3">Tovuti Mashuhuri</h5>
                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="https://www.moh.go.tz/" target="_blank" class="footer-menu-link">Wizara Ya Afya</a></li>
                            <li class="footer-menu-item"><a href="https://www.ikulu.go.tz/" target="_blank" class="footer-menu-link">President's Office-State House</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mx-auto">
                        <h5 class="site-footer-title mb-3">ANWANI</h5>
                        <p class="text-white d-flex mb-2">
                            <i class="fa fa-location-arrow me-2"></i>
                            Traditional and Alternative Health Practice Council
                        </p>
                        <p class="text-white d-flex">
                            <i class="bi-geo-alt me-2"></i>
                            S.L.P 743, Dodoma
                        </p>
                        <p class="text-white d-flex">
                            <i class="fa fa-phone-alt me-2"></i>
                            Simu: +255735600123
                        </p>
                        <p class="text-white d-flex mt-3">
                            <i class="fa fa-envelope me-2"></i>
                            Barua pepe: registra.tahpc@afya.go.tz, barazatibaasili@gmail.com
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
