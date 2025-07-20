## FACULTY OF INFORMATION AND COMMUNICATION TECHNOLOGY

## Universiti Teknikal Malaysia Melaka
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
| 5.  | *(To be filled)*                          | *(To be filled)* | S3G1          |

---

## 1.0 Introduction

*(To be completed with a short description of the system, its purpose, and problem it solves)*

---

## 2.0 System Architecture

*(Insert a high-level diagram here — use image or Mermaid syntax)*

---

## 3.0 Backend Application

*(To be completed with backend stack, list of APIs, methods, example responses, security mechanisms like authentication, and middleware roles)*

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

**Figure 1:** Snippet of RESTful API routes used by the Faculty Booking (User) application
**Figure 2:** JavaScript snippet for PDF download integration
**Figure 3:** Backend method to generate PDF booking confirmation

**Explanation:**

* `Route::get('/bookings/{id}/pdf', ...)` generates a downloadable PDF version of a specific booking, providing users with a digital or printable confirmation.

**Frontend usage example:**

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

**Figure 5:** Snippet of RESTful API routes used by the Booking Management (Admin) application
**Figure 6:** Frontend JavaScript function to delete a room using the `DELETE` API endpoint
**Figure 7:** Laravel `destroy()` method in `RoomApiController` that handles room deletion via API

**Explanation:**

* `Route::apiResource('rooms', RoomApiController::class)` defines a full RESTful controller for managing room resources.
* `GET /users` exposes user data for admin tracking and user management.
* The frontend JavaScript uses `fetch()` to call the `DELETE` method on `/api/rooms/{id}`, mapping to the controller’s `destroy()` method.

**Frontend usage example:**

**Figure 8:** Example of frontend JavaScript integrating the DELETE API to remove a room in the admin interface

---

## 5.0 Database Design

*(Include ERD diagram and schema justification)*

---

## 6.0 Business Logic and Data Validation

### 6.1 Use Case Diagrams / Flowcharts

*(Include visual representations of key processes such as login, booking, room management, etc.)*

### 6.2 Data Validation

**a. Log In**

* Check if email and password are filled
* Validate user role before granting access

**b. Booking Details**

* Ensure dates are valid (not in the past)
* Prevent double-booking of the same room

**c. New Room Addition**

* Validate room name is unique
* Check capacity and room type fields are filled

\*\*d. *(Add more cases if applicable)* \*\*

---

> 📌 *Note: Images and diagrams can be placed inside a ****`/docs`**** or ****`/assets`**** folder and linked in markdown using ****`![Alt text](./assets/diagram.png)`**** syntax.*
