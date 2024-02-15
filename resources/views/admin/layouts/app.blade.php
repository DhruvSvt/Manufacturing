<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from demo.tailadmin.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 07:16:30 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Welcome' }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <!-- Custom Css  -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <!-- Font Awwsome icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Tailwind play cdn -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Toggle Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Sweet Alert CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Include lodash from CDN -->
    <script src="https://cdn.jsdelivr.net/lodash/4.17.21/lodash.min.js"></script>
    <style>
        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: none !important;
            background-image: none;
        }
    </style>


</head>

<body
    x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded"
        x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent">
        </div>
    </div>
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">

        <!-- ===== Sidebar Start ===== -->
        @php
        $sidebar = $sidebar ?? true;
        @endphp
        @if($sidebar)
        @include('admin.inc.sidebar')
        @endif
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">

            <!-- ===== Header Start ===== -->
            @php
            $header = $header ?? true;
            @endphp
            @if($header)
            @include('admin.inc.header')
            @endif
            <!-- ===== Header End ===== -->

            @yield('content')
        </div>
        <!-- ===== Content Area End ===== -->

    </div>
    <!-- ===== Page Wrapper End ===== -->

    <!-- ===== Page Footer ===== -->
    @include('admin.inc.footer')
    <!-- ===== Page Footer ===== -->

    @yield('scripts')
</body>

</html>