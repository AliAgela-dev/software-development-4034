# School Management API

A comprehensive REST API built with Laravel for managing schools, teachers, students, grades, fees, ratings, and comments. The system supports three types of users: Admin, Manager, and Regular Users.

---

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [API Testing with Postman](#api-testing-with-postman)
- [Default Credentials](#default-credentials)
- [API Endpoints Overview](#api-endpoints-overview)

---

## Features

### Admin Features
- Manage schools (CRUD operations)
- Manage teachers (CRUD operations)
- Manage managers (CRUD operations)
- View school success ratings

### Manager Features
- Manage grades and fees for their school
- Assign teachers to their school
- Manage success ratings for their school
- View school statistics

### User Features
- Register and login
- Rate schools (1-5 stars)
- Comment on schools
- Personal notes management

---

## Requirements

Before you begin, ensure you have the following installed:

- **PHP** >= 8.1
- **Composer** >= 2.x
- **MySQL** >= 5.7 or **MariaDB** >= 10.3
- **Laravel** 11.x (will be installed via Composer)
- **Postman** (for API testing)

---

## Installation

### Step 1: Clone the Repository

```bash
git clone <your-repository-url>
cd <project-folder>
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Environment Configuration

1. Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

2. Open the `.env` file and configure your database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_management
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Configure JWT Secret

```bash
php artisan jwt:secret
```

This will add the `JWT_SECRET` to your `.env` file.

---

## Database Setup

### Step 1: Create Database

Create a new database in MySQL/MariaDB:

```sql
CREATE DATABASE school_management;
```

Or use your MySQL client/phpMyAdmin to create the database.

### Step 2: Run Migrations

Execute the migrations to create all necessary tables:

```bash
php artisan migrate
```

This will create the following tables:
- `admins`
- `users`
- `managers`
- `schools`
- `teachers`
- `grades`
- `fees`
- `ratings`
- `comments`
- `notes`
- `success_ratings`
- `schools_teachers` (pivot table)

### Step 3: Seed the Database

Run the seeders to populate the database with initial data:

```bash
php artisan db:seed
```

This will create:
- 1 Admin user
- 1 School
- 1 Manager
- 1 Grade
- 1 Teacher
- 1 Fee
- 1 Regular User
- 1 Rating
- 1 Comment
- 1 School-Teacher assignment

**Note:** If you need to reset and reseed the database:

```bash
php artisan migrate:fresh --seed
```

⚠️ **Warning:** This will drop all tables and recreate them!

---

## Running the Application

### Start the Laravel Development Server

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

### API Base URL

All API endpoints are prefixed with `/api`:

```
http://localhost:8000/api
```

---

## API Testing with Postman

### Step 1: Import the Postman Collection

1. Open **Postman**
2. Click on **Import** button (top left)
3. Select **Raw text** tab
4. Paste the entire JSON collection (provided separately)
5. Click **Import**

### Step 2: Configure Environment Variables

The collection includes pre-configured variables:

- `base_url`: `http://localhost:8000/api`
- `admin_token`: (auto-filled after admin login)
- `manager_token`: (auto-filled after manager login)
- `user_token`: (auto-filled after user login)

If your server runs on a different port, update the `base_url`:

1. Click on the collection name
2. Go to **Variables** tab
3. Update the `base_url` value
4. Click **Save**

### Step 3: Authentication Flow

The collection automatically handles JWT tokens. Here's how to use it:

#### For Admin:
1. Navigate to: **Admin → Auth → Login**
2. Click **Send**
3. The `admin_token` is automatically saved
4. All subsequent admin requests will use this token

#### For Manager:
1. Navigate to: **Manager → Auth → Login**
2. Click **Send**
3. The `manager_token` is automatically saved

#### For User:
1. Navigate to: **User → Auth → Login**
2. Click **Send**
3. The `user_token` is automatically saved

### Step 4: Testing Endpoints

Now you can test any endpoint:

1. Select an endpoint from the collection
2. Click **Send**
3. View the response

**Example workflow:**
```
1. Admin Login → Creates/Gets token
2. Admin → Schools → Get All Schools → View all schools
3. Admin → Teachers → Create Teacher → Add new teacher
```

---

## Default Credentials

### Admin Account
```
Phone Number: 1234567890
Password: password
```

### Manager Account
```
Phone Number: 1234567890
Password: password
```

### User Account
```
Email: user@example.com
Password: password
```

---

## API Endpoints Overview

### Public Endpoints (No Authentication Required)
```
POST   /api/admin/login          - Admin login
POST   /api/manager/login        - Manager login
POST   /api/user/login           - User login
POST   /api/user/register        - User registration
```

### Admin Endpoints (Requires Admin Token)
```
POST   /api/admin/logout                    - Logout
GET    /api/admin/managers                  - Get all managers
POST   /api/admin/managers                  - Create manager
GET    /api/admin/managers/{id}             - Get manager by ID
PUT    /api/admin/managers/{id}             - Update manager
DELETE /api/admin/managers/{id}             - Delete manager

GET    /api/admin/schools                   - Get all schools
POST   /api/admin/schools                   - Create school
GET    /api/admin/schools/{id}              - Get school by ID
PUT    /api/admin/schools/{id}              - Update school
DELETE /api/admin/schools/{id}              - Delete school

GET    /api/admin/teachers                  - Get all teachers
POST   /api/admin/teachers                  - Create teacher
GET    /api/admin/teachers/{id}             - Get teacher by ID
PUT    /api/admin/teachers/{id}             - Update teacher
DELETE /api/admin/teachers/{id}             - Delete teacher

GET    /api/admin/school-success-rate       - Get all success ratings
GET    /api/admin/school-success-rate/{id}  - Get success rating by school
```

### Manager Endpoints (Requires Manager Token)
```
POST   /api/manager/logout                  - Logout

GET    /api/manager/grades                  - Get all grades
POST   /api/manager/grades                  - Create grade
GET    /api/manager/grades/{id}             - Get grade by ID
PUT    /api/manager/grades/{id}             - Update grade
DELETE /api/manager/grades/{id}             - Delete grade

GET    /api/manager/fees                    - Get school fees
POST   /api/manager/fees                    - Create fee
GET    /api/manager/fees/{id}               - Get fee by ID
PUT    /api/manager/fees/{id}               - Update fee
DELETE /api/manager/fees/{id}               - Delete fee

GET    /api/manager/schools/teachers        - Get school teachers
POST   /api/manager/schools/teachers        - Assign teacher to school
PUT    /api/manager/schools/teachers/{id}   - Update teacher assignment
DELETE /api/manager/schools/teachers/{id}   - Remove teacher from school

GET    /api/manager/success-ratings         - Get success ratings
POST   /api/manager/success-ratings         - Create success rating
GET    /api/manager/success-ratings/{id}    - Get success rating by ID
PUT    /api/manager/success-ratings/{id}    - Update success rating
DELETE /api/manager/success-ratings/{id}    - Delete success rating
```

### User Endpoints (Requires User Token)
```
POST   /api/user/logout                     - Logout
GET    /api/user/me                         - Get current user info

GET    /api/user/ratings                    - Get my ratings
POST   /api/user/ratings                    - Create rating
GET    /api/user/ratings/{id}               - Get rating by ID
PUT    /api/user/ratings/{id}               - Update rating
DELETE /api/user/ratings/{id}               - Delete rating

GET    /api/user/comments                   - Get my comments
POST   /api/user/comments                   - Create comment
GET    /api/user/comments/{id}              - Get comment by ID
PUT    /api/user/comments/{id}              - Update comment
DELETE /api/user/comments/{id}              - Delete comment

GET    /api/user/notes                      - Get my notes
POST   /api/user/notes                      - Create note
GET    /api/user/notes/{id}                 - Get note by ID
PUT    /api/user/notes/{id}                 - Update note
DELETE /api/user/notes/{id}                 - Delete note
```

---

## Common Issues & Troubleshooting

### Issue: "SQLSTATE[HY000] [1045] Access denied"
**Solution:** Check your database credentials in the `.env` file.

### Issue: "JWT secret not set"
**Solution:** Run `php artisan jwt:secret`

### Issue: "Class not found"
**Solution:** Run `composer dump-autoload`

### Issue: "Token expired"
**Solution:** Login again to get a new token

### Issue: Unauthorized (401)
**Solution:** Ensure you're using the correct token for the role

---

## Additional Commands

### Clear Application Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### View All Routes
```bash
php artisan route:list
```

### Run Tests (if available)
```bash
php artisan test
```

---

## Support

For issues and questions, please refer to the Laravel documentation:
- [Laravel Documentation](https://laravel.com/docs)
- [JWT-Auth Documentation](https://jwt-auth.readthedocs.io/)

---

## License

This project is open-sourced software licensed under the MIT license.