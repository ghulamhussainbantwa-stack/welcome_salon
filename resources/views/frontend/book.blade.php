@extends('layouts.frontend')

@section('title', 'Book Appointment')

@section('content')
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?q=80&w=1920&auto=format&fit=crop'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <span class="section-tag animate__animated animate__fadeInDown">Reservation</span>
        <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">Book <span class="gradient-text">Appointment</span></h1>
        <p class="text-secondary mt-3 animate__animated animate__fadeInUp animate__delay-1s">Secure your spot in seconds. Luxury awaits.</p>
    </div>
</section>

<section class="py-100 booking-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="glass-card-front p-5">
                    <h3 class="fw-bold mb-4">Your Information</h3>
                    <form id="publicBookingForm">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label-dark">Full Name *</label>
                                <input type="text" name="name" class="form-control-dark w-100" placeholder="e.g. John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-dark">Phone Number *</label>
                                <input type="tel" name="phone" class="form-control-dark w-100" placeholder="e.g. +1 234 567 890" required pattern="^([0-9\s\-\+\(\)]*)$" minlength="10">
                            </div>
                        </div>

                        <h3 class="fw-bold mb-4 mt-5">Appointment Details</h3>
                        <div class="mb-4">
                            <label class="form-label-dark">Select Service *</label>
                            <select name="service_id" class="form-select-dark w-100" required>
                                <option value="">Choose a service...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ request('service') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} — ${{ number_format($service->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <label class="form-label-dark">Preferred Date *</label>
                                <input type="date" name="appointment_date" class="form-control-dark w-100" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-dark">Preferred Time *</label>
                                <select name="appointment_time" class="form-select-dark w-100" required>
                                    <option value="">Choose time...</option>
                                    @for($h=9; $h<=20; $h++)
                                        @php $time = sprintf('%02d:00', $h); @endphp
                                        <option value="{{ $time }}">{{ date('h:i A', strtotime($time)) }}</option>
                                        @php $time = sprintf('%02d:30', $h); @endphp
                                        @if($h < 20)
                                            <option value="{{ $time }}">{{ date('h:i A', strtotime($time)) }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary-glow w-100 py-3 mt-2" id="submitBooking">
                            <span class="btn-text">Confirm Booking</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div>
                    <div class="glass-card-front mb-4">
                        <h5 class="fw-bold text-neon-blue mb-3">Why book online?</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3 d-flex gap-3 align-items-center">
                                <i class="fa-solid fa-circle-check text-success"></i>
                                <span class="small text-secondary">Instant confirmation via phone</span>
                            </li>
                            <li class="mb-3 d-flex gap-3 align-items-center">
                                <i class="fa-solid fa-circle-check text-success"></i>
                                <span class="small text-secondary">Reschedule easily if needed</span>
                            </li>
                            <li class="mb-0 d-flex gap-3 align-items-center">
                                <i class="fa-solid fa-circle-check text-success"></i>
                                <span class="small text-secondary">No waiting time at the salon</span>
                            </li>
                        </ul>
                    </div>

                    <div class="glass-card-front">
                        <h5 class="fw-bold text-neon-purple mb-3">Operating Hours</h5>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-secondary">Mon — Fri</span>
                            <span>09:00 AM - 08:00 PM</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-secondary">Saturday</span>
                            <span>10:00 AM - 06:00 PM</span>
                        </div>
                        <div class="d-flex justify-content-between small">
                            <span class="text-secondary">Sunday</span>
                            <span class="text-danger">Closed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#publicBookingForm').on('submit', function(e) {
        e.preventDefault();
        const $btn = $('#submitBooking');
        const $text = $btn.find('.btn-text');
        const $spinner = $btn.find('.spinner-border');

        // UI Loading
        $btn.prop('disabled', true);
        $text.addClass('d-none');
        $spinner.removeClass('d-none');

        $.ajax({
            url: "{{ route('public.book') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(res) {
                Swal.fire({
                    title: 'Success!',
                    text: res.message,
                    icon: 'success',
                    background: '#111',
                    color: '#fff',
                    confirmButtonColor: '#00d2ff'
                }).then(() => {
                    window.location.href = "{{ route('welcome') }}";
                });
            },
            error: function(xhr) {
                $btn.prop('disabled', false);
                $text.removeClass('d-none');
                $spinner.addClass('d-none');

                const errors = xhr.responseJSON?.errors;
                let errorMsg = 'Something went wrong.';
                if (errors) {
                    errorMsg = Object.values(errors).flat()[0];
                }

                Swal.fire({
                    title: 'Error!',
                    text: errorMsg,
                    icon: 'error',
                    background: '#111',
                    color: '#fff',
                    confirmButtonColor: '#ff006e'
                });
            }
        });
    });
});
</script>
@endsection
