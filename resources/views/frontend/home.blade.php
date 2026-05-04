@extends('layouts.frontend')

@section('title', 'Welcome Salon | Premium Hair & Beauty Studio')

@section('content')
<!-- ======= HERO SECTION ======= -->
<section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1560066984-138dadb4c035?q=80&w=1920&auto=format&fit=crop'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 py-lg-5">
                <span class="hero-tag animate__animated animate__fadeInDown"><i class="fa-solid fa-crown me-2"></i>ESTABLISHED 1998 — THE GOLD STANDARD</span>
                <h1 class="hero-title animate__animated animate__fadeInUp mt-4">
                    Where Luxury Meets <span class="gradient-text">Artistry.</span><br>
                    Welcome to <span class="gradient-text">Perfection.</span>
                </h1>
                <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                    Indulge in a bespoke beauty experience tailored for those who demand nothing less than excellence. Rated #1 Salon in Town for over a decade.
                </p>
                <div class="d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="{{ route('book') }}" class="btn-primary-glow">
                        <i class="fa-solid fa-calendar-plus me-2"></i>Book Your Royalty Treatment
                    </a>
                    <a href="#explore" class="btn-outline-glow">
                        Experience the Vision
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block animate__animated animate__fadeInRight">
                <div class="hero-image-box float-anim">
                    <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?q=80&w=800&auto=format&fit=crop" class="img-fluid" alt="Luxury Salon" onerror="this.src='https://picsum.photos/800/1000?random=hero'">
                    <div class="hero-float-card card-1">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fa-solid fa-star text-warning"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">4.9/5 Rating</h6>
                                <small class="text-secondary">By 2000+ Clients</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="neon-divider" id="explore"></div>

<!-- ======= SERVICES GRID (DYNAMIC) ======= -->
<section class="py-100 position-relative">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-tag">The Boutique</span>
            <h2 class="section-title mt-2">Bespoke <span class="gradient-text">Services</span></h2>
            <p class="text-secondary mt-3 max-w-600 mx-auto">Masterfully crafted treatments designed to rejuvenate your spirit and enhance your natural allure.</p>
        </div>
        
        <div class="card-grid-container" id="servicesGrid">
            @foreach($services as $i => $service)
            <div class="service-card-wrap reveal {{ $i >= 6 ? 'card-hidden' : '' }}">
                <div class="glass-card-front h-100">
                    <div class="package-img-wrapper mb-4 rounded-4 overflow-hidden" style="height: 220px; background: #1a1a1a;">
                        @php
                            $salonIds = [
                                '1560066984-138dadb4c035', '1562322140-8baeececf3df', '1503951914875-452162b0f3f1',
                                '1527799858524-8b18b7a00d49', '1512290923902-8a9f81dc2069', '1560869713-7d0a29430803',
                                '1621605815841-2da41ee70b9a', '1519699047748-de8e457a634e', '1487412720507-e7ab37603c6f',
                                '1604654894610-df49ff6697ad', '1521590832167-7bcbfaa6381f', '1516975080664-ed2fc6a32937',
                                '1522337360788-8b13dee7a37e', '1593702295094-ade34350338f', '1634449571010-02389ed0f9b0'
                            ];
                            $imgId = $salonIds[$i % count($salonIds)];
                        @endphp
                        <img src="{{ (isset($service->image_url) && str_starts_with($service->image_url, 'http') && !str_contains($service->image_url, 'placeholder')) ? $service->image_url : 'https://images.unsplash.com/photo-'.$imgId.'?q=80&w=800' }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $service->name }}" onerror="this.src='https://images.unsplash.com/photo-1560066984-138dadb4c035?q=80&w=800'">
                    </div>
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold mb-0">{{ $service->name }}</h5>
                        <span class="text-neon-cyan fw-bold">${{ number_format($service->price, 0) }}</span>
                    </div>
                    <p class="text-secondary small mb-4">{{ $service->description ?? 'Experience world-class artistry with our signature treatments.' }}</p>
                    <a href="{{ route('book') }}?service={{ $service->id }}" class="btn-outline-glow py-2 px-4 fs-6 w-100 text-center">Reserve Now</a>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($services->count() > 6)
        <div class="text-center mt-5">
            <button class="btn-outline-glow px-5" id="loadMoreServices">Discover More Services <i class="fa-solid fa-chevron-down ms-2"></i></button>
        </div>
        @endif
    </div>
</section>

<div class="neon-divider"></div>

<!-- ======= STYLE GALLERY (50+ CARDS MOCKUP) ======= -->
<section class="py-100 bg-black-lighter">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-tag">Visual Inspiration</span>
            <h2 class="section-title mt-2">The Style <span class="gradient-text">Archive</span></h2>
            <p class="text-secondary mt-3">A collection of our most iconic transformations. Find your next masterpiece.</p>
        </div>
        
        <div class="card-grid-container" id="galleryGrid">
            @php
            $galleryIds = [
                '1562322140-8baeececf3df', '1560869713-7d0a29430803', '1521590832167-7bcbfaa6381f', '1522337360788-8b13dee7a37e',
                '1607692731135-0a4fa302bd98', '1634449571010-02389ed0f9b0', '1593702295094-ade34350338f', '1621605815841-2da41ee70b9a',
                '1560066984-138dadb4c035', '1503951914875-452162b0f3f1', '1527799858524-8b18b7a00d49', '1512290923902-8a9f81dc2069',
                '1519699047748-de8e457a634e', '1487412720507-e7ab37603c6f', '1604654894610-df49ff6697ad', '1532710093739-9470acff878f',
                '1521590832167-7bcbfaa6381f', '1560869713-7d0a29430803', '1621605815841-2da41ee70b9a', '1607692731135-0a4fa302bd98',
                '1512290923902-8a9f81dc2069', '1487412720507-e7ab37603c6f', '1522337360788-8b13dee7a37e', '1593702295094-ade34350338f'
            ];
            @endphp
            @for($i=0; $i<24; $i++)
            <div class="gallery-card reveal {{ $i >= 8 ? 'card-hidden' : '' }}">
                <div class="package-card h-100">
                    <div class="package-img-wrapper">
                        <img src="https://images.unsplash.com/photo-{{ $galleryIds[$i] }}?q=80&w=800&auto=format&fit=crop" alt="Style {{ $i+1 }}" class="img-fluid" onerror="this.src='https://images.unsplash.com/photo-1562322140-8baeececf3df?q=80&w=800'">
                        <div class="package-badge">CURATED LOOK #{{ sprintf('%02d', $i+1) }}</div>
                    </div>
                    <div class="p-4 text-center">
                        <h6 class="mb-1 fw-bold text-white">Signature Style {{ $i+1 }}</h6>
                        <small class="text-neon-blue">Master Stylist Exclusive</small>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <div class="text-center mt-5">
            <button class="btn-outline-glow px-5" id="loadMoreGallery">Explore Full Archive <i class="fa-solid fa-chevron-down ms-2"></i></button>
        </div>
    </div>
</section>

<div class="neon-divider"></div>

<!-- ======= PACKAGES & OFFERS (NEW SECTION) ======= -->
<section class="py-100">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-tag">Exclusive Access</span>
            <h2 class="section-title mt-2">Elite <span class="gradient-text">Packages</span></h2>
        </div>
        
        <div class="row g-4">
            @php
            $packages = [
                ['name' => 'Royal Bridal Suite', 'price' => '499', 'features' => ['Complete Makeover', 'Trial Session', 'Home Service', 'Premium Spa'], 'img' => '1522337360788-8b13dee7a37e'],
                ['name' => 'Groom’s Distinction', 'price' => '199', 'features' => ['Signature Haircut', 'Skin Detox', 'Beard Sculpting', 'Head Massage'], 'img' => '1503951914875-452162b0f3f1'],
                ['name' => 'The Weekend Glow', 'price' => '149', 'features' => ['Hydra Facial', 'Hair Spa', 'Manicure', 'Pedicure'], 'img' => '1487412720507-e7ab37603c6f'],
            ];
            @endphp
            @foreach($packages as $pkg)
            <div class="col-12 col-md-6 col-lg-4 reveal">
                <div class="package-card h-100">
                    <div class="package-img-wrapper">
                        <img src="https://images.unsplash.com/photo-{{ $pkg['img'] }}?q=80&w=800&auto=format&fit=crop" alt="{{ $pkg['name'] }}" class="img-fluid">
                        <div class="package-badge">POPULAR</div>
                    </div>
                    <div class="p-5">
                        <h4 class="fw-bold mb-1">{{ $pkg['name'] }}</h4>
                        <div class="package-price mb-4">${{ $pkg['price'] }}</div>
                        <ul class="package-features">
                            @foreach($pkg['features'] as $feat)
                                <li><i class="fa-solid fa-circle-check"></i> {{ $feat }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('book') }}" class="btn-primary-glow w-100 text-center mt-3">Select Package</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="neon-divider"></div>

<div class="neon-divider"></div>

<!-- ======= EXCLUSIVE OFFERS (TO REACH 50+ CARDS) ======= -->
<section class="py-100 position-relative overflow-hidden">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-tag">Limited Time</span>
            <h2 class="section-title mt-2">Exclusive <span class="gradient-text">Offers</span></h2>
        </div>
        
        <div class="card-grid-container" id="offersGrid">
            @for($i=1; $i<=8; $i++)
            <div class="offer-card reveal {{ $i > 4 ? 'card-hidden' : '' }}">
                <div class="glass-card-front h-100 p-0 overflow-hidden border-neon">
                    <div class="offer-img-box" style="height: 160px; overflow: hidden; position: relative;">
                        <img src="https://images.unsplash.com/photo-{{ ['1560066984-138dadb4c035', '1562322140-8baeececf3df', '1503951914875-452162b0f3f1', '1527799858524-8b18b7a00d49', '1512290923902-8a9f81dc2069', '1560869713-7d0a29430803', '1621605815841-2da41ee70b9a', '1519699047748-de8e457a634e'][$i-1] }}?q=80&w=800" class="img-fluid w-100 h-100 object-fit-cover" alt="Offer {{ $i }}" onerror="this.src='https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?q=80&w=800'">
                        <div class="position-absolute top-0 end-0 p-2">
                            <span class="badge bg-danger shadow">SAVE {{ 10 + ($i * 5) }}%</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="fw-bold mb-0">Summer Glow Offer #{{ $i }}</h5>
                            <i class="fa-solid fa-bolt text-warning"></i>
                        </div>
                        <p class="text-secondary small mb-4">Valid for bookings this week only. Don't miss out on this signature treatment.</p>
                        <a href="{{ route('book') }}" class="btn-outline-glow w-100 text-center py-2">Claim Offer</a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        
        <div class="text-center mt-5">
            <button class="btn-outline-glow px-5" id="loadMoreOffers">View All Offers <i class="fa-solid fa-chevron-down ms-2"></i></button>
        </div>
    </div>
</section>

<div class="neon-divider"></div>

<!-- ======= TEAM SECTION ======= -->
<section class="py-100">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-tag">The Artisans</span>
            <h2 class="section-title mt-2">Meet the <span class="gradient-text">Master Stylists</span></h2>
        </div>
        <div class="row g-4">
            @foreach($staff as $member)
            <div class="col-lg-3 col-md-6 reveal">
                <div class="glass-card-front text-center p-4 h-100">
                    <div class="mb-4 position-relative d-inline-block">
                        @php
                            $stylistImages = [
                                '1507003211169-0a1dd7228f2d', '1494790108377-be9c29b29330', 
                                '1500648767791-00dcc994a43e', '1544005313-94ddf0286df2'
                            ];
                            $stylistImg = $stylistImages[$loop->index % count($stylistImages)];
                        @endphp
                        <img src="{{ (isset($member->image_url) && str_starts_with($member->image_url, 'http')) ? $member->image_url : 'https://images.unsplash.com/photo-'.$stylistImg.'?q=80&w=300&h=300&fit=crop' }}" class="rounded-circle border-glass p-2" width="150" height="150" style="object-fit:cover;" alt="{{ $member->name }}">
                        <div class="position-absolute bottom-0 end-0 bg-neon-blue rounded-circle p-2 shadow">
                            <i class="fa-solid fa-award text-black fs-6"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-1">{{ $member->name }}</h5>
                    <p class="text-neon-blue small mb-3">{{ $member->role }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        @if($member->instagram_url)
                            <a href="{{ $member->instagram_url }}" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if($member->linkedin_url)
                            <a href="{{ $member->linkedin_url }}" class="social-btn"><i class="fa-brands fa-linkedin-in"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="neon-divider"></div>

<!-- ======= TESTIMONIALS (NEW SECTION) ======= -->
<section class="py-100 bg-black-lighter">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-tag">Voices of Luxury</span>
            <h2 class="section-title mt-2">Client <span class="gradient-text">Experiences</span></h2>
        </div>
        <div class="row g-4">
            @for($i=1; $i<=3; $i++)
            <div class="col-12 col-md-6 col-lg-4 reveal">
                <div class="testimonial-card h-100 p-5">
                    <div class="stars mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-secondary fst-italic mb-4">"The attention to detail at Welcome Salon is unparalleled. It's not just a haircut, it's a transformation of confidence."</p>
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Client+{{ $i }}&background=random" class="rounded-circle" width="45">
                        <div>
                            <h6 class="mb-0 fw-bold">Happy Client {{ $i }}</h6>
                            <small class="text-secondary">Loyal Member</small>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Load More Services
    $('#loadMoreServices').click(function() {
        const hidden = $('#servicesGrid .card-hidden');
        hidden.slice(0, 6).removeClass('card-hidden').addClass('reveal visible');
        if ($('#servicesGrid .card-hidden').length == 0) $(this).parent().fadeOut();
    });

    // Load More Gallery
    $('#loadMoreGallery').click(function() {
        const hidden = $('#galleryGrid .card-hidden');
        hidden.slice(0, 8).removeClass('card-hidden').addClass('reveal visible');
        if ($('#galleryGrid .card-hidden').length == 0) $(this).parent().fadeOut();
    });

    // Load More Offers
    $('#loadMoreOffers').click(function() {
        const hidden = $('#offersGrid .card-hidden');
        hidden.slice(0, 4).removeClass('card-hidden').addClass('reveal visible');
        if ($('#offersGrid .card-hidden').length == 0) $(this).parent().fadeOut();
    });

    // Back to Top Logic
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) $('#backToTop').addClass('visible');
        else $('#backToTop').removeClass('visible');
    });
});
</script>
@endsection
