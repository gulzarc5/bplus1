<html>
    <head>
        <title> @yield('title')</title>
    </head>
    <body>
        @include('web.include.header')

        <div>
            @yield('content')
        </div>
        @include('web.include.footer')
        @yield('script')
        
    </body>
</html>