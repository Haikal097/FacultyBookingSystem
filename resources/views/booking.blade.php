@extends('app')

@section('title', 'Home - Facility Booking System')

@section('content')
    @if (Route::has('login'))
        <div class="mb-4"></div>
    @endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Book a Room - Facility Booking System</title>

    <style>
        :root {
            --primary-color: #4a6bff;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
        }
        
        #page-content {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f5f7fa;
            padding-top: 70px;
            min-height: 100vh;
        }
        
        .booking-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .booking-header {
            background: linear-gradient(135deg, var(--primary-color), #6a8aff);
            color: white;
            padding: 1.5rem;
            border-radius: 10px 10px 0 0;
        }
        
        .form-section {
            padding: 1.5rem;
            background-color: white;
        }
        
        .form-section-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(74, 107, 255, 0.1);
        }
        
        .room-card {
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .room-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(74, 107, 255, 0.1);
        }
        
        .room-card.selected {
            border: 2px solid var(--primary-color);
            background-color: rgba(74, 107, 255, 0.05);
        }
        
        .room-type-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
        }
        
        .room-capacity {
            display: inline-flex;
            align-items: center;
            background-color: #f8f9fa;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
        }
        
        .time-slot {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .time-slot:hover {
            border-color: var(--primary-color);
        }
        
        .time-slot.selected {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .btn-book {
            background: linear-gradient(135deg, var(--success-color), #6bc76b);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }
        
        .btn-book:hover {
            background: linear-gradient(135deg, #43a047, #5cb860);
        }
        
        .availability-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }
        
        .nav-tabs .nav-link.active {
            font-weight: 600;
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
        }
    </style>
</head>
<body class="bg-light text-dark">
    <!-- Main Content -->
    <main class="container py-4">
        <div class="row justify-content-center" id="page-content">
            <div class="col-lg-10">
                <div class="booking-card">
                    <div class="booking-header">
                        <h2 class="mb-0"><i class="fas fa-calendar-plus me-2"></i> Book a Facility</h2>
                    </div>
                    
                    <form action="{{ route('bookings.store') }}" method="POST" class="form-section">
                        @csrf

                        <!-- Step Indicator -->
                        <div class="d-flex justify-content-between mb-4">
                            <div class="text-center">
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">1</div>
                                <div class="small mt-1">Select Room</div>
                            </div>
                            <div class="text-center">
                                <div class="rounded-circle bg-light text-muted d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">2</div>
                                <div class="small mt-1">Choose Time</div>
                            </div>
                            <div class="text-center">
                                <div class="rounded-circle bg-light text-muted d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">3</div>
                                <div class="small mt-1">Confirm</div>
                            </div>
                        </div>

                        <!-- Room Selection -->
                        <div class="mb-4">
                            <h5 class="form-section-title"><i class="fas fa-door-open me-2"></i>Select Facility</h5>
                            
                            <ul class="nav nav-tabs mb-3" id="roomTypeTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="lecture-tab" data-bs-toggle="tab" data-bs-target="#lecture" type="button" role="tab">Lecture Halls</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="meeting-tab" data-bs-toggle="tab" data-bs-target="#meeting" type="button" role="tab">Meeting Rooms</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="lab-tab" data-bs-toggle="tab" data-bs-target="#lab" type="button" role="tab">Labs</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="sports-tab" data-bs-toggle="tab" data-bs-target="#sports" type="button" role="tab">Sports</button>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="roomTypeTabsContent">
                                <div class="tab-pane fade show active" id="all" role="tabpanel">
                                    <div class="row">
                                        @foreach ($rooms as $room)
                                            <div class="col-md-6">
                                                <div class="room-card" onclick="selectRoom(this, {{ $room->id }})">
                                                    <div class="d-flex align-items-center">
                                                        <div class="room-type-icon bg-primary">
                                                            @if($room->type == 'Lecture Hall')
                                                                <i class="fas fa-chalkboard-teacher"></i>
                                                            @elseif($room->type == 'Meeting Room')
                                                                <i class="fas fa-users"></i>
                                                            @elseif($room->type == 'Computer Lab')
                                                                <i class="fas fa-laptop"></i>
                                                            @elseif($room->type == 'Sports Facility')
                                                                <i class="fas fa-running"></i>
                                                            @else
                                                                <i class="fas fa-door-open"></i>
                                                            @endif
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">{{ $room->name }}</h6>
                                                            <div class="d-flex justify-content-between">
                                                                <small class="text-muted">{{ $room->building }}, {{ $room->floor }}</small>
                                                                <span class="room-capacity">
                                                                    <i class="fas fa-users me-1"></i> {{ $room->capacity }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        @if($room->features)
                                                            @foreach(explode(',', $room->features) as $feature)
                                                                <span class="badge bg-light text-dark me-1">{{ trim($feature) }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="mt-2 text-end">
                                                        <span class="availability-badge bg-success text-white">Available</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Other tab panes would be similar -->
                            </div>
                            
                            <input type="hidden" name="room_id" id="selected_room_id" required>
                        </div>

                        <!-- Date Selection -->
                        <div class="mb-4">
                            <h5 class="form-section-title"><i class="fas fa-calendar-day me-2"></i>Select Date</h5>
                            <div class="d-flex align-items-center">
                                <input type="date" name="booking_date" id="booking_date" class="form-control me-3" style="max-width: 200px;" required>
                                <div>
                                    <span class="badge bg-primary me-2">Today</span>
                                    <span class="badge bg-light text-dark me-2">Tomorrow</span>
                                    <span class="badge bg-light text-dark">Next Week</span>
                                </div>
                            </div>
                        </div>

                        <!-- Time Selection -->
                        <div class="mb-4">
                            <h5 class="form-section-title"><i class="fas fa-clock me-2"></i>Select Time Slot</h5>
                            
                            <h6 class="mt-3 mb-2">Morning</h6>
                            <div class="d-flex flex-wrap">
                                <span class="time-slot" onclick="selectTimeSlot(this, '08:00', '09:30')">8:00 - 9:30 AM</span>
                                <span class="time-slot" onclick="selectTimeSlot(this, '09:30', '11:00')">9:30 - 11:00 AM</span>
                                <span class="time-slot" onclick="selectTimeSlot(this, '11:00', '12:30')">11:00 - 12:30 PM</span>
                            </div>
                            
                            <h6 class="mt-3 mb-2">Afternoon</h6>
                            <div class="d-flex flex-wrap">
                                <span class="time-slot" onclick="selectTimeSlot(this, '13:00', '14:30')">1:00 - 2:30 PM</span>
                                <span class="time-slot" onclick="selectTimeSlot(this, '14:30', '16:00')">2:30 - 4:00 PM</span>
                                <span class="time-slot" onclick="selectTimeSlot(this, '16:00', '17:30')">4:00 - 5:30 PM</span>
                            </div>
                            
                            <h6 class="mt-3 mb-2">Evening</h6>
                            <div class="d-flex flex-wrap">
                                <span class="time-slot" onclick="selectTimeSlot(this, '18:00', '19:30')">6:00 - 7:30 PM</span>
                                <span class="time-slot" onclick="selectTimeSlot(this, '19:30', '21:00')">7:30 - 9:00 PM</span>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="start_time" class="form-label">Custom Start Time</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="end_time" class="form-label">Custom End Time</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <!-- Purpose -->
                        <div class="mb-4">
                            <h5 class="form-section-title"><i class="fas fa-info-circle me-2"></i>Booking Details</h5>
                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose</label>
                                <select name="purpose_type" id="purpose_type" class="form-select mb-2">
                                    <option value="Lecture">Lecture</option>
                                    <option value="Meeting">Meeting</option>
                                    <option value="Study Group">Study Group</option>
                                    <option value="Event">Event</option>
                                    <option value="Other">Other</option>
                                </select>
                                <textarea name="purpose" id="purpose" rows="3" class="form-control" placeholder="Please provide details about your booking..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Special Requirements</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="needs_projector" id="needs_projector">
                                    <label class="form-check-label" for="needs_projector">Projector Needed</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="needs_audio" id="needs_audio">
                                    <label class="form-check-label" for="needs_audio">Audio System Needed</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="needs_whiteboard" id="needs_whiteboard">
                                    <label class="form-check-label" for="needs_whiteboard">Whiteboard Needed</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-book btn-lg">
                                <i class="fas fa-check-circle me-2"></i> Confirm Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Room selection
        function selectRoom(element, roomId) {
            document.querySelectorAll('.room-card').forEach(card => {
                card.classList.remove('selected');
            });
            element.classList.add('selected');
            document.getElementById('selected_room_id').value = roomId;
        }
        
        // Time slot selection
        function selectTimeSlot(element, startTime, endTime) {
            document.querySelectorAll('.time-slot').forEach(slot => {
                slot.classList.remove('selected');
            });
            element.classList.add('selected');
            document.getElementById('start_time').value = startTime;
            document.getElementById('end_time').value = endTime;
        }
        
        // Set default date to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('booking_date').value = today;
            document.getElementById('booking_date').min = today;
        });
    </script>
</body>
</html>
@endsection