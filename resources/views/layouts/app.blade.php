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

    <script src="{{asset('scripts/sweetalert2@11.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @auth
        @include('layouts.sidebar')
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

    <script src="{{asset('scripts/adminkit.js')}}"></script>
    <script src="{{asset('scripts/pdfmake.min.js')}}"></script>
    <script src="{{asset('scripts/vfs_fonts.min.js')}}"></script>
    <script src="{{asset('scripts/datatables.min.js')}}"></script>
    <script src="{{asset('scripts/highcharts.js')}}"></script>
    <script src="{{asset('scripts/tinymce.min.js')}}"></script>








    

    @yield('scripts')

</body>

</html>