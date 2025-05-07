<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Admin Dashboard</title>

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
                <a href="#" class="nav-link active"><i class="fas fa-users"></i>Manage Users</a>
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
            <h2>Manage Users</h2>
            <div class="d-flex align-items-center">
                <div class="search-box me-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search users...">
                </div>
                <button class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add User
                </button>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Users</h5>
                <div class="d-flex">
                    <select class="form-select form-select-sm me-2" style="width: 120px;">
                        <option>Filter by</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Admins</option>
                    </select>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- User 1 -->
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Ahmad bin Abdullah</h6>
                                        <small class="text-muted">901025-14-5678</small>
                                    </div>
                                </div>
                            </td>
                            <td>ahmad.abdullah@example.com</td>
                            <td>+6012-345 6789</td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">Admin</span></td>
                            <td><span class="badge bg-success bg-opacity-10 text-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- User 2 -->
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Siti Nurhaliza</h6>
                                        <small class="text-muted">900305-08-1234</small>
                                    </div>
                                </div>
                            </td>
                            <td>siti.nurhaliza@example.com</td>
                            <td>+6013-456 7890</td>
                            <td><span class="badge bg-info bg-opacity-10 text-info">Staff</span></td>
                            <td><span class="badge bg-success bg-opacity-10 text-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- User 3 -->
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Lim Wei Jie</h6>
                                        <small class="text-muted">950712-10-5678</small>
                                    </div>
                                </div>
                            </td>
                            <td>lim.weijie@example.com</td>
                            <td>+6011-234 5678</td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary">Student</span></td>
                            <td><span class="badge bg-success bg-opacity-10 text-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- User 4 -->
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-danger rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Rajesh Kumar</h6>
                                        <small class="text-muted">880430-05-1234</small>
                                    </div>
                                </div>
                            </td>
                            <td>rajesh.kumar@example.com</td>
                            <td>+6016-789 0123</td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary">Student</span></td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- User 5 -->
                        <tr>
                            <td>5</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Tan Mei Ling</h6>
                                        <small class="text-muted">920815-14-9876</small>
                                    </div>
                                </div>
                            </td>
                            <td>tan.meiling@example.com</td>
                            <td>+6017-890 1234</td>
                            <td><span class="badge bg-info bg-opacity-10 text-info">Staff</span></td>
                            <td><span class="badge bg-danger bg-opacity-10 text-danger">Inactive</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Showing 1 to 5 of 25 entries
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>