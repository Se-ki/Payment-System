{{-- {{ dd(isset(request()->route('year')->id) ? request()->route('year')->id : null) }} --}}
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
                    <a href="/" class="nav_link {{ request()->path() === '/' ? 'active' : null }}">
                        <i class='bx bxs-home nav_icon'></i>
                        <span class="nav_name">Home</span>
                    </a>
                    <a href="{{ route('payments.index') }}"
                        class="nav_link {{ request()->path() === 'payments' ? 'active' : null }}">
                        <i class="fa-solid fa-file-invoice nav_icon"></i>
                        <span class="nav_name">Payments</span>
                    </a>

                    <a href="{{ route('records.index') }}"
                        class="nav_link {{ request()->path() === 'records' ? 'active' : null }}">
                        <i class='bx bx-receipt nav_icon'></i>
                        <span class="nav_name">My Payment Records</span>
                    </a>
                    <a href="{{ route('balance.index') }}"
                        class="nav_link {{ request()->path() === 'balance' ? 'active' : '' }}">
                        <i class='bx bxs-credit-card nav_icon'></i>
                        <span class="nav_name">My Balance</span>
                    </a>
                </div>
            @elseif (Auth::user()->role_type_id === 2)
                <div class="nav_list">
                    <a href="{{ url('/') }}" class="nav_link {{ request()->path() === '/' ? 'active' : '' }}">
                        <i class='bx bxs-home nav_icon'></i>
                        <span class="nav_name">Home</span>
                    </a>
                </div>
                <div class="nav_list">
                    <a href="{{ route('balance.student.index') }}"
                        class="nav_link {{ request()->path() === 'students' ? 'active' : null }}">
                        <i class="fa-solid fa-person-walking nav_icon"></i>
                        <span class="nav_name">Walk In</span>
                    </a>
                </div>
            @else
                <div class="nav_list">
                    <a href="{{ url('/') }}" class="nav_link {{ request()->path() === '/' ? 'active' : '' }}">
                        <i class='bx bxs-home nav_icon'></i>
                        <span class="nav_name">Home</span>
                    </a>
                </div>
                <div class="nav_list">
                    <a href="{{ route('balance.student.index') }}"
                        class="nav_link {{ request()->path() === 'students' ? 'active' : '' }}">
                        <i class="fa-solid fa-person-walking nav_icon"></i>
                        <span class="nav_name">Walk In</span>
                    </a>
                </div>
                <div class="nav_list">
                    <a href="{{ route('payments.create') }}"
                        class="nav_link {{ request()->path() === 'payments/create' ? 'active' : '' }}">
                        <i class="fa-solid fa-file-circle-plus nav_icon"></i>
                        <span class="nav_name">Add Payment</span>
                    </a>
                </div>
                <div class="nav_list">
                    <a href="{{ route('records.index') }}"
                        class="nav_link {{ request()->path() === 'records' ? 'active' : (request()->path() === 'records/' . request()->route('semester') . '/' . (request()->route('year')->id ?? null) ? 'active' : (request()->path() === 'records/' . request()->route('semester') ? 'active' : null)) }}">
                        <i class="fa-solid fa-clipboard-list nav_icon"></i>
                        <span class="nav_name">Student Payment Records</span>
                    </a>
                </div>
                <div class="nav_list">
                    <a href="{{ route('descriptions.index') }}"
                        class="nav_link {{ request()->path() === 'payments/description' ? 'active' : '' }}">
                        <i class="fa-regular fa-rectangle-list nav_icon"></i>
                        <span class="nav_name">List of Description</span>
                    </a>
                </div>
            @endif
            <a href="{{ url('/profile') }}" class="nav_link {{ request()->path() === 'profile' ? 'active' : '' }}">
                <i class='bx bxs-user-badge nav_icon'></i>
                <span class="nav_name">Profile</span>
            </a>
            <a href="#" class="nav_link {{ request()->path() === '' ? 'active' : '' }}">
                <i class='bx bx-cog nav_icon'></i>
                <span class="nav_name">Settings</span>
            </a>
            <a href="{{ route('logout') }}" class="nav_link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
                    class='bx bx-log-out nav_icon'></i> <span class="nav_name">Logout</span> </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
    </nav>
</div>
