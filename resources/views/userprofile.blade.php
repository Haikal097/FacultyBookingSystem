@extends('app')

@section('title', 'Profile - Facility Booking System')

@section('content')
    @if (Route::has('login'))
        <div class="mb-4"></div>
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<body class="bg-light text-dark min-vh-100">
    <!-- Main Content -->
    <main class="container py-4">
        @if (Route::has('login'))
            <div class="mb-4"></div>
        @endif

        <!-- Your page content here -->
        <!-- Hero Section -->
<div class="container py-1">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex align-items-center" style="height: 50px;">
            <h4 class="mb-0 fw-bold">User Profile</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Column - User Info (30%) -->
                <div class="col-lg-3 border-end">
                    <div class="user-profile text-center">
                        <div class="avatar-placeholder rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; margin-top: 20px;">
                            <i class="fas fa-user fa-3x text-secondary"></i>
                        </div>
                        
                        <div class="user-details text-start">
                            <div class="detail-item mb-3 p-3 bg-light rounded">
                                <div class="fw-bold small">IC Number</div>
                                <div>{{Auth::user()->ic_number}}</div>
                            </div>
                            
                            <div class="detail-item mb-3 p-3 bg-light rounded">
                                <div class="fw-bold small">Full Name</div>
                                <div>{{Auth::user()->name}}</div>
                            </div>
                            
                            <div class="detail-item mb-3 p-3 bg-light rounded">
                                <div class="fw-bold small">Email</div>
                                <div>{{Auth::user()->email}}</div>
                            </div>
                            
                            <div class="detail-item mb-3 p-3 bg-light rounded">
                                <div class="fw-bold small">Phone Number</div>
                                <div>{{Auth::user()->phone_number}}</div>
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold">Booking History</h5>
                    </div>
                    
                    <!-- Filters Card -->
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <form method="GET" action="{{ request()->url() }}">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <label for="statusFilter" class="form-label">Status</label>
                                        <select class="form-select" id="statusFilter" name="status">
                                            <option value="">All Statuses</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="dateFrom" class="form-label">From Date</label>
                                        <input type="date" class="form-control" id="dateFrom" name="date_from" value="{{ request('date_from') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dateTo" class="form-label">To Date</label>
                                        <input type="date" class="form-control" id="dateTo" name="date_to" value="{{ request('date_to') }}">
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="facilityType" class="form-label">Facility Type</label>
                                        <select class="form-select" id="facilityType" name="facility_type">
                                            <option value="">All Types</option>
                                            @foreach(['Lecture Hall', 'Meeting Room', 'Computer Lab', 'Sports Facility'] as $type)
                                                <option value="{{ $type }}" {{ request('facility_type') == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-8 mt-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="search" name="search" 
                                                   placeholder="Search purpose or facility..." value="{{ request('search') }}">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mt-2 d-flex">
                                        <button type="submit" class="btn btn-primary me-2 flex-grow-1">
                                            <i class="fas fa-filter me-1"></i> Apply
                                        </button>
                                        <a href="{{ request()->url() }}" class="btn btn-outline-secondary flex-grow-1">
                                            <i class="fas fa-undo me-1"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Booking History Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Purpose</th>
                                    <th>Facility</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->purpose_type }}</td>
                                    <td>{{ $booking->room->name ?? 'N/A' }}</td>
                                    <td>
                                        @if ($booking->end_date && $booking->end_date !== $booking->booking_date)
                                            <span data-bs-toggle="tooltip" title="Booking until {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}">
                                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                                <i class="bi bi-calendar-range ms-1 text-primary"></i> {{-- Bootstrap Icons --}}
                                            </span>
                                        @else
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                                    <td>RM {{ number_format($booking->total_price, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($booking->status) {
                                                'approved' => 'bg-success text-white',
                                                'rejected' => 'bg-danger text-white',
                                                'pending' => 'bg-warning text-black',
                                                default => 'bg-secondary text-white',
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ ucfirst($booking->status) }}</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary view-booking" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#bookingDetailsModal"
                                                data-id="{{ $booking->id }}"
                                                data-purpose-type="{{ $booking->purpose_type }}"
                                                data-purpose="{{ $booking->purpose }}"
                                                data-facility="{{ $booking->room->name ?? 'N/A' }}"
                                                data-building="{{ $booking->room->building ?? 'N/A' }}"
                                                data-date="{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}"
                                                data-end-date="{{ $booking->end_date ? \Carbon\Carbon::parse($booking->end_date)->format('d M Y') : '' }}"
                                                data-time="{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}"
                                                data-price="RM {{ number_format($booking->total_price, 2) }}"
                                                data-status="{{ ucfirst($booking->status) }}"
                                                data-status-class="{{ $statusClass }}"
                                                data-approve-url="{{ route('bookings.approve', $booking->id) }}"
                                                data-reject-url="{{ route('bookings.reject', $booking->id) }}"
                                                onclick="toggleCancelButton(this)">
                                            View
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $bookings->appends(request()->query())->links() }}
                        </div>
                    </div>
                    
                    <!-- Booking Details Modal -->
                    <div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-labelledby="bookingDetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="bookingDetailsModalLabel">Booking Details</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Purpose</h6>
                                                <p id="bookingPurposeType"></p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Details</h6>
                                                <p id="bookingPurpose"></p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Facility</h6>
                                                <p id="bookingFacility"></p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Building</h6>
                                                <p id="bookingBuilding"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Date</h6>
                                                <p id="bookingDate"></p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Time</h6>
                                                <p id="bookingTime"></p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Price</h6>
                                                <p id="bookingPrice"></p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Status</h6>
                                                <p id="bookingStatus"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="cancelBookingButton" class="btn btn-danger">Cancel Booking</button>
                                    <a href="#" id="downloadPdfBtn"
                                    target="_blank"
                                    class="btn btn-outline-success"
                                    download="booking.pdf"
                                    style="display: none;">
                                    📄 Download PDF
                                    </a>
                                    <script>
                                        let currentBookingId = null;

                                        function toggleCancelButton(button) {
                                            const status = button.getAttribute('data-status').toLowerCase();
                                            const cancelButton = document.getElementById('cancelBookingButton');
                                            const downloadBtn = document.getElementById('downloadPdfBtn');
                                            currentBookingId = button.getAttribute('data-id');

                                            // Show/hide cancel button
                                            if (cancelButton) {
                                                cancelButton.style.display = (status === 'pending') ? 'inline-block' : 'none';
                                            }

                                            // Set download link dynamically
                                            if (downloadBtn) {
                                                downloadBtn.href = `/api/bookings/${currentBookingId}/pdf`;
                                                downloadBtn.style.display = 'inline-block'; // Show the button
                                            }
                                        }


                                        document.getElementById('cancelBookingButton').addEventListener('click', function () {
                                            if (!currentBookingId) {
                                                alert('No booking selected.');
                                                return;
                                            }

                                            if (confirm('Are you sure you want to cancel this booking?')) {
                                                fetch(`/bookings/${currentBookingId}/cancel`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                        'Accept': 'application/json'
                                                    },
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    alert(data.message);
                                                    // Optionally: Reload page or update UI
                                                    location.reload();
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                    alert('An error occurred while cancelling the booking.');
                                                });
                                            }
                                        });
                                        
                                    </script>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    @if(auth()->user()->role == 'admin')
                                    <div class="btn-group">
                                        <form id="approveForm" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <form id="rejectForm" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            <form action="{{ route('userprofile.update') }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                value="{{ old('name', Auth::user()->name) }}" required>
                        </div>  
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                value="{{ old('email', Auth::user()->email) }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ic_number" class="form-label">IC Number</label>
                            <input type="text" class="form-control" id="ic_number" name="ic_number" 
                                value="{{ old('ic_number', Auth::user()->ic_number) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" 
                                value="{{ old('phone_number', Auth::user()->phone_number) }}" required>
                        </div>
                    </div>
                    
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

<!-- JavaScript for Booking Details Modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle view booking button click
    document.querySelectorAll('.view-booking').forEach(button => {
        button.addEventListener('click', function() {
            // Get all data attributes
            const purposeType = this.getAttribute('data-purpose-type');
            const purpose = this.getAttribute('data-purpose');
            const facility = this.getAttribute('data-facility');
            const building = this.getAttribute('data-building');
            const date = this.getAttribute('data-date');
            const endDate = this.getAttribute('data-end-date');
            const time = this.getAttribute('data-time');
            const price = this.getAttribute('data-price');
            const status = this.getAttribute('data-status');
            const statusClass = this.getAttribute('data-status-class');
            const approveUrl = this.getAttribute('data-approve-url');
            const rejectUrl = this.getAttribute('data-reject-url');
            
            // Populate modal
            document.getElementById('bookingPurposeType').textContent = purposeType;
            document.getElementById('bookingPurpose').textContent = purpose || 'No additional details';
            document.getElementById('bookingFacility').textContent = facility;
            document.getElementById('bookingBuilding').textContent = building;
            document.getElementById('bookingDate').textContent = endDate
                ? `${date} - ${endDate}`
                : date;
            document.getElementById('bookingTime').textContent = time;
            document.getElementById('bookingPrice').textContent = price;
            
            // Format status with badge
            const statusElement = document.getElementById('bookingStatus');
            statusElement.innerHTML = '';
            const badge = document.createElement('span');
            badge.className = `badge ${statusClass}`;
            badge.textContent = status;
            statusElement.appendChild(badge);
            
            // Update form actions if admin
            @if(auth()->user()->role == 'admin')
                document.getElementById('approveForm').action = approveUrl;
                document.getElementById('rejectForm').action = rejectUrl;
            @endif
        });

        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
});
</script>

<style>
    /* Custom styles */
    .avatar-placeholder {
        border: 3px solid #dee2e6;
        background: white !important;
    }
    
    .detail-item {
        transition: all 0.2s ease;
    }
    
    .detail-item:hover {
        background-color: #e9ecef !important;
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
    
    /* Filter card styling */
    .filter-card {
        background-color: #f8f9fa;
        border-radius: 8px;
    }
</style>

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

    .pagination {
    --bs-pagination-color: #0d6efd;
    --bs-pagination-hover-color: #0a58ca;
    --bs-pagination-focus-color: #0a58ca;
    --bs-pagination-active-bg: #0d6efd;
    --bs-pagination-active-border-color: #0d6efd;
    }

    .pagination .page-item.active .page-link {
        background-color: var(--bs-pagination-active-bg);
        border-color: var(--bs-pagination-active-border-color);
    }

    /* Booking Details Modal Styling */
    #bookingDetailsModal .modal-body h6 {
        color: #495057;
        margin-bottom: 0.25rem;
    }
    #bookingDetailsModal .modal-body p {
        padding: 0.5rem;
        background-color: #f8f9fa;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
</style>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </main>
</body>
</html>
@endsection
