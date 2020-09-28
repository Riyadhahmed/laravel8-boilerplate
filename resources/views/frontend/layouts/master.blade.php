<!DOCTYPE html>
<html>
<head>
    @include('frontend.layouts.head')
</head>
<body>
    <div class="container">    
        <section>
            @yield('content')
        </section>
        <!-- Footer section -->
        <footer>
            @include('frontend.layouts.footer')
        </footer>
    </div>
</body>
</html>
