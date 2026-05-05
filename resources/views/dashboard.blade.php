@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Welcome back, Admin. Here\'s what\'s happening today.')

@section('content')
<div class="row g-2 g-md-4 mb-4">
    <!-- Stat Cards -->
    <div class="col-6 col-md-3">
        <div class="glass-card glow-blue p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="p-2 bg-opacity-10 bg-info rounded-3">
                    <i class="fa-solid fa-users text-neon-blue fs-5"></i>
                </div>
                <span class="text-success small d-none d-sm-block"><i class="fa-solid fa-arrow-up"></i> 12%</span>
            </div>
            <h3 class="fw-bold mb-0 counter">{{ $stats['total_customers'] }}</h3>
            <p class="text-secondary small mb-0">Total Customers</p>
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="glass-card glow-purple p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="p-2 bg-opacity-10 bg-primary rounded-3">
                    <i class="fa-solid fa-calendar-check text-neon-purple fs-5"></i>
                </div>
                <span class="text-neon-purple small d-none d-sm-block">Today</span>
            </div>
            <h3 class="fw-bold mb-0 counter">{{ $stats['today_appointments'] }}</h3>
            <p class="text-secondary small mb-0">Today's Appts</p>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="glass-card glow-cyan p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="p-2 bg-opacity-10 bg-info rounded-3">
                    <i class="fa-solid fa-dollar-sign text-neon-cyan fs-5"></i>
                </div>
                <span class="text-neon-cyan small d-none d-sm-block">Total</span>
            </div>
            <h3 class="fw-bold mb-0 counter">{{ number_format($stats['total_revenue'] ?? 0) }}</h3>
            <p class="text-secondary small mb-0">Total Revenue</p>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="glass-card p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="p-2 bg-opacity-10 bg-warning rounded-3">
                    <i class="fa-solid fa-clock text-warning fs-5"></i>
                </div>
                <span class="text-warning small d-none d-sm-block">Pending</span>
            </div>
            <h3 class="fw-bold mb-0 counter">{{ $stats['pending_appointments'] }}</h3>
            <p class="text-secondary small mb-0">Pending</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="glass-card h-100">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
                <h5 class="fw-bold mb-0">Recent Appointments</h5>
                <a href="{{ route('appointments.index') }}" class="text-neon-blue small text-decoration-none">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_appointments as $appointment)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-sm p-1 border-glass rounded-circle">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(optional($appointment->customer)->name ?? 'Unknown') }}&background=random" class="rounded-circle" width="30">
                                    </div>
                                    <span>{{ optional($appointment->customer)->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td><span class="badge bg-opacity-10 bg-info text-neon-blue">{{ optional($appointment->service)->name ?? 'Unknown Service' }}</span></td>
                            <td>
                                <small class="d-block">{{ $appointment->appointment_date }}</small>
                                <small class="text-secondary">{{ $appointment->appointment_time }}</small>
                            </td>
                            <td>
                                @if($appointment->status == 'completed')
                                    <span class="text-success small"><i class="fa-solid fa-circle-check me-1"></i> Completed</span>
                                @elseif($appointment->status == 'cancelled')
                                    <span class="text-danger small"><i class="fa-solid fa-circle-xmark me-1"></i> Cancelled</span>
                                @else
                                    <span class="text-warning small"><i class="fa-solid fa-circle-dot me-1"></i> Pending</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-secondary">No recent appointments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="glass-card h-100">
            <h5 class="fw-bold mb-4">Quick Actions</h5>
            <div class="d-grid gap-3">
                <a href="{{ route('appointments.index') }}" class="btn btn-neon text-start py-3 px-4">
                    <i class="fa-solid fa-calendar-plus me-2"></i> Book Appointment
                </a>
                <a href="{{ route('customers.index') }}" class="btn btn-neon text-start py-3 px-4 border-glass text-white" style="border-color: rgba(255,255,255,0.1) !important;">
                    <i class="fa-solid fa-user-plus me-2"></i> Add New Customer
                </a>
                <a href="{{ route('services.index') }}" class="btn btn-neon text-start py-3 px-4 border-glass text-white" style="border-color: rgba(255,255,255,0.1) !important;">
                    <i class="fa-solid fa-scissors me-2"></i> Manage Services
                </a>
            </div>

            <div class="mt-5 p-4 border-glass rounded-4 bg-opacity-10 bg-info">
                <p class="small mb-2">Daily Revenue Goal</p>
                <div class="d-flex justify-content-between align-items-end mb-2">
                    <h4 class="fw-bold mb-0 text-neon-blue">$1,200</h4>
                    <span class="small text-secondary">75% Complete</span>
                </div>
                <div class="progress bg-dark" style="height: 6px;">
                    <div class="progress-bar bg-neon-blue" style="width: 75%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Counter Animation
        $('.counter').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    });
</script>
@endsection
