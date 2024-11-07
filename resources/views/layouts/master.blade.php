<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href={{url(asset('layout/css/bootstrap.min.css'))}}>
    <link rel="stylesheet" href={{url(asset('layout/css/custom.css'))}}>
    <script src={{url(asset('layout/js/bootstrap.bundle.min.js'))}} ></script>
    <script src={{url(asset('layout/js/jquery.js'))}} ></script>
    <link href={{url(asset('icon/css/fontawesome.css'))}} rel="stylesheet" />
    <link href={{url(asset('icon/css/brands.css'))}} rel="stylesheet" />
    <link href={{url(asset('icon/css/solid.css'))}} rel="stylesheet" />
</head>
<body class="m-0">

    @yield('aplayout')

    @yield('urlayout')

    @yield('auth')

    @yield('script')




</body>
</html>
