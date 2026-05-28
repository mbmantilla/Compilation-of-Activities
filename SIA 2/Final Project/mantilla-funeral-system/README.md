# Web-Based Mantilla Funeral Reservation System
PHP + Laravel + MySQL + Blade

This source-code kit is designed to be copied into a fresh Laravel project. It includes the main system modules for:

## User Roles

### Client / Family Member
- Register account
- Login / logout
- View funeral service listings
- View service details
- Submit funeral service reservation
- View reservation status
- Cancel reservation

### Funeral Service Admin / Staff
- Admin login / logout
- Manage funeral service listings
- View reservation requests
- Approve / reject reservations
- Manage client records
- Update service availability
- Generate reports

---

## Recommended Requirements

- PHP 8.2 or higher
- Composer
- MySQL or MariaDB
- Laravel 12/13 style project structure
- Web browser

---

## Step 1: Create a Laravel Project

```bash
composer create-project laravel/laravel mantilla-funeral-system
cd mantilla-funeral-system
```

---

## Step 2: Configure `.env`

Create a database in MySQL:

```sql
CREATE DATABASE mantilla_funeral_db;
```

Update your `.env` file:

```env
APP_NAME="Mantilla Funeral Reservation System"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mantilla_funeral_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## Step 3: Copy the Source Files

Copy the folders/files from this kit into your Laravel project.

Important:
- Replace the default `routes/web.php`.
- Replace the default `app/Models/User.php`.
- Replace or adjust the default user migration if your Laravel project already has one.
- Add the middleware alias shown in `bootstrap/app.php.example` into your real `bootstrap/app.php`.

---

## Step 4: Register the Role Middleware

Open your real Laravel file:

```txt
bootstrap/app.php
```

Inside `->withMiddleware(function (Middleware $middleware): void { ... })`, add:

```php
$middleware->alias([
    'role' => \App\Http\Middleware\RoleMiddleware::class,
]);
```

A full example is included in `bootstrap/app.php.example`.

---

## Step 5: Run Migrations and Seeders

```bash
php artisan migrate:fresh --seed
```

This creates:
- Users table
- Funeral services table
- Reservations table
- Default admin account
- Sample funeral services

---

## Step 6: Start the System

```bash
php artisan serve
```

Open:

```txt
http://127.0.0.1:8000
```

---

## Default Accounts

### Admin / Staff
```txt
Email: admin@mantilla.test
Password: password
```

### Client
Register using the website.

---

## Folder Structure

```txt
app/
  Http/
    Controllers/
      AuthController.php
      DashboardController.php
      ServiceController.php
      ReservationController.php
      Admin/
        AdminDashboardController.php
        AdminServiceController.php
        AdminReservationController.php
        AdminClientController.php
        AdminReportController.php
    Middleware/
      RoleMiddleware.php
  Models/
    User.php
    FuneralService.php
    Reservation.php

database/
  migrations/
  seeders/

resources/
  views/
    layouts/
    auth/
    services/
    reservations/
    admin/
```

---

## Main Database Tables

### users
Stores all users including clients and admin/staff.

### funeral_services
Stores funeral package/service details.

### reservations
Stores client reservation requests and reservation status.

---

## Reservation Status Flow

```txt
pending -> approved
pending -> rejected
pending/approved -> cancelled
```

---

## Notes for Beginners

This project intentionally uses simple Blade templates and Laravel controllers instead of complex frontend frameworks. This makes it easier to understand for capstone, thesis, and school system development.
