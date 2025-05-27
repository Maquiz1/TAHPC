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
                    <h3>FACILITIES</h3>
                   <ul>
                       <li>
                           <a href="{{ route('traditional-medicine-shrine') }}"
                              class="dropdown-item {{ request()->routeIs('traditional-medicine-shrine') ? 'active' : '' }}"
                              aria-current="{{ request()->routeIs('traditional-medicine-shrine') ? 'page' : '' }}">
                               Traditional medicine Shrine
                           </a>
                       </li>
                       <li>
                           <a href="{{ route('traditional-medicine-clinic') }}"
                              class="dropdown-item {{ request()->routeIs('traditional-medicine-clinic') ? 'active' : '' }}"
                              aria-current="{{ request()->routeIs('traditional-medicine-clinic') ? 'page' : '' }}">
                               Traditional medicine Clinic
                           </a>
                       </li>
                       <li>
                           <a href="{{ route('alternatively-medicine-clinic') }}"
                              class="dropdown-item {{ request()->routeIs('alternatively-medicine-clinic') ? 'active' : '' }}"
                              aria-current="{{ request()->routeIs('alternatively-medicine-clinic') ? 'page' : '' }}">
                               Alternatively medicine Clinic
                           </a>
                       </li>
                       <li>
                           <a href="{{ route('traditional-medicine-health-centre') }}"
                              class="dropdown-item {{ request()->routeIs('traditional-medicine-health-centre') ? 'active' : '' }}"
                              aria-current="{{ request()->routeIs('traditional-medicine-health-centre') ? 'page' : '' }}">
                               Traditional Medicine Health Centre
                           </a>
                       </li>
                       <li>
                           <a href="{{ route('alternatively-medicine-health-centre') }}"
                              class="dropdown-item {{ request()->routeIs('alternatively-medicine-health-centre') ? 'active' : '' }}"
                              aria-current="{{ request()->routeIs('alternatively-medicine-health-centre') ? 'page' : '' }}">
                               Alternatively Medicine Health Centre
                           </a>
                       </li>
                       <li>
                           <a href="{{ route('traditional-medicine-hospital') }}"
                              class="dropdown-item {{ request()->routeIs('traditional-medicine-hospital') ? 'active' : '' }}"
                              aria-current="{{ request()->routeIs('traditional-medicine-hospital') ? 'page' : '' }}">
                               Traditional Medicine Hospital
                           </a>
                       </li>
                       <li>
                           <a href="{{ route('alternative-medicine-hospital') }}"
                              class="dropdown-item {{ request()->routeIs('alternative-medicine-hospital') ? 'active' : '' }}"
                              aria-current="{{ request()->routeIs('alternative-medicine-hospital') ? 'page' : '' }}">
                               Alternative medicine Hospital
                           </a>
                       </li>
                       <li>
                           <a href="{{ route('traditional-medicine-store') }}"
                              class="dropdown-item {{ request()->routeIs('traditional-medicine-store') ? 'active' : '' }}"
                              aria-current="{{ request()->routeIs('traditional-medicine-store') ? 'page' : '' }}">
                               Traditional Medicine Store
                           </a>
                       </li>
                   </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
