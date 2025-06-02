<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .pagination {
            margin-bottom: 0;
        }

        .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .page-link {
            color: #0d6efd;
        }
        .dropdown-item.active-filter {
            background-color: #e9ecef;
            font-weight: 500;
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
                <a href="{{ route('rooms.index') }}" class="nav-link"><i class="fas fa-door-open"></i>Manage Rooms</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.managebooking') }}" class="nav-link active"><i class="fas fa-calendar-check"></i>Manage Bookings</a>
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
            <h2>Manage Bookings</h2>
            <div class="d-flex align-items-center">
                <div class="search-box me-3">
                    <form action="{{ url()->current() }}" method="GET" class="search-box me-3">
                        <i class="fas fa-search"></i>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Search bookings..." 
                            name="search"
                            value="{{ request('search') }}"
                        >
                        @if(request()->has('filter'))
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                        @endif
                    </form>
                </div>
                <div class="btn-group me-3">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i> 
                        @if(request()->has('filter'))
                            {{ ucfirst(str_replace('_', ' ', request('filter'))) }}
                        @else
                            Filter
                        @endif
                    </button>
                    <ul class="dropdown-menu">
                        @foreach([
                            'today' => 'Today',
                            'this_week' => 'This Week',
                            'this_month' => 'This Month',
                            'pending' => 'Pending Approval',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                            'cancelled' => 'Cancelled'
                        ] as $value => $label)
                            <li>
                                <a class="dropdown-item @if(request('filter') == $value) active-filter @endif" 
                                href="{{ request()->fullUrlWithQuery(['filter' => $value]) }}">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                        @if(request()->has('filter'))
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ request()->url() }}">Clear Filter</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Bookings</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Purpose</th>
                            <th>Facility</th>
                            <th>User</th>
                            <th>Date & Time</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>
                            <div class="room-info">
                                <div class="room-name fw-bold">{{ $booking->purpose_type }}</div>
                                <div class="room-capacity small text-muted">
                                    <i class="fas fa-info-circle me-1"></i> {{ \Illuminate\Support\Str::limit($booking->purpose, 20) }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-door-open me-2"></i>
                                <div>
                                    <div>{{ $booking->room->name }}</div>
                                    <small class="text-muted">{{ $booking->room->building ?? 'Main Building' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle fa-2x text-secondary me-2"></i>
                                <div>
                                    <div>{{ $booking->user->name }}</div>
                                    <small class="text-muted">{{ $booking->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <i class="fas fa-calendar-day calendar-icon"></i>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('D, d M Y') }}
                            </div>
                            <div>
                                <i class="fas fa-clock calendar-icon"></i>
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                            </div>
                        </td>
                        <td>
                            RM {{ number_format($booking->total_price, 2) }}
                        </td>
                        <td>
                            @php
                                $statusColor = [
                                    'approved' => 'success',
                                    'pending' => 'warning',
                                    'rejected' => 'danger',
                                ][$booking->status] ?? 'secondary';
                            @endphp
                            <span class="booking-status">
                                <span class="booking-status-dot bg-{{ $statusColor }}"></span>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($booking->status === 'pending')
                                <!-- Approve button -->
                                <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success btn-action me-1" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                <!-- Reject button -->
                                <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger btn-action me-1" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            @elseif ($booking->status === 'rejected')
                            <!--
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>-->
                            <button class="btn btn-sm btn-outline-danger btn-action" 
                                    title="Delete" 
                                    data-booking-id="{{ $booking->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            @else
                            <!--
                                <button class="btn btn-sm btn-outline-primary btn-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" title="Cancel">
                                    <i class="fas fa-times"></i>
                                </button>-->
                                <button class="btn btn-sm btn-outline-danger btn-action" 
                                        title="Delete" 
                                        data-booking-id="{{ $booking->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            @endif
                            @if ($booking->status !== 'pending')
                            <button
                                class="btn btn-sm btn-outline-secondary btn-action ms-1"
                                title="Details"
                                data-bs-toggle="modal"
                                data-bs-target="#bookingDetailsModal"
                                data-purpose-type="{{ $booking->purpose_type }}"
                                data-purpose="{{ $booking->purpose }}"
                                data-status="{{ $booking->status }}"
                                data-user-name="{{ $booking->user->name }}"
                                data-user-email="{{ $booking->user->email }}"
                                data-room-name="{{ $booking->room->name }}"
                                data-room-type="{{ $booking->room->type }}"
                                data-room-capacity="{{ $booking->room->capacity }}"
                                data-room-building="{{ $booking->room->building }}"
                                data-room-description="{{ $booking->room->description }}"
                                data-booking-date="{{ $booking->booking_date }}"
                                data-start-time="{{ $booking->start_time }}"
                                data-end-time="{{ $booking->end_time }}"
                            >
                                <i class="fas fa-eye"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} bookings
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        {{-- Previous Page Link --}}
                        @if ($bookings->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $bookings->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                            @if ($page == $bookings->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($bookings->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $bookings->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
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
                            <h4 id="modalPurposeType">...</h4>
                            <p class="text-muted" id="modalPurpose">...</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="badge bg-secondary fs-6" id="modalStatus">Approved</span>
                        </div>
                    </div>
                    
                    <!-- BOOKED BY -->
                    <div class="w-100 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title text-muted">BOOKED BY</h6>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle fa-2x text-secondary me-2"></i>
                                    <div>
                                        <div id="modalUserName" class="fw-bold">...</div>
                                        <div id="modalUserEmail" class="text-muted small">...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ROOM DETAILS -->
                    <div class="w-100 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title text-muted">ROOM DETAILS</h6>
                                <div class="d-flex align-items-center">
                                    <div class="room-type-icon bg-primary bg-opacity-10 text-primary me-3">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div>
                                        <div id="modalRoomName" class="fw-bold">...</div>
                                        <div id="modalRoomType" class="text-muted small">...</div>
                                        <div id="modalRoomBuilding" class="text-muted small">...</div>
                                        <div id="modalRoomCapacity" class="text-muted small">...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--
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
                                            <div id="modalBookingDate" class="fw-bold">...</div>
                                            <div id="modalBookingTime" class="text-muted">...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn btn-primary">Print Details</button>-->
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

        document.getElementById('bookingDetailsModal').addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const modal = this;

            // Get values from button attributes
            const purposeType = button.getAttribute('data-purpose-type');
            const purpose = button.getAttribute('data-purpose');
            const status = button.getAttribute('data-status');
            const userName = button.getAttribute('data-user-name');
            const userEmail = button.getAttribute('data-user-email');
            const roomName = button.getAttribute('data-room-name');
            const roomType = button.getAttribute('data-room-type');
            const roomCapacity = button.getAttribute('data-room-capacity');
            const roomBuilding = button.getAttribute('data-room-building');
            const roomDescription = button.getAttribute('data-room-description');
            const bookingDate = button.getAttribute('data-booking-date');
            const startTime = button.getAttribute('data-start-time');
            const endTime = button.getAttribute('data-end-time');

            // Format date
            const dateFormatted = new Date(bookingDate).toLocaleDateString('en-GB', {
                weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
            });

            // Calculate duration
            const start = new Date(`1970-01-01T${startTime}`);
            const end = new Date(`1970-01-01T${endTime}`);
            const diffHours = ((end - start) / 1000 / 60 / 60).toFixed(1);

            // Populate modal
            modal.querySelector('#modalPurposeType').textContent = purposeType;
            modal.querySelector('#modalPurpose').textContent = purpose;
            modal.querySelector('#modalStatus').textContent = status.charAt(0).toUpperCase() + status.slice(1);

            // User
            modal.querySelector('#modalUserName').textContent = userName;
            modal.querySelector('#modalUserEmail').textContent = userEmail;

            // Room
            modal.querySelector('#modalRoomName').textContent = roomName;
            modal.querySelector('#modalRoomType').textContent = roomType;
            modal.querySelector('#modalRoomBuilding').textContent = roomBuilding;
            modal.querySelector('#modalRoomCapacity').textContent = `Capacity: ${roomCapacity}`;
            modal.querySelector('#modalRoomDescription').textContent = roomDescription;

            // Date & Time
            modal.querySelector('#modalBookingDate').textContent = dateFormatted;
            modal.querySelector('#modalBookingTime').textContent = `${startTime} - ${endTime} (${diffHours} hours)`;
            const statusElement = modal.querySelector('#modalStatus');

            // Remove existing bg-* classes and set new one based on status
            statusElement.classList.remove('bg-success', 'bg-warning', 'bg-danger');

            if (status === 'approved') {
                statusElement.classList.add('bg-success');
            } else if (status === 'pending') {
                statusElement.classList.add('bg-warning');
            } else if (status === 'rejected') {
                statusElement.classList.add('bg-danger');
            }
        });

    document.querySelectorAll('.btn-action').forEach(button => {
        button.addEventListener('click', function () {
            const bookingId = this.getAttribute('data-booking-id');

            // Send AJAX request to delete booking immediately
            fetch(`/bookings/${bookingId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF Token
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Or remove the element from the DOM
                } else {
                    
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
            });
        });
    });
    </script>
</body>
</html>