# Laravel User Registration/Login System and Todo Application

This is a Laravel-based web application that includes a user registration/login system and a Todo application with REST APIs. The application uses Laravel Eloquent for database interactions, form validation, and hashed password storage.

## Features

- User Registration
- User Login
- Email and Password Validation
- Dashboard Access for Authenticated Users
- User Logout
- Todo Application with REST APIs
  - Add Task
  - Update Task Status
  - API Key Authentication

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL
- Apache/Nginx (for production)

## Installation

### Clone the Repository

```bash
git clone https://github.com/your-repository/your-laravel-project.git
cd your-laravel-project
```
### Install Dependencies

```bash
composer install
```

### Set Up Environment File
- Copy the .env.example file to .env and update the necessary configuration settings.

```bash
cp .env.example .env
```
- Update the .env file with your database and application details:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Run Migration
- Run the database migrations to create the necessary tables.
```bash
php artisan migrate
```

### Running the Application

- Start the Laravel development server.
  
```bash
php artisan serve
```
- The application will be accessible at http://localhost:8000.

### User Registration and Login
### Routes

- /register - View the registration page
- /registerSave - Register a new user
- /login - View the login page
- /loginUser - Authenticate and log in the user
- /logout - Log out the user
- /dashboard - Access the dashboard (protected route)

### Validation
- Name: Must be letters only and can include spaces.
- Email: Must be in a valid format and unique.
- Password: Must be at least 8 characters long.

### Registration
- On successful registration, the user is redirected to the login page with a success message. Passwords are hashed before storage.

### Login
- On successful login, the user is redirected to the dashboard. The dashboard is protected and requires authentication.

### Todo Application with REST APIs
### New Features
- TaskController: Handles task-related operations.
- Task Model: Represents the tasks in the database.
- Tasks Table: Stores tasks with columns id, user_id, task, and status.

### Eloquent Relationships
- A User has many Tasks.
- A Task belongs to a User.

### API Endpoints
### Add Task
- Endpoint: /api/todo/add
- Method: POST
- Parameters: task, user_id
- Response:
```json
{
  "task": { "id": 1, "user_id": 1, "task": "Sample Task", "status": "pending" },
  "status": 1,
  "message": "Successfully created a task"
}

```

### Update Task Status
- Endpoint: /api/todo/status
- Method: POST
- Parameters: task_id, status
- Response:
```json
{
  "task": { "id": 1, "user_id": 1, "task": "Sample Task", "status": "done" },
  "status": 1,
  "message": "Marked task as done"
}

```

### API Key Authentication
- The APIs are protected by an API key middleware. The API key is helloatg. Requests without this key will return an authentication error.
  
### Example Request with API Key
```bash
curl -X POST http://localhost:8000/api/todo/add \
     -H "Authorization: helloatg" \
     -F "task=Sample Task" \
     -F "user_id=1"
```

### Frontend Part

### HTML Structure

- The main components of the dashboard are:

1. Navbar: Contains the logout button.
2. Welcome Message: Displays a welcome message with the user's name.
3. Add Task Form: A form to add new tasks.
4. Task List: Displays the list of tasks with options to update their status.

