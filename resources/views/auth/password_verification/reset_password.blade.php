@extends('frontend.layouts.master')
@section('title', 'Reset Password')
@section('content')
    <div class="ps-page--my-account" >
        <div class="ps-my-account" >
            <div class="container">
                <form class="ps-form--account ps-tab-root" action="{{ route('reset.password.update',$user->id) }}" method="POST" style="padding-top: 60px;">
                    @csrf
                    <ul class="ps-tab-list">
                        <li class="active"><a href="#sign-in">Reset Password</a></li>
                    </ul>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="sign-in">
                            <div class="ps-form__content">
                                <h5>Enter your new password to change it.</h5>
                                <div class="form-group form-forgot">
                                    <input id="password" type="password" placeholder="New Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group submtit" style="padding-bottom: 40px;">
                                    <button class="ps-btn ps-btn--fullwidth">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

