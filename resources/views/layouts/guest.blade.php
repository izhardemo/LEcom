<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="semi-dark-layout" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        
        <!-- Title -->
        <title>@yield('title',config('app.name', 'Laravel'))</title>

        <!-- favicon icon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/logo/logo.png')}}" />
        <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet"> --}}

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
        <!-- END: Vendor CSS-->

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.min.css')}}">

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/semi-dark-layout.min.css')}}">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-validation.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/authentication.css')}}">
        @stack('style-link')
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
        <!-- END: Custom CSS-->

        <!-- Scripts -->
        @vite(['resources/js/app.js'])

        <!-- Styles -->
        @stack('css')
    </head>
    <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">

        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    @yield('content')
                    {{ $slot ?? ''}}
                </div>
            </div>
        </div>
        <!-- END: Content-->

        <!-- BEGIN: Vendor JS-->
        <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="{{asset('app-assets/js/core/app-menu.min.js')}}"></script>
        <script src="{{asset('app-assets/js/core/app.min.js')}}"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        @stack('script')
        <!-- END: Page JS-->

        <script>
        $(window).on('load', function() {
            if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
            }
        })
        </script>
        <!-- custom js -->
        @stack('js')
    </body>
</html>
