<header class="header" id="header">
    <div class="header_toggle">
        <i class='bx bx-menu' id="header-toggle"></i>
    </div>
    <span class=""><img src="{{ asset('img/logo-no-bg.png') }}" width="120px" height="50px" alt=""
            srcset=""></span>
    <li class="nav-item dropdown">
        <a class="dropdown-toggle" data-bs-toggle="dropdown">
            {{ Auth::user()->lastname }}
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ url('/profile') }}">My info</a></li>
            <li>
                <form class="dropdown-item" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <button class="bg-transparent border-0" type="submit">Logout</button>
                </form>
            </li>
            {{-- <li><a class="dropdown-item" href="{{ route('session.destroy') }}">Logout</a></li> --}}
        </ul>
    </li>
</header>
