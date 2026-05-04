<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Welcome Salon Premium Studio</title>
    
    <!-- Fonts & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    
    <style>
        .py-100 { padding: 100px 0; }
        .bg-black-lighter { background: #0a0a0a; }
        .rotate-3 { transform: rotate(3deg); }
        .z-index-1 { z-index: 1; }
        .max-w-600 { max-width: 600px; }
    </style>
</head>
<body>

    @include('partials.navbar')

    <div class="global-wrapper">
        @yield('content')
    </div>

    @include('partials.footer')

    <!-- Back to Top -->
    <a href="#" class="btn-back-to-top" id="backToTop">
        <i class="fa-solid fa-arrow-up"></i>
    </a>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Init AOS
        AOS.init({ duration: 1000, once: true });
        
        // CSRF for AJAX
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        // Navbar Scroll Effect
        $(window).scroll(function() {
            $('.site-navbar').toggleClass('scrolled', $(this).scrollTop() > 50);
        });

        // GSAP Scroll Registration
        gsap.registerPlugin(ScrollTrigger);
        
        // Heavy Staggered Reveal
        const revealElements = document.querySelectorAll('.reveal');
        revealElements.forEach((el, i) => {
            ScrollTrigger.create({
                trigger: el,
                start: 'top 92%', // Trigger slightly later for better feel
                onEnter: () => {
                    setTimeout(() => {
                        el.classList.add('visible');
                    }, i % 3 * 100); 
                },
                onUpdate: (self) => {
                    // Fallback: If element is already past the trigger point on load
                    if (self.progress > 0 && !el.classList.contains('visible')) {
                        el.classList.add('visible');
                    }
                }
            });
        });

        // Floating Elements Animation (with null check)
        if (document.querySelector('.hero-float-card')) {
            gsap.to('.hero-float-card', {
                y: -20,
                duration: 2,
                repeat: -1,
                yoyo: true,
                ease: "power1.inOut",
                stagger: 0.5
            });
        }

        // Newsletter Submission
        $('#newsletterForm').on('submit', function(e) {
            e.preventDefault();
            const email = $('#newsletterEmail').val();
            
            $.ajax({
                url: "{{ route('newsletter.subscribe') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Welcome to the Elite!',
                        text: response.message,
                        icon: 'success',
                        background: '#121212',
                        color: '#fff',
                        confirmButtonColor: '#00d2ff'
                    });
                    $('#newsletterEmail').val('');
                },
                error: function() {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error',
                        background: '#121212',
                        color: '#fff',
                        confirmButtonColor: '#ff0055'
                    });
                }
            });
        });
    </script>

    @yield('scripts')

</body>
</html>
