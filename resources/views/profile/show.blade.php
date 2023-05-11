@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<!-- breadcrumbs -->
<x-breadcrumbs :breadcrumbs="['Profile'=>route('profile.account.show'), ucwords(last(explode('/',request()->url())))]" />

<div class="row">
    <div class="col-12">
        <ul class="nav nav-pills mb-2">
            <!-- account -->
            @if (Laravel\Fortify\Features::canUpdateProfileInformation() || Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('profile.account.show') ? 'active' : ''}}" href="{{route('profile.account.show')}}">
                    <i data-feather="user" class="font-medium-3 me-50"></i>
                    <span class="fw-bold">Account</span>
                </a>
            </li>
            @endif

            <!-- security -->
            <li class="nav-item">
                <a class="nav-link {{request()->routeIs('profile.security.show') ? 'active' : ''}}" href="{{route('profile.security.show')}}">
                    <i data-feather="lock" class="font-medium-3 me-50"></i>
                    <span class="fw-bold">Security</span>
                </a>
            </li>
        </ul>

        @if (request()->routeIs('profile.account.show'))
            <!-- profile -->
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.account.update-profile-information')
            @endif

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                @livewire('profile.account.delete-user')
            @endif
            <!--/ profile -->
        @endif

        @if (request()->routeIs('profile.security.show'))
            <!-- security -->
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                @livewire('profile.security.update-password')
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                @livewire('profile.security.two-factor-authentication')
            @endif

            @livewire('profile.security.browser-sessions')
            <!--/ security -->
        @endif
    </div>
</div>
@endsection