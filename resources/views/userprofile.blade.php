@extends('app')

@section('title', 'Home - Facility Booking System')

@section('content')
    @if (Route::has('login'))
        <div class="mb-4"></div>
    @endif
<body class="bg-light text-dark min-vh-100">
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
                    <h5 class="mb-4 fw-bold">Booking History</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Purpose</th>
                                    <th>Facility</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <!--<th>Actions</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                <tr>
                                <td>{{ $booking->purpose_type }}</td>
                                <td>{{ $booking->room->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
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
                                <!--
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                </td>-->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination 
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
                    </nav>-->
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
@endsection
