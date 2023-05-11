@extends('layouts.guest')

@section('title', 'Two Step Verification')

@section('content')
<div class="auth-wrapper auth-cover">
    <div class="auth-inner row m-0">
        <!-- Brand logo-->
        <x-authentication-card-logo />
        <!-- /Brand logo-->
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                <img class="img-fluid" src="{{asset("app-assets/images/illustration/two-steps-verification-illustration.svg")}}" alt="two steps verification" />
            </div>
        </div>
        <!-- /Left Text-->
        <!-- two steps verification v2-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto" x-data="{ recovery: false }">
                <h2 class="card-title fw-bolder mb-1">{{__("Two Step Verification")}} &#x1F4AC;</h2>
                <p class="card-text mb-75" x-show="! recovery">
                    {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                </p>
                <p class="card-text mb-75" x-show="recovery">
                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                </p>
                <form class="mt-2 auth-input-wrapper" action="{{ route('two-factor.login') }}" method="POST">
                    @csrf
                    <div class="mb-1" x-show="! recovery">
                        <label for="code">{{ __('Code') }}</label>
                        <input type="text" name="code" id="code" class="form-control numeral-mask" autofocus x-ref="code" autocomplete="one-time-code" />
                        @error('code')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-1" x-show="recovery">
                        <label for="recovery_code">{{ __('Recovery Code') }}</label>
                        <input type="text" name="recovery_code" id="recovery_code" class="form-control numeral-mask" autofocus x-ref="recovery_code" autocomplete="one-time-code" />
                        @error('recovery_code')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="text-end mb-1" style="text-align: right">
                        <a href="javascript:void(0);" x-show="! recovery" x-on:click=" recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                            <span>{{ __('Use a recovery code') }}</span>
                        </a>
    
                        <a href="javascript:void(0);" x-show="recovery" x-on:click=" recovery = false; $nextTick(() => { $refs.code.focus() })">
                            <span>{{ __('Use an authentication code') }}</span>
                        </a>
                    </div>

                    <button type="submit" class="btn btn-primary mb-1 w-100" tabindex="4">
                        {{ __('Verify my account') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection