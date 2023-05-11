@extends('layouts.guest')

@section('title', 'Verify Email')

@section('content')
<div class="auth-wrapper auth-cover">
    <div class="auth-inner row m-0">
        <!-- Brand logo-->
        <x-authentication-card-logo />
        <!-- /Brand logo-->
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                <img class="img-fluid" src="{{asset('app-assets/images/illustration/verify-email-illustration.svg')}}" alt="two steps verification" />
            </div>
        </div>
        <!-- /Left Text-->
        <!-- verify email v2-->
        <div class="d-flex flex-column col-lg-4 auth-bg px-2 p-lg-2">
            <div class="ms-auto" style="z-index: 2">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="dropdown me-2">
                    <img class="rounded-circle dropdown-toggle cursor-pointer" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" data-bs-toggle="dropdown" aria-expanded="false" width="50" />
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('user.profile.view') }}" class="dropdown-item text-sm text-secondary" >
                                {{ __('Edit Profile') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item text-sm text-secondary" onclick="document.getElementById('logout').submit();" >
                                {{ __('Logout') }}
                            </a>
                            <form id="logout" method="POST" action="{{ route('logout') }}" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="dropdown">
                    <button type="button" class="btn btn-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('user.profile.view') }}" class="dropdown-item text-sm text-secondary" >
                                {{ __('Edit Profile') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item text-sm text-secondary" onclick="document.getElementById('logout').submit();" >
                                {{ __('Logout') }}
                            </a>
                            <form id="logout" method="POST" action="{{ route('logout') }}" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
            </div>
            <div class="d-flex my-auto">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-1 fw-bold text-sm text-success">
                            {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                        </div>
                    @endif
                    <h2 class="card-title fw-bolder mb-1">{{ __('Verify your email') }} &#x2709;&#xFE0F;</h2>
                    <p class="card-text mb-2">
                        {{ __('Account activation link sent to your email address:') }}
                        <span class="fw-bolder">{{Auth::user()->email}}</span>
                        {{__('Please follow the link inside to continue.')}}
                    </p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- verify email-->
    </div>
</div>
@endsection