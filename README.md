# User Management API

## Overview
This is a RESTful API built with Laravel to manage users. It supports CRUD operations and includes role-based user management.

## Features
- Create a user
- Read user details
- Update user information
- Delete a user
- Store user roles (`isSeller`, `isCustomer`, `isAdmin`)
- Input validation for user data

## Setup Instructions

### 1️⃣ Install Laravel
```sh
composer create-project --prefer-dist laravel/laravel user-management-api
```

### 2️⃣ Configure Environment
Update `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3️⃣ Run Database Migrations
```sh
php artisan migrate
```

### 4️⃣ Start the Laravel Server
```sh
php artisan serve
```
Server will start at: `http://127.0.0.1:8000`

## API Endpoints

### **Create User**
**Method:** `POST`
**Endpoint:** `/api/users`
**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "role": "isCustomer"
}
```
**Response:** `201 Created`
```json
{
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "isCustomer",
    "created_at": "2025-03-26T12:00:00.000000Z",
    "updated_at": "2025-03-26T12:00:00.000000Z"
}
```

### **Get User**
**Method:** `GET`
**Endpoint:** `/api/users/{id}`
**Response:**
```json
{
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "isCustomer"
}
```

### **Update User**
**Method:** `PUT`
**Endpoint:** `/api/users/{id}`
**Request Body:**
```json
{
    "name": "John Updated",
    "email": "john.updated@example.com"
}
```
**Response:** `200 OK`

### **Delete User**
**Method:** `DELETE`
**Endpoint:** `/api/users/{id}`
**Response:** `204 No Content`

## Testing with Postman
1. Open **Postman**.
2. Enter API endpoint.
3. Select **Method** (`POST`, `GET`, `PUT`, `DELETE`).
4. Set headers: `Content-Type: application/json`.
5. Add a request body (for `POST` and `PUT`).
6. Click **Send** and check the response.

## Testing with cURL

### **Create User**
```sh
curl -X POST "http://127.0.0.1:8000/api/users" \
     -H "Content-Type: application/json" \
     -d '{
        "name": "John Doe",
        "email": "john@example.com",
        "password": "password123",
        "role": "isCustomer"
     }'
```

### **Get User**
```sh
curl -X GET "http://127.0.0.1:8000/api/users/1"
```

### **Update User**
```sh
curl -X PUT "http://127.0.0.1:8000/api/users/1" \
     -H "Content-Type: application/json" \
     -d '{
        "name": "John Updated",
        "email": "john.updated@example.com"
     }'
```

### **Delete User**
```sh
curl -X DELETE "http://127.0.0.1:8000/api/users/1"
```

## Troubleshooting

### **404 Not Found**
- Ensure API routes are registered by running:
  ```sh
  php artisan route:list
  ```
- If routes are missing, clear cache:
  ```sh
  php artisan route:clear
  php artisan cache:clear
  ```
- Restart server:
  ```sh
  php artisan serve
  ```

### **500 Internal Server Error**
- Check logs for errors:
  ```sh
  tail -f storage/logs/laravel.log
  ```

## License
MIT
