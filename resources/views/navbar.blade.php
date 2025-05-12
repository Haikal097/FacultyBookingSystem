<nav class="navbar navbar-expand bg-white fixed-top shadow-sm ps-5">
    <div class="container-fluid ps-0">
        <div class="d-flex align-items-center">
            <a class="navbar-brand me-4" href="#">
                <i class="fas fa-door-open me-2"></i>Facility Booking
            </a>
            <div class="navbar-nav">
                <a class="nav-link pe-3 {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                    <i class="fas fa-home me-1"></i> Home
                </a>
                <a class="nav-link pe-3 {{ request()->is('booking') ? 'active' : '' }}" href="{{ route('bookings.create') }}">
                    <i class="fas fa-calendar-check me-1"></i> Book Room
                </a>
                <!--
                <a class="nav-link pe-3 {{ request()->is('my-bookings*') ? 'active' : '' }}" href="#">
                    <i class="fas fa-history me-1"></i> My Bookings
                </a>-->
            </div>
        </div>

        <div class="ms-auto d-flex align-items-center pe-4">
            @auth
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4a6bff&color=fff" class="rounded-circle me-2" width="40" height="40">
                        <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('userprofile') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <!--<li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>-->
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            @guest
                <a class="btn btn-outline-primary me-2" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                @if (Route::has('register'))
                    <a class="btn btn-primary" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i> Register</a>
                @endif
            @endguest
        </div>
    </div>
</nav>