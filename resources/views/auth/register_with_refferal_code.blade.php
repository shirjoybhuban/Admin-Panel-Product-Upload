@extends('frontend.layouts.master')
@section('title', 'Register')
@push('css')
    <style>
        .form_height{
            height: 40px;
        }
        .form_padding {
            margin-bottom: 10px;
        }
    </style>
@endpush
@section('content')
    <div class="ps-page--my-account">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Register</li>
                </ul>
            </div>
        </div>
        <div class="ps-my-account">
            <div class="container" style="padding: 0 50px">

                <form class="ps-form--account ps-tab-root" action="{{ route('user.register') }}" method="POST" style="padding: 0px;">
                    @csrf
                    <ul class="ps-tab-list">
                        <li class="active"><a href="#register">Register</a></li>
                    </ul>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="register">
                            <div class="ps-form__content">
                                <h5>Register An Account</h5>
                                <div class="form-group form_padding">
                                    <label>Your Full Name</label>
                                    <input class="form-control form_height" type="text" name="name" placeholder="Username">
                                </div>
                                <div class="form-group form_padding">
                                    <label>Your Email</label>
                                    <input class="form-control form_height" type="email" name="email" placeholder="Email address">
                                </div>
                                <div class="form-group form_padding">
                                    <label>Your Phone Number</label>
                                    <input class="form-control form_height" type="number" name="phone" placeholder="Phone Number">
                                </div>
                                <div class="form-group form_padding">
                                    <label>Password</label>
                                    <input class="form-control form_height" type="password" minlength="6" name="password" placeholder="Password">
                                </div>
                                <div class="form-group form_padding">
                                    <label>Referral Code <span class="small" style="color: green;">(Enter your friend's referral code)</span></label>
                                    <input class="form-control form_height" type="number" name="referred_by" value="{{$refferal_by->referral_code}}" readonly>
                                    <input type="hidden" name="refferal_by" value="{{$refferal_by->id}}">
                                </div>
                                <div class="form-group submtit" style="padding-bottom: 40px;">
                                    <button class="ps-btn ps-btn--fullwidth">Register</button>
                                </div>
                                <div class="" style="margin-top: -50px; padding-bottom: 30px;">
                                    <p class="text-center">Already have an account? <span style="color: green;"> <a href="{{route('login')}}">Log In </a> </span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
