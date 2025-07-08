<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Rooms - Admin Dashboard</title>

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
        
        .room-type-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
        
        .room-capacity {
            display: inline-flex;
            align-items: center;
            background-color: #f8f9fa;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
        }
        
        .room-status {
            display: inline-flex;
            align-items: center;
        }
        
        .room-status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 6px;
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
        /* Add to your existing styles */
        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .modal-header {
            border-radius: 10px 10px 0 0 !important;
            padding: 1.25rem 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid #eee;
            padding: 1rem 1.5rem;
        }

        /* Set fixed width for actions column */
        table th:nth-child(5),
        table td:nth-child(5) {  /* Price column */
            width: 120px;
            min-width: 120px;
        }

        table th:nth-child(7),
        table td:nth-child(7) {
            width: 120px; /* Adjust as needed */
            min-width: 120px;
            white-space: nowrap;
        }
        
        /* Add spacing between action buttons */
        .btn-action {
            margin-right: 6px; /* Space between buttons */
        }
        .btn-action:last-child {
            margin-right: 0;
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
                <a href="{{ route('admin.manageuser') }}" class="nav-link"><i class="fas fa-users"></i>Manage Users</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('rooms.index') }}" class="nav-link active"><i class="fas fa-door-open"></i>Manage Rooms</a>
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
            <h2>Manage Rooms</h2>
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: transparent; border-bottom: none;">
                    <!-- Your existing title and filters -->
                    <form method="GET" class="ms-auto me-3">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="search" class="form-control" placeholder="Search rooms..." 
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                        <i class="fas fa-plus me-2"></i>Add Room
                    </button>
                </div>
        </div>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Rooms</h5>
                <div class="d-flex">
                    <form id="filterForm" method="GET" class="d-flex">
                        <select name="type" class="form-select form-select-sm me-2" style="width: 150px;" onchange="this.form.submit()">
                            <option value="All Types" {{ request('type') == 'All Types' ? 'selected' : '' }}>All Types</option>
                            <option value="Lecture Hall" {{ request('type') == 'Lecture Hall' ? 'selected' : '' }}>Lecture Hall</option>
                            <option value="Meeting Room" {{ request('type') == 'Meeting Room' ? 'selected' : '' }}>Meeting Room</option>
                            <option value="Computer Lab" {{ request('type') == 'Computer Lab' ? 'selected' : '' }}>Computer Lab</option>
                            <option value="Sports Facility" {{ request('type') == 'Sports Facility' ? 'selected' : '' }}>Sports Facility</option>
                        </select>
                        <select name="status" class="form-select form-select-sm me-2" style="width: 140px;" onchange="this.form.submit()">
                            <option value="All Statuses" {{ request('status') == 'All Statuses' ? 'selected' : '' }}>All Statuses</option>
                            <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Maintenance" {{ request('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                        
                        <!-- Hidden fields to preserve other query parameters -->
                        @if(request()->has('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if(request()->has('type') || request()->has('status'))
                            <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary ms-2">
                                Reset Filters
                            </a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Type</th>
                            <th>Capacity</th>
                            <th>Building</th>
                            <th style="width: 150px;">Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                        @php
                            $typeIcons = [
                                'Lecture Hall'     => 'fas fa-chalkboard-teacher',
                                'Meeting Room'     => 'fas fa-users',
                                'Computer Lab'     => 'fas fa-laptop',
                                'Sports Facility'  => 'fas fa-running',
                                'Other'            => 'fas fa-door-open',
                            ];

                            $typeColors = [
                                'Lecture Hall'     => 'text-primary bg-primary bg-opacity-10',   // Blue
                                'Meeting Room'     => 'text-warning bg-warning bg-opacity-10',   // Yellow/Orange
                                'Computer Lab'     => 'text-info bg-info bg-opacity-10',         // Cyan/Teal
                                'Sports Facility'  => 'text-success bg-success bg-opacity-10',   // Green
                                'Other'            => 'text-secondary bg-secondary bg-opacity-10', // Grey
                            ];

                            $iconClass = $typeIcons[$room->type] ?? 'fas fa-door-open';
                            $colorClass = $typeColors[$room->type] ?? 'text-dark bg-light';
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="room-type-icon {{ $colorClass }} me-3 flex-shrink-0">
                                        <i class="{{ $iconClass }}"></i>
                                    </div>
                                    <div class="d-flex flex-column text-break" style="min-width: 0;">
                                        <h6 class="mb-0 text-truncate" style="max-width: 200px;">{{ $room->name }}</h6>
                                        <small class="text-muted text-wrap">{{ Str::words($room->description, 7, '...') }}</small>
                                    </div>
                                </div>
                                <style>
                                    .room-type-icon {
                                        flex-shrink: 0; /* Prevents icon from shrinking */
                                    }
                                    .text-break {
                                        word-wrap: break-word;
                                        overflow-wrap: break-word;
                                    }
                                </style>
                            </td>
                            <td>{{ $room->type }}</td>
                            <td>
                                <span class="room-capacity">
                                    <i class="fas fa-users me-1"></i> {{ $room->capacity }}
                                </span>
                            </td>
                            <td>{{ $room->building }}</td>
                            <td>
                                RM {{ number_format($room->price_per_hour, 2) }}<br>
                                <small class="text-muted">RM {{ number_format($room->price_fullday, 2) }}<small>/day</small></small>
                            </td>
                            <td>
                                <span class="room-status">
                                    <span class="room-status-dot bg-{{ $room->status == 'available' ? 'success' : ($room->status == 'maintenance' ? 'warning' : 'danger') }}"></span>
                                    {{ ucfirst($room->status) }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit"
                                    data-bs-toggle="modal" data-bs-target="#editRoomModal"
                                    data-id="{{ $room->id }}"
                                    data-name="{{ $room->name }}"
                                    data-type="{{ $room->type }}"
                                    data-capacity="{{ $room->capacity }}"
                                    data-building="{{ $room->building }}"
                                    data-status="{{ $room->status }}"
                                    data-price="{{ $room->price_per_hour }}"
                                    data-description="{{ $room->description }}"
                                    data-price-fullday="{{ $room->price_fullday }}"
                                    onclick="editRoom(this)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Delete" 
                                    data-id="{{ $room->id }}" onclick="deleteRoom(this)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <script>
                        async function deleteRoom(button) {
                            const roomId = button.getAttribute('data-id');

                            if (!roomId || !confirm('Are you sure you want to delete this room?')) return;

                            try {
                                const response = await fetch(`/api/rooms/${roomId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Accept': 'application/json'
                                    }
                                });

                                const result = await response.json();

                                if (response.ok) {
                                    alert('Room deleted successfully!');
                                    location.reload(); // Or remove row from table dynamically
                                } else {
                                    alert('Error deleting room: ' + (result.message || 'Unknown error'));
                                }
                            } catch (error) {
                                console.error(error);
                                alert('Network error. Could not delete room.');
                            }
                        }

                        function editRoom(button) {
                            // Get all data attributes from the button
                            const roomId = button.getAttribute('data-id');
                            const roomName = button.getAttribute('data-name');
                            const roomType = button.getAttribute('data-type');
                            const roomCapacity = button.getAttribute('data-capacity');
                            const building = button.getAttribute('data-building');
                            const status = button.getAttribute('data-status');
                            const description = button.getAttribute('data-description');
                            const price = button.getAttribute('data-price');
                            const priceFullday = button.getAttribute('data-price-fullday');
                            
                            // Set the form action URL with the room ID
                            document.getElementById('editRoomForm').action = `/rooms/${roomId}`;
                            
                            // Populate the form fields
                            document.getElementById('editRoomName').value = roomName;
                            document.getElementById('editRoomType').value = roomType;
                            document.getElementById('editRoomCapacity').value = roomCapacity;
                            document.getElementById('editBuilding').value = building;
                            document.getElementById('editRoomStatus').value = status;
                            document.getElementById('editRoomDescription').value = description;
                            document.getElementById('editRoomPrice').value = price;
                            document.getElementById('editRoomPriceFullDay').value = priceFullday;
                        }
                    </script>
                </table>
            </div>
            
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Showing {{ $rooms->firstItem() }} to {{ $rooms->lastItem() }} of {{ $rooms->total() }} rooms
                </div>
                <nav aria-label="Page navigation">
                    {{ $rooms->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>
    </div>

    <!-- Add Room Modal -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fs-5" id="addRoomModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>Add New Room
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="roomForm">
                    @csrf
                    <div class="modal-body">
                        <!-- Room Basic Info Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-info-circle me-2"></i>Basic Information
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="roomName" class="form-label">Room Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="roomName" name="name" 
                                        placeholder="e.g. Dewan Kuliah 100" required>
                                    <small class="text-muted">Enter the official room name</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="roomType" class="form-label">Room Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="roomType" name="type" required>
                                        <option value="" disabled selected>Select room type</option>
                                        <option value="Lecture Hall">Lecture Hall</option>
                                        <option value="Meeting Room">Meeting Room</option>
                                        <option value="Computer Lab">Computer Lab</option>
                                        <option value="Sports Facility">Sports Facility</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Room Specifications Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-cog me-2"></i>Specifications
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="roomCapacity" class="form-label">Capacity <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="roomCapacity" 
                                            name="capacity" min="1" required>
                                        <span class="input-group-text">people</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="building" class="form-label">Building <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="building" name="building" 
                                        placeholder="e.g. Block A" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="roomStatus" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="roomStatus" name="status" required>
                                        <option value="available">Available</option>
                                        <option value="maintenance">Under Maintenance</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-tag me-2"></i>Pricing
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="roomPrice" class="form-label">Hourly Rate <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">RM</span>
                                        <input type="number" class="form-control" id="roomPrice" 
                                            name="price_per_hour" min="0" step="0.01" placeholder="0.00" required>
                                    </div>
                                    <small class="text-muted">Price per hour</small>
                                </div>
                                <div class="col-md-4">
                                    <label for="roomPriceFullDay" class="form-label">Full Day Rate</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">RM</span>
                                        <input type="number" class="form-control" id="roomPriceFullDay" 
                                            name="price_fullday" min="0" step="0.01" placeholder="0.00">
                                    </div>
                                    <small class="text-muted">Optional full day price</small>
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="mb-3">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-align-left me-2"></i>Additional Information
                            </h6>
                            <label for="roomDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="roomDescription" name="description" 
                                    rows="3" placeholder="Enter room features, equipment, or special notes"></textarea>
                            <small class="text-muted">Maximum 500 characters</small>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Room
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Custom Modal Styling */
        #addRoomModal .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        #addRoomModal .modal-header {
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding: 1rem 1.5rem;
        }
        
        #addRoomModal .modal-body {
            padding: 1.5rem;
        }
        
        #addRoomModal .modal-footer {
            padding: 1rem 1.5rem;
            border-radius: 0 0 10px 10px;
        }
        
        #addRoomModal .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        #addRoomModal .input-group-text {
            min-width: 45px;
            justify-content: center;
        }
        
        #addRoomModal .section-title {
            border-bottom: 1px dashed #dee2e6;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
    </style>

    <!-- Edit Room Modal -->
    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fs-5" id="editRoomModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Room
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRoomForm">
                    <div class="modal-body">
                        <!-- Room Basic Info Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-info-circle me-2"></i>Basic Information
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="editRoomName" class="form-label">Room Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="editRoomName" name="name" required>
                                    <small class="text-muted">Official room name</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="editRoomType" class="form-label">Room Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="editRoomType" name="type" required>
                                        <option value="" disabled>Select type</option>
                                        <option value="Lecture Hall">Lecture Hall</option>
                                        <option value="Meeting Room">Meeting Room</option>
                                        <option value="Computer Lab">Computer Lab</option>
                                        <option value="Sports Facility">Sports Facility</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Room Specifications Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-cog me-2"></i>Specifications
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="editRoomCapacity" class="form-label">Capacity <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="editRoomCapacity" 
                                            name="capacity" min="1" required>
                                        <span class="input-group-text">people</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="editBuilding" class="form-label">Building <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="editBuilding" name="building" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="editRoomStatus" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="editRoomStatus" name="status" required>
                                        <option value="available">Available</option>
                                        <option value="maintenance">Under Maintenance</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-tag me-2"></i>Pricing
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="editRoomPrice" class="form-label">Hourly Rate <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">RM</span>
                                        <input type="number" class="form-control" id="editRoomPrice" name="price_per_hour" min="0" step="0.01" required>
                                    </div>
                                    <small class="text-muted">Price per hour</small>
                                </div>
                                <div class="col-md-4">
                                    <label for="editRoomPriceFullDay" class="form-label">Full Day Rate</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">RM</span>
                                        <input type="number" class="form-control" id="editRoomPriceFullDay" 
                                            name="price_fullday" min="0" step="0.01">
                                    </div>
                                    <small class="text-muted">Optional full day price</small>
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="mb-3">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-align-left me-2"></i>Additional Information
                            </h6>
                            <label for="editRoomDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editRoomDescription" name="description" rows="3"></textarea>
                            <small class="text-muted">Maximum 500 characters</small>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    function renderRooms(rooms) {
        const tableBody = document.getElementById('room-table-body');
        tableBody.innerHTML = '';

        if (rooms.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center">No rooms available.</td></tr>';
            return;
        }

        rooms.forEach(room => {
            const row = `
                <tr>
                    <td>${room.name}</td>
                    <td>${room.type}</td>
                    <td>${room.capacity}</td>
                    <td>${room.building}</td>
                    <td>RM ${parseFloat(room.price_per_hour).toFixed(2)}</td>
                    <td>${room.status}</td>
                    <td>
                        <button onclick="editRoom(${room.id})">Edit</button>
                        <button onclick="deleteRoom(${room.id})">Delete</button>
                    </td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
    }
});

document.getElementById('roomForm').addEventListener('submit', async function(e) {
    e.preventDefault(); // Prevent default form submission

    const form = e.target;

    const formData = {
        name: form.name.value,
        type: form.type.value,
        capacity: form.capacity.value,
        building: form.building.value,
        status: form.status.value,
        price_per_hour: form.price_per_hour.value,
        price_fullday: form.price_fullday.value || null,
        description: form.description.value || null,
    };

    try {
        const response = await fetch('/api/rooms', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(formData)
        });

        const result = await response.json();

        if (response.ok) {
            alert('Room created successfully!');
            location.reload();
        } else {
            alert('Error: ' + (result.message || 'Something went wrong.'));
        }
    } catch (error) {
        console.error(error);
        alert('Network error. Please try again later.');
    }
});

document.getElementById('editRoomForm').addEventListener('submit', async function(e) {
    e.preventDefault(); // prevent normal form submission

    const roomId = this.action.split('/').pop(); // extract ID from action URL

    const formData = {
        name: document.getElementById('editRoomName').value,
        type: document.getElementById('editRoomType').value,
        capacity: document.getElementById('editRoomCapacity').value,
        building: document.getElementById('editBuilding').value,
        status: document.getElementById('editRoomStatus').value,
        description: document.getElementById('editRoomDescription').value,
        price_per_hour: parseFloat(document.getElementById('editRoomPrice').value),
        price_fullday: parseFloat(document.getElementById('editRoomPriceFullDay').value) || 0
    };

    try {
        const response = await fetch(`/api/rooms/${roomId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        const result = await response.json();

        if (response.ok) {
            alert('Room updated successfully!');
            location.reload(); // or update row in table dynamically
        } else {
            alert('Error updating room: ' + (result.message || 'Unknown error'));
        }
    } catch (error) {
        console.error(error);
        alert('Network error. Could not update room.');
    }
});
</script>

</html>