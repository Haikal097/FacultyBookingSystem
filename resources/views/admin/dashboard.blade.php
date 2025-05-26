<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #1a237e;
            --sidebar-active: #3949ab;
            --primary-color: #4a6bff;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }
        
        .sidebar {
            height: 100vh;
            position: fixed;
            width: 280px;
            background: var(--sidebar-bg);
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
        }
        
        .sidebar-brand h4 {
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            border-radius: 6px;
            margin: 0.25rem 1rem;
            padding: 0.75rem 1rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            background: var(--sidebar-active);
            color: white;
        }
        
        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 10px;
        }
        
        .content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .header h2 {
            font-weight: 600;
            color: #333;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .card .card-body {
            padding: 1.5rem;
        }
        
        .card .card-title {
            font-size: 1rem;
            font-weight: 500;
            color: rgba(0,0,0,0.6);
            margin-bottom: 0.5rem;
        }
        
        .card .card-text {
            font-size: 1.75rem;
            font-weight: 600;
            color: #333;
        }
        
        .btn-logout {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            padding: 0.75rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            margin: 1rem;
        }
        
        .btn-logout:hover {
            background: var(--danger-color);
        }
        
        .welcome-message {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        
        .welcome-message p {
            color: #666;
            margin-bottom: 0;
        }
        
        /* Custom card colors */
        .bg-primary {
            background: linear-gradient(135deg, var(--primary-color), #6a8aff) !important;
        }
        
        .bg-success {
            background: linear-gradient(135deg, var(--success-color), #6bc76b) !important;
        }
        
        .bg-warning {
            background: linear-gradient(135deg, var(--warning-color), #ffb74d) !important;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="sidebar-brand">
            <h4><i class="fas fa-shield-alt me-2"></i>Admin Panel</h4>
        </div>
        <ul class="nav nav-pills flex-column flex-grow-1">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.manageuser') }}" class="nav-link"><i class="fas fa-users"></i>Manage Users</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('rooms.index') }}" class="nav-link"><i class="fas fa-door-open"></i>Manage Rooms</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.managebooking') }}" class="nav-link"><i class="fas fa-calendar-check"></i>Manage Bookings</a>
            </li>
            <!--
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-cog"></i>Settings</a>
            </li>-->
        </ul>
        <form method="POST" action="{{ route('logout') }}" class="mt-auto px-5">
            @csrf
            <button type="submit" class="btn btn-logout w-75">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h2>Welcome Back, Admin</h2>
        </div>
        
        <div class="welcome-message">
            <p>Here's what's happening with your facility management system today.</p>
        </div>

        <!-- Dashboard Cards -->
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">TOTAL USERS</h5>
                                <p class="card-text">{{ $totalUsers - 1}}</p>
                            </div>
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">TODAY'S BOOKINGS</h5>
                                <p class="card-text">{{ $todaysBookings }}</p>
                            </div>
                            <i class="fas fa-calendar-check fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">AVAILABLE ROOMS</h5>
                                <p class="card-text">{{ $availableRooms }}</p>
                            </div>
                            <i class="fas fa-door-open fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-4 border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h5 class="card-title mb-0 fw-semibold d-flex align-items-center">
                        <i class="fas fa-clock text-warning me-2"></i>
                        Recent Pending Bookings
                    </h5>
                </div>
                
                <div class="list-group list-group-flush">
                    @forelse($pendingBookings as $booking)
                    <div class="list-group-item border-0 py-3 px-4 hover-bg-light">
                        <div class="d-flex justify-content-between align-items-start">
                            <!-- Left Content -->
                            <div class="d-flex align-items-start flex-grow-1">
                                <div class="bg-warning bg-opacity-10 p-2 rounded-2 me-3 text-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-clock text-warning"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-wrap align-items-center mb-1">
                                        <h6 class="mb-0 me-2 fw-semibold">{{ $booking->purpose_type }}</h6>
                                        <span class="badge bg-warning bg-opacity-15 text-white fs-11 fw-normal me-3">
                                            Pending
                                        </span>

                                        <span class="small text-muted d-flex align-items-center">
                                            <i class="fas fa-money-bill-wave me-1 text-success"></i> 
                                            <span class="fw-semibold text-dark">Total Price:</span>&nbsp;RM{{ number_format($booking->total_price, 2) }}
                                        </span>
                                    </div>

                                    <p class="small text-muted mb-1">
                                        <i class="fas fa-door-open me-1"></i> {{ $booking->room->name }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-calendar-day me-1"></i> {{ Carbon\Carbon::parse($booking->booking_date)->format('D, M j') }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-clock me-1"></i> {{ Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}-{{ Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-2">
                                            <div class="avatar-title bg-light rounded-circle text-primary">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <small class="text-muted">Requested by {{ $booking->user->name }}</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Content -->
                            <div class="d-flex flex-column align-items-end">
                                <small class="text-muted mb-2">{{ $booking->created_at->diffForHumans() }}</small>
                                <div class="btn-group btn-group-sm gap-2">
                                    <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success px-3" title="Approve" data-bs-toggle="tooltip">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-3" title="Reject" data-bs-toggle="tooltip">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item border-0 py-4 text-center">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="avatar-lg mb-3">
                                <div class="avatar-title bg-light rounded-circle text-muted">
                                    <i class="fas fa-calendar-times fs-24"></i>
                                </div>
                            </div>
                            <h5 class="text-muted mb-1">No Pending Bookings</h5>
                            <p class="text-muted mb-0">All bookings are processed</p>
                        </div>
                    </div>
                    @endforelse
                </div>
                
                @if($pendingBookings->count() > 0)
                <div class="card-footer bg-white border-top py-3 px-4">
                    <a href="{{ route('admin.managebooking', ['filter' => 'pending']) }}" class="btn btn-link text-decoration-none px-0">
                        View All Pending Bookings <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <style>
            .hover-bg-light:hover {
                background-color: #f8f9fa;
                transition: background-color 0.2s ease;
            }
            .fs-11 {
                font-size: 11px;
            }
            .fs-24 {
                font-size: 24px;
            }
            .avatar-xs {
                width: 24px;
                height: 24px;
            }
            .avatar-lg {
                width: 72px;
                height: 72px;
            }
            .avatar-title {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
            }
        </style>

        <script>
            // Initialize tooltips
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
                
                // Add confirmation dialogs
                document.querySelectorAll('form[action*="approve"]').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        if (!confirm('Are you sure you want to approve this booking?')) {
                            e.preventDefault();
                        }
                    });
                });
                
                document.querySelectorAll('form[action*="reject"]').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        if (!confirm('Are you sure you want to reject this booking?')) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>