<footer class="site-footer">
    <div class="container">
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="mb-4">
                    @include('partials.logo')
                </div>
                <p class="text-secondary small mb-4" style="line-height:1.8">
                    Redefining luxury beauty experiences since 2010. We combine artistry with premium care to help you find your unique style.
                </p>
                <div class="d-flex gap-2">
                    <a href="https://instagram.com/welcomesalon" target="_blank" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://facebook.com/welcomesalon" target="_blank" class="social-btn"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://tiktok.com/@welcomesalon" target="_blank" class="social-btn"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="https://linkedin.com/company/welcomesalon" target="_blank" class="social-btn"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1">
                <h6 class="fw-bold mb-4 text-white small text-uppercase letter-spacing-1">Navigation</h6>
                <a href="{{ route('welcome') }}" class="footer-link">Home</a>
                <a href="{{ route('services') }}" class="footer-link">Services</a>
                <a href="{{ route('about') }}" class="footer-link">About Us</a>
                <a href="{{ route('contact') }}" class="footer-link">Contact</a>
            </div>
            <div class="col-lg-2">
                <h6 class="fw-bold mb-4 text-white small text-uppercase letter-spacing-1">Services</h6>
                <a href="{{ route('book') }}" class="footer-link">Hair Styling</a>
                <a href="{{ route('book') }}" class="footer-link">Luxury Spa</a>
                <a href="{{ route('book') }}" class="footer-link">Grooming</a>
                <a href="{{ route('services') }}" class="footer-link">View All</a>
            </div>
            <div class="col-lg-3">
                <h6 class="fw-bold mb-4 text-white small text-uppercase letter-spacing-1">Newsletter</h6>
                <p class="text-secondary small mb-3">Subscribe for exclusive offers and style tips.</p>
                <form id="newsletterForm" class="input-group">
                    <input type="email" name="email" id="newsletterEmail" class="form-control-dark border-end-0 rounded-start-pill" placeholder="Email Address" required>
                    <button type="submit" class="btn-primary-glow px-3 rounded-end-pill border-0"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        <div class="neon-divider"></div>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center pt-4">
            <p class="text-secondary small mb-2 mb-md-0">&copy; {{ date('Y') }} Welcome Salon Premium. All rights reserved.</p>
            <p class="text-secondary small mb-0">Experience the Future of Beauty</p>
        </div>
    </div>
</footer>
