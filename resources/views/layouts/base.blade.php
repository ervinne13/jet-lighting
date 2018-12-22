<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Jet Lighting Operations') </title>

    <link rel="stylesheet" href="{!! asset('css/inspinia-vendor.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/inspinia.min.css') !!}" />

    @yield('css')
</head>

<body class="@yield('bodyClass')">

    <!-- Main view  -->
    @yield('content')

    <script src="{!! asset('js/inspinia.min.js') !!}" type="text/javascript"></script>
    @yield('js')
</body>

</html>
