<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">{{ __('Site') }} <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->login }}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('/admin/dashboard') }}">{{ __('Dashboard') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/logout">{{ __('Logout') }}</a>
        </div>
    </li>
</ul>
