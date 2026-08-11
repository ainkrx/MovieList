# 🎬 MovieList
A full-stack web application for browsing movies and actors, and maintaining a personal movie watchlist. Built with **Laravel** (PHP), Blade, and a relational database.  
🔗 **Live Demo:** https://movie-list-i.vercel.app  
Developed on **Vercel** and the database runs on **Neon** (PostgreSQL).
## Background
This project was developed as a group assignment for a university web-programming course. The application follows Laravel's MVC pattern and focuses on practical full-stack concepts: relational data modelling, server-rendered pages, authentication, authorization, and CRUD operations.

This was built from a hands-on assignment blueprint, so the objective was implementing the features and UI as the assignment required. This deploy did not touch the original code at all, what's running here is exactly the project as it was back then.

The project was originally built with MySQL, but for deployment purposes it was containerized with Docker as well, so it's also easier for other people to run.
## Deployment Notes
Movie and actor image uploads are saved inside the current container, which will be displayed while that container is running, but disappear after Render sleeps, restarts, or redeploys the service. Neon stores the database records and image paths only and does not store the uploaded image files. That's why the live-demo database is intentionally reset to its seeded state whenever the service starts.
## License
Learning purposes. All images belong to their respective owners.

# Project Overview
## Backend (Laravel / PHP)
- MVC structure with Eloquent models: `Movie`, `Actor`, `Genre`, and `User`
- Relational data modelling for movies, actors, genres, and watchlists
- Movie discovery through title search, genre filtering, sorting, a random-movie carousel, and a watchlist-count-ranked section
- Similar-movie recommendations based on shared genres
- Session-based registration, login, logout, and remember-me authentication
- Role-based middleware for `guests`, `signed-in users`, `members`, and `administrators`
- Database migrations and seeders for users, movies, actors, genres, watchlists, and relationship pivot tables
## Frontend (Blade)
- Home page with carousel, popular section, search, genre filters, and catalogue sorting
- Movie and actor listings with title search and pagination
- Movie details with cast character names, genres, director, release year, and similar-movie recommendations
- Actor details with biography, popularity, and filmography
- Login, registration, logout, profile-detail editing, profile-image-URL editing, and personal watchlist pages
- Administrator pages to create, edit, and remove movies and actors, including local image-file uploads
## Structure
```text
MovieList/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Home, movie, actor, genre, and user controllers
│   │   └── Middleware/      # Role and authentication middleware
│   └── Models/              # Movie, Actor, Genre, and User models
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Demo users, catalogue data, and pivot data
├── public/                  # Web entry point, CSS, images, and static assets
├── resources/
│   └── views/               # Blade templates
├── routes/
│   ├── web.php              # Browser routes
│   └── api.php              # Sanctum-protected current-user endpoint
├── .env.example             # Environment-variable template
├── composer.json            # PHP dependencies
└── package.json             # Frontend build dependencies
```

# 🚀 Quick Start Guide
## Step 1: Set Up Environment Variables
Copy `.env.example` to `.env`, then fill in the values.
## Step 2: Generate an APP_KEY
```bash
php -r "echo 'base64:' . base64_encode(random_bytes(32)) . PHP_EOL;"
```
Paste the output into `APP_KEY` in `.env`.
## Step 3: Build and Run
```bash
docker compose up --build
```
## Step 4: Set Up the Database
```bash
docker compose exec server php artisan migrate --seed
```

# 🎮 Test the App
## Guest Preview
Visit `/` to browse the home feed, or `/movies` and `/actors` to explore the catalogue. Signing in is required to create a watchlist; administrator pages are restricted.
## Demo Accounts
The demo accounts are seeded automatically with `php artisan migrate --seed`:  
1. **Administrator** 
  - **Email**: `admin@admin.com`
  - **Password**: `adminadmin`
2. **Member**  
  - **Email**: `dummy@user.com`
  - **Password**: `dummyuser`
## Try These Actions
1. **Explore the home feed**: Search by title, filter by genre, or sort the catalogue by latest / A–Z / Z–A.
2. **Browse movies**: Open `/movies`, search the catalogue, then select a movie to view its cast, genres, director, and similar recommendations.
3. **Browse actors**: Open `/actors`, then select an actor to view their biography and filmography.
4. **Register or sign in**: Create an account or use a demo account.
5. **Manage a watchlist**: Feature only for member, add a movie, then mark it as Planning, Watching, or Finished, or remove it from `/watchlists`.
6. **Edit a profile**: Update profile details or the profile image URL from `/profile/edit`.
7. **Administrator tools**: Sign in as the administrator to add, edit, or remove movies and actors.
