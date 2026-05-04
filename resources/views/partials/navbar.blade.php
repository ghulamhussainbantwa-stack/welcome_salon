<nav class="site-navbar navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
            @include('partials.logo')
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="fa-solid fa-bars-staggered text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('welcome') ? 'active' : '' }}" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <div class="ms-lg-3 d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3 mt-3 mt-lg-0">
                <a href="{{ route('book') }}" class="btn-book-nav w-100 text-center">Book Appointment</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link nav-link-custom p-0" title="Admin Dashboard">
                        <i class="fa-solid fa-gauge-high fs-5 text-neon-blue"></i>
                    </a>
                @else
                    {{-- Very discreet staff entry point --}}
                    <a href="{{ route('login') }}" class="staff-access-link" title="Staff Area">
                        <i class="fa-solid fa-shield-halved"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
