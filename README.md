# Berlin Pfand Finder

A Laravel web app for finding and sharing places in Berlin where you can return Pfand (deposit) bottles. Visitors can browse locations and read reviews; registered users can add new locations and leave a rating with a comment; admins can edit and delete locations.

## Features

- Browse all Pfand return locations, with address, coordinates, description and who added them
- Location detail page with all reviews (rating 1–5 and comment)
- Register / log in (Laravel Breeze)
- Logged-in users can add a location and post reviews
- Admins can edit and delete locations
- Form validation with error messages on every form

## Tech stack

- PHP 8.4 / Laravel 13
- Laravel Breeze (Blade + Alpine.js) for authentication
- Tailwind CSS v3, bundled with Vite
- SQLite (default from `.env.example`)
- Pest for tests

## Requirements

- PHP 8.3 or newer
- Composer
- Node.js 20.19+ or 22.12+ (current LTS recommended) and npm

## Installation

```bash
git clone https://github.com/zzIvyWang/pfantlocation.git
cd pfantlocation
composer setup
php artisan migrate:fresh --seed
```

`composer setup` installs the PHP and npm dependencies, creates `.env` from `.env.example`, generates the app key, creates the SQLite database and builds the frontend assets (`npm run build`).

<details>
<summary>Manual installation (same steps one by one)</summary>

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run build
```

If `migrate:fresh` reports that the SQLite database does not exist, create the empty file first with `touch database/database.sqlite`.

</details>

## Running the app

- **Laravel Herd:** if the project folder is inside your Herd directory, open `http://pfantlocation.test`.
- **Without Herd:** run `php artisan serve` and open `http://127.0.0.1:8000`.

The frontend is already built by the installation step. Only run `npm run dev` if you change CSS, JavaScript or Blade files and want live reloading.

## Test accounts

| Role | Email | Password |
|---|---|---|
| Admin | `admin@admin.com` | `password` |

To try the app as a normal user, register a new account via **Register**.

## Seeded data

`php artisan migrate:fresh --seed` creates:

- 1 admin user (see above) and 10 normal users
- 10 Pfand locations around Berlin, added by the admin
- 2 reviews per location, written by random normal users

## Who can do what

| Action | Guest | Logged-in user | Admin |
|---|:---:|:---:|:---:|
| View locations and reviews | ✅ | ✅ | ✅ |
| Add a location | | ✅ | ✅ |
| Post a review | | ✅ | ✅ |
| Edit / delete a location | | | ✅ |

## Data model

- **User** (`name`, `email`, `password`, `role`: `user` or `admin`) — has many locations
- **Location** (`name`, `address`, `latitude`, `longitude`, `description`) — belongs to a user, has many comments
- **Comment** (`content`, `rating` 1–5) — belongs to a user and a location

## Running the tests

```bash
php artisan test
```

## Where to find things

| What | Where |
|---|---|
| Routes | `routes/web.php` |
| Location CRUD and admin checks | `app/Http/Controllers/LocationController.php` |
| Posting reviews | `app/Http/Controllers/CommentController.php` |
| Models and relationships | `app/Models/` |
| Migrations, factories, seeder | `database/` |
| Views (shared layout in `layouts/app.blade.php`) | `resources/views/` |

## Use of AI

During development, Claude Code was used mainly as a mentor (rules in `CODE_MENTOR.md`): it explains concepts and reviews code, and only writes code when explicitly asked.
