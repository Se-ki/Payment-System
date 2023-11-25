<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo">
                <img src="{{ asset('img/icon-no-bg.png') }}" width="25px" height="25px" alt="">
                <span class="nav_logo-name" style="font:bolder">CEIT E-PAYMENT
                </span>
            </a>
            @if (Auth::user()->role_type_id === 1)
                <div class="nav_list">
                    <a href="/" class="nav_link {{ request()->path() === '/' ? 'active' : '' }}">
                        <i class='bx bxs-home nav_icon'></i>
                        <span class="nav_name">Home</span>
                    </a>
                    <a href="{{ route('payments.index') }}"
                        class="nav_link {{ request()->path() === 'payments' ? 'active' : '' }} ">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Payments</span>
                    </a>
                    <a href="{{ route('records.index') }}"
                        class="nav_link {{ request()->path() === 'records' ? 'active' : '' }}">
                        <i class='bx bx-receipt nav_icon'></i>
                        <span class="nav_name">Student Records</span>
                    </a>
                    <a href="{{ route('balance.index') }}"
                        class="nav_link {{ request()->path() === 'balance' ? 'active' : '' }}">
                        <i class='bx bxs-credit-card nav_icon'></i>
                        <span class="nav_name">Balance</span>
                    </a>
                </div>
            @elseif (Auth::user()->role_type_id === 2)
                <div class="nav_list">
                    <a href="{{ url('/') }}" class="nav_link {{ request()->path() === '/' ? 'active' : '' }}">
                        <i class='bx bxs-dashboard nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                </div>
            @else
                <div class="nav_list">
                    <a href="/" class="nav_link {{ request()->path() === '/' ? 'active' : '' }}">
                        <i class='bx bxs-dashboard nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                </div>
            @endif
            <a href="{{ url('/profile') }}" class="nav_link {{ request()->path() === 'profile' ? 'active' : '' }}">
                <i class='bx bxs-user-badge nav_icon'></i>
                <span class="nav_name">Profile</span>
            </a>
            <a href="#" class="nav_link {{ request()->path() === '' ? 'active' : '' }}">
                <i class='bx bx-cog '></i>
                <span class="nav_name">Settings</span>
            </a>
        </div> <a href="{{ route('logout') }}" class="nav_link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
                class='bx bx-log-out nav_icon'></i> <span class="nav_name">Logout</span> </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
</div>
