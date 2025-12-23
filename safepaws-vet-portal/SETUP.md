# SafePaws LK Vet Portal - Setup Guide

Welcome to the SafePaws LK Veterinary Portal! This is a comprehensive veterinary management system built with Laravel 12, featuring a modern dark-themed interface with Tailwind CSS and Alpine.js.

## Features

- **Dashboard**: Overview with key statistics (patients, appointments, reports, revenue)
- **Branch Management**: View all clinic branches with locations
- **Appointments**: Track and manage patient appointments
- **Medical Reports**: Create and view medical records with file uploads
- **Authentication**: Secure login system for veterinarians
- **Dark Theme**: Professional dark mode interface with glass-card design

## Tech Stack

- Laravel 12
- PHP 8.3+
- Tailwind CSS 4
- Alpine.js
- SQLite Database

## Installation

### 1. Install PHP Extensions

Make sure you have the following PHP extensions installed:

```bash
# On Ubuntu/Debian
sudo apt-get install php8.3-dom php8.3-xml php8.3-xmlwriter php8.3-mbstring php8.3-sqlite3

# On macOS with Homebrew
brew install php@8.3
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Configure Environment

The `.env` file is already configured with:
- SQLite database connection
- Application key generated

### 4. Run Migrations and Seeders

```bash
# Run database migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

This will create:
- 3 branches (Colombo, Kandy, Galle)
- 5 sample patients
- 5 appointments
- 5 medical records
- 1 veterinarian user

### 5. Build Assets

```bash
# Build frontend assets
npm run build

# Or run in development mode with hot reload
npm run dev
```

### 6. Start the Application

```bash
# Start Laravel development server
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Default Login Credentials

- **Email**: `vet@safepaws.lk`
- **Password**: `password`

## Project Structure

```
safepaws-vet-portal/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   ├── VetDashboardController.php
│   │   └── MedicalRecordController.php
│   └── Models/
│       ├── Patient.php
│       ├── Branch.php
│       ├── Appointment.php
│       └── MedicalRecord.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000003_create_patients_table.php
│   │   ├── 2024_01_01_000004_create_branches_table.php
│   │   ├── 2024_01_01_000005_create_appointments_table.php
│   │   └── 2024_01_01_000006_create_medical_records_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── VetPortalSeeder.php
├── resources/
│   ├── views/
│   │   ├── dashboard.blade.php
│   │   └── auth/
│   │       └── login.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
└── routes/
    └── web.php
```

## Usage

### Dashboard Tab

View key statistics:
- Total patients registered
- Upcoming appointments
- Total medical reports
- Monthly revenue

### Branches Tab

Browse all clinic branches with:
- Branch name
- Location with map icon
- Contact information

### Appointments Tab

Manage appointments with:
- Patient name and species
- Appointment date and time
- Status (pending/completed/cancelled)

### Medical Reports Tab

**View Reports**:
- List of all medical records
- Patient name
- Record creation date

**Add New Record**:
- Select patient from dropdown
- Enter title, symptoms, and diagnosis
- Add multiple prescriptions
- Upload supporting files (PDF, JPG, PNG)
- File preview for images

## Database Schema

### Patients Table
- id, name, species, breed, age
- owner_name, owner_phone, owner_email
- medical_history
- timestamps

### Branches Table
- id, name, location
- phone, email, address
- timestamps

### Appointments Table
- id, patient_id, user_id, branch_id
- time, status, notes
- timestamps

### Medical Records Table
- id, patient_id, user_id
- title, symptoms, diagnosis
- prescription (JSON array)
- file_path
- timestamps

## Customization

### Theme Colors

Colors are defined in `resources/css/app.css`:
- Primary: `#0ea5e9` (Sky blue)
- Primary Dark: `#0284c7`
- Gold: `#fbbf24`
- Background: `#0f172a` (Slate 900)
- Card: `#1e293b` (Slate 800)

### Adding Features

1. Create new models in `app/Models/`
2. Create migrations in `database/migrations/`
3. Create controllers in `app/Http/Controllers/`
4. Add routes in `routes/web.php`
5. Create Blade views in `resources/views/`

## Troubleshooting

### Missing PHP Extensions

If you see errors about missing extensions (DOMDocument, XML, etc.), install them:

```bash
# Check currently installed extensions
php -m

# Install missing extensions
sudo apt-get install php8.3-dom php8.3-xml php8.3-xmlwriter
```

### Database Issues

Reset the database:

```bash
php artisan migrate:fresh --seed
```

### Asset Build Issues

Clear and rebuild:

```bash
npm cache clean --force
rm -rf node_modules package-lock.json
npm install
npm run build
```

## Support

For issues or questions about the SafePaws LK Vet Portal, please refer to the Laravel documentation:
- https://laravel.com/docs

## License

This project is built with Laravel, which is open-sourced software licensed under the MIT license.
