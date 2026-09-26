# Task Manager (Laravel)

A lightweight, full-stack task management dashboard built with **Laravel** and **MySQL**. It lets a user create, track, and update tasks through a single-page style dashboard — complete with live stats, search, priority filtering, and status toggling — without a page reload for most actions.

**Project Code:** WST21-PM-2026-SF
**Student Name:** Calvo, Shinji Lei
**Course & Year:** BSIT2 — SEC-1
**Database Used:** MySQL

---

## Overview

The app follows a classic Laravel MVC structure: task records are stored in MySQL, served to the Blade view as JSON, and rendered client-side with vanilla JavaScript. All CRUD actions (create, edit, delete, status toggle) talk to Laravel routes via `fetch()` calls protected by the CSRF token, so the dashboard stays in sync with the database on every change.

## Features

- **Add Task**
  Create new tasks with a title, a detailed description, a priority level (`Urgent` or `Reminder`), and a due date. A modal form validates required fields before submission.

- **View Tasks**
  A dynamic dashboard displays real-time statistics — Total, Pending, and Completed task counts — alongside the full task registry. Tasks can be filtered by status (via the nav tabs), filtered by priority (via the dropdown), and searched by title or description.

- **Edit Task**
  Clicking the edit icon on any task reopens the same modal, pre-filled with that task's current data, so existing fields can be updated in place.

- **Delete Task**
  Tasks can be removed directly from the registry, guarded by a confirmation prompt to prevent accidental deletion.

- **Update Status**
  A single click toggles a task between Pending and Completed, instantly updating both the task card and the summary statistics.

## Tech Stack

| Layer      | Technology                        |
|------------|------------------------------------|
| Local Server | XAMPP (Apache + MySQL)          |
| Backend    | Laravel (PHP)                     |
| Dependency Manager | Composer                  |
| Database   | MySQL                             |
| Frontend   | Blade templates, Tailwind CSS, vanilla JavaScript |
| Icons      | Font Awesome                      |
| Fonts      | Google Fonts (Inter)              |

## Setup Instructions

1. **Start XAMPP**
   Open the XAMPP Control Panel and start the **Apache** and **MySQL** modules.

2. **Create the database**
   Go to `http://localhost/phpmyadmin` and create a new database matching the `DB_DATABASE` value you'll set in `.env` (e.g. `task_manager`).

3. **Install PHP dependencies**
   ```bash
   composer install
   ```

4. **Create the environment file**
   ```bash
   cp .env.example .env
   ```

5. **Generate the application key**
   ```bash
   php artisan key:generate
   ```

6. **Run fresh database migrations**
   ```bash
   php artisan migrate:fresh
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

8. **Open the app in your browser**
   ```
   http://127.0.0.1:8000
   ```

> In your `.env` file, make sure `DB_CONNECTION=mysql`, `DB_HOST=127.0.0.1`, `DB_PORT=3306`, and `DB_USERNAME=root` with an empty `DB_PASSWORD` (XAMPP's default MySQL credentials), unless you've changed them in XAMPP.

## Screenshots

<img width="1917" height="1080" alt="Dashboard overview" src="https://github.com/user-attachments/assets/29606dab-37cd-4b80-8fac-dc88d6d5cd17" />
<img width="1905" height="982" alt="Task registry view" src="https://github.com/user-attachments/assets/bfaeb058-e57f-4aed-b96e-987e4291a1d0" />
<img width="1917" height="942" alt="Dashboard with tasks" src="https://github.com/user-attachments/assets/60f12dca-1712-4ee1-a2fb-26859c1df8be" />
<img width="1344" height="466" alt="Add/Edit task modal" src="https://github.com/user-attachments/assets/c2795e7c-d369-4572-9eb6-185e93f3b292" />
<img width="1292" height="446" alt="Task card detail" src="https://github.com/user-attachments/assets/57404e65-2730-4beb-b93d-eb13439e15b2" />
<img width="813" height="526" alt="Status toggle and delete confirmation" src="https://github.com/user-attachments/assets/fa65f806-0192-4519-a593-c1c590b52f47" />

## Author

**Shinji Lei Calvo** — BSIT2, SEC-1
