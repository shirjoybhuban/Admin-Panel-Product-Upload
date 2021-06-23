@extends('frontend.layouts.master')
@section('title', 'Login')
@section('content')
    <div class="ps-page--my-account">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Login</li>
                </ul>
            </div>
        </div>
        <div class="ps-my-account" >
            <div class="container">
                <form class="ps-form--account ps-tab-root" action="{{ route('login') }}" method="POST" style="padding: 0px;">
                    @csrf
                    <ul class="ps-tab-list">
                        <li class="active"><a href="#sign-in">Login</a></li>
                    </ul>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="sign-in">
                            <div class="ps-form__content">
                                <h5>Log In Your Account</h5>
                                <div class="form-group">
                                    <input id="phone" type="text" placeholder="Enter your Phone Number"  class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-forgot">
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <a href="{{route('reset.password')}}">Forgot?</a>
                                </div>
                                <div class="form-group">
                                    <div class="ps-checkbox">
                                        <input class="form-control" type="checkbox" id="remember-me" name="remember-me">
                                        <label for="remember-me">Rememeber me</label>
                                    </div>
                                </div>
                                <div class="form-group submtit" style="padding-bottom: 40px;">
                                    <button class="ps-btn ps-btn--fullwidth">Login</button>
                                </div>
                                <div class="" style="margin-top: -50px; padding-bottom: 30px;">
                                    <p class="text-center">Need an account? <span style="color: green;"> <a href="{{route('register')}}">Register Now </a> </span></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

