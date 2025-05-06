<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
            }
        </style>
    @endif

    <style>
        body {
            padding-top: 70px; /* Adjust depending on navbar height */
        }
    </style>
</head>
<body class="bg-light text-dark min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand bg-white fixed-top shadow-sm ps-5">
        <div class="container-fluid ps-0">
            <div class="d-flex align-items-center">
                <a class="navbar-brand me-4" href="#">Navbar</a>
                <div class="navbar-nav">
                    <a class="nav-link active pe-3" href="#">Home</a>
                    <a class="nav-link pe-3" href="#">Features</a>
                    <a class="nav-link pe-3" href="#">Pricing</a>
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </div>
            </div>
            <!-- Right-aligned Navbar Content -->
            <div class="ms-auto d-flex align-items-center pe-4">
                @auth
                    <!-- Profile Icon for Logged-in User -->
                    <a class="nav-link" href="{{ route('userprofile') }}">
                        <i class="fas fa-user-circle fa-3x"></i>
                    </a>
                @endauth

                @guest
                    <!-- Login & Register for Guests -->
                    <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                    @endif
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4">
        @if (Route::has('login'))
            <div class="mb-4"></div>
        @endif

        <!-- Your page content here -->
         <!-- Hero Section -->
         <div class="container py-4">
    <h1 class="text-center mb-4">Tempahan Ruang dan Kemudahan</h1>
    <p class="text-center mb-5">Maklumat berkaitan ruang dan kemudahan yang ditawarkan oleh UiTM Cawangan Johor, Kampus Pasir Gudang.</p>

    <!-- First infographic (left image, right text) -->
    <div class="row align-items-center mb-5 infographic-section">
    <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
            <img src="{{ asset('images/display1.png') }}" class="img-fluid rounded shadow enlargeable-image" alt="Dewan Kuliah dan Bilik" data-bs-toggle="modal" data-bs-target="#imageModal" data-img-src="{{ asset('images/display1.png') }}">
        </div>
        <div class="col-lg-9 col-md-8">
            <h3 class="section-title">Dewan Kuliah & Bilik Khas</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>DK 200</h5>
                        <p>Kapasiti: 100-200 orang</p>
                        <ul class="facility-features">
                            <li>Projector</li>
                            <li>White board</li>
                            <li>PA Sistem</li>
                            <li>Hawa dingin</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>DK 100 A & B</h5>
                        <p>Kapasiti: Bawah 100 orang</p>
                        <ul class="facility-features">
                            <li>Projector</li>
                            <li>White board</li>
                            <li>PA Sistem</li>
                            <li>Hawa dingin</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>Bilik Mesyuarat</h5>
                        <p>Kapasiti: 20-30 orang</p>
                        <ul class="facility-features">
                            <li>Projector</li>
                            <li>White board</li>
                            <li>PA system</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>Bilik Seminar</h5>
                        <p>Kapasiti: Bawah 40 orang</p>
                        <ul class="facility-features">
                            <li>Meja dan kerusi</li>
                            <li>White board</li>
                            <li>Rostrum</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second infographic (right image, left text) -->
    <div class="row align-items-center mb-5 infographic-section">
        <div class="col-lg-9 col-md-8 order-lg-1 order-md-1">
            <h3 class="section-title">Kemudahan Sukan & Expo</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>Arena Sukan</h5>
                        <ul class="facility-features">
                            <li>Padang Bola Sepak</li>
                            <li>Gelanggang Bolatampar</li>
                            <li>Gelanggang Sepak Takraw</li>
                            <li>Gelanggang Futsal</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>Tapak Jualan & Expo</h5>
                        <ul class="facility-features">
                            <li>Parkir Non Resident</li>
                            <li>Pakej termasuk:
                                <ul>
                                    <li>Projector</li>
                                    <li>PA Sistem</li>
                                    <li>Hawa Dingin</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>Foodtruck/Caravan</h5>
                        <ul class="facility-features">
                            <li>Cas Pengurusan</li>
                            <li>Tapak Sewaan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 order-lg-2 order-md-2 mb-4 mb-md-0">
            <img src="{{ asset('images/display2.png') }}" class="img-fluid rounded shadow enlargeable-image" alt="Kemudahan Sukan" data-bs-toggle="modal" data-bs-target="#imageModal" data-img-src="{{ asset('images/display2.png') }}">
        </div>
    </div>

    <!-- Third infographic (left image, right text) -->
    <div class="row align-items-center mb-5 infographic-section">
    <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
            <img src="{{ asset('images/display3.png') }}" class="img-fluid rounded shadow enlargeable-image" alt="Bilik Kuliah dan Seminar" data-bs-toggle="modal" data-bs-target="#imageModal" data-img-src="{{ asset('images/display3.png') }}">
        </div>
        <div class="col-lg-9 col-md-8">
            <h3 class="section-title">Bilik Kuliah & Seminar</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>Bilik Kuliah</h5>
                        <ul class="facility-features">
                            <li>White board</li>
                            <li>TV LCD</li>
                            <li>Hawa Dingin</li>
                            <li>Meja dan Kerusi</li>
                        </ul>
                        <p class="capacity">Kapasiti: Bawah 40 orang</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>Bilik TEC</h5>
                        <ul class="facility-features">
                            <li>White board</li>
                            <li>TV LCD</li>
                            <li>Hawa Dingin</li>
                            <li>Meja dan Kerusi</li>
                        </ul>
                        <p class="capacity">Kapasiti: Bawah 40 orang</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>Dewan Seminar</h5>
                        <ul class="facility-features">
                            <li>Projector</li>
                            <li>PA Sistem</li>
                            <li>Hawa Dingin</li>
                        </ul>
                        <p class="capacity">Kapasiti: 100-120 orang</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="facility-item">
                        <h5>Bangunan Khawarizmi</h5>
                        <p>Lokasi strategik di kampus</p>
                        <p class="capacity">(Bilik Peperiksaan)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="card contact-card p-4 mt-5">
        <h3 class="text-center mb-4">Hubungi Kami</h3>
        <div class="row">
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <div class="contact-item">
                    <i class="fas fa-phone-alt contact-icon"></i>
                    <h5>Unit Residensi dan Hospitaliti Pelajar</h5>
                    <p>07-381 8722</p>
                </div>
            </div>
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <div class="contact-item">
                    <i class="fas fa-user-tie contact-icon"></i>
                    <h5>En Syamaiza Bin Ibrahim</h5>
                    <p>Pegawai Eksekutif Kanan</p>
                    <p>012-448 4566</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="contact-item">
                    <i class="fas fa-user-tie contact-icon"></i>
                    <h5>En Zahirizal Bin Miskom</h5>
                    <p>Penolong Pendaftar Kanan</p>
                    <p>012-731 2840</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-header border-0 position-absolute top-0 end-0 z-1">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center p-0">
                <img id="modalImage" src="" class="img-fluid mw-100 mh-100" alt="Enlarged view" style="object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<style>
    .infographic-section {
        padding: 2rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        margin-bottom: 3rem;
        background-color: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .infographic-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .section-title {
        color: #2c3e50;
        margin-bottom: 1.5rem;
        font-weight: 600;
        border-bottom: 2px solid #3498db;
        padding-bottom: 0.5rem;
        display: inline-block;
    }
    
    .facility-item {
        background-color: #f8f9fa;
        padding: 1.25rem;
        border-radius: 8px;
        height: 100%;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .facility-item:hover {
        background-color: #e9ecef;
        transform: translateY(-3px);
    }
    
    .facility-item h5 {
        color: #2980b9;
        font-weight: 600;
    }
    
    .facility-features {
        list-style-type: none;
        padding-left: 0;
        margin-top: 0.75rem;
    }
    
    .facility-features li {
        padding: 0.25rem 0;
        position: relative;
        padding-left: 1.5rem;
    }
    
    .facility-features li:before {
        content: "•";
        color: #3498db;
        font-weight: bold;
        position: absolute;
        left: 0;
    }
    
    .capacity {
        font-style: italic;
        color: #7f8c8d;
        margin-top: 0.5rem;
        margin-bottom: 0;
    }
    
    .btn-book {
        background-color: #3498db;
        border-color: #3498db;
        color: white;
        font-weight: 500;
        padding: 0.5rem 1.5rem;
    }
    
    .btn-book:hover {
        background-color: #2980b9;
        border-color: #2980b9;
        color: white;
    }
    
    .contact-card {
        background-color: #f8f9fa;
        border: none;
    }
    
    .contact-item {
        padding: 1rem;
    }
    
    .contact-icon {
        font-size: 2rem;
        color: #3498db;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .infographic-section {
            padding: 1rem;
        }
        
        .facility-item {
            padding: 1rem;
        }
    }
    .enlargeable-image {
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .enlargeable-image:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .modal {
        background-color: rgba(0, 0, 0, 0.8) !important;
    }
    
    .modal-content {
        background: transparent;
        border: none;
    }
    
    .modal-body {
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    #modalImage {
        max-width: 90vw;
        max-height: 90vh;
        width: auto;
        height: auto;
    }
    
    .btn-close-white {
        filter: invert(1) grayscale(100%) brightness(200%);
        opacity: 0.8;
        font-size: 1.5rem;
    }
    
    .btn-close-white:hover {
        opacity: 1;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var imageModal = document.getElementById('imageModal');
    
    // Initialize modal image source
    imageModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var imgSrc = button.getAttribute('data-img-src');
        var modalImg = document.getElementById('modalImage');
        modalImg.src = imgSrc;
        modalImg.alt = button.getAttribute('alt');
    });
    
    // Close modal when clicking outside image
    imageModal.addEventListener('click', function(e) {
        if (e.target === this) {
            var modal = bootstrap.Modal.getInstance(imageModal);
            modal.hide();
        }
    });
    
    // Center image on window resize
    window.addEventListener('resize', function() {
        var modalImg = document.getElementById('modalImage');
        if (modalImg.src) {
            centerImage(modalImg);
        }
    });
    
    function centerImage(img) {
        // This will be handled by the flexbox CSS
    }
});
</script>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </main>
</body>
</html>
