<!DOCTYPE html>
<html lang="nl">
    <head>
        @include('components.head')
    </head>

    <body>
        @yield('before_content')

        @include('components.navigation')

        @include('components.notifications')

        @yield('content')

        @include('components.footer')

        @yield('after_content')

        @if(!app()->environment('production'))
            <div style="position: fixed;bottom: 20px;right: 20px;background-color: red;color:#333;padding:5px;border:3px solid #333;">{{ ucfirst(app()->environment()) }}</div>
        @endif

        <script src="{{ mix('assets/js/app.js') }}"></script>

        @yield('extraJS')
    </body>
</html>
