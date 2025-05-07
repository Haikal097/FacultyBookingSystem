<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tempahan Ruang dan Kemudahan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #1a237e;
            --secondary-color: #3949ab;
            --accent-color: #4a6bff;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8f9fa;
            padding-top: 70px;
            min-height: 100vh;
        }
        
        /* Infographic Styles */
        .infographic-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .page-header h1 {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .page-header p {
            font-size: 1.1rem;
            color: #555;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .infographic-section {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 3rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .infographic-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .facility-card {
            background-color: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            height: 100%;
            border-left: 4px solid var(--accent-color);
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .facility-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        .facility-card h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        
        .facility-features {
            list-style-type: none;
            padding-left: 0;
            margin-top: 1rem;
        }
        
        .facility-features li {
            padding: 0.35rem 0;
            position: relative;
            padding-left: 1.75rem;
            color: #444;
        }
        
        .facility-features li:before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            color: var(--success-color);
        }
        
        .capacity-badge {
            display: inline-block;
            background-color: rgba(74, 107, 255, 0.1);
            color: var(--primary-color);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.85rem;
            margin-top: 0.75rem;
            font-weight: 500;
        }
        
        .infographic-image {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .infographic-image:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .contact-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 12px;
            padding: 2.5rem;
            margin-top: 3rem;
        }
        
        .contact-section h3 {
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            padding-bottom: 1rem;
        }
        
        .contact-section h3:after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 80px;
            height: 3px;
            background-color: white;
            transform: translateX(-50%);
        }
        
        .contact-card {
            text-align: center;
            padding: 1.5rem;
            background-color: rgba(255,255,255,0.1);
            border-radius: 8px;
            height: 100%;
            transition: all 0.3s ease;
        }
        
        .contact-card:hover {
            background-color: rgba(255,255,255,0.2);
            transform: translateY(-5px);
        }
        
        .contact-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: white;
        }
        
        .contact-card h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .contact-card p {
            margin-bottom: 0.25rem;
        }
        
        /* Modal Styles */
        .enlargeable-image {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .modal {
            background-color: rgba(0, 0, 0, 0.9) !important;
        }
        
        .modal-content {
            background: transparent;
            border: none;
        }
        
        .modal-body {
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        
        .modal-body img {
            max-width: 90%;
            max-height: 90vh;
            border-radius: 8px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.3);
        }
        
        .btn-close-white {
            filter: invert(1);
            opacity: 0.8;
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 10;
        }
        
        .btn-close-white:hover {
            opacity: 1;
        }
        
        @media (max-width: 768px) {
            .infographic-section {
                padding: 1.5rem;
            }
            
            .facility-card {
                padding: 1.25rem;
            }
            
            .contact-section {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar (kept exactly as provided) -->
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
    <main class="infographic-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Tempahan Ruang dan Kemudahan</h1>
            <p>Maklumat berkaitan ruang dan kemudahan yang ditawarkan oleh UiTM Cawangan Johor, Kampus Pasir Gudang.</p>
        </div>

        <!-- First Infographic Section -->
        <div class="infographic-section p-4">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <img src="{{ asset('images/display1.png') }}" 
                         class="img-fluid infographic-image enlargeable-image" 
                         alt="Dewan Kuliah dan Bilik" 
                         data-bs-toggle="modal" 
                         data-bs-target="#imageModal" 
                         data-img-src="{{ asset('images/display1.png') }}">
                </div>
                <div class="col-lg-9 col-md-8">
                    <h3 class="section-title">Dewan Kuliah & Bilik Khas</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>DK 200</h5>
                                <span class="capacity-badge"><i class="fas fa-users me-1"></i> Kapasiti: 100-200 orang</span>
                                <ul class="facility-features">
                                    <li>Projector berkualiti tinggi</li>
                                    <li>White board bersaiz besar</li>
                                    <li>Sistem PA yang jelas</li>
                                    <li>Penghawa dingin terkawal</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>DK 100 A & B</h5>
                                <span class="capacity-badge"><i class="fas fa-users me-1"></i> Kapasiti: Bawah 100 orang</span>
                                <ul class="facility-features">
                                    <li>Projector HD</li>
                                    <li>White board mudah alih</li>
                                    <li>Sistem PA bersepadu</li>
                                    <li>Kawalan suhu individu</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>Bilik Mesyuarat</h5>
                                <span class="capacity-badge"><i class="fas fa-users me-1"></i> Kapasiti: 20-30 orang</span>
                                <ul class="facility-features">
                                    <li>Projector LCD</li>
                                    <li>White board interaktif</li>
                                    <li>Sistem audio persidangan</li>
                                    <li>Meja persidangan berbentuk U</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>Bilik Seminar</h5>
                                <span class="capacity-badge"><i class="fas fa-users me-1"></i> Kapasiti: Bawah 40 orang</span>
                                <ul class="facility-features">
                                    <li>Susunan kerusi teater</li>
                                    <li>Papan putih elektronik</li>
                                    <li>Rostrum profesional</li>
                                    <li>Sistem rakaman persidangan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Infographic Section -->
        <div class="infographic-section p-4">
            <div class="row align-items-center">
                <div class="col-lg-9 col-md-8 order-lg-1 order-md-1">
                    <h3 class="section-title">Kemudahan Sukan & Expo</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>Arena Sukan</h5>
                                <ul class="facility-features">
                                    <li>Padang Bola Sepak berukuran standard FIFA</li>
                                    <li>Gelanggang Bolatampar berpermukaan khas</li>
                                    <li>Gelanggang Sepak Takraw bertaraf antarabangsa</li>
                                    <li>Gelanggang Futsal dengan pencahayaan LED</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>Tapak Jualan & Expo</h5>
                                <ul class="facility-features">
                                    <li>Parkir Non Resident yang luas</li>
                                    <li>Pakej lengkap termasuk:
                                        <ul style="list-style-type: circle; padding-left: 1.5rem;">
                                            <li>Projector laser 4K</li>
                                            <li>Sistem PA profesional</li>
                                            <li>Kawalan hawa dingin zon</li>
                                        </ul>
                                    </li>
                                    <li>Ruang pameran modular</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>Foodtruck/Caravan</h5>
                                <ul class="facility-features">
                                    <li>Cas pengurusan yang kompetitif</li>
                                    <li>Tapak sewaan dengan kemudahan asas</li>
                                    <li>Lokasi strategik berhampiran kawasan tumpuan</li>
                                    <li>Kemudahan elektrik dan air</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 order-lg-2 order-md-2 mb-4 mb-md-0">
                    <img src="{{ asset('images/display2.png') }}" 
                         class="img-fluid infographic-image enlargeable-image" 
                         alt="Kemudahan Sukan" 
                         data-bs-toggle="modal" 
                         data-bs-target="#imageModal" 
                         data-img-src="{{ asset('images/display2.png') }}">
                </div>
            </div>
        </div>

        <!-- Third Infographic Section -->
        <div class="infographic-section p-4">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <img src="{{ asset('images/display3.png') }}" 
                         class="img-fluid infographic-image enlargeable-image" 
                         alt="Bilik Kuliah dan Seminar" 
                         data-bs-toggle="modal" 
                         data-bs-target="#imageModal" 
                         data-img-src="{{ asset('images/display3.png') }}">
                </div>
                <div class="col-lg-9 col-md-8">
                    <h3 class="section-title">Bilik Kuliah & Seminar</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>Bilik Kuliah</h5>
                                <span class="capacity-badge"><i class="fas fa-users me-1"></i> Kapasiti: Bawah 40 orang</span>
                                <ul class="facility-features">
                                    <li>White board magnetik</li>
                                    <li>TV LCD 65" dengan Smart Capabilities</li>
                                    <li>Sistem kawalan iklim individu</li>
                                    <li>Meja dan kerusi ergonomik</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>Bilik TEC</h5>
                                <span class="capacity-badge"><i class="fas fa-users me-1"></i> Kapasiti: Bawah 40 orang</span>
                                <ul class="facility-features">
                                    <li>White board interaktif</li>
                                    <li>TV LCD dengan sambungan HDMI</li>
                                    <li>Sistem pengudaraan terkawal</li>
                                    <li>Susunan meja seminar</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>Dewan Seminar</h5>
                                <span class="capacity-badge"><i class="fas fa-users me-1"></i> Kapasiti: 100-120 orang</span>
                                <ul class="facility-features">
                                    <li>Projector laser ultra HD</li>
                                    <li>Sistem PA dengan mikrofon tanpa wayar</li>
                                    <li>Kawalan suhu zon</li>
                                    <li>Sistem rakaman automatik</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="facility-card">
                                <h5>Bangunan Khawarizmi</h5>
                                <p class="mb-2">Lokasi strategik di pusat kampus dengan kemudahan:</p>
                                <ul class="facility-features">
                                    <li>Akses kad pintar</li>
                                    <li>WiFi kelajuan tinggi</li>
                                    <li>Kawasan rehat staf</li>
                                    <li>Bilik Peperiksaan terkawal</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <h3>Hubungi Kami</h3>
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="contact-card">
                        <i class="fas fa-phone-alt contact-icon"></i>
                        <h5>Unit Residensi dan Hospitaliti Pelajar</h5>
                        <p><i class="fas fa-phone me-2"></i> 07-381 8722</p>
                        <p><i class="fas fa-envelope me-2"></i> urusetia@uitm.edu.my</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="contact-card">
                        <i class="fas fa-user-tie contact-icon"></i>
                        <h5>En Syamaiza Bin Ibrahim</h5>
                        <p>Pegawai Eksekutif Kanan</p>
                        <p><i class="fas fa-mobile-alt me-2"></i> 012-448 4566</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <i class="fas fa-user-tie contact-icon"></i>
                        <h5>En Zahirizal Bin Miskom</h5>
                        <p>Penolong Pendaftar Kanan</p>
                        <p><i class="fas fa-mobile-alt me-2"></i> 012-731 2840</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 bg-transparent">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid" alt="Enlarged view">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modal image source
            var imageModal = document.getElementById('imageModal');
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
        });
    </script>
</body>
</html>