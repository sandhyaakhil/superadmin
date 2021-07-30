
    @if(session()->has('logged_in') && Session::get('logged_in')==true)

        @include('layouts.navbars.navs.auth')

    @else

        @include('layouts.navbars.navs.guest')

    @endif
