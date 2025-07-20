<p align="center">
  <img src="./readme%20image/UTeM.jpg" alt="UTeM Logo" width="350">
</p>

## UNIVERSITI TEKNIKAL MALAYSIA MELAKA
## FACULTY OF INFORMATION AND COMMUNICATION TECHNOLOGY

**BITP3123 Distributed Application Development**
**Semester 2, 2024/2025**

---

### Lecturer:

**Ts. Muhammad Faheem Mohd Ezani**

### Prepared By:

| No. | Group Members                             | Matric Number    | Section/Group |
| --- | ----------------------------------------- | ---------------- | ------------- |
| 1.  | Muhammad Afiq Haikal bin Shari'at Helsuki | B032420065       | S3G1          |
| 2.  | Khairulnadzmi bin Md Yusof                | B032420046       | S3G1          |
| 3.  | Mohamad Haikal bin Rejab                  | B032420055       | S3G1          |
| 4.  | Muhammad Aliff bin Affandi                | B032420067       | S3G1          |
| 5.  | Amardeep Singh Sidhu A/L Surjit Singh     | B032420021       | S3G1          |

---

## 1.0 Introduction

The Faculty Booking System is a web-based application designed to streamline room and facility bookings within a university faculty.

Users can view available rooms, make bookings, and manage existing reservations easily via a centralized platform.

The system ensures better resource allocation, reduces booking conflicts, and improves communication between staff and faculty admins.

## 1.1 Commercial Value and Third-Party Integration

Commercial Value:

- Reduces administrative overhead and manual booking processes.
- Enhances efficiency and productivity for both students and faculty staff.
- Provides real-time availability and booking status to prevent scheduling issues.

Third-Party Integration:
- Uses phpMyAdmin for MySQL database management.
- Can be integrated with Google Calendar API for event syncing (future scalability).
- Potential to integrate with university SSO (Single Sign-On) system for authentication

---

## 2.0 System Architecture

- Built using the Laravel framework, which offers robust MVC architecture, routing, middleware, and Eloquent ORM.
- Backend is developed in PHP (Laravel), while frontend utilizes Blade templating engine, HTML, CSS, and optional JavaScript/jQuery for interactivity.
- phpMyAdmin (MySQL) is used to manage all booking data, room records, and user credentials.

The system is structured into Modules:

- User Management
- Room Management
- Booking Engine
- Admin Panel

## 2.1 High-level Diagram

<p align="center">
  <img src="./readme%20image/hld.png" alt="" width="550">
</p>


---

## 3.0 Backend Application

### 3.1 Technology Stack

## 🖥️ Backend Framework & Language

- **PHP 8.2+** – Programming language  
- **Laravel 12.0** – PHP web application framework  
- **Laravel Breeze 2.3** – Authentication scaffolding  

## 🎨 Frontend Technologies

- **Blade Templates** – Laravel's templating engine  
- **Tailwind CSS 3.1** – Utility-first CSS framework  
- **Alpine.js 3.4.2** – Lightweight JavaScript framework  
- **Vite 6.2.4** – Modern build tool and development server  

## 🛠️ Build & Development Tools

- **Composer** – PHP dependency manager  
- **NPM** – Node.js package manager  
- **Laravel Vite Plugin** – Asset bundling integration  
- **PostCSS** – CSS post-processor  
- **Autoprefixer** – CSS vendor prefix automation  

## 🌐 HTTP Client & Utilities

- **Axios** – HTTP client for JavaScript  
- **Firebase/Auth & Firebase** – Authentication and real-time database services  

## 📦 Additional Libraries

- **@tailwindcss/forms** – Form styling plugin for Tailwind CSS  
- **Concurrently** – Run multiple commands concurrently  

### 3.2 API Documentation

## GET /api/users

**Description**: Retrieve a paginated list of all users.

**Request**
- **Headers**:
  ```json
  {
    "Accept": "application/json"
  }

**✅ Success (Status: 200):**
```html
{
  "status": 200,
  "message": "Users fetched successfully",
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 7,
        "name": "Wilfred Littel",
        "email": "walker.erling@example.org",
        "role": 0,
        "ic_number": null,
        "phone_number": null,
        "email_verified_at": "2025-07-08T10:43:45.000000Z",
        "created_at": "2025-07-08T10:43:45.000000Z",
        "updated_at": "2025-07-08T10:43:45.000000Z"
      }
    ]
  }
}
```
**❌ Error (Status: 500):**
```html
{
  "status": 500,
  "message": "Internal Server Error"
}
``

---

## 4.0 Frontend Applications

### 4.1 Faculty Booking (User Application)

**Purpose:**
This frontend is designed for faculty staff or students who want to book available rooms for meetings, classes, or events. It allows users to:

* View available rooms
* Make bookings
* View booking history
* Cancel reservations if needed

**Technology Stack:**

* Blade Templating Engine (Laravel's built-in frontend system)
* HTML5 & CSS3 (for structure and styling)
* Bootstrap 5 (for responsive design and components)
* JavaScript (including jQuery for interactivity)

**API Integration:**
The Faculty Booking frontend interacts with the backend using RESTful API principles. Laravel's route system is used to define HTTP endpoints such as `GET`, `POST`, and `DELETE`. These endpoints allow the frontend to operate asynchronously using JavaScript or AJAX.

<p align="center">
  <img src="./readme%20image/Picture2.png" alt="" width="550">
</p>

**Figure 1:** Snippet of RESTful API routes used by the Faculty Booking (User) application

<p align="center">
  <img src="./readme%20image/Picture3.png" alt="" width="550">
</p>

**Figure 2:** JavaScript snippet for PDF download integration

<p align="center">
  <img src="./readme%20image/Picture4.png" alt="" width="550">
</p>

**Figure 3:** Backend method to generate PDF booking confirmation

**Explanation:**

* `Route::get('/bookings/{id}/pdf', ...)` generates a downloadable PDF version of a specific booking, providing users with a digital or printable confirmation.

**Frontend usage example:**

<p align="center">
  <img src="./readme%20image/Picture5.png" alt="" width="550">
</p>

**Figure 4:** Example of integrating the booking PDF download API on the frontend

---

### 4.2 Booking Management (Admin Application)

**Purpose:**
This frontend is intended for administrators or facility managers responsible for overseeing and managing booking requests. It enables:

* Viewing incoming booking applications
* Approving or rejecting bookings
* Monitoring room availability
* Managing users and rooms

**Technology Stack:**

* Blade Templating Engine (Laravel's built-in frontend system)
* HTML5 & CSS3 (for structure and styling)
* Bootstrap 5 (for responsive design and components)
* JavaScript (including jQuery for interactivity)

**API Integration:**
The Admin Booking Management interface communicates with the backend via RESTful API routes. These routes allow administrative actions such as approving bookings, rejecting requests, viewing logs, and exporting reports. Laravel routes are protected by authentication and role-based access to ensure that only authorized administrators can access sensitive features.

<p align="center">
  <img src="./readme%20image/Picture6.png" alt="" width="550">
</p>

**Figure 5:** Snippet of RESTful API routes used by the Booking Management (Admin) application

<p align="center">
  <img src="./readme%20image/Picture7.png" alt="" width="550">
</p>

**Figure 6:** Frontend JavaScript function to delete a room using the `DELETE` API endpoint

<p align="center">
  <img src="./readme%20image/Picture8.png" alt="" width="550">
</p>

**Figure 7:** Laravel `destroy()` method in `RoomApiController` that handles room deletion via API

**Explanation:**

* `Route::apiResource('rooms', RoomApiController::class)` defines a full RESTful controller for managing room resources.
* `GET /users` exposes user data for admin tracking and user management.
* The frontend JavaScript uses `fetch()` to call the `DELETE` method on `/api/rooms/{id}`, mapping to the controller’s `destroy()` method.

**Frontend usage example:**

<p align="center">
  <img src="./readme%20image/Picture9.png" alt="" width="550">
</p>

**Figure 8:** Example of frontend JavaScript integrating the DELETE API to remove a room in the admin interface

---

## 5.0 Database Design

### 5.1 Entity-Relationship Diagram (ERD)

The Room Booking System is structured around three core entities: **Users**, **Rooms**, and **Bookings**. The relationships are defined as:

- **Users ↔ Bookings**: One-to-Many  
- **Rooms ↔ Bookings**: One-to-Many

Each user can make multiple bookings, and each room can be booked multiple times. This relational structure promotes data integrity, prevents redundancy, and ensures efficient management of booking records.

<p align="center">
  <img src="./readme%20image/booking-erd (1).drawio.png" alt="" width="550">
</p>

---

### 5.2 Schema Justification

The database was designed with simplicity, scalability, and clarity in mind. Here's a breakdown of key tables and their roles:

### Users Table
Stores user information and supports authentication.

| Column             | Purpose                                |
|--------------------|----------------------------------------|
| `id` (PK)          | Unique user ID                         |
| `name`             | Full name                              |
| `email`            | Login & communication                  |
| `role`             | User type (admin, staff, user)         |
| `ic_number`        | ID card verification                   |
| `phone_number`     | Contact info                           |
| `email_verified_at`| Email verification status              |
| `password`         | Secured credentials                    |
| `remember_token`   | "Remember me" support                  |
| `created_at`       | Timestamp when created                 |
| `updated_at`       | Timestamp when updated                 |

### Rooms Table
Defines the attributes of bookable rooms.

| Column             | Purpose                                |
|--------------------|----------------------------------------|
| `id` (PK)          | Unique room ID                         |
| `name`, `type`     | Room description (e.g., Lab, Hall)     |
| `capacity`         | Max occupancy                          |
| `price_per_hour`   | Hourly booking rate                    |
| `price_fullday`    | Full-day rate                          |
| `building`         | Location of the room                   |
| `status`           | Availability status                    |
| `description`      | Additional details                     |
| `created_at`       | Timestamp when created                 |
| `updated_at`       | Timestamp when updated                 |

### Bookings Table
Tracks all room reservation data.

| Column             | Purpose                                |
|--------------------|----------------------------------------|
| `id` (PK)          | Unique booking ID                      |
| `user_id` (FK)     | Links to booking user                  |
| `room_id` (FK)     | Links to booked room                   |
| `booking_date`     | Reservation date                       |
| `end_date`         | For multi-day bookings                 |
| `start_time`       | Start time of booking                  |
| `end_time`         | End time of booking                    |
| `purpose_type`     | Type of event (e.g., seminar)          |
| `purpose`          | Description of the booking             |
| `status`           | Booking status (pending, approved)     |
| `total_price`      | Calculated cost                        |
| `created_at`       | Timestamp when created                 |
| `updated_at`       | Timestamp when updated                 |

---

## 6.0 Business Logic and Data Validation

### 6.1 Use Case Diagrams / Flowcharts

*(Include visual representations of key processes such as login, booking, room management, etc.)*

### 6.2 Data Validation

**a. Log In**

**Description:**
* Email must be a valid address and exist in the database.
* Password must be at least 8 characters.
* Form errors are displayed inline under each input field.

**Frontend Behavior:**
When validation fails, error messages appear like:
```html
<span class="text-sm text-red-600">The email field is required.</span>
```

**Blade Snippet**
```html
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />
    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>|
```

**Backend Validation Code:**
```html
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
```

---

**b. Booking Details**

**Description:**
* Users must select a purpose type (Lecture, Meeting, Study Group, etc.)
* Users must provide additional details about the booking in the purpose field
* Booking date and end date must be valid and not in the past
* Room must exist in the system
* Validation ensures that all inputs are meaningful and prevent incorrect submissions

**Frontend Behavior:**
When validation fails, error messages appear like:
```html
<span class="text-sm text-red-600">The email field is required.</span>
```

**Blade Snippet**
```html
<div class="mb-4">
    <h5 class="form-section-title">
        <i class="fas fa-info-circle me-2"></i>Booking Details
    </h5>

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

<div class="d-flex justify-content-between align-items-center mt-4">
    <input type="hidden" name="total_price" id="total_price" value="0.00">
    <div class="price-info">
        <strong>Total Price:</strong> RM <span id="pricePlaceholder">0.00</span>
    </div>

    <button type="submit" class="btn btn-book btn-lg">
        <i class="fas fa-check-circle me-2"></i> Confirm Booking
    </button>
</div>
```

**Backend Validation Code:**
```html
public function store(Request $request)
{
    $request->merge([
        'end_date' => $request->input('booking_end_date')
    ]);

    $validated = $request->validate([
        'purpose_type' => ['required', 'in:Lecture,Meeting,Study Group,Event,Other'],
        'purpose' => ['required', 'string', 'min:10'],
        'booking_date' => ['required', 'date', 'after_or_equal:today'],
        'booking_end_date' => ['required', 'date', 'after_or_equal:booking_date'],
        'room_id' => ['required', 'exists:rooms,id'],
    ]);

    ProcessBooking::dispatch(Auth::user(), $validated);

    return redirect()->route('userprofile')
                     ->with('success', 'Booking is being processed!');
}
```

---

**c. New Room Addition**

**Description:**
* Allows admin users to create a new room in the system with specific attributes like name, type, capacity, price, and description.

**Frontend Behavior:**
When validation fails, error messages appear like:
```html
<span class="text-sm text-red-600">The email field is required.</span>
```

**Blade Snippet**
```html
<div class="row g-3">
    <div class="col-md-6">
        <label for="roomName" class="form-label">Room Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="roomName" name="name" placeholder="e.g. Dewan Kuliah 100" required>
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
```

**JavaScript AJAX Submission Code:**
```html
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
```

**Backend Validation Code:**
```html
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'capacity' => 'required|integer|min:1',
        'building' => 'required|string|max:255',
        'status' => 'required|in:available,maintenance,occupied',
        'price_per_hour' => 'required|numeric|min:0',
        'price_fullday' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
    ]);

    Room::create($validated);

    return redirect()->back()->with('success', 'Room added successfully.');
}
```
