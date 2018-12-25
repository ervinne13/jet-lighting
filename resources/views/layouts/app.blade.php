<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jet Lighting Operations') </title>

    <link rel="stylesheet" href="{!! asset('css/inspinia-vendor.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/inspinia.min.css') !!}" />

    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />
    @yield('css')
</head>
<body>

    <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('layouts.topnavbar')

            <!-- Main view  -->
            @yield('content')

            <!-- Footer -->
            @include('layouts.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->

<script src="{!! asset('js/inspinia.min.js') !!}" type="text/javascript"></script>

@yield('js')

</body>
</html>
