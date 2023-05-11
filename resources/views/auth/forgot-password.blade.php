@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="auth-wrapper auth-cover">
    <div class="auth-inner row m-0">
        <!-- Brand logo-->
        <x-authentication-card-logo />
        <!-- /Brand logo-->
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                <img class="img-fluid" src="{{asset('app-assets/images/pages/forgot-password-v2.svg')}}" alt="Forgot password V2" />
            </div>
        </div>
        <!-- /Left Text-->
        <!-- Forgot password-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <h2 class="card-title fw-bold mb-1">{{__('Forgot Password?')}} 🔒</h2>
                <p class="card-text mb-2">
                    {{__('Enter your email and we\'ll send you instructions to reset your password')}}
                </p>
                @if (session('status'))
                    <div class="mb-1 fw-bold text-sm text-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="auth-forgot-password-form mt-2" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-1">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="john@example.com" aria-describedby="email" autofocus="" tabindex="1" />
                        @error('email')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100" tabindex="2">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </form>
                <p class="text-center mt-2">
                    <a href="{{route('login')}}">
                        <i data-feather="chevron-left"></i>
                        {{ __('Back to login') }}
                    </a>
                </p>
            </div>
        </div>
        <!-- /Forgot password-->
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('app-assets/js/scripts/pages/auth-forgot-password.js')}}"></script>
@endpush