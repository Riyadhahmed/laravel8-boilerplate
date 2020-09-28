<!DOCTYPE html>
<html>
<head>
    @include('frontend.layouts.head')
</head>
<body>
<div class="{{ $app_settings->layout ? '' : 'container' }}">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- header section -->
    <header class="header-section">
        @include('frontend.layouts.header')
    </header>
    <div class="container m-top-60">
        <div class="row">
            <!-- sidebar -->
            <div class="col-sm-12 col-md-4 p-right-40">
                @include('frontend.layouts.notice')
            </div>
            <div class="col-sm-12 col-md-8">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer section -->
    <footer class="footer-section">
        @include('frontend.layouts.footer')
    </footer>
</div>
</body>
</html>