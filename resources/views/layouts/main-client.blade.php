<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    @yield('css')
    @include('assets.client.asset-css')
</head>

<body>
    @include('__share.client.header')

    @yield('content')

    @include('__share.client.footer')

    @include('assets.client.asset-js')

</body>
</html>
