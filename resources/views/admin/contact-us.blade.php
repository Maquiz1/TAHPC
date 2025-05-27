@extends('layouts.admin-layout')
@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h5>Message From User</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-hover" width="100%">
                   <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Read Status</th>
                            <th>Created At</th>
                            <th>Attended By</th>
                            <th>Attended At</th>
                            <th>Action</th>
                        </tr>
                   </thead>
                   <tbody id="display-contact-us-details"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
