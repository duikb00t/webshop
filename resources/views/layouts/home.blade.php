<!doctype html>
<html lang="nl">
    <head>
        @include('components.head')
    </head>

    <body>
        @yield('before_content')

        @include('components.navigation')

        @include('components.notifications')

        @include('components.header')

        @yield('content')

        @include('components.footer')

        @yield('after_content')

        @if(!app()->environment('production'))
            <div style="position: fixed;bottom: 20px;right: 20px;background-color: red;color:#333;padding:5px;border:3px solid #333;">{{ ucfirst(app()->environment()) }}</div>
        @endif

        <script src="{{ mix('assets/js/app.js') }}"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#header-slider').slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear',
                    autoplay: true,
                    arrows: false
                });
            });
        </script>

        @yield('extraJS')
    </body>
</html>
