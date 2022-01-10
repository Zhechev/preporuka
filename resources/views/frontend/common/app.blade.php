<!DOCTYPE html>
<html lang="en">
<head>
    @yield('head')
</head>
<body>
    <!-- Wrapper -->
    <div id="main_wrapper">
        @include('frontend.common.header')

        @yield('content')
    </div>
    @include('frontend.common.footer')
</body>
</html>
