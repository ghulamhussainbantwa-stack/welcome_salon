@extends('layouts.frontend')

@section('title', 'Our Services')

@section('content')
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?q=80&w=1920&auto=format&fit=crop'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <span class="section-tag animate__animated animate__fadeInDown">Catalogue</span>
        <h1 class="display-3 fw-bold animate__animated animate__fadeInUp">Our <span class="gradient-text">Services</span></h1>
        <p class="text-secondary mt-3 animate__animated animate__fadeInUp animate__delay-1s">Curated treatments for the modern individual.</p>
    </div>
</section>

<section class="py-5 my-5">
    <div class="container">
        <div class="row g-4">
            @foreach($services as $i => $service)
            <div class="col-md-4 reveal">
                <div class="glass-card-front h-100 d-flex flex-column p-0 overflow-hidden">
                    <div class="service-image-box" style="height: 240px; overflow: hidden; background: #1a1a1a;">
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
                    <div class="p-4 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0">{{ $service->name }}</h4>
                            <span class="service-price-tag">${{ number_format($service->price, 2) }}</span>
                        </div>
                        <p class="text-secondary small mb-4">{{ $service->description ?? 'Experience world-class artistry with our signature treatments.' }}</p>
                        
                        <div class="mt-auto pt-4 border-top border-glass d-flex justify-content-between align-items-center">
                            <small class="text-secondary"><i class="fa-regular fa-clock me-1"></i>{{ $service->duration ?? 30 }} mins</small>
                            <a href="{{ route('book') }}?service={{ $service->id }}" class="btn-primary-glow py-2 px-4 fs-6">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 bg-black-lighter border-top border-glass">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">Quality <span class="text-neon-blue">Assurance</span></h2>
                <p class="text-secondary mb-4">We use only the finest products from world-renowned brands. Our tools are sterilized after every use, and our staff follows strict hygiene protocols to ensure your safety and comfort.</p>
                <div class="d-flex gap-4">
                    <div class="text-center">
                        <i class="fa-solid fa-shield-halved text-neon-blue fs-1 mb-2"></i>
                        <p class="small fw-bold">Safe & Sterile</p>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-leaf text-success fs-1 mb-2"></i>
                        <p class="small fw-bold">Organic Products</p>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-award text-warning fs-1 mb-2"></i>
                        <p class="small fw-bold">Certified Pros</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="glass-card-front p-0 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?q=80&w=1000&auto=format&fit=crop" class="img-fluid" alt="Salon Service">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
