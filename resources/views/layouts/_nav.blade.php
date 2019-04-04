<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0">
    <div class="container">
        <a class="navbar-brand" href="#">TIMS</a>
        {{--            <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}
        <ul class="navbar-nav px-3">
            @guest
                <li><a href="{{ route('login') }}" class="">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('logout') }}">Sign out</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>