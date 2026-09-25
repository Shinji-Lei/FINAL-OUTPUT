# Task Manager (Laravel)

**Project Code:** WST21-PM-2026-SF  
**Student Name:** Calvo, Shinji Lei  
**Course & Year:** BSIT2  SEC-1
**Database Used:** MySQL  

## Features
- **Add Task:** Create new tasks with titles, detailed descriptions, priorities (e.g., Urgent, Reminder), and due dates.
- **View Tasks:** Dynamic dashboard with real-time statistics (Total, Pending, Completed tasks) and filter/search support.
- **Edit Task:** Easily update existing task fields using an interactive modal window.
- **Delete Task:** Remove tasks directly from the registry with confirmation prompts.
- **Update Status:** Instantly toggle task completion status back and forth with a single click.

## Setup Instructions

1. install PHP dependencies: composer install

2. cp .env.example .env

3. php artisan key:generate

4. php artisan migrate:fresh

5. php artisan serve

6. localhost : http://127.0.0.1:8000

SCREENSHOTS