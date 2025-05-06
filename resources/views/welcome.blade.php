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
    <div class="container-fluid ps-0"> <!-- Added ps-0 to override container padding -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand me-4" href="#">Navbar</a>
            <div class="navbar-nav">
                <a class="nav-link active pe-3" href="#">Home</a> <!-- Added pe-3 for spacing between links -->
                <a class="nav-link pe-3" href="#">Features</a>
                <a class="nav-link pe-3" href="#">Pricing</a>
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </div>
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
        <div class="position-relative overflow-hidden" style="height: 500px; margin-top: 10px; border-radius: 70px 0 70px 0">
        <!-- Background Image -->
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: url('{{ asset('images/uitmimage.jpg') }}') center/cover no-repeat; border-radius: inherit;">
        </div>
        
        <!-- Dark Overlay -->
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50" style="border-radius: inherit;"></div>
        
        <!-- Content -->
        <div class="position-relative container h-100 d-flex flex-column justify-content-center text-white ps-5">
            <h1 class="display-1 ps-3 ps-md-5">Welcome to Our Site</h1>
            <p class="lead fs-3 ps-3 ps-md-5">This is some introductory text</p>
        </div>
    </div>
    <!-- Action Buttons Section -->
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary btn-lg w-100 h-100 py-4 d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-calendar-check fa-2x mb-2"></i>
                    Book a Room
                </a>
            </div>
            <div class="col-md-6">
                <a href="#" class="btn btn-dark btn-lg w-100 h-100 py-4 d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-door-open fa-2x mb-2"></i>
                    View Available Rooms
                </a>
            </div>
        </div>
    </div>
    </main>
</body>
</html>
