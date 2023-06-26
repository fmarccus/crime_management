<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui@5.0.15/material-ui.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- @vite(['resources/js/app.js']) -->
    <link href="https://cdn.datatables.net/v/ju/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @auth
        @if(auth()->user()->email_verified_at!=null)
        @include('layouts.sidebar')
        @endif
        @endauth
        <div class="main">
            <!-- Top Navigation Bar -->
            @include('layouts.top-navigation')


            <main class="content py-4">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @include('layouts.footer')
        </div>
    </div>

    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/v/ju/dt-1.13.4/datatables.min.js"></script>
    @yield('scripts')

</body>

</html>