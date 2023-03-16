@extends('auth.layouts.app')

@section('page_css')
<link href="{{ url('assets/custom/css/login.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_content')
<!-- BEGIN REGISTRATION FORM -->
<div class="register-form">
    <h3>Sign Up</h3>
    <p> Enter your account details below: </p>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <input id="reg-username" class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input id="reg-email" class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input id="reg-password" class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
        <div class="controls">
            <div class="input-icon">
                <i class="fa fa-check"></i>
                <input id="reg-rpassword" class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>
            <input type="checkbox" name="tnc" /> I agree to the
            <a href="javascript:;"> Terms of Service </a> and
            <a href="javascript:;"> Privacy Policy </a>
        </label>
        <div id="register_tnc_error"> </div>
    </div>
    <div class="form-actions">
        <a href="{{ url('login') }}" class="btn red btn-outline"> Back </a>
        <button type="submit" id="btn-register" class="btn green pull-right"> Sign Up </button>
    </div>
</div>
<!-- END REGISTRATION FORM -->
@endsection

@section('page_js')
<script src="{{ url('assets/custom/scripts/auth/register.js') }}" type="text/javascript"></script>
@endsection
