@extends('layouts.website-layout')
@section('main-content')
    <div class="container" id="more-details">
        <div class="row mt-5">
            <div class="col-lg-8">
                <h5>Alternatively Practitioner (Non citizen)</h5>
                <hr>
                @if(isset($pageContent))
                    <p id="paragraph-content">
                        <?= $pageContent->body ?>
                    </p>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="sidebar-pages float-lg-end mt-4">
                    <h3>Temporary and Full Registration</h3>
                    <ul>
                        <li>
                            <a href="{{ route('traditional-citizen') }}"
                               class="dropdown-item {{ request()->routeIs('traditional-citizen') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('traditional-citizen') ? 'page' : '' }}">
                                Traditional health practitioner(citizen)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('traditional-noncitizen') }}"
                               class="dropdown-item {{ request()->routeIs('traditional-noncitizen') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('traditional-noncitizen') ? 'page' : '' }}">
                                Traditional health practitioner (Non citizen)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('alternatively-citizen') }}"
                               class="dropdown-item {{ request()->routeIs('alternatively-citizen') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('alternatively-citizen') ? 'page' : '' }}">
                                Alternatively health practitioner (citizen)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('alternatively-noncitizen') }}"
                               class="dropdown-item {{ request()->routeIs('alternatively-noncitizen') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('alternatively-noncitizen') ? 'page' : '' }}">
                                Alternatively practitioner (Non citizen)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('massage-citizen') }}"
                               class="dropdown-item {{ request()->routeIs('massage-citizen') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('massage-citizen') ? 'page' : '' }}">
                                Massage health practitioner (Citizen)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('traditional-medicine-seller') }}"
                               class="dropdown-item {{ request()->routeIs('traditional-medicine-seller') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('traditional-medicine-seller') ? 'page' : '' }}">
                                Traditional Medicine Seller
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('assistant-alternatively') }}"
                               class="dropdown-item {{ request()->routeIs('assistant-alternatively') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('assistant-alternatively') ? 'page' : '' }}">
                                Assistant Alternatively health practitioner
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('assistant-traditional') }}"
                               class="dropdown-item {{ request()->routeIs('assistant-traditional') ? 'active' : '' }}"
                               aria-current="{{ request()->routeIs('assistant-traditional') ? 'page' : '' }}">
                                Assistant Traditional health practitioner
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
