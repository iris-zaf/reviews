
# Reviews App
The Reviews app is a Laravel-based web application that allows users to search for books by popularity and rating. Users can also create new book reviews or delete existing ones. The app uses Laravel Breeze for authentication and provides separate routes for admin and user functionalities.

## Features
-Authentication: The app uses Laravel Breeze for simple authentication.
-User Routes: Separate routes are provided for user functionalities, including book search, review creation, and review deletion.
-Admin Routes: Admin users have access to additional functionalities, such as managing user accounts and book reviews.
-Book Search: Users can search for books based on popularity and rating.
-Review Creation: Users can create new book reviews.
-Review Deletion: Users can delete existing book reviews.
-Setup
---Prerequisites:
  PHP >= 7.3
  Composer
  Node.js and NPM
  MySQL or another compatible database
  Installation

  
Clone the repository:
git clone https://github.com/yourusername/reviews.git

Install PHP dependencies:
composer install


Set up environment variables:
Rename the .env.example file to .env.

Configure the database connection settings and other environment variables as needed.

Generate the application key:
php artisan key:generate

Run database migrations and seeders:
php artisan migrate --seed

### Usage:

1.Start the development server:
php artisan serve

2.Access the application in your web browser at http://localhost:8000.

3.Register as a new user or log in with existing credentials. For admin username:admin@gmail.com, password:12345678

4.Explore the available functionalities, such as searching for books, creating reviews, and managing user accounts.

