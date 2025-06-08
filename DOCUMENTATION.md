# Hotel Reservation System Documentation

## Table of Contents

1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [Project Structure](#project-structure)
4. [Core Features](#core-features)
5. [API Endpoints](#api-endpoints)
6. [Development Setup](#development-setup)
7. [Testing](#testing)
8. [Security](#security)
9. [Additional Notes](#additional-notes)

## Project Overview

This is a Laravel-based hotel reservation system that allows users to browse, book, and manage hotels. The system includes features for both regular users and hotel administrators.

## Technology Stack

-   **Backend Framework**: Laravel
-   **Frontend**:
    -   Vite (Build Tool)
    -   Tailwind CSS (Styling)
-   **Database**: MySQL (based on Laravel's default configuration)
-   **Authentication**: Laravel Sanctum

## Project Structure

```
├── app/
│   ├── Actions/        # Business logic actions
│   ├── Console/        # Console commands
│   ├── Enums/          # Enumeration classes
│   ├── Http/           # Controllers and Middleware
│   ├── Models/         # Database models
│   ├── Providers/      # Service providers
│   └── View/           # View components
├── config/            # Configuration files
├── database/          # Database migrations and seeders
├── public/            # Public assets
├── resources/         # Frontend resources
├── routes/            # Application routes
└── tests/             # Test files
```

## Core Features

### 1. Public Features

-   Home page with hotel listings
-   About page
-   Hotel browsing and viewing
-   Hotel details viewing

### 2. Authentication Required Features

-   User dashboard
-   Hotel management
    -   Create new hotels
    -   Edit existing hotels
    -   Delete hotels
    -   View owned hotels
-   Booking system
    -   Make hotel reservations
    -   View booking details
-   Hotel items management
-   Location management (Countries, Provinces, Cities)

## API Endpoints

### Public Routes

-   `GET /` - Home page
-   `GET /about` - About page
-   `GET /hotels` - List all hotels
-   `GET /hotels/{hotel}` - View specific hotel
-   `GET /makeHotel` - Create hotel form

### Protected Routes (Requires Authentication)

-   `GET /dashboard` - User dashboard
-   `GET /my-hotels` - User's hotels management
-   Hotel Management:
    -   `POST /hotels` - Create new hotel
    -   `GET /hotels/{hotel}/edit` - Edit hotel form
    -   `PUT /hotels/{hotel}` - Update hotel
    -   `DELETE /hotels/{hotel}` - Delete hotel
-   Booking System:
    -   `POST /hotels/{hotel}/book` - Create booking
    -   `GET /hotel/{hotelId}/book/{roomId}` - Booking form
    -   `POST /hotel/book` - Store booking
-   Location Management:
    -   Full CRUD operations for:
        -   Countries
        -   Provinces
        -   Cities
-   Hotel Items Management:
    -   CRUD operations for hotel items

## Development Setup

1. Clone the repository
2. Install PHP dependencies:
    ```bash
    composer install
    ```
3. Install Node.js dependencies:
    ```bash
    npm install
    ```
4. Copy `.env.example` to `.env` and configure your environment
5. Generate application key:
    ```bash
    php artisan key:generate
    ```
6. Run database migrations:
    ```bash
    php artisan migrate
    ```
7. Start the development server:
    ```bash
    php artisan serve
    ```
8. Start Vite development server:
    ```bash
    npm run dev
    ```

## Docker Development Environment

The project includes a Docker development environment configuration in `docker-compose.dev.yml`. To use it:

1. Make sure Docker and Docker Compose are installed
2. Run the following command:
    ```bash
    docker-compose -f docker-compose.dev.yml up
    ```

## Testing

The project uses PHPUnit for testing. Run tests using:

```bash
php artisan test
```

## Security

-   Authentication is handled through Laravel Sanctum
-   CSRF protection is enabled
-   Form validation is implemented
-   Input sanitization is in place

## Additional Notes

-   The project follows Laravel's best practices and conventions
-   Uses Tailwind CSS for styling
-   Implements responsive design
-   Includes proper error handling and validation

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.
