<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> @yield('title') | Larastarter</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- Font-Awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Select2 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Dropify CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS-->
    <link href="{{ asset('assets/backend/css/main.css') }}" rel="stylesheet">

    <!-- IziToast CSS-->
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

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
        </div>
    </div>

    <!-- Jquery CDN-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Sweetalert2 CDN-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Select2 CDN-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Dropify CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- IziToast Js-->
    <script src="{{ asset('js/iziToast.js') }}"></script>

    <!-- Main Js-->
    <script src="{{ asset('assets/backend/scripts/main.js') }}"></script>

    <!-- Common Js-->
    <script src="{{ asset('assets/backend/scripts/common.js') }}"></script>

    <!-- IziToast -->
    @include('vendor.lara-izitoast.toast')

    @stack('js')

</body>

</html>
