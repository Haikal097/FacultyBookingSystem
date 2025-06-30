@extends('app')

@section('title', 'Booking - Facility Booking System')

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

        /* Hover state when already selected */
        .time-slot.selected:hover {
            color: grey;
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
                        <!-- Step Indicator (Updated Version) -->
                        <div class="d-flex justify-content-between mb-4" id="step-indicator">
                            <div class="text-center step" data-step="1">
                                <div class="rounded-circle bg-light text-muted d-inline-flex align-items-center justify-content-center step-circle" style="width: 36px; height: 36px;">1</div>
                                <div class="small mt-1">Select Room</div>
                            </div>
                            <div class="text-center step" data-step="2">
                                <div class="rounded-circle bg-light text-muted d-inline-flex align-items-center justify-content-center step-circle" style="width: 36px; height: 36px;">2</div>
                                <div class="small mt-1">Choose Time</div>
                            </div>
                            <div class="text-center step" data-step="3">
                                <div class="rounded-circle bg-light text-muted d-inline-flex align-items-center justify-content-center step-circle" style="width: 36px; height: 36px;">3</div>
                                <div class="small mt-1">Confirm</div>
                            </div>
                        </div>

                        <style>
                            /* Add this to your existing styles */
                            .step-circle.completed {
                                background-color: var(--success-color) !important;
                                color: white !important;
                            }
                            .step-circle.current {
                                background-color: var(--primary-color) !important;
                                color: white !important;
                            }
                            .step-text.completed {
                                color: var(--success-color) !important;
                                font-weight: 600;
                            }
                            .step-text.current {
                                color: var(--primary-color) !important;
                                font-weight: 600;
                            }
                        </style>

                        <script>
                        // Add this to your existing JavaScript
                        document.addEventListener('DOMContentLoaded', function() {
                            // Track completed steps
                            let completedSteps = [];
                            let currentStep = 1;
                            
                            // Initialize step indicator
                            updateStepIndicator();
                            
                            // Room selection completes step 1
                            document.addEventListener('click', function(e) {
                                if (e.target.closest('.room-card')) {
                                    if (!completedSteps.includes(1)) {
                                        completedSteps.push(1);
                                        currentStep = 2;
                                        updateStepIndicator();
                                    }
                                }
                                
                                // Time selection completes step 2
                                if (e.target.closest('.time-slot')) {
                                    if (!completedSteps.includes(2)) {
                                        completedSteps.push(2);
                                        currentStep = 3;
                                        updateStepIndicator();
                                    }
                                }
                            });
                            
                            // Form submission would complete step 3
                            document.querySelector('form').addEventListener('submit', function() {
                                completedSteps.push(3);
                                updateStepIndicator();
                            });
                            
                            // Update step indicator visuals
                            function updateStepIndicator() {
                                document.querySelectorAll('.step').forEach(step => {
                                    const stepNum = parseInt(step.dataset.step);
                                    const circle = step.querySelector('.step-circle');
                                    const text = step.querySelector('.small');
                                    
                                    // Reset classes
                                    circle.classList.remove('completed', 'current');
                                    text.classList.remove('completed', 'current');
                                    
                                    // Add appropriate classes
                                    if (completedSteps.includes(stepNum)) {
                                        circle.classList.add('completed');
                                        text.classList.add('completed');
                                    } else if (stepNum === currentStep) {
                                        circle.classList.add('current');
                                        text.classList.add('current');
                                    }
                                });
                            }
                            
                            // Your existing time slot selection function
                            function selectTimeSlot(element, startTime, endTime) {
                                document.querySelectorAll('.time-slot').forEach(slot => {
                                    slot.classList.remove('selected');
                                });
                                element.classList.add('selected');
                                document.getElementById('start_time').value = startTime;
                                document.getElementById('end_time').value = endTime;
                                
                                // Mark step 2 as complete when time is selected
                                if (!completedSteps.includes(2)) {
                                    completedSteps.push(2);
                                    currentStep = 3;
                                    updateStepIndicator();
                                }

                                
                                const startTimeInput = document.getElementById('start_time');
                                const endTimeInput = document.getElementById('end_time');
                                const priceDisplay = document.getElementById('pricePlaceholder');

                                // Validate inputs
                                if (!startTimeInput.value || !endTimeInput.value || window.bookingData.pricePerHour <= 0) {
                                    priceDisplay.textContent = '0.00';
                                    return;
                                }

                                // Parse times
                                const [startHours, startMins] = startTimeInput.value.split(':').map(Number);
                                const [endHours, endMins] = endTimeInput.value.split(':').map(Number);

                                // Calculate duration in hours
                                let durationHours = (endHours + endMins / 60) - (startHours + startMins / 60);

                                // Handle overnight bookings (if allowed)
                                if (durationHours < 0) {
                                    durationHours += 24; // Add 24 hours if end time is next day
                                }

                                // Always round up to the next full hour
                                const roundedHours = Math.ceil(durationHours);

                                // Calculate and display price
                                if (roundedHours > 0) {
                                    const totalPrice = roundedHours * window.bookingData.pricePerHour;
                                    priceDisplay.textContent = totalPrice.toFixed(2);
                                } else {
                                    priceDisplay.textContent = '0.00';
                                }
                                
                                calculateTotalPrice();
                            }

                            function toggleEntireDay(checkbox) {
                                const timeSlots = document.querySelectorAll('.time-slot');
                                const startTimeInput = document.getElementById('start_time');
                                const endTimeInput = document.getElementById('end_time');
                                const priceDisplay = document.getElementById('pricePlaceholder');
                                
                                if (checkbox.checked) {
                                    enableMultiDayDateSelection(true);
                                    setCustomTimeInputsDisabled(true);
                                    // Set entire day times
                                    startTimeInput.value = '08:00';
                                    endTimeInput.value = '22:00';
                                    
                                    // Disable all time slots and remove selection
                                    timeSlots.forEach(slot => {
                                        slot.classList.add('disabled');
                                        slot.classList.remove('selected');
                                    });
                                    
                                    // Disable manual time inputs
                                    startTimeInput.readOnly = true;
                                    endTimeInput.readOnly = true;
                                    
                                    // Calculate price for entire day
                                    const totalPrice = window.bookingData.priceFullDay;
                                    priceDisplay.textContent = totalPrice.toFixed(2);
                                    
                                    // Mark step 2 as complete
                                    if (!completedSteps.includes(2)) {
                                        completedSteps.push(2);
                                        currentStep = 3;
                                        updateStepIndicator();
                                    }
                                    
                                    calculateTotalPrice();
                                } else {
                                    enableMultiDayDateSelection(false);
                                    setCustomTimeInputsDisabled(false);
                                    // Enable all time slots
                                    timeSlots.forEach(slot => {
                                        slot.classList.remove('disabled');
                                    });
                                    
                                    // Enable manual time inputs
                                    startTimeInput.readOnly = false;
                                    endTimeInput.readOnly = false;

                                    priceDisplay.textContent = (0).toFixed(2); 
                                    startTimeInput.value = '';
                                    endTimeInput.value = '';
                                    
                                }
                            }

                            function setCustomTimeInputsDisabled(isDisabled = true) {
                                const startInput = document.getElementById('start_time');
                                const endInput = document.getElementById('end_time');

                                if (!startInput || !endInput) return;

                                startInput.readOnly = isDisabled;
                                endInput.readOnly = isDisabled;

                                if (isDisabled) {
                                    startInput.value = '08:00';
                                    endInput.value = '22:00';
                                } else {
                                    startInput.value = '';
                                    endInput.value = '';
                                }
                            }

                            function enableMultiDayDateSelection(enable = true) {
                                const dateSection = document.getElementById('dateSection');
                                const bookingDate = document.getElementById('booking_date');
                                const bookingEndDate = document.getElementById('booking_end_date');
                                const dateOptions = document.querySelectorAll('.date-option');

                                // Ensure we proceed only if elements exist
                                if (!dateSection || !bookingDate || !bookingEndDate) return;

                                // Clear previous labels (if any)
                                dateSection.querySelectorAll('.from-label, .to-label').forEach(el => el.remove());

                                if (enable) {
                                    // Hide all quick-select badges
                                    dateOptions.forEach(badge => badge.classList.add('d-none'));

                                    // Create and insert "From" label above booking_date
                                    const fromLabel = document.createElement('label');
                                    fromLabel.textContent = 'From:';
                                    fromLabel.className = 'form-label from-label';
                                    bookingDate.parentNode.insertBefore(fromLabel, bookingDate);

                                    // Show booking_end_date field and insert "To" label
                                    bookingEndDate.classList.remove('d-none');
                                    bookingEndDate.disabled = false;

                                    const toLabel = document.createElement('label');
                                    toLabel.textContent = 'To:';
                                    toLabel.className = 'form-label to-label';

                                    // Place To label and end date input after start date
                                    bookingDate.parentNode.insertBefore(toLabel, bookingEndDate);
                                } else {
                                    // Re-enable quick-select badges
                                    dateOptions.forEach(badge => badge.classList.remove('d-none'));

                                    // Hide and disable end date
                                    bookingEndDate.classList.add('d-none');
                                    bookingEndDate.disabled = true;

                                    // Remove labels if toggled off
                                    dateSection.querySelectorAll('.from-label, .to-label').forEach(el => el.remove());
                                }
                            }

                            function validateDateRange() {
                                const startDateInput = document.getElementById('booking_date');
                                const endDateInput = document.getElementById('booking_end_date');

                                if (!startDateInput || !endDateInput || endDateInput.disabled) return;

                                const startDate = new Date(startDateInput.value);
                                const endDate = new Date(endDateInput.value);

                                if (endDate < startDate) {
                                    alert('End date must be after the start date.');
                                    endDateInput.value = ''; // Reset invalid input
                                    return false;
                                }

                                calculateTotalPrice();
                                return true;
                            }

                            const endDateInput = document.getElementById('booking_end_date');
                            const startDateInput = document.getElementById('booking_date');

                            if (startDateInput && endDateInput) {
                                endDateInput.addEventListener('change', validateDateRange);
                                startDateInput.addEventListener('change', function () {
                                    if (endDateInput.value) {
                                        validateDateRange();
                                    }
                                });
                            }

                            startDateInput.addEventListener('change', function () {
                                if (endDateInput) {
                                    const startVal = this.value;
                                    const startDate = new Date(startVal);
                                    startDate.setDate(startDate.getDate() + 1); // Next day
                                    endDateInput.min = startDate.toISOString().split('T')[0];
                                }
                            });
                                                        // Make selectTimeSlot available globally
                            window.selectTimeSlot = selectTimeSlot;
                            window.toggleEntireDay = toggleEntireDay;
                        });

                        </script>

                        <!-- Room Selection -->
                        <div class="mb-4">
                            <h5 class="form-section-title"><i class="fas fa-door-open me-2"></i>Select Facility</h5>
                            
                            <ul class="nav nav-tabs mb-3" id="roomTypeTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="lecture-tab" data-bs-toggle="tab" data-bs-target="#lecture" type="button" role="tab">Lecture Hall</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="meeting-tab" data-bs-toggle="tab" data-bs-target="#meeting" type="button" role="tab">Meeting Room</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="lab-tab" data-bs-toggle="tab" data-bs-target="#lab" type="button" role="tab">Computer Lab</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="sports-tab" data-bs-toggle="tab" data-bs-target="#sports" type="button" role="tab">Sports Facility</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="other-tab" data-bs-toggle="tab" data-bs-target="#other" type="button" role="tab">Other</button>
                                </li>
                            </ul>

                            
                            <div class="tab-content" id="roomTypeTabsContent">
                            {{-- All Rooms --}}
                            <div class="tab-pane fade show active" id="all" role="tabpanel">
                                <div class="row">
                                    @foreach ($rooms->sortByDesc(function($room) { return $room->status == 'available' ? 1 : 0; }) as $room)
                                        @include('partials.room_card', ['room' => $room])
                                    @endforeach
                                </div>
                            </div>

                            {{-- Lecture Halls --}}
                            <div class="tab-pane fade" id="lecture" role="tabpanel">
                                <div class="row">
                                    @foreach ($rooms->where('type', 'Lecture Hall')->sortByDesc(function($room) { return $room->status == 'available' ? 1 : 0; }) as $room)
                                        @include('partials.room_card', ['room' => $room])
                                    @endforeach
                                </div>
                            </div>

                            {{-- Meeting Rooms --}}
                            <div class="tab-pane fade" id="meeting" role="tabpanel">
                                <div class="row">
                                    @foreach ($rooms->where('type', 'Meeting Room')->sortByDesc(function($room) { return $room->status == 'available' ? 1 : 0; }) as $room)
                                        @include('partials.room_card', ['room' => $room])
                                    @endforeach
                                </div>
                            </div>

                            {{-- Computer Labs --}}
                            <div class="tab-pane fade" id="lab" role="tabpanel">
                                <div class="row">
                                    @foreach ($rooms->where('type', 'Computer Lab')->sortByDesc(function($room) { return $room->status == 'available' ? 1 : 0; }) as $room)
                                        @include('partials.room_card', ['room' => $room])
                                    @endforeach
                                </div>
                            </div>

                            {{-- Sports Facilities --}}
                            <div class="tab-pane fade" id="sports" role="tabpanel">
                                <div class="row">
                                    @foreach ($rooms->where('type', 'Sports Facility')->sortByDesc(function($room) { return $room->status == 'available' ? 1 : 0; }) as $room)
                                        @include('partials.room_card', ['room' => $room])
                                    @endforeach
                                </div>
                            </div>

                            {{-- Other --}}
                            <div class="tab-pane fade" id="other" role="tabpanel">
                                <div class="row">
                                    @foreach (
                                        $rooms->whereNotIn('type', ['Lecture Hall', 'Meeting Room', 'Computer Lab', 'Sports Facility'])
                                            ->sortByDesc(function($room) { return $room->status == 'available' ? 1 : 0; }) 
                                        as $room
                                    )
                                        @include('partials.room_card', ['room' => $room])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                            <input type="hidden" name="room_id" id="selected_room_id" required>
                        </div>

                        <!-- Date Selection Section -->
                        <div class="mb-4" id="dateSection">
                            <h5 class="form-section-title"><i class="fas fa-calendar-day me-2"></i>Select Date</h5>
                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <!-- Start Date -->
                                <input type="date" name="booking_date" id="booking_date" class="form-control" style="max-width: 200px;" required>

                                <!-- End Date: Initially hidden -->
                                <input type="date" name="booking_end_date" id="booking_end_date" class="form-control d-none" style="max-width: 200px;" disabled>

                                <!-- Quick-select date badges -->
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge date-option active" data-action="today">
                                        <i class="fas fa-sun me-1"></i> Today
                                    </span>
                                    <span class="badge date-option" data-action="tomorrow">
                                        <i class="fas fa-arrow-right me-1"></i> Tomorrow
                                    </span>
                                    <span class="badge date-option" data-action="next-week">
                                        <i class="fas fa-calendar-week me-1"></i> Next Week
                                    </span>
                                    <span class="badge date-option" data-action="next-monday">
                                        <i class="fas fa-calendar-day me-1"></i> Next Monday
                                    </span>
                                </div>
                            </div>
                        </div>


                        <!-- JavaScript -->
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const dateInput = document.getElementById('booking_date');
                            const dateOptions = document.querySelectorAll('.date-option');
                            
                            // Format date as YYYY-MM-DD
                            function formatDate(date) {
                                const d = new Date(date);
                                const year = d.getFullYear();
                                const month = String(d.getMonth() + 1).padStart(2, '0');
                                const day = String(d.getDate()).padStart(2, '0');
                                return `${year}-${month}-${day}`;
                            }

                            // Set date and highlight active option
                            function setDate(action) {
                                const date = new Date();
                                
                                switch(action) {
                                    case 'today':
                                        // Already today's date
                                        break;
                                    case 'tomorrow':
                                        date.setDate(date.getDate() + 1);
                                        break;
                                    case 'next-week':
                                        date.setDate(date.getDate() + 7);
                                        break;
                                    case 'next-monday':
                                        const daysUntilMonday = (1 - date.getDay() + 7) % 7;
                                        date.setDate(date.getDate() + (daysUntilMonday || 7));
                                        break;
                                }
                                
                                dateInput.value = formatDate(date);
                                updateActiveOption(action);
                            }

                            // Update active option styling
                            function updateActiveOption(selectedAction) {
                                dateOptions.forEach(option => {
                                    const isActive = option.dataset.action === selectedAction;
                                    option.classList.toggle('active', isActive);
                                    option.classList.toggle('bg-primary', isActive);
                                    option.classList.toggle('text-white', isActive);
                                });
                            }

                            // Add click event listeners
                            dateOptions.forEach(option => {
                                option.addEventListener('click', () => {
                                    setDate(option.dataset.action);
                                });
                            });

                            // Initialize with today's date
                            setDate('today');
                            
                            // Update active state when manual date is selected
                            dateInput.addEventListener('change', function() {
                                const selectedDate = new Date(this.value);
                                const today = new Date();
                                const tomorrow = new Date(today);
                                tomorrow.setDate(tomorrow.getDate() + 1);
                                
                                const nextWeek = new Date(today);
                                nextWeek.setDate(nextWeek.getDate() + 7);
                                
                                const nextMonday = new Date(today);
                                nextMonday.setDate(nextMonday.getDate() + ((1 - nextMonday.getDay() + 7) % 7 || 7));
                                
                                if (selectedDate.toDateString() === today.toDateString()) {
                                    updateActiveOption('today');
                                } else if (selectedDate.toDateString() === tomorrow.toDateString()) {
                                    updateActiveOption('tomorrow');
                                } else if (selectedDate.toDateString() === nextWeek.toDateString()) {
                                    updateActiveOption('next-week');
                                } else if (selectedDate.toDateString() === nextMonday.toDateString()) {
                                    updateActiveOption('next-monday');
                                } else {
                                    dateOptions.forEach(option => option.classList.remove('active', 'bg-primary', 'text-white'));
                                }
                            });
                        });
                        </script>

                        <!-- CSS Styles -->
                        <style>
                            /* Updated CSS for perfect visibility */
                            .date-option {
                                padding: 0.5rem 0.9rem;
                                cursor: pointer;
                                transition: all 0.2s ease;
                                border-radius: 50px;
                                border: 1px solid #dee2e6;
                                display: inline-flex;
                                align-items: center;
                                font-size: 0.9rem;
                                background-color: #f8f9fa; /* Light gray background */
                                color: #212529 !important; /* Forced dark text */
                            }
                            
                            .date-option.active {
                                background-color: #4a6bff !important; /* Your primary color */
                                color: white !important; /* White text when active */
                                border-color: #4a6bff;
                            }
                            
                            .date-option:hover {
                                transform: translateY(-2px);
                                box-shadow: 0 3px 8px rgba(0,0,0,0.1);
                            }
                            
                            /* Ensure icons are always visible */
                            .date-option i {
                                color: inherit !important; /* Inherits text color */
                            }
                        </style>

                        <!-- Time Selection -->
                        <div class="mb-4">
                            <h5 class="form-section-title"><i class="fas fa-clock me-2"></i>Select Time Slot</h5>
                            
                            <!-- Entire Day Toggle -->
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="entireDayToggle" onchange="toggleEntireDay(this)">
                                <label class="form-check-label" for="entireDayToggle">
                                    <i class="fas fa-calendar-day me-1"></i> Entire Day (8:00 AM - 10:00 PM)
                                </label>
                            </div>
                            
                            <!-- Time Slot Groups -->
                            <div class="time-slot-groups">
                                <h6 class="mt-3 mb-2">Morning</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="time-slot" onclick="selectTimeSlot(this, '08:00', '10:00')">8:00 AM - 10:00 AM</span>
                                    <span class="time-slot" onclick="selectTimeSlot(this, '10:00', '12:00')">10:00 AM - 12:00 PM</span>
                                </div>
                                
                                <h6 class="mt-3 mb-2">Afternoon</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="time-slot" onclick="selectTimeSlot(this, '14:00', '16:00')">2:00 PM - 4:00 PM</span>
                                    <span class="time-slot" onclick="selectTimeSlot(this, '16:00', '18:00')">4:00 PM - 6:00 PM</span>
                                </div>
                                
                                <h6 class="mt-3 mb-2">Evening</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="time-slot" onclick="selectTimeSlot(this, '18:00', '20:00')">6:00 PM - 8:00 PM</span>
                                    <span class="time-slot" onclick="selectTimeSlot(this, '20:00', '22:00')">8:00 PM - 10:00 PM</span>
                                </div>
                            </div>
                            
                            <!-- Custom Time Inputs -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="start_time" class="form-label">Custom Start Time</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="end_time" class="form-label">Custom End Time</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time" required>
                                </div>
                            </div>
                        </div>

                        <style>
                            .time-slot {
                                padding: 8px 16px;
                                border: 1px solid #dee2e6;
                                border-radius: 4px;
                                cursor: pointer;
                                transition: all 0.2s;
                            }
                            
                            .time-slot:hover:not(.disabled) {
                                background-color: #f8f9fa;
                                border-color: #adb5bd;
                            }
                            
                            .time-slot.selected {
                                background-color: #0d6efd;
                                color: white;
                                border-color: #0d6efd;
                            }
                            
                            .time-slot.disabled {
                                opacity: 0.5;
                                cursor: not-allowed;
                                pointer-events: none;
                            }
                            
                            .form-section-title {
                                color: #333;
                                font-weight: 600;
                            }
                            
                            .form-check-label {
                                font-weight: 500;
                                cursor: pointer;
                            }
                        </style>

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
                        </div>

                        <!-- Submit and Price -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <input type="hidden" name="total_price" id="total_price" value="0.00">
                            <div class="price-info">
                                <strong>Total Price:</strong> RM <span id="pricePlaceholder">0.00</span>
                            </div>

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
        // Global variable to store pricing info
        window.bookingData = {
            pricePerHour: 0,
            priceFullDay: 0,
            selectedRoomId: null
        };

        // Room selection handler
        function selectRoom(element, roomId, pricePerHour, priceFullDay) {
            document.querySelectorAll('.room-card').forEach(card => {
                card.classList.remove('selected');
            });
            element.classList.add('selected');
            
            // Update global booking data
            window.bookingData.pricePerHour = parseFloat(pricePerHour);
            window.bookingData.priceFullDay = parseFloat(priceFullDay);
            window.bookingData.selectedRoomId = roomId;
            
            // Update hidden field
            document.getElementById('selected_room_id').value = roomId;
            
            // Recalculate price
            calculateTotalPrice();
        }

        function calculateTotalPrice() {
            const startTimeInput = document.getElementById('start_time');
            const endTimeInput = document.getElementById('end_time');
            const priceDisplay = document.getElementById('pricePlaceholder');
            const priceHiddenInput = document.getElementById('total_price');
            const entireDayCheckbox = document.getElementById('entireDayToggle');

           
            // Handle Entire Day pricing with multi-day logic
            if (entireDayCheckbox && entireDayCheckbox.checked) {
                const fullDayPrice = window.bookingData.priceFullDay || 0;

                const startDateInput = document.getElementById('booking_date');
                const endDateInput = document.getElementById('booking_end_date');

                const startDate = new Date(startDateInput.value);
                const endDate = endDateInput && endDateInput.value
                    ? new Date(endDateInput.value)
                    : new Date(startDate); // default to same day if empty

                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;

                const totalPrice = fullDayPrice * diffDays;

                priceDisplay.textContent = totalPrice.toFixed(2);
                priceHiddenInput.value = totalPrice.toFixed(2);
                return;
            }

            // Skip if missing inputs or price per hour is invalid
            if (!startTimeInput.value || !endTimeInput.value || window.bookingData.pricePerHour <= 0) {
                priceDisplay.textContent = '0.00';
                priceHiddenInput.value = '0.00';
                
                return;
            }

            // Per-hour calculation
            const [startHours, startMins] = startTimeInput.value.split(':').map(Number);
            const [endHours, endMins] = endTimeInput.value.split(':').map(Number);

            let durationHours = (endHours + endMins / 60) - (startHours + startMins / 60);

            // Handle overnight bookings
            if (durationHours < 0) {
                durationHours += 24;
            }

            const roundedHours = Math.ceil(durationHours);
            

            if (roundedHours > 0) {
                let totalPrice = roundedHours * window.bookingData.pricePerHour;
                
                if(totalPrice > window.bookingData.priceFullDay){
                    totalPrice = window.bookingData.priceFullDay;
                }
                
                priceDisplay.textContent = totalPrice.toFixed(2);
                priceHiddenInput.value = totalPrice.toFixed(2);
            } else {
                priceDisplay.textContent = '0.00';
                priceHiddenInput.value = '0.00';
            }
        }


        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize date picker
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('booking_date').value = today;
            document.getElementById('booking_date').min = today;
            
            // Set up time change listeners
            document.getElementById('start_time').addEventListener('change', function() {
                calculateTotalPrice();
                validateTimeRange();
            });
            
            document.getElementById('end_time').addEventListener('change', function() {
                calculateTotalPrice();
                validateTimeRange();
            });
        });

        // Additional validation function
        function validateTimeRange() {
            const start = document.getElementById('start_time').value;
            const end = document.getElementById('end_time').value;
            
            if (start && end) {
                const startTime = new Date(`2000-01-01T${start}`);
                const endTime = new Date(`2000-01-01T${end}`);
                
                if (endTime <= startTime) {
                    alert('End time must be after start time');
                    document.getElementById('end_time').value = '';
                    calculateTotalPrice();
                }
            }
        }
        
        // Set default date to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('booking_date').value = today;
            document.getElementById('booking_date').min = today;
        });
    </script>
@if ($errors->any())
    <script>
        alert("{{ implode('\n', $errors->all()) }}");
    </script>
@endif

</body>
</html>
@endsection