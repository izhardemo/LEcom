<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Title -->
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/logo/logo.png')}}" />
    <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">

    <!-- Styles -->
    @include('layouts.user.include.style-links')
    @stack('style-link')
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- custom css -->
    @stack('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    @include('layouts.user.include.navigation')
    @include('layouts.user.include.sidebar')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row"></div>
            <div class="content-body">
                @yield('content')
                {{ $slot ?? '' }}
            </div>
        </div>
    </div>
    <!-- END: Content-->
    @include('layouts.user.include.footer')

    <!-- Scripts -->
    @include('layouts.user.include.script')
    @livewireScripts
    @stack('script')
    @stack('modals')


    <script>
        var isRtl = $('html').attr('data-textdirection') === 'rtl';
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
            
            // Notification
            @if (session()->has('loginSuccess'))
                toastr_success_noti('{{session()->get("loginSuccess")}}','👋 Welcome {{ucwords(Auth::user()->name)}}!');
            @endif
            @if (session()->has('success'))
                toastr_success_noti('{{session()->get("success")}}');
            @endif
            @if (session()->has('error'))
                toastr_error_noti('{{session()->get("error")}}');
            @endif
            @if (session()->has('info'))
                toastr_info_noti('{{session()->get("info")}}');
            @endif
            @if (session()->has('warning'))
                toastr_warning_noti('{{session()->get("warning")}}');
            @endif
        });
    </script>
    @stack('js')
</body>
<!-- END: Body-->
</html>
