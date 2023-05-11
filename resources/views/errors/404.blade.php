@extends('layouts.guest')

@section('title', 'Page Not Found')

@section('content')
    <!-- Error page-->
    <div class="misc-wrapper">
        <!-- Brand logo-->
        <x-authentication-card-logo />
        <!-- /Brand logo-->
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">Page Not Found 🕵🏻‍♀️</h2>
                <p class="mb-2">Oops! 😖 The requested URL was not found on this server.</p><a class="btn btn-primary mb-2 btn-sm-block" href="{{request()->user() ? (request()->user()->hasRole('user') ? route('user.dashboard') : route('admin.dashboard')) : route('login')}}">Back to home</a><img class="img-fluid" src="{{asset('app-assets/images/pages/error.svg')}}" alt="Error page" />
            </div>
        </div>
        <!-- / Error page-->
    </div>
@endsection

@push('style-link')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-misc.css') }}">
@endpush
    