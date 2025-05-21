@extends('layouts.website-layout')
@section('main-content')
    <div class="container" id="more-details">
        <div class="row mt-5">
            <div class="col-lg-8">
                <h4>MANAGEMENT TEAM</h4>
                <hr>
                <div class="container text-center my-5">
                    @if(isset($team) && count($team) >0)
                        @php($firstId = $team->first()->id)
                        @php($imageData = \App\Http\Controllers\v1\AdminController::getContentImage($team->first()->id))
                        <div class="row justify-content-center my-4">
                            <div class="col-md-4">
                                <div class="member-card">
                                    <img src="{{asset('storage/'.$imageData->document_path)}}" alt="Chairperson">
                                    <div class="member-info">
                                        <div class="member-name">{{$team->first()->full_name}}</div>
                                        <div class="member-role">{{$team->first()->title_p}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center g-4">
                            @foreach($team as $row)
                                @php($imageData = \App\Http\Controllers\v1\AdminController::getContentImage($row->id))
                                @if($row->id != $firstId)
                                    <div class="col-md-3 col-sm-6">
                                        <div class="member-card">
                                            <img src="{{asset('storage/'.$imageData->document_path)}}" alt="member">
                                            <div class="member-info">
                                                <div class="member-name">{{$row->full_name}}</div>
                                                <div class="member-role">{{$row->title_p}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
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
