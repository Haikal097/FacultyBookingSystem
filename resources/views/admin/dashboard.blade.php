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
                <a href="#" class="nav-link active"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-users"></i>Manage Users</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-door-open"></i>Manage Rooms</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-calendar-check"></i>Manage Bookings</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-cog"></i>Settings</a>
            </li>
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
            <div class="d-flex align-items-center">
                <span class="me-3">Last login: Today, 10:30 AM</span>
                <div class="avatar bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-user text-white"></i>
                </div>
            </div>
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
                                <p class="card-text">142</p>
                            </div>
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                        <div class="mt-2">
                            <span class="small">+12% from last month</span>
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
                                <p class="card-text">27</p>
                            </div>
                            <i class="fas fa-calendar-check fa-2x opacity-50"></i>
                        </div>
                        <div class="mt-2">
                            <span class="small">+3 from yesterday</span>
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
                                <p class="card-text">14</p>
                            </div>
                            <i class="fas fa-door-open fa-2x opacity-50"></i>
                        </div>
                        <div class="mt-2">
                            <span class="small">3 currently in maintenance</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity Section -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Recent Activity</h5>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action border-0 mb-2 rounded">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-user-plus text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">New user registered</h6>
                                    <p class="mb-0 small text-muted">John Doe signed up 30 minutes ago</p>
                                </div>
                            </div>
                            <small class="text-muted">Just now</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 mb-2 rounded">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-calendar-check text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">New booking</h6>
                                    <p class="mb-0 small text-muted">Dewan Kuliah 200 booked for tomorrow</p>
                                </div>
                            </div>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 rounded">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-exclamation-triangle text-warning"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Maintenance scheduled</h6>
                                    <p class="mb-0 small text-muted">Bilik Mesyuarat 3 under maintenance</p>
                                </div>
                            </div>
                            <small class="text-muted">5 hours ago</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>