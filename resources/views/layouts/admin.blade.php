<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Welcome Salon Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-dark.css') }}?v={{ time() }}">
    @yield('styles')
</head>
<body style="overflow-x: hidden;">
    <div class="sidebar-overlay" id="sidebar-overlay"></div>



    <nav id="sidebar" class="d-flex flex-column">
        <!-- Sidebar Header -->
        <div class="p-4 d-flex justify-content-between align-items-center flex-shrink-0">
            <a href="{{ route('welcome') }}" style="text-decoration:none">
                @include('partials.logo')
            </a>
            <button id="sidebar-close" class="btn btn-link text-white d-lg-none p-0">
                <i class="fa-solid fa-xmark fs-4"></i>
            </button>
        </div>

        <!-- Sidebar Body (Scrollable) -->
        <div class="sidebar-body flex-grow-1" style="overflow-y: auto; padding-bottom: 20px;">
            <div class="nav flex-column mt-3 px-2">
                <div class="sidebar-heading">Core Management</div>
                
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('appointments.index') }}" class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-check"></i><span>Appointments</span>
                    @php $apptCount = \App\Models\Appointment::where('status', 'pending')->count(); @endphp
                    @if($apptCount > 0)
                        <span class="badge bg-info text-black ms-auto" style="font-size: 0.6rem;">{{ $apptCount }}</span>
                    @endif
                </a>
                <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-scissors"></i><span>Services</span>
                </a>
                <a href="{{ route('customers.index') }}" class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i><span>Customers</span>
                </a>

                <div class="sidebar-heading">Admin Tools</div>

                <a href="{{ route('messages.index') }}" class="nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-envelope"></i><span>Messages</span>
                    @php $msgCount = \App\Models\Message::where('is_read', false)->count(); @endphp
                    @if($msgCount > 0)
                        <span class="badge bg-danger ms-auto" style="font-size: 0.6rem;">{{ $msgCount }}</span>
                    @endif
                </a>
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-gear"></i><span>Manage Users</span>
                </a>
                <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i><span>Reports</span>
                </a>
            </div>
        </div>

        <!-- Sidebar Footer (Fixed) -->
        <div class="sidebar-footer flex-shrink-0" style="padding:15px 20px; background:rgba(10,10,10,0.98); border-top:1px solid var(--border-glass);">
            <a href="{{ route('welcome') }}" target="_blank" class="nav-link text-neon-blue d-flex align-items-center gap-2 py-1">
                <i class="fa-solid fa-arrow-up-right-from-square"></i><span style="font-size: 0.85rem;">View Website</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-1">
                @csrf
                <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start d-flex align-items-center gap-2 py-1">
                    <i class="fa-solid fa-right-from-bracket"></i><span style="font-size: 0.85rem;">Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <header class="admin-header mb-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 w-100">
                <div class="d-flex align-items-center gap-2">
                    <button id="mobile-sidebar-toggle" class="btn btn-neon d-lg-none" style="padding:8px 12px;">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div>
                        <h2 class="fw-bold mb-0 admin-page-title">@yield('page-title')</h2>
                        <p class="text-secondary mb-0 small d-none d-md-block">@yield('page-subtitle')</p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 ms-auto ms-md-0">
                    <div class="glass-card py-1 px-2 py-md-2 px-md-3 d-flex align-items-center gap-2">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=00d2ff&color=fff" class="rounded-circle" width="28" height="28" alt="Admin">
                        <div class="d-none d-sm-block">
                            <p class="mb-0 fw-bold" style="font-size:0.75rem">Admin</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-neon py-2 px-3" id="logoutBtn">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // CSRF for AJAX
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            // Sidebar Toggle (Desktop)
            $('#sidebar-toggle').click(function() {
                $('#sidebar').toggleClass('collapsed');
                $('#main-content').toggleClass('expanded');
            });

            // Mobile Sidebar Toggle
            $('#mobile-sidebar-toggle, #sidebar-overlay, #sidebar-close').click(function() {
                $('#sidebar').toggleClass('show');
                $('#sidebar-overlay').toggleClass('show');
            });

            // GSAP Animations removed to fix visibility issues
            // gsap.from('#sidebar', { x: -100, opacity: 0, duration: 0.8, ease: 'power4.out' });
            // gsap.from('header', { y: -40, opacity: 0, duration: 0.7, delay: 0.15 });
            // gsap.from('.glass-card', { y: 20, opacity: 0, duration: 0.5, stagger: 0.08, delay: 0.3, ease: 'back.out(1.5)' });
        });

        // Toast Helper
        const showToast = (message, icon = 'success') => {
            Swal.fire({
                toast: true, position: 'top-end', showConfirmButton: false,
                timer: 3000, timerProgressBar: true, icon, title: message,
                background: '#111', color: '#fff'
            });
        };
    </script>
    @yield('scripts')
</body>
</html>
