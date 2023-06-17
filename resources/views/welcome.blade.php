<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    @vite('public/assets/css/main.css')
    @vite('public/assets/plugins/custom/datatables/datatables.bundle.css')
    @vite('public/assets/css/style.bundle.css')
    @vite('public/assets/plugins/global/plugins.bundle.css')
</head>

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed bg-body"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

    <div id="app"></div>

    <script>
        (function() {
            @if (Auth::check())
                window.authUser = {!! authUser() !!}
            @else
                window.authUser = false
            @endif
        })();

        var baseUrl = "{{ url('/') }}/";
    </script>

    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    @vite('resources/js/app.js')
</body>

</html>
