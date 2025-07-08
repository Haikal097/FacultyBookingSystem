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
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.manageuser') }}" class="nav-link active"><i class="fas fa-users"></i>Manage Users</a>
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
            <h2>Manage Users</h2>
            <div class="d-flex align-items-center">
                <form method="GET" action="{{ url()->current() }}" class="search-box me-3">
                    @csrf
                    <div class="search-box me-3 position-relative">
                    <i class="fas fa-search"></i>
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Search users..."
                        value="{{ request('search') }}"
                    >
                </div>
                </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Users</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>IC Number</th>
                            <!--<th>Actions</th>-->
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        <!-- JavaScript will inject user rows here -->
                    </tbody>

                </table>
            </div>
            
            <!-- Pagination Footer -->
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted" id="user-pagination-info">
                    <!-- Showing X to Y of Z entries -->
                </div>
                <nav aria-label="User page navigation">
                    <ul class="pagination mb-0" id="user-pagination-links">
                        <!-- Pagination buttons -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchUsers(); // initial load

        async function fetchUsers(page = 1, search = '') {
            try {
                const response = await fetch(`/api/users?page=${page}&search=${encodeURIComponent(search)}`);
                const result = await response.json();

                if (response.ok && result.data) {
                    renderUsers(result.data.data); // the actual array of users
                    renderUserPagination(result.data); // pagination metadata
                } else {
                    alert('Failed to load users.');
                }
            } catch (err) {
                console.error(err);
                alert('Error fetching users.');
            }
        }

        function renderUsers(users) {
            const tbody = document.getElementById('user-table-body');
            tbody.innerHTML = '';

            if (users.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-center">No users found.</td></tr>`;
                return;
            }

            users.forEach((user, index) => {
                tbody.insertAdjacentHTML('beforeend', `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            </div>
                        </td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.phone_number || '-'}</td>
                        <td>${user.ic_number || '-'}</td>
                    </tr>
                `);
            });
        }

        function renderUserPagination(data) {
            const info = document.getElementById('user-pagination-info');
            const links = document.getElementById('user-pagination-links');

            info.textContent = `Showing ${data.from} to ${data.to} of ${data.total} entries`;
            links.innerHTML = '';

            for (let page = 1; page <= data.last_page; page++) {
                const li = document.createElement('li');
                li.className = `page-item ${page === data.current_page ? 'active' : ''}`;

                const btn = document.createElement('button');
                btn.className = 'page-link';
                btn.textContent = page;
                btn.onclick = () => fetchUsers(page);

                li.appendChild(btn);
                links.appendChild(li);
            }
        }

        // Optional: debounce live search
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            let debounce;
            searchInput.addEventListener('input', () => {
                clearTimeout(debounce);
                debounce = setTimeout(() => {
                    fetchUsers(1, searchInput.value);
                }, 400);
            });

            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    fetchUsers(1, searchInput.value);
                }
            });
        }
    });
    </script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>