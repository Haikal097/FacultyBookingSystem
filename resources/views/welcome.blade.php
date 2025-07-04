@extends('app')

@section('title', 'Home - Facility Booking System')

@section('styles')
<style>
    .hero-section {
        height: 100vh;
        min-height: 600px;
        margin-top: 70px;
        border-radius: 0 0 80px 80px;
        overflow: hidden;
        position: relative;
    }
    
    .hero-content {
        z-index: 2;
        animation: fadeInUp 1s ease-out;
    }
    
    .hero-title {
        font-weight: 800;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        letter-spacing: -1px;
    }
    
    .hero-subtitle {
        text-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }
    
    .action-card {
        transition: all 0.3s ease;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        height: 100%;
    }
    
    .action-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    
    .action-icon {
        transition: all 0.3s ease;
    }
    
    .action-card:hover .action-icon {
        transform: scale(1.1);
    }
    
    .features-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
        border-radius: 80px 80px 0 0;
        padding: 80px 0;
        margin-top: -80px;
        position: relative;
        z-index: 1;
    }
    
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Background Image -->
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: url('{{ asset('images/uitmimage.jpg') }}') center/cover no-repeat;">
        </div>
        
        <!-- Dark Overlay -->
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>
        
        <!-- Content -->
        <div class="position-relative container h-100 d-flex flex-column justify-content-center hero-content" style="margin-top: 250px;">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center text-md-start">
                    <h1 class="hero-title display-2 fw-bold text-white mb-4">
                        Faculty Booking<br>System
                    </h1>
                    <p class="hero-subtitle lead fs-3 text-white mb-5">
                        Easily book lecture halls, meeting rooms, and sports facilities with our intuitive platform
                    </p>
                    <div class="d-flex gap-3 justify-content-center justify-content-md-start">
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i> Book Now
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection