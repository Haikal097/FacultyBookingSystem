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
            <!-- Left links -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand me-4" href="#">Navbar</a>
                <div class="navbar-nav">
                    <a class="nav-link active pe-3" href="#">Home</a>
                    <a class="nav-link pe-3" href="#">Features</a>
                </div>
            </div>

            <!-- Right-aligned Navbar Content -->
            <div class="ms-auto d-flex align-items-center pe-4">
                @auth
                    <a class="nav-link" href="{{ route('userprofile') }}">
                        <i class="fas fa-user-circle fa-3x"></i>
                    </a>
                @endauth

                @guest
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
        <div class="container my-5">
            <h2 class="mb-4">Book a Room</h2>

            <form action="{{ route('bookings.store') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
                @csrf

                <!-- Room Selection -->
                <div class="mb-3">
                    <label for="room_id" class="form-label">Select Room</label>
                    <select name="room_id" id="room_id" class="form-select" required>
                        <option value="" disabled selected>-- Choose a Room --</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }} ({{ $room->type }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div class="mb-3">
                    <label for="booking_date" class="form-label">Date</label>
                    <input type="date" name="booking_date" id="booking_date" class="form-control" required>
                </div>

                <!-- Time Slot -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" name="start_time" id="start_time" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" name="end_time" id="end_time" class="form-control" required>
                    </div>
                </div>

                <!-- Purpose -->
                <div class="mb-3">
                    <label for="purpose" class="form-label">Purpose</label>
                    <textarea name="purpose" id="purpose" rows="3" class="form-control" placeholder="Meeting, Lecture, Discussion, etc." required></textarea>
                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check-circle me-1"></i> Confirm Booking
                    </button>
                </div>
            </form>
        </div>


    </main>
</body>
</html>
