# Inventory Management API

A simplified RESTful API for managing products in an inventory system built with Laravel 10. This project demonstrates backend development best practices, API design, and the application of OOP and SOLID principles.

## Features

- **Product Management**: Complete CRUD operations for products
- **Category Management**: Organize products into categories
- **Inventory Control**: Add/reduce product quantities
- **Advanced Filtering**: Filter products by category, price range, and stock availability
- **Authentication**: Secure API endpoints using Laravel Sanctum
- **Clean Architecture**: Repository pattern, service classes, and dependency injection


## Technical Stack

- **Framework**: Laravel 10
- **Authentication**: Laravel Sanctum
- **Database**: MySQL
- **API Documentation**: RESTful standards
- **Architecture Patterns**: Repository Pattern, Service Layer

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/Pratik67796/inventory-api.git
   cd inventory-api
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   ```
   
   Update the `.env` file with your database credentials:
   ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=inventory
    DB_USERNAME=root
    DB_PASSWORD=

   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Run database migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

The API will be available at `http://127.0.0.1:8000/`

## API Documentation

### Authentication Endpoints

#### Register User
```http
POST /api/v1/register
Content-Type: application/json

{
    "name": "Pratik",
    "email": "pratik@yopmail.com",
    "password": "password"
}
```

**Response:**
```json
{
    "message": "User registered successfully.",
    "data": {
        "name": "Pratik",
        "email": "pratik@yopmail.com",
        "updated_at": "2025-05-25T07:09:50.000000Z",
        "created_at": "2025-05-25T07:09:50.000000Z",
        "id": 1
    }
}
```

#### Login
```http
POST /api/v1/login
Content-Type: application/json

{
    "email": "pratik@yopmail.com",
    "password": "password"
}
```
#### Response

```json
{
    "message": "Login successful",
    "data": {
        "id": 1,
        "name": "Pratik",
        "email": "pratik@yopmail.com",
        "email_verified_at": null,
        "created_at": "2025-05-25T07:09:50.000000Z",
        "updated_at": "2025-05-25T07:09:50.000000Z",
        "token": "27|QVmu0gIJ2wJzcX6KzfbTQP0sgU0F3XxaZBHpjMLO54004278"
    }
}
```
#### Logout
```http
POST /api//v1/logout
Authorization: Bearer {token}
```
#### Logout Response

```json 
{
    "message": "Logout successful"
}
```

For other APis i shere collection in storage->Inventory-apis.postman_collection.json