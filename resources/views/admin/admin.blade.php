@extends('layouts.admin-layout')
@section('main-content')
   <div class="row">
       <div class="col-lg-6">
           <div class="card">
               <div class="card-header">
                   <div class="card-title">
                       <div class="row" style="padding: 5px;">
                           <div class="col-lg-9">
                               TOP NAVBAR SETUP SECTION
                           </div>
                           <div class="col-lg-3">
                               <button type="button" class="btn btn-sm btn-info float-lg-end" data-toggle="modal" data-target="#top-navbar-modal">NEW DETAILS <i class="fa fa-plus"></i></button>
                           </div>
                       </div>

                   </div>
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-striped table-md" width="100%">
                           <thead>
                               <tr>
                                   <th style="white-space: nowrap;">#</th>
                                   <th style="white-space: nowrap;">POSITION</th>
                                   <th style="white-space: nowrap;">VALUE</th>
                                   <th style="white-space: nowrap;">STATUS</th>
                                   <th style="white-space: nowrap;">CREATED AT</th>
                                   <th style="white-space: nowrap;">CREATED BY</th>
                                   <th style="white-space: nowrap;">ACTION</th>
                               </tr>
                           </thead>
                           <tbody id="display-top-navbar-details"></tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-lg-6">
           <div class="card">
               <div class="card-header">
                   <div class="card-title">
                       <div class="row" style="padding: 5px;">
                           <div class="col-lg-9">
                              SLIDER SETUP SECTION
                           </div>
                           <div class="col-lg-3">
                               <button type="button" class="btn btn-sm btn-info float-lg-end" data-toggle="modal" data-target="#slider-section-modal">NEW DETAILS <i class="fa fa-plus"></i></button>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-striped table-md" width="100%">
                           <thead>
                               <tr>
                                   <th style="white-space: nowrap;">#</th>
                                   <th style="white-space: nowrap;">POSITION</th>
                                   <th style="white-space: nowrap;">VALUE</th>
                                   <th style="white-space: nowrap;">TITLE</th>
                                   <th style="white-space: nowrap;">NAME</th>
                                   <th style="white-space: nowrap;">STATUS</th>
                                   <th style="white-space: nowrap;">CREATED AT</th>
                                   <th style="white-space: nowrap;">CREATED BY</th>
                                   <th style="white-space: nowrap;">ACTION</th>
                               </tr>
                           </thead>
                           <tbody id="display-slider-section-details"></tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <div class="row" style="padding: 5px;">
                        <div class="col-lg-5">
                            CONTENT SETUP SECTION
                        </div>
                        <div class="col-lg-7">
                            <div class="button-group float-lg-end">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#pages-content-section-modal">PAGES CONTENT <i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#content-section-modal">NEW DETAILS <i class="fa fa-plus"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-borderless" width="100">
                            <thead>
                                <tr>
                                    <th style="white-space: nowrap">#</th>
                                    <th style="white-space: nowrap">MEDIA</th>
                                    <th style="white-space: nowrap">CATEGORY</th>
                                    <th style="white-space: nowrap">TITLE</th>
                                    <th style="white-space: nowrap">DESCRIPTION</th>
                                    <th style="white-space: nowrap">BODY</th>
                                    <th style="white-space: nowrap">PUBLISHED AT</th>
                                    <th style="white-space: nowrap">PUBLISHED BY</th>
                                    <th style="white-space: nowrap">STATUS</th>
                                    <th style="white-space: nowrap">ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="display-content-section-data"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


