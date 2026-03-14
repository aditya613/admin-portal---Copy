# Placify Admin Portal

A production-ready admin dashboard for managing off-campus placement data: jobs, students, applications, verification workflows, and analytics.

This repository contains the Laravel 12 admin portal used in Team 404 Found's placement ecosystem.

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)
![MongoDB](https://img.shields.io/badge/MongoDB-Database-47A248?style=for-the-badge&logo=mongodb)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-UI-06B6D4?style=for-the-badge&logo=tailwindcss)
![Vite](https://img.shields.io/badge/Vite-Bundler-646CFF?style=for-the-badge&logo=vite)

## Why This Project

Placement teams often manage data across multiple sheets and tools. This portal centralizes operations into one interface:

- View and filter job opportunities from multiple sources.
- Verify jobs and manage listing quality.
- Track student profiles and resume analysis.
- Monitor applications and hiring funnel status.
- Use dashboard insights to make faster decisions.

## Core Features

### Dashboard & Analytics

- High-level stats for jobs, students, and applications.
- Application status distribution.
- Top hiring sources and companies.
- Recent activity feed for jobs and applications.

### Job Management

- Advanced search and filters by source, location, and type.
- Job detail view with metadata and verification controls.
- Admin actions: verify/unverify and delete jobs.
- In-page applications list for each job.
- Fetch More Jobs workflow (POST trigger to external scraper service).

### Student Management

- Student listing and profile details.
- Resume retrieval and analysis integration endpoints.

### Application Tracking

- Application list with status filters.
- Job-wise and student-wise application views.
- Detailed application inspection pages.

## Screenshots

| Dashboard | Jobs List |
| --- | --- |
| ![Dashboard](docs/screenshots/dashboard.svg) | ![Jobs List](docs/screenshots/jobs-list.svg) |

| Job Detail | Fetch More Jobs |
| --- | --- |
| ![Job Detail](docs/screenshots/job-detail.svg) | ![Fetch Jobs Modal](docs/screenshots/fetch-jobs-modal.svg) |

| Students | Applications |
| --- | --- |
| ![Students](docs/screenshots/students-list.svg) | ![Applications](docs/screenshots/applications-list.svg) |

## Tech Stack

- Backend: Laravel 12, PHP 8.2+
- Database: MongoDB (mongodb/laravel-mongodb)
- Frontend: Blade, TailwindCSS, Alpine.js
- Bundling: Vite
- Auth: Laravel Breeze
- Testing: Pest + PHPUnit

## Repository Structure

```text
app/
  Http/Controllers/Admin/      # Dashboard, Jobs, Students, Applications
  Models/                      # JobListing, Student, Application, etc.
resources/views/admin/         # Blade views for admin UI
routes/web.php                 # Main web routes
database/migrations/           # Schema + Mongo-compatible app models
```

## Local Setup

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 18+
- MongoDB instance

### 1) Install Dependencies

```bash
composer install
npm install
```

### 2) Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Update your MongoDB connection values in `.env`:

```env
DB_CONNECTION=mongodb
MONGODB_URI=mongodb://127.0.0.1:27017
MONGODB_DATABASE=placify
```

### 3) Run Migrations

```bash
php artisan migrate
```

### 4) Start Development Servers

```bash
composer run dev
```

Or run manually:

```bash
php artisan serve
npm run dev
```

## Production Build

```bash
npm run build
php artisan optimize
```

## Useful Commands

```bash
# Run tests
php artisan test

# Clear and rebuild caches
php artisan optimize:clear
php artisan optimize
```

## Key Routes

- `/admin` Dashboard
- `/admin/jobs` Job management
- `/admin/students` Student management
- `/admin/applications` Applications management

## Security Notes

- Admin pages are guarded by `auth` and `isAdmin` middleware.
- CSRF protection is enabled for state-changing operations.
- Use HTTPS and secure MongoDB credentials in production.

## Deployment Checklist

- Set production `.env` values (APP_ENV, APP_DEBUG, DB credentials).
- Configure queue worker/process manager if needed.
- Run `npm run build` before deploy.
- Run `php artisan optimize` after deploy.
- Verify admin auth and role restrictions.

## Team

Built by Team 404 Found for hackathon final evaluation.

If you are showcasing this project publicly, replace placeholder screenshot files in `docs/screenshots/` with real UI captures from your hosted deployment.