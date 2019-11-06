
        <title> @yield('title')</title>
        @include('web.include.header')

            @yield('content')
            
        @include('web.include.footer')
        @yield('script')
    