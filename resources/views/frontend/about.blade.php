@extends('layouts.frontend')

@section('title', 'About Us')

@section('content')
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?q=80&w=1920&auto=format&fit=crop'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <span class="section-tag animate__animated animate__fadeInDown">Our Legacy</span>
        <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">Defining <span class="gradient-text">Excellence</span></h1>
        <p class="text-secondary mt-3 animate__animated animate__fadeInUp animate__delay-1s">A decade of crafting confidence through artistry.</p>
    </div>
</section>

<section class="py-100 position-relative overflow-hidden">
    <div class="container position-relative z-index-1">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 reveal">
                <h6 class="text-neon-blue fw-bold text-uppercase mb-3">Our Story</h6>
                <h1 class="display-4 fw-bold mb-4">Artistry Meets <span class="text-neon-purple">Luxury</span></h1>
                <p class="lead text-secondary mb-5">Welcome Salon is not just a place for a haircut; it's a destination where artistry meets luxury. We believe every individual deserves to look and feel their best.</p>
                
                <div class="row g-4 mb-5">
                    <div class="col-sm-6">
                        <div class="glass-card p-4">
                            <h3 class="fw-bold text-neon-blue mb-2">13+</h3>
                            <p class="text-secondary mb-0">Years of Experience</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="glass-card p-4">
                            <h3 class="fw-bold text-neon-purple mb-2">15k+</h3>
                            <p class="text-secondary mb-0">Happy Clients</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <div class="glass-card p-2 rotate-3">
                        <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?q=80&w=1000&auto=format&fit=crop" alt="Salon Interior" class="img-fluid rounded-4 shadow-lg">
                    </div>
                    <div class="position-absolute bottom-0 start-0 translate-middle-x ms-5 mb-n5 d-none d-md-block">
                        <div class="glass-card p-4 glow-blue">
                            <p class="fw-bold mb-0 text-white">Award Winning Salon 2023</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="vision-mission py-100 bg-black-lighter">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-4" data-aos="fade-up">
                <div class="glass-card h-100 text-center p-5">
                    <div class="avatar-lg bg-opacity-10 bg-info rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4">
                        <i class="fa-solid fa-eye text-neon-blue fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Our Vision</h4>
                    <p class="text-secondary">To be the most trusted name in premium grooming, setting new standards for excellence and style.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card h-100 text-center p-5">
                    <div class="avatar-lg bg-opacity-10 bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4">
                        <i class="fa-solid fa-bullseye text-neon-purple fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Our Mission</h4>
                    <p class="text-secondary">To provide personalized, high-quality beauty and grooming services in a luxurious, welcoming atmosphere.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card h-100 text-center p-5">
                    <div class="avatar-lg bg-opacity-10 bg-success rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4">
                        <i class="fa-solid fa-gem text-success fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Our Values</h4>
                    <p class="text-secondary">Integrity, Creativity, and Excellence in every snip, stroke, and style we create for our clients.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team py-100">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3">Meet Our <span class="text-neon-blue">Experts</span></h2>
            <p class="text-secondary max-w-600 mx-auto">Our team of world-class stylists and beauty experts are dedicated to your transformation.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3" data-aos="flip-left">
                <div class="glass-card p-3 text-center">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&h=300&fit=crop" class="img-fluid rounded-4 mb-3" alt="Stylist">
                    <h5 class="fw-bold mb-1">Alex Style</h5>
                    <p class="small text-neon-blue mb-0">Master Barber</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="flip-left" data-aos-delay="100">
                <div class="glass-card p-3 text-center">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=300&h=300&fit=crop" class="img-fluid rounded-4 mb-3" alt="Stylist">
                    <h5 class="fw-bold mb-1">Sarah Glow</h5>
                    <p class="small text-neon-purple mb-0">Skin Specialist</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="flip-left" data-aos-delay="200">
                <div class="glass-card p-3 text-center">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=300&h=300&fit=crop" class="img-fluid rounded-4 mb-3" alt="Stylist">
                    <h5 class="fw-bold mb-1">John Blade</h5>
                    <p class="small text-neon-blue mb-0">Senior Stylist</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="flip-left" data-aos-delay="300">
                <div class="glass-card p-3 text-center">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=300&h=300&fit=crop" class="img-fluid rounded-4 mb-3" alt="Stylist">
                    <h5 class="fw-bold mb-1">Emma Chic</h5>
                    <p class="small text-neon-purple mb-0">Color Expert</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
