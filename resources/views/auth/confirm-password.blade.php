@extends('layouts.guest')

@section('title', 'Confirm Password')

@section('content')
<div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
        <!-- Confirm Password basic -->
        <div class="card mb-0">
            <div class="card-body">
                <x-authentication-card-logo />

                <h4 class="card-title mb-1">{{__('Confirm Password')}} 🔒</h4>
                <p class="card-text mb-2">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>

                <form class="auth-confirm-password-form mt-2" action="{{ route('password.confirm') }}" method="POST">
                    @csrf
                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" name="password" class="form-control form-control-merge" id="password" placeholder="***********" aria-describedby="password" tabindex="1" required autocomplete="current-password" autofocus />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                        @error('password')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100" tabindex="2">{{ __('Confirm') }}</button>
                </form>
            </div>
        </div>
        <!-- /Confirm Password basic -->
    </div>
</div>
@endsection