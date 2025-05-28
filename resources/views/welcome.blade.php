@extends('layouts.website-layout')
@section('main-content')
    <main>
        <section class="hero-section hero-section-full-height">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-12 pr-5" style="text-align: left;">
                        @if(isset($sliderProfile) && count($sliderProfile) >= 2)
                            <div class="frame">
                                <img src="{{asset('storage/'.$sliderProfile[0]->value)}}" alt="Profile" />
                                <div class="frame-banner">{{$sliderProfile[0]->name}} <br> {{$sliderProfile[0]->title}}</div>
                            </div>
                            <div class="frame">
                                <img src="{{asset('storage/'.$sliderProfile[1]->value)}}" alt="Profile" />
                                <div class="frame-banner">{{$sliderProfile[1]?->name}} <br> {{$sliderProfile[1]->title}}</div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-9 col-12 p-1">
                        <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if(isset($sliderCarousel) && count($sliderCarousel) >0)
                                    <div class="carousel-item active">
                                        <img src="{{asset('storage/'.$sliderCarousel[0]->value)}}"
                                             class="carousel-image img-fluid" alt="...">
                                    </div>
                                @endif
                                @foreach($sliderCarousel as $row_carousel)
                                    @if($row_carousel->value != $sliderCarousel[0]->value)
                                            <div class="carousel-item">
                                                <img src="{{asset('storage/'.$row_carousel->value)}}"
                                                     class="carousel-image img-fluid" alt="...">
                                            </div>
                                    @endif
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#hero-slide"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#hero-slide"
                                    data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="content-body mt-5 mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-container text-center py-3" style="width:100%;">
                                    <div class="title-line d-inline-block">
                                        <span class="line"></span>
                                        <span class="title-text text-white px-3" id="header-title-style">HABARI MPYA</span>
                                        <span class="line"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                @if(isset($habari) && count($habari) >0)
                                    @foreach($habari as $row)
                                        @php($imageData = \App\Http\Controllers\v1\AdminController::getContentImage($row->id))
                                        <div class="card mb-3" id="habari-card-style">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <img src="{{asset('storage/'.$imageData->document_path)}}" alt="img" width="200">
                                                    </div>
                                                    <div class="col-lg-8">
                                                       <div id="card-title-style"><strong><a href="{{route('more-details',['contentKey'=>$row->uuid])}}">{{$row->title}}</a></strong></div>
                                                        <div class="date">{{date('F d',strtotime($row->published_at))}}, {{date('Y',strtotime($row->published_at))}}</div>
                                                        <p>
                                                            {{$row->short_description}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-container mt-3 mb-3 text-center py-3">
                                    <div class="title-line d-inline-block">
                                        <span class="line"></span>
                                        <span class="title-text text-white px-3" id="header-title-style">VIDEO</span>
                                        <span class="line"></span>
                                    </div>
                                </div>
                                @if(count($videos) > 0)
                                    <div class="container position-relative">
                                        <!-- Scroll Buttons -->
                                        <button class="scroll-btn scroll-left" onclick="scrollCarousel(-1)">&#10094;</button>
                                        <button class="scroll-btn scroll-right" onclick="scrollCarousel(1)">&#10095;</button>

                                        <!-- Carousel Content -->
                                        <div class="carousel-container" id="videoCarousel">
                                            @foreach($videos as $video)
                                                @php($imageData = \App\Http\Controllers\v1\AdminController::getContentImage($video->id))

                                                <div class="video-card">
                                                    <div class="video-thumb">
                                                        <video width="300" height="180" controls>
                                                            <source src="{{ asset('storage/'.$imageData->document_path) }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                    <div class="video-caption">
                                                        <div class="video-title">{{ $video->title ?? 'Untitled Video' }}</div>
                                                        <div class="video-meta mt-1">Uploaded At: {{ date('F d',strtotime($video->created_at)) }}, {{ date('Y',strtotime($video->created_at)) }}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <p>No active videos found.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-container text-center py-3">
                                    <div class="title-line d-inline-block">
                                        <span class="line"></span>
                                        <span class="title-text text-white px-3" id="header-title-style">TAARIFA KWA UMMA</span>
                                        <span class="line"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                @if(isset($taarifa) && count($taarifa) >0)
                                    @foreach($taarifa as $row)
                                        @php($imageData = \App\Http\Controllers\v1\AdminController::getContentImage($row->id))
                                        <div class="card mb-3" id="habari-card-style">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <i class="fa fa-calendar-alt custom-icon"></i>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <div id="card-title-style"><strong><a href="{{route('more-details',['contentKey'=>$row->uuid])}}">{{$row->title}}</a></strong></div>
                                                        <div class="date">{{date('F d',strtotime($row->published_at))}}, {{date('Y',strtotime($row->published_at))}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="section-title-container mt-3 mb-3 text-center py-3">
                            <div class="title-line d-inline-block">
                                <span class="line"></span>
                                <span class="title-text text-white px-3" id="header-title-style">MATUKIO</span>
                                <span class="line"></span>
                            </div>
                        </div>
                        @if(isset($matukio) && count($matukio) >0)
                            @foreach($matukio as $row)
                                @php($imageData = \App\Http\Controllers\v1\AdminController::getContentImage($row->id))
                                <div class="card mb-3" id="habari-card-style">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <i class="fa fa-calendar-alt custom-icon"></i>
                                            </div>
                                            <div class="col-lg-10">
                                                <div id="card-title-style"><strong><a href="{{route('more-details',['contentKey'=>$row->uuid])}}">{{$row->title}}</a></strong></div>
                                                <div class="date">{{date('F d',strtotime($row->published_at))}}, {{date('Y',strtotime($row->published_at))}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
