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
        <div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex align-items-center" style="height: 50px;">
            <h4 class="mb-0 fw-bold">User Profile</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Column - User Info (30%) -->
                <div class="col-lg-3 border-end">
                    <div class="user-profile text-center">
                        <div class="avatar-placeholder rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                            <i class="fas fa-user fa-3x text-secondary"></i>
                        </div>
                        
                        <div class="user-details text-start">
                            <div class="detail-item mb-3 p-3 bg-light rounded">
                                <div class="fw-bold small">IC Number</div>
                                <div>901025-14-5678</div>
                            </div>
                            
                            <div class="detail-item mb-3 p-3 bg-light rounded">
                                <div class="fw-bold small">Full Name</div>
                                <div>Ahmad bin Abdullah</div>
                            </div>
                            
                            <div class="detail-item mb-3 p-3 bg-light rounded">
                                <div class="fw-bold small">Email</div>
                                <div>ahmad.abdullah@example.com</div>
                            </div>
                            
                            <div class="detail-item mb-3 p-3 bg-light rounded">
                                <div class="fw-bold small">Phone Number</div>
                                <div>+6012-345 6789</div>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                    <i class="fas fa-edit me-2"></i>Edit Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Booking History (70%) -->
                <div class="col-lg-9">
                    <h5 class="mb-4 fw-bold">Booking History</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Facility</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dummy Booking Data -->
                                <tr>
                                    <td>BK-2023-001</td>
                                    <td>Dewan Kuliah 200</td>
                                    <td>15 Jan 2023</td>
                                    <td>09:00 - 12:00</td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BK-2023-002</td>
                                    <td>Gelanggang Futsal</td>
                                    <td>18 Jan 2023</td>
                                    <td>14:00 - 16:00</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BK-2023-003</td>
                                    <td>Bilik Mesyuarat</td>
                                    <td>20 Jan 2023</td>
                                    <td>10:00 - 11:30</td>
                                    <td><span class="badge bg-danger">Rejected</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BK-2023-004</td>
                                    <td>Dewan Seminar</td>
                                    <td>25 Jan 2023</td>
                                    <td>08:00 - 17:00</td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <nav aria-label="Booking pagination">
                        <ul class="pagination justify-content-center mt-4">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ic_number" class="form-label">IC Number</label>
                            <input type="text" class="form-control" id="ic_number" name="ic_number" value="901025-14-5678" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="Ahmad bin Abdullah" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="ahmad.abdullah@example.com" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="+6012-345 6789" required>
                        </div>
                    </div>
                    
                    <!-- Add password change fields if needed -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .avatar-placeholder {
        border: 3px solid #dee2e6;
        margin-top: -50px;
        background: white !important;
    }
    
    .detail-item {
        transition: all 0.2s ease;
    }
    
    .detail-item:hover {
        background-color: #e9ecef !important;
    }
    
    .table th {
        white-space: nowrap;
    }
    
    .border-end {
        border-right: 1px solid #dee2e6 !important;
    }
    
    @media (max-width: 992px) {
        .border-end {
            border-right: none !important;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 2rem;
            margin-bottom: 2rem;
        }
    }
</style>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </main>
</body>
</html>
