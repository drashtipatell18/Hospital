@extends('layouts.app')

@section('content')
<div class="main-wrapper account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form action="{{ route('login')}}" class="form-signin">
                    <div class="account-logo">
                        <a href=""><img src="{{ asset('assets/img/logo-dark.png')}}" alt=""></a>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" autofocus="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="form-group text-right">
                        <a href="forgot-password.html">Forgot your password?</a>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary account-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
