@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="auth-wrapper auth-cover">
    <div class="auth-inner row m-0">
        <!-- Brand logo-->
        <x-authentication-card-logo />
        <!-- /Brand logo-->
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                <img class="img-fluid" src="{{asset('app-assets/images/pages/register-v2.svg')}}" alt="Register V2" />
            </div>
        </div>
        <!-- /Left Text-->
        <!-- Register-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <h2 class="card-title fw-bold mb-1">{{__('Adventure starts here')}} 🚀</h2>
                <p class="card-text mb-2">{{__('Make your app management easy and fun!')}}</p>
                <form class="auth-register-form mt-2" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-1">
                        <label class="form-label" for="name">{{ __('Full Name') }}</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="johndoe" aria-describedby="name" autofocus autocomplete="name" tabindex="1" />
                        @error('name')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="john@example.com" aria-describedby="email" tabindex="2" />
                        @error('email')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" name="password" class="form-control form-control-merge" id="password" placeholder="***********" aria-describedby="password" tabindex="3" />
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
                            <input type="password" name="password_confirmation" class="form-control form-control-merge" id="password_confirmation" placeholder="***********" aria-describedby="password_confirmation" tabindex="4" autocomplete="new-password" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                        @error('password_confirmation')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-1">
                        <div class="form-check">
                            <input type="checkbox" name="terms" class="form-check-input" id="terms" tabindex="5" required />
                            <label class="form-check-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </label>
                        </div>
                        @error('terms')
                            <div class="error text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary w-100" tabindex="6">{{ __('Register') }}</button>
                </form>
                <p class="text-center mt-2">
                    <a href="{{ route('login') }}"><span>{{ __('Already registered?') }}</span></a>
                </p>
                <div class="divider my-2">
                    <div class="divider-text">{{ __('or') }}</div>
                </div>
                <div class="auth-footer-btn d-flex justify-content-center">
                    <a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a>
                    <a class="btn btn-google" href="#"><i data-feather="mail"></i></a>
                </div>
            </div>
        </div>
        <!-- /Register-->
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('app-assets/js/scripts/pages/auth-register.js')}}"></script>
@endpush