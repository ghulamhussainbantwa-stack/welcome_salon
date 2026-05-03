@extends('layouts.frontend')

@section('title', 'Contact Us')

@section('content')
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1532710093739-9470acff878f?q=80&w=1920&auto=format&fit=crop'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <span class="section-tag animate__animated animate__fadeInDown">Global Concierge</span>
        <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">Get in <span class="gradient-text">Touch</span></h1>
        <p class="text-secondary mt-3 animate__animated animate__fadeInUp animate__delay-1s">Expert advice and luxury assistance at your fingertips.</p>
    </div>
</section>

<section class="py-100">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 reveal">
                <h3 class="fw-bold mb-4">Location & Info</h3>
                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="fa-solid fa-location-dot text-neon-blue"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-white">Our Address</h6>
                        <p class="small text-secondary mb-0">123 Beauty Avenue, Style City, SC 54321</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="fa-solid fa-phone text-neon-blue"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-white">Phone Support</h6>
                        <p class="small text-secondary mb-0">+1 (555) 000-STYLE</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="fa-solid fa-envelope text-neon-blue"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-white">Email Us</h6>
                        <a href="mailto:hello@welcomesalon.com" class="small text-secondary mb-0 text-decoration-none hover-neon">hello@welcomesalon.com</a>
                    </div>
                </div>

                <div class="glass-card-front mt-5 p-4">
                    <h6 class="fw-bold mb-3">Follow our style</h6>
                    <div class="d-flex gap-3">
                        <a href="https://instagram.com/welcomesalon" target="_blank" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://facebook.com/welcomesalon" target="_blank" class="social-btn"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://twitter.com/welcomesalon" target="_blank" class="social-btn"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://tiktok.com/@welcomesalon" target="_blank" class="social-btn"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 reveal">
                <div class="glass-card-front p-5">
                    <h3 class="fw-bold mb-4">Send a Message</h3>
                    <form id="contactForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label-dark">Name</label>
                                <input type="text" name="name" class="form-control-dark w-100" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-dark">Email</label>
                                <input type="email" name="email" class="form-control-dark w-100" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label-dark">Subject</label>
                            <input type="text" name="subject" class="form-control-dark w-100" placeholder="What is this regarding?">
                        </div>
                        <div class="mb-4">
                            <label class="form-label-dark">Message</label>
                            <textarea name="message" class="form-control-dark w-100" rows="5" placeholder="How can we help?" required></textarea>
                        </div>
                        <button type="submit" class="btn-primary-glow w-100 py-3" id="btnSend">
                            <span class="btn-text">Send Message</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        const $btn = $('#btnSend');
        const $text = $btn.find('.btn-text');
        const $spinner = $btn.find('.spinner-border');

        $btn.prop('disabled', true);
        $text.addClass('d-none');
        $spinner.removeClass('d-none');

        $.ajax({
            url: "{{ route('contact.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(res) {
                Swal.fire({
                    title: 'Message Sent!',
                    text: res.message,
                    icon: 'success',
                    background: '#111',
                    color: '#fff',
                    confirmButtonColor: '#00d2ff'
                });
                $('#contactForm')[0].reset();
            },
            error: function(xhr) {
                let errorMsg = 'Failed to send message.';
                if (xhr.responseJSON?.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).flat()[0];
                }
                Swal.fire({
                    title: 'Error!',
                    text: errorMsg,
                    icon: 'error',
                    background: '#111',
                    color: '#fff',
                    confirmButtonColor: '#ff006e'
                });
            },
            complete: function() {
                $btn.prop('disabled', false);
                $text.removeClass('d-none');
                $spinner.addClass('d-none');
            }
        });
    });
});
</script>
@endsection

