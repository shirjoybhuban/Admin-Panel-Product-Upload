@extends('frontend.layouts.master')
@section('title', 'Reset Password')
@section('content')
    <div class="ps-page--my-account">
{{--        <div class="ps-breadcrumb">--}}
{{--            <div class="container">--}}
{{--                <ul class="breadcrumb">--}}
{{--                    <li><a href="{{url('/')}}">Home</a></li>--}}
{{--                    <li>Reset Password</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="ps-my-account" style="padding-top: 50px;">
            <div class="container">
                <form class="ps-form--account ps-tab-root" action="{{ route('phone.check') }}" method="POST" style="padding: 0px;">
                    @csrf
                    <ul class="ps-tab-list">
                        <li class="active" style="padding-bottom: 10px;"><a href="#sign-in">Reset Password</a></li>
                    </ul>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="sign-in">
                            <div class="ps-form__content">
                                <h5>Enter your phone number to recover your password.</h5>
                                <div class="form-group">
                                    <input id="phone" type="text" placeholder="Enter your Valid Phone Number" name="phone" minlength="11" class="form-control" required autocomplete="phone" autofocus>
                                </div>
                                <div class="form-group submtit" style="padding-bottom: 40px;">
                                    <button class="ps-btn ps-btn--fullwidth">Send</button>
                                </div>
                                <div class="form-group" style="margin-top: -50px; padding-bottom: 30px">
                                    <a href="{{route('login')}}">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

