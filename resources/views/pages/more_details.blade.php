@extends('layouts.website-layout')
@section('main-content')

   <div class="container" id="more-details">
       @if(isset($content) && count($content) >0)
           @php($resultsDocuments = \App\Http\Controllers\v1\AdminController::getContentMultipleDocuments($content[0]->id))
           @if($content[0]->category == 'habari')
               <div class="row mt-5">
                   <div class="col-lg-5 mb-5">
                       @if(isset($resultsDocuments) && count($resultsDocuments) >0)
                           @foreach($resultsDocuments as $row)
                               @if($row->document_type == 'image')
                                   <img src="{{asset('storage/'.$row->document_path)}}" alt="content-image" id="more-details-image">
                               @elseif($row->document_type == 'document')
                               @else
                               @endif
                           @endforeach
                       @endif
                   </div>
                   <div class="col-lg-7">
                       <h4>{{$content[0]->title}}</h4>
                       <p class="small">Published At: {{date('F d',strtotime($content[0]->created_at))}}, {{date('Y',strtotime($content[0]->created_at))}}</p>
                       <hr>
                       <p id="paragraph-content">{{$content[0]->body}}</p>
                   </div>
               </div>
           @elseif($content[0]->category == 'taarifa')
               <div class="row mt-5" >
                   <div class="col-lg-12">
                       <h4>{{$content[0]->title}}</h4>
                       <p id="paragraph-content">
                           {{$content[0]->body}}
                       </p>

                       @if(isset($resultsDocuments) && count($resultsDocuments) >0)
                           @foreach($resultsDocuments as $row)
                               <p style="white-space: nowrap;">{{$content[0]->title}}</p> <a href="{{asset('storage/'.$row->document_path)}}" download>Download PDF</a>
                               <br><br>
                               @if($row->document_type == 'image')
                                   <img src="{{asset('storage/'.$row->document_path)}}" alt="content-image" id="more-details-image">
                               @elseif($row->document_type == 'document')
                                   <iframe src="{{asset('storage/'.$row->document_path)}}" width="100%" height="750px">
                                       This browser does not support PDFs. Please download the PDF to view it:
                                       <a href="{{asset('storage/'.$row->document_path)}}" download>Download PDF</a>.
                                   </iframe>
                               @else
                               @endif
                           @endforeach
                       @endif
                   </div>
               </div>
           @else
               <div class="row mt-5" >
                   <div class="col-lg-12">
                       <h4>{{$content[0]->title}}</h4>
                       <p id="paragraph-content">
                           {{$content[0]->body}}
                       </p>

                       @if(isset($resultsDocuments) && count($resultsDocuments) >0)
                           @foreach($resultsDocuments as $row)
                               <p style="white-space: nowrap;">{{$content[0]->title}}</p> <a href="{{asset('storage/'.$row->document_path)}}" download>Download PDF</a>
                               <br><br>
                               @if($row->document_type == 'image')
                                   <img src="{{asset('storage/'.$row->document_path)}}" alt="content-image" id="more-details-image">
                               @elseif($row->document_type == 'document')
                                   <iframe src="{{asset('storage/'.$row->document_path)}}" width="100%" height="750px">
                                       This browser does not support PDFs. Please download the PDF to view it:
                                       <a href="{{asset('storage/'.$row->document_path)}}" download>Download PDF</a>.
                                   </iframe>
                               @else
                               @endif
                           @endforeach
                       @endif
                   </div>
               </div>
           @endif
       @endif
   </div>
@endsection

