<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Admin Dashboard</title>

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
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.25rem 1.5rem;
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-top: none;
        }
        
        .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }
        
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
        
        .btn-action {
            padding: 0.35rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .search-box {
            position: relative;
            max-width: 300px;
        }
        
        .search-box .form-control {
            padding-left: 2.5rem;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }
        
        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        
        .pagination .page-link {
            border-radius: 6px !important;
            margin: 0 3px;
            border: none;
            color: #495057;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
        }
        
        .booking-status {
            display: inline-flex;
            align-items: center;
        }
        
        .booking-status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 6px;
        }
        
        .calendar-icon {
            color: var(--primary-color);
            margin-right: 5px;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
        
        .booking-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 0.5rem;
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
                <a href="#" class="nav-link"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-users"></i>Manage Users</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-door-open"></i>Manage Rooms</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link active"><i class="fas fa-calendar-check"></i>Manage Bookings</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-cog"></i>Settings</a>
            </li>
        </ul>
        <form method="POST" action="{{ route('logout') }}" class="mt-auto px-3 pb-3">
            @csrf
            <button type="submit" class="btn btn-logout w-100 py-2">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h2>Manage Bookings</h2>
            <div class="d-flex align-items-center">
                <div class="search-box me-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search bookings...">
                </div>
                <div class="btn-group me-3">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Week</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Pending Approval</a></li>
                        <li><a class="dropdown-item" href="#">Approved</a></li>
                        <li><a class="dropdown-item" href="#">Rejected</a></li>
                    </ul>
                </div>
                <button class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>New Booking
                </button>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Bookings</h5>
                <div class="d-flex">
                    <input type="date" class="form-control form-control-sm me-2" style="width: 150px;">
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Event</th>
                            <th>Room</th>
                            <th>User</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Booking 1 -->
                        <tr>
                            <td>BK-2023-001</td>
                            <td>
                                <strong>CS101 Lecture</strong>
                                <div class="booking-details small">
                                    <div><i class="fas fa-user-tie me-1"></i> Prof. Ahmad</div>
                                    <div><i class="fas fa-users me-1"></i> 120 students</div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-door-open me-2"></i>
                                    <div>
                                        <div>Dewan Kuliah 200</div>
                                        <small class="text-muted">Academic Building</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="user-avatar">
                                    <div>
                                        <div>Ahmad bin Abdullah</div>
                                        <small class="text-muted">Faculty</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div><i class="fas fa-calendar-day calendar-icon"></i> Mon, 15 Jan 2023</div>
                                <div><i class="fas fa-clock calendar-icon"></i> 09:00 - 12:00</div>
                            </td>
                            <td>
                                <span class="booking-status">
                                    <span class="booking-status-dot bg-success"></span>
                                    Approved
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Cancel">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary btn-action ms-1" title="Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Booking 2 -->
                        <tr>
                            <td>BK-2023-002</td>
                            <td>
                                <strong>Department Meeting</strong>
                                <div class="booking-details small">
                                    <div><i class="fas fa-user-tie me-1"></i> Dr. Siti</div>
                                    <div><i class="fas fa-users me-1"></i> 15 staff</div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-door-open me-2"></i>
                                    <div>
                                        <div>Bilik Mesyuarat Utama</div>
                                        <small class="text-muted">Admin Building</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="user-avatar">
                                    <div>
                                        <div>Siti Nurhaliza</div>
                                        <small class="text-muted">HOD</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div><i class="fas fa-calendar-day calendar-icon"></i> Tue, 16 Jan 2023</div>
                                <div><i class="fas fa-clock calendar-icon"></i> 14:00 - 16:00</div>
                            </td>
                            <td>
                                <span class="booking-status">
                                    <span class="booking-status-dot bg-success"></span>
                                    Approved
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Cancel">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary btn-action ms-1" title="Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Booking 3 -->
                        <tr>
                            <td>BK-2023-003</td>
                            <td>
                                <strong>Programming Lab</strong>
                                <div class="booking-details small">
                                    <div><i class="fas fa-user-tie me-1"></i> Mr. Lim</div>
                                    <div><i class="fas fa-users me-1"></i> 25 students</div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-door-open me-2"></i>
                                    <div>
                                        <div>Makmal Komputer 1</div>
                                        <small class="text-muted">ICT Building</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/75.jpg" class="user-avatar">
                                    <div>
                                        <div>Lim Wei Jie</div>
                                        <small class="text-muted">Lecturer</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div><i class="fas fa-calendar-day calendar-icon"></i> Wed, 17 Jan 2023</div>
                                <div><i class="fas fa-clock calendar-icon"></i> 10:00 - 12:00</div>
                            </td>
                            <td>
                                <span class="booking-status">
                                    <span class="booking-status-dot bg-success"></span>
                                    Approved
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Cancel">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary btn-action ms-1" title="Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Booking 4 -->
                        <tr>
                            <td>BK-2023-004</td>
                            <td>
                                <strong>Sports Day Practice</strong>
                                <div class="booking-details small">
                                    <div><i class="fas fa-user-tie me-1"></i> Coach Rajesh</div>
                                    <div><i class="fas fa-users me-1"></i> Football Team</div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-door-open me-2"></i>
                                    <div>
                                        <div>Gelanggang Futsal</div>
                                        <small class="text-muted">Sports Complex</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/22.jpg" class="user-avatar">
                                    <div>
                                        <div>Rajesh Kumar</div>
                                        <small class="text-muted">Coach</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div><i class="fas fa-calendar-day calendar-icon"></i> Thu, 18 Jan 2023</div>
                                <div><i class="fas fa-clock calendar-icon"></i> 16:00 - 18:00</div>
                            </td>
                            <td>
                                <span class="booking-status">
                                    <span class="booking-status-dot bg-warning"></span>
                                    Pending
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-success btn-action me-1" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action me-1" title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary btn-action" title="Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Booking 5 -->
                        <tr>
                            <td>BK-2023-005</td>
                            <td>
                                <strong>Research Presentation</strong>
                                <div class="booking-details small">
                                    <div><i class="fas fa-user-tie me-1"></i> Dr. Tan</div>
                                    <div><i class="fas fa-users me-1"></i> 8 attendees</div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-door-open me-2"></i>
                                    <div>
                                        <div>Seminar Room 2</div>
                                        <small class="text-muted">Research Building</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/63.jpg" class="user-avatar">
                                    <div>
                                        <div>Tan Mei Ling</div>
                                        <small class="text-muted">Researcher</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div><i class="fas fa-calendar-day calendar-icon"></i> Fri, 19 Jan 2023</div>
                                <div><i class="fas fa-clock calendar-icon"></i> 13:00 - 15:00</div>
                            </td>
                            <td>
                                <span class="booking-status">
                                    <span class="booking-status-dot bg-danger"></span>
                                    Rejected
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary btn-action ms-1" title="Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Showing 1 to 5 of 23 bookings
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Booking Details Modal -->
    <div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-labelledby="bookingDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="bookingDetailsModalLabel">Booking Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h4>CS101 Lecture</h4>
                            <p class="text-muted">Weekly class for Computer Science students</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="badge bg-success fs-6">Approved</span>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">BOOKED BY</h6>
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="user-avatar">
                                        <div>
                                            <div class="fw-bold">Ahmad bin Abdullah</div>
                                            <div class="text-muted small">Faculty of Computer Science</div>
                                            <div class="text-muted small">ahmad.abdullah@university.edu</div>
                                            <div class="text-muted small">+6012-345 6789</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">ROOM DETAILS</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="room-type-icon bg-primary bg-opacity-10 text-primary me-3">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Dewan Kuliah 200</div>
                                            <div class="text-muted small">Academic Building, Floor 2</div>
                                            <div class="text-muted small">Capacity: 200 people</div>
                                            <div class="text-muted small">Features: Projector, AC, Sound System</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">DATE & TIME</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="calendar-icon-large bg-primary bg-opacity-10 text-primary me-3" style="width: 50px; height: 50px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-calendar-day fa-lg"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Monday, 15 January 2023</div>
                                            <div class="text-muted">09:00 AM - 12:00 PM (3 hours)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">ATTENDEES</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="calendar-icon-large bg-primary bg-opacity-10 text-primary me-3" style="width: 50px; height: 50px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-users fa-lg"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">120 students</div>
                                            <div class="text-muted">CS101 Class</div>
                                            <div class="text-muted">Lecturer: Prof. Ahmad</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="card-title text-muted">ADDITIONAL INFORMATION</h6>
                            <p>Please ensure the projector is working properly before the class starts. We will need the sound system for video presentations.</p>
                            <div class="d-flex">
                                <span class="badge bg-light text-dark me-2">Projector</span>
                                <span class="badge bg-light text-dark me-2">Sound System</span>
                                <span class="badge bg-light text-dark">AC</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Print Details</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Activate tooltips for action buttons
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>