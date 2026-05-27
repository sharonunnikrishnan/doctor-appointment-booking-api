# 🏥 Doctor Appointment Booking API

A RESTful Doctor Appointment Booking System built with Laravel 13.

This project demonstrates modern Laravel development practices including:

- Laravel Sanctum Authentication
- Service Layer Architecture
- Form Request Validation
- API Resources
- Eloquent Relationships
- Authorization Policies
- Event Driven Architecture
- Queue Jobs
- Email Notifications
- Database Transactions
- API Testing with Pest/PHPUnit

---

# 🚀 Features

## Authentication

- User Registration
- User Login
- User Logout
- Sanctum Token Authentication
- Protected API Routes

## Doctor Management

- Create Doctor Profile
- Update Doctor Profile
- View Doctor Details
- List Doctors
- Delete Doctor

## Appointment Management

- Book Appointment
- View Appointments
- Update Appointment Status
- Cancel Appointment
- Delete Appointment

## Authorization

### Patient

- Create appointments
- View own appointments
- Cancel own appointments

### Doctor

- View assigned appointments
- Confirm appointments
- Complete appointments

### Admin

- Full system access

## Notifications

- Appointment Booked Event
- Event Listener
- Queue Job Processing
- Email Confirmation Notifications

---

# 🏗️ Architecture

```text
Controller
    ↓
Form Request Validation
    ↓
Service Layer
    ↓
Eloquent Models
    ↓
Database
```

### Event Workflow

```text
Appointment Created
        ↓
AppointmentBooked Event
        ↓
SendAppointmentConfirmationListener
        ↓
SendAppointmentConfirmationJob
        ↓
Email Notification
```

---

# 🛠️ Tech Stack

- PHP 8.3+
- Laravel 13
- MySQL
- Laravel Sanctum
- Pest / PHPUnit
- Mailtrap (for testing emails)

---

# 📂 Project Structure

```text
app
├── Events
│   └── AppointmentBooked.php
│
├── Http
│   ├── Controllers
│   ├── Requests
│   └── Resources
│
├── Jobs
│   └── SendAppointmentConfirmationJob.php
│
├── Listeners
│   └── SendAppointmentConfirmationListener.php
│
├── Mail
│   └── AppointmentConfirmationMail.php
│
├── Models
│   ├── User.php
│   ├── Doctor.php
│   └── Appointment.php
│
├── Policies
│   └── AppointmentPolicy.php
│
├── Services
│   ├── DoctorService.php
│   └── AppointmentService.php
```

---

# 🔗 Database Design

## Users

| Column | Type |
|----------|----------|
| id | bigint |
| name | string |
| email | string |
| password | string |
| role | enum |

Roles:

```text
admin
doctor
patient
```

---

## Doctors

| Column | Type |
|----------|----------|
| id | bigint |
| user_id | bigint |
| specialization | string |
| experience | integer |
| consultation_fee | decimal |

---

## Appointments

| Column | Type |
|----------|----------|
| id | bigint |
| doctor_id | bigint |
| patient_id | bigint |
| appointment_date | date |
| appointment_time | time |
| status | enum |
| remarks | text |

Status:

```text
pending
confirmed
completed
cancelled
```

---

# 🔐 Authentication

Authentication is implemented using Laravel Sanctum.

## Register

```http
POST /api/register
```

Request:

```json
{
    "name":"John Doe",
    "email":"john@example.com",
    "password":"password",
    "password_confirmation":"password"
}
```

---

## Login

```http
POST /api/login
```

Request:

```json
{
    "email":"john@example.com",
    "password":"password"
}
```

Response:

```json
{
    "token":"1|xxxxxxxxxxxxx"
}
```

Use token in header:

```http
Authorization: Bearer TOKEN
```

---

## Logout

```http
POST /api/logout
```

---

# 👨‍⚕️ Doctor APIs

## Create Doctor

```http
POST /api/doctors
```

```json
{
    "specialization":"Cardiology",
    "experience":10,
    "consultation_fee":1000
}
```

---

## List Doctors

```http
GET /api/doctors
```

---

## Show Doctor

```http
GET /api/doctors/{id}
```

---

## Update Doctor

```http
PUT /api/doctors/{id}
```

```json
{
    "experience":15
}
```

---

## Delete Doctor

```http
DELETE /api/doctors/{id}
```

---

# 📅 Appointment APIs

## Create Appointment

```http
POST /api/appointments
```

Request:

```json
{
    "doctor_id":1,
    "appointment_date":"2026-06-01",
    "appointment_time":"10:00"
}
```

---

## List Appointments

```http
GET /api/appointments
```

---

## Show Appointment

```http
GET /api/appointments/{id}
```

---

## Update Appointment

```http
PUT /api/appointments/{id}
```

```json
{
    "status":"confirmed",
    "remarks":"Appointment approved"
}
```

---

## Delete Appointment

```http
DELETE /api/appointments/{id}
```

---

# 🔒 Authorization Policies

Implemented using Laravel Policies.

Examples:

- Patients can access only their appointments
- Doctors can access appointments assigned to them
- Admins can access all resources

Example:

```php
$this->authorize(
    'update',
    $appointment
);
```

---

# ⚡ Queue System

Queue Driver:

```env
QUEUE_CONNECTION=database
```

Create queue tables:

```bash
php artisan make:queue-table
php artisan migrate
```

Start worker:

```bash
php artisan queue:work
```

---

# 📧 Email Notifications

When an appointment is booked:

```text
Appointment Created
      ↓
Event Fired
      ↓
Listener Triggered
      ↓
Queue Job Executed
      ↓
Email Sent
```

Mail testing:

```env
MAIL_MAILER=log
```

or Mailtrap SMTP.

---

# 🧪 Testing

Run tests:

```bash
php artisan test
```

or

```bash
./vendor/bin/pest
```

Example test:

```php
test('patient can create appointment', function () {

    $response = $this->postJson(
        '/api/appointments',
        [
            'doctor_id' => 1,
            'appointment_date' => now()
                ->addDay()
                ->toDateString(),
            'appointment_time' => '10:00'
        ]
    );

    $response->assertCreated();

});
```

---

# ⚙️ Installation

Clone repository:

```bash
git clone https://github.com/your-username/doctor-appointment-booking-api.git
```

Move into project:

```bash
cd doctor-appointment-booking-api
```

Install dependencies:

```bash
composer install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database in `.env`.

Run migrations:

```bash
php artisan migrate
```

Install Sanctum:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

Start development server:

```bash
php artisan serve
```

---

# Future Improvements

- Doctor Availability Slots
- Online Video Consultation
- Payment Gateway Integration
- Prescription Management
- Appointment Reminders
- Admin Dashboard
- React Frontend
- Mobile App Integration

---

# 👨‍💻 Author

**Sharon Unnikrishnan**

Laravel Developer | PHP Developer | API Integration Specialist

Technologies:

- Laravel
- PHP
- MySQL
- React.js
- JavaScript
- REST APIs
- Sanctum Authentication
- Queue Jobs
- Event Driven Architecture

---
