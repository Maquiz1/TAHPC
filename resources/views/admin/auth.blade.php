@extends('layouts.login-layout')
@section('main-content')
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{asset('storage/images/council-logo.svg')}}" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form id="login-form" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" required="required" autocomplete="off" name="email" id="username" class="form-control input_user" value="" placeholder="username">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" required="required" autocomplete="off" name="password" id="password" class="form-control input_pass" value="" placeholder="password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button type="submit" name="button" id="login-btn" class="btn btn-info btn-md login_btn login-btn float-lg-right">Login</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="#">Forgot password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
