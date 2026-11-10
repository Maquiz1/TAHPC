@extends('layouts.admin-layout')
@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="row" style="padding: 5px;">
                    <div class="col-lg-9">
                        <h5>USERS</h5>
                        <small>Admins can manage users and post content. Editors can only post content.</small>
                    </div>
                    <div class="col-lg-3">
                        <button type="button" class="btn btn-sm btn-info float-lg-end" data-toggle="modal" data-target="#add-user-modal">NEW USER <i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="display-users-details"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add user modal -->
    <div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="add-user-modal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: left;">ADD USER</h5>
                </div>
                <div class="modal-body">
                    <form action="#" id="add-user-form" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group row mb-4">
                            <div class="col-lg-4">
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control shadow-sm" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="middle_name">Middle name</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control shadow-sm">
                            </div>
                            <div class="col-lg-4">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control shadow-sm" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-lg-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control shadow-sm" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="user-phone">Phone number</label>
                                <input type="text" name="phone" id="user-phone" placeholder="07...." pattern="[0-9]{10}" title="Only ten numbers required." class="form-control shadow-sm">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-lg-6">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="editor">Editor (post content only)</option>
                                    <option value="admin">Admin (post content + manage users)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-lg-6">
                                <label for="password">Temporary password</label>
                                <input type="password" name="password" id="password" minlength="8" autocomplete="new-password" class="form-control shadow-sm" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="password_confirmation">Confirm password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" minlength="8" autocomplete="new-password" class="form-control shadow-sm" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-info btn-md float-lg-end user-submission-btn">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset password modal -->
    <div class="modal fade" id="reset-password-modal" tabindex="-1" role="dialog" aria-labelledby="reset-password-modal" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: left;">RESET PASSWORD</h5>
                    <small id="reset-password-email"></small>
                </div>
                <div class="modal-body">
                    <form action="#" id="reset-password-form" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="uuid" id="reset-password-uuid">
                        <div class="form-group row mb-4">
                            <div class="col-lg-12">
                                <label for="reset-password">New password</label>
                                <input type="password" name="password" id="reset-password" minlength="8" autocomplete="new-password" class="form-control shadow-sm" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-lg-12">
                                <label for="reset-password-confirmation">Confirm password</label>
                                <input type="password" name="password_confirmation" id="reset-password-confirmation" minlength="8" autocomplete="new-password" class="form-control shadow-sm" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-info btn-md float-lg-end user-submission-btn">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    usersCallBack();
});

function usersCallBack() {
    displayHtmlData("{{ route('users-callback') }}", '', 'display-users-details');
}

// Sends a user form or action and refreshes the table on success.
function submitUserRequest(route, data, onSuccess) {
    $.ajax({
        url: route,
        type: 'POST',
        data: data,
        processData: !(data instanceof FormData),
        contentType: data instanceof FormData ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
        beforeSend: function () {
            $('.user-submission-btn').attr('disabled', true).html('Processing...');
        },
        success: function (response) {
            $('.user-submission-btn').attr('disabled', false).html('SUBMIT');
            const results = JSON.parse(response);
            notificationCallBack(response, results);
            if (results.success) {
                if (onSuccess) onSuccess();
                usersCallBack();
            }
        },
        error: function (xhr) {
            $('.user-submission-btn').attr('disabled', false).html('SUBMIT');
            try {
                const results = JSON.parse(xhr.responseText);
                notificationCallBack(JSON.stringify({error: results.error || results.message}), {error: results.error || results.message});
            } catch (e) {
                console.error('Error parsing JSON response:', e);
            }
        }
    });
}

$('#add-user-form').on('submit', function (e) {
    e.preventDefault();
    submitUserRequest("{{ route('users-store') }}", new FormData(this), function () {
        $('#add-user-modal').modal('hide');
        $('#add-user-form').trigger('reset');
    });
});

$('#reset-password-form').on('submit', function (e) {
    e.preventDefault();
    submitUserRequest("{{ route('users-reset-password') }}", new FormData(this), function () {
        $('#reset-password-modal').modal('hide');
        $('#reset-password-form').trigger('reset');
    });
});

function userAction(button, action) {
    const routes = {
        status: "{{ route('users-toggle-status') }}",
        role: "{{ route('users-toggle-role') }}"
    };
    if (!confirm('Are you sure you want to ' + $(button).data('confirm') + '?')) {
        return;
    }
    submitUserRequest(routes[action], {"_token": "{{ csrf_token() }}", "uuid": $(button).data('uuid')});
}

function openResetPassword(button) {
    $('#reset-password-form').trigger('reset');
    $('#reset-password-uuid').val($(button).data('uuid'));
    $('#reset-password-email').text($(button).data('email'));
    $('#reset-password-modal').modal('show');
}
</script>
@endpush
