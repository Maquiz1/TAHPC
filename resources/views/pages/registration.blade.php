@extends('layouts.website-layout')
@section('main-content')
    <div class="container" id="more-details">
        <div class="row mt-5">
            <div class="col-lg-8">
                <h4>REGISTRATION DETAILS</h4>
                <hr>

            </div>
            <div class="col-lg-4">
                <div class="sidebar-pages float-lg-end mt-4">
                    <h3>ABOUT THE COUNCIL</h3>
                    <ul>
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
                </div>
            </div>
        </div>
    </div>
@endsection
