@extends('layouts.website-layout')
@section('main-content')
    <div class="container" id="more-details">
        <div class="row mt-5">
            <div class="col-lg-8">
                <h5>{{$title}}</h5>
                <hr>
                @if(isset($pageContent))
                    <p id="paragraph-content">
                        <?= $pageContent->body ?>
                    </p>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="sidebar-pages float-lg-end mt-4">
                    <h3>MEDICINES</h3>
                    <ul>
                        <li>
                            <a href="{{ route('registration-traditional-medicine') }}"
                               class="dropdown-item {{ request()->routeIs('registration-traditional-medicine') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('registration-traditional-medicine') ? 'page' : '' }}">
                                Registration Of Traditional Medicines
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('registration-alternative-medicine') }}"
                               class="dropdown-item {{ request()->routeIs('registration-alternative-medicine') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('registration-alternative-medicine') ? 'page' : '' }}">
                                Registration Of Alternative Medicines
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('enlisting-traditional-medicines') }}"
                               class="dropdown-item {{ request()->routeIs('enlisting-traditional-medicines') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('enlisting-traditional-medicines') ? 'page' : '' }}">
                                Enlisting Traditional Medicines
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('importing-medicines') }}"
                               class="dropdown-item {{ request()->routeIs('importing-medicines') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('importing-medicines') ? 'page' : '' }}">
                                Importing Medicines
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('exporting-medicines') }}"
                               class="dropdown-item {{ request()->routeIs('exporting-medicines') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('exporting-medicines') ? 'page' : '' }}">
                                Exporting Medicines
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
