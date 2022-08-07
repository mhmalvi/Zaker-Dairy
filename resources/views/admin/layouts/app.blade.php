<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/icons/fav_zaker.ico')}}">
    {{-- Style Sheets --}}
    @include('admin.layouts.styles')

</head>

<body>
    <div class="app" id="app">
        <div class="layout">
            <!-- Header START -->
            @include('admin.layouts.header')
            <!-- Header END -->

            <!-- Side Nav START -->
            <div class="side-nav">
                @include('admin.layouts.sidebar')
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">


                <!-- Content Wrapper START -->
                <div class="main-content">
                    @yield('content')
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <footer class="footer">
                    @include('admin.layouts.footer')
                </footer>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->
        </div>
    </div>

    <script src="{{asset('js/app.js')}}" defer></script>
    @include('admin.layouts.scripts')
 

</body>

</html>

