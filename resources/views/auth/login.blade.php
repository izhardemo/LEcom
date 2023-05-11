@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="auth-wrapper auth-cover">
    <div class="auth-inner row m-0">
        <!-- Brand logo-->
        <x-authentication-card-logo />
        <!-- /Brand logo-->
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                <img class="img-fluid" src="{{asset('app-assets/images/pages/login-v2.svg')}}" alt="Login V2" />
            </div>
        </div>
        <!-- /Left Text-->
        <!-- Login-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <h2 class="card-title fw-bold mb-1">
                    {{ __('Welcome to') . ' ' . config('app.name', 'Laravel')}}! 👋
                </h2>
                <p class="card-text mb-2">{{__('Please sign-in to your account and start the adventure')}}</p>
                @if (session('status'))
                    <div class="mb-1 fw-bold text-sm text-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-1">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="john@example.com" aria-describedby="email" tabindex="1" required autofocus />
                        @error('email')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <small>{{ __('Forgot your password?') }}</small>
                            </a>
                            @endif
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" name="password" class="form-control form-control-merge" id="password" placeholder="***********" aria-describedby="password" tabindex="2" />
                            <span class="input-group-text cursor-pointer">
                                <i data-feather="eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <div class="form-check">
                            <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                            <label class="form-check-label" for="remember-me">{{ __('Remember me') }}</label>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100" tabindex="4">{{ __('Log in') }}</button>
                </form>
                <p class="text-center mt-2">
                    <span>{{ __('New on our platform?') }}</span>
                    <a href="{{route('register')}}">
                        <span>&nbsp;{{ __('Create an account') }}</span>
                    </a>
                </p>
                <div class="divider my-2">
                    <div class="divider-text">or</div>
                </div>
                <div class="auth-footer-btn d-flex justify-content-center">
                    <a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a>
                    <a class="btn btn-google" href="#"><i data-feather="mail"></i></a>
                </div>
            </div>
        </div>
        <!-- /Login-->
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('app-assets/js/scripts/pages/auth-login.js')}}"></script>
@endpush