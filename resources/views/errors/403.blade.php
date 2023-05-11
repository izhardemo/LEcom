@extends('layouts.guest')

@section('title', 'Not Authorized')

@section('content')
    <!-- Not authorized-->
    <div class="misc-wrapper">
        <!-- Brand logo-->
        <x-authentication-card-logo />
        <!-- /Brand logo-->
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">You are not authorized! 🔐</h2>
                <p class="mb-2">
                    The Webtrends Marketing Lab website in IIS uses the default IUSR account credentials to access the web pages it
                    serves.
                </p>
                <a class="btn btn-primary mb-1 btn-sm-block" href="{{route('login')}}">Back to login</a>
                <img class="img-fluid" src="{{asset('app-assets/images/pages/not-authorized.svg')}}" alt="Not authorized page" />
            </div>
        </div>
    </div>
@endsection

@push('style-link')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-misc.css') }}">
@endpush