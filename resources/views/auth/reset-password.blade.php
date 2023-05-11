@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div class="auth-wrapper auth-cover">
    <div class="auth-inner row m-0">
        <!-- Brand logo-->
        <x-authentication-card-logo />
        <!-- /Brand logo-->
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                <img class="img-fluid" src="{{asset('app-assets/images/pages/reset-password-v2.svg')}}" alt="Register V2" />
            </div>
        </div>
        <!-- /Left Text-->
        <!-- Reset password-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <h2 class="card-title fw-bold mb-1">{{__("Reset Password")}} 🔒</h2>
                <p class="card-text mb-2">
                    {{__('Your new password must be different from previously used passwords')}}
                </p>
                <form class="auth-reset-password-form mt-2" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="mb-1">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <input type="email" name="email" value="{{old('email',$request->email)}}" class="form-control" id="email" placeholder="john@example.com" aria-describedby="email" tabindex="1" required />
                        @error('email')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">{{ __('New Password') }}</label>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" name="password" class="form-control form-control-merge" id="password" placeholder="***********" aria-describedby="password" autofocus="" tabindex="1" autocomplete="new-password" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                        @error('password')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" name="password_confirmation" class="form-control form-control-merge" id="password_confirmation" placeholder="***********" aria-describedby="password_confirmation" tabindex="2" autocomplete="new-password" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" tabindex="3">{{ __('Reset Password') }}</button>
                </form>
                <p class="text-center mt-2">
                    <a href="{{route('login')}}">
                        <i data-feather="chevron-left"></i>
                        {{ __('Back to login') }}
                    </a>
                </p>
            </div>
        </div>
        <!-- /Reset password-->
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('app-assets/js/scripts/pages/auth-reset-password.js')}}"></script>
@endpush