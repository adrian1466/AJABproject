# AJAB Student Record Management System

AJAB is a Laravel-based student record management system with admin, teacher, and student dashboards.

## Features

- Role-based login for admin, teacher, and student users
- Student CRUD management for administrators
- Searchable and paginated student directory
- PDF and Excel export for admin, teacher, and student dashboards
- Railway MySQL-ready database configuration
- Render Docker deployment configuration

## Local Setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

## Render Deployment

1. Connect the GitHub repository to Render.
2. Use the included `render.yaml` blueprint or create a Docker web service from this repository.
3. Set production environment variables in Render, including `APP_KEY`, `APP_URL`, and Railway MySQL `DB_*` values.
4. Deploy from the `main` branch.

The Docker start command clears cached config, runs migrations, and starts Laravel on Render's provided port.
