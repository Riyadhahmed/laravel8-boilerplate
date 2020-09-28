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
    <div class="container m-top-60">
        <div class="row ">
            <div class="col-sm-12 col-md-8 p-right-40">
                @yield('content')
            </div>
            <!-- sidebar -->
            <div class="col-sm-12 col-md-4">
                @include('frontend.layouts.notice')
            </div>
        </div>
    </div>
    <!-- Footer section -->
    <footer class="footer-section">
        @include('frontend.layouts.footer')
        @include('backend.layouts.datatable')
    </footer>
</div>
</body>
</html>