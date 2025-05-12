<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Admin Dashboard</title>

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
        
        .settings-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        
        .settings-card .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1rem 1.5rem;
            font-weight: 600;
        }
        
        .settings-card .card-body {
            padding: 1.5rem;
        }
        
        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
            margin-right: 0.5rem;
        }
        
        .settings-group {
            margin-bottom: 1.5rem;
        }
        
        .settings-group-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .settings-group-title i {
            margin-right: 0.5rem;
        }
        
        .settings-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .settings-item:last-child {
            border-bottom: none;
        }
        
        .settings-item-label {
            flex: 1;
        }
        
        .settings-item-label h6 {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .settings-item-label p {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 0;
        }
        
        .settings-item-control {
            margin-left: 1rem;
        }
        
        .btn-save {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }
        
        .btn-save:hover {
            background-color: #3a5bef;
            border-color: #3a5bef;
        }
        
        .theme-color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 0.5rem;
            cursor: pointer;
            border: 2px solid transparent;
        }
        
        .theme-color-option.selected {
            border-color: #495057;
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
        
        .theme-color-1 { background-color: #1a237e; }
        .theme-color-2 { background-color: #0d6efd; }
        .theme-color-3 { background-color: #4caf50; }
        .theme-color-4 { background-color: #ff9800; }
        .theme-color-5 { background-color: #9c27b0; }
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
                <a href="{{ route('admin.managebooking') }}" class="nav-link"><i class="fas fa-calendar-check"></i>Manage Bookings</a>
            </li>
            <!--
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active"><i class="fas fa-cog"></i>Settings</a>
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
            <h2>Settings</h2>
            <div class="d-flex align-items-center">
                <button class="btn btn-save">
                    <i class="fas fa-save me-2"></i>Save Changes
                </button>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <!-- General Settings -->
                <div class="settings-card card">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-sliders-h me-2"></i>
                        General Settings
                    </div>
                    <div class="card-body">
                        <div class="settings-group">
                            <div class="settings-group-title">
                                <i class="fas fa-building"></i>
                                System Configuration
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>System Name</h6>
                                    <p>Display name for the booking system</p>
                                </div>
                                <div class="settings-item-control">
                                    <input type="text" class="form-control" value="UiTM Facility Booking System" style="width: 250px;">
                                </div>
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Time Zone</h6>
                                    <p>Set the default time zone for all bookings</p>
                                </div>
                                <div class="settings-item-control">
                                    <select class="form-select" style="width: 250px;">
                                        <option>(UTC+08:00) Kuala Lumpur, Singapore</option>
                                        <option>(UTC+00:00) London</option>
                                        <option>(UTC-05:00) New York</option>
                                    </select>
                                </div>
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Date Format</h6>
                                    <p>How dates are displayed throughout the system</p>
                                </div>
                                <div class="settings-item-control">
                                    <select class="form-select" style="width: 250px;">
                                        <option>DD/MM/YYYY (15/01/2023)</option>
                                        <option>MM/DD/YYYY (01/15/2023)</option>
                                        <option>YYYY-MM-DD (2023-01-15)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="settings-group">
                            <div class="settings-group-title">
                                <i class="fas fa-bell"></i>
                                Notifications
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Email Notifications</h6>
                                    <p>Send email notifications for new bookings and changes</p>
                                </div>
                                <div class="settings-item-control">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                                        <label class="form-check-label" for="emailNotifications"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Approval Required</h6>
                                    <p>Require admin approval for all bookings</p>
                                </div>
                                <div class="settings-item-control">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="approvalRequired" checked>
                                        <label class="form-check-label" for="approvalRequired"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Reminder Notifications</h6>
                                    <p>Send reminders before booked events</p>
                                </div>
                                <div class="settings-item-control">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="reminderNotifications" checked>
                                        <label class="form-check-label" for="reminderNotifications"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Booking Settings -->
                <div class="settings-card card">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-calendar-check me-2"></i>
                        Booking Settings
                    </div>
                    <div class="card-body">
                        <div class="settings-group">
                            <div class="settings-group-title">
                                <i class="fas fa-clock"></i>
                                Booking Rules
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Maximum Booking Duration</h6>
                                    <p>Maximum allowed duration for a single booking</p>
                                </div>
                                <div class="settings-item-control">
                                    <select class="form-select" style="width: 150px;">
                                        <option>4 hours</option>
                                        <option>8 hours</option>
                                        <option>12 hours</option>
                                        <option>24 hours</option>
                                    </select>
                                </div>
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Advance Booking Limit</h6>
                                    <p>How far in advance users can book facilities</p>
                                </div>
                                <div class="settings-item-control">
                                    <select class="form-select" style="width: 150px;">
                                        <option>1 week</option>
                                        <option>2 weeks</option>
                                        <option>1 month</option>
                                        <option>3 months</option>
                                    </select>
                                </div>
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Minimum Cancellation Notice</h6>
                                    <p>How much notice is required to cancel a booking</p>
                                </div>
                                <div class="settings-item-control">
                                    <select class="form-select" style="width: 150px;">
                                        <option>1 hour</option>
                                        <option>6 hours</option>
                                        <option>12 hours</option>
                                        <option>24 hours</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="settings-group">
                            <div class="settings-group-title">
                                <i class="fas fa-restroom"></i>
                                Room Restrictions
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Maximum Simultaneous Bookings</h6>
                                    <p>Maximum bookings a user can have at one time</p>
                                </div>
                                <div class="settings-item-control">
                                    <input type="number" class="form-control" value="3" min="1" style="width: 80px;">
                                </div>
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Restrict Booking Times</h6>
                                    <p>Only allow bookings during certain hours</p>
                                </div>
                                <div class="settings-item-control">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="restrictBookingTimes">
                                        <label class="form-check-label" for="restrictBookingTimes"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Theme Settings -->
                <div class="settings-card card">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-palette me-2"></i>
                        Appearance
                    </div>
                    <div class="card-body">
                        <div class="settings-group">
                            <div class="settings-group-title">
                                <i class="fas fa-fill-drip"></i>
                                Theme Color
                            </div>
                            <div class="d-flex mb-3">
                                <div class="theme-color-option theme-color-1 selected"></div>
                                <div class="theme-color-option theme-color-2"></div>
                                <div class="theme-color-option theme-color-3"></div>
                                <div class="theme-color-option theme-color-4"></div>
                                <div class="theme-color-option theme-color-5"></div>
                            </div>
                        </div>
                        
                        <div class="settings-group">
                            <div class="settings-group-title">
                                <i class="fas fa-moon"></i>
                                Dark Mode
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Enable Dark Mode</h6>
                                    <p>Switch between light and dark color schemes</p>
                                </div>
                                <div class="settings-item-control">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="darkMode">
                                        <label class="form-check-label" for="darkMode"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="settings-group">
                            <div class="settings-group-title">
                                <i class="fas fa-columns"></i>
                                Dashboard Layout
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Compact Mode</h6>
                                    <p>Use a more compact layout with smaller elements</p>
                                </div>
                                <div class="settings-item-control">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="compactMode">
                                        <label class="form-check-label" for="compactMode"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Account Settings -->
                <div class="settings-card card">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-user-cog me-2"></i>
                        Account Settings
                    </div>
                    <div class="card-body">
                        <div class="settings-group">
                            <div class="settings-group-title">
                                <i class="fas fa-user-shield"></i>
                                Admin Profile
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Change Password</h6>
                                    <p>Update your account password</p>
                                </div>
                                <div class="settings-item-control">
                                    <button class="btn btn-outline-primary btn-sm">Change</button>
                                </div>
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Two-Factor Authentication</h6>
                                    <p>Add an extra layer of security to your account</p>
                                </div>
                                <div class="settings-item-control">
                                    <button class="btn btn-outline-secondary btn-sm">Enable</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="settings-group">
                            <div class="settings-group-title">
                                <i class="fas fa-envelope"></i>
                                Email Preferences
                            </div>
                            <div class="settings-item">
                                <div class="settings-item-label">
                                    <h6>Notification Frequency</h6>
                                    <p>How often you receive email notifications</p>
                                </div>
                                <div class="settings-item-control">
                                    <select class="form-select">
                                        <option>Immediately</option>
                                        <option>Daily Digest</option>
                                        <option>Weekly Summary</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Theme color selection
        document.querySelectorAll('.theme-color-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.theme-color-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });
        
        // Toggle dark mode preview (for demo purposes)
        document.getElementById('darkMode').addEventListener('change', function() {
            if(this.checked) {
                document.body.classList.add('dark-mode-preview');
            } else {
                document.body.classList.remove('dark-mode-preview');
            }
        });
    </script>
</body>
</html>