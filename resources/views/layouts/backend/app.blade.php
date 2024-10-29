<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Admin Dashboard - @yield('title')</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    {{-- <link href="{{ asset('assets/backend/css/font-awesome.css') }}" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('assets/backend/css/main.css') }}" rel="stylesheet">

    @stack('css')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

        @include('layouts.backend.partials.header')

        <div class="app-main">

            @include('layouts.backend.partials.sidebar')

            <div class="app-main__outer">

                <div class="app-main__inner">
                    @yield('content')
                </div>

                @include('layouts.backend.partials.footer')

            </div>
            <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('assets/backend/scripts/main.js') }}"></script>

    @stack('js')

</body>

</html>
