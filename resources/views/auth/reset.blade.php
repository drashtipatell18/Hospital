@extends('layouts.app')
@section('content')
<div class="main-wrapper account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form id="resetPasswordForm" method="POST" action="{{ route('post_reset', ['token' => $token]) }}" class="login">
                    @csrf
                    <div class="account-logo">
                        <a href="index-2.html"><img src="{{ asset('assets/img/logo-dark.png')}}" alt=""></a>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="new_password" autofocus>
                        <span class="text-danger" id="new_passwordError"></span>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                        <span class="text-danger" id="confirm_passwordError"></span>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                    </div>
                    <div class="text-center register-link">
                        <a href="{{ route('login') }}">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $("#resetPasswordForm").validate({
        rules: {
            new_password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                equalTo: "[name='new_password']"
            }
        },
        messages: {
            new_password: {
                required: "Please enter a new password",
                minlength: "Password must be at least 6 characters long"
            },
            confirm_password: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
@endpush
