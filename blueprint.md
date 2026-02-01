
# Blueprint: User Catalog

## Overview

This project is a Laravel application designed to display a catalog of users. It demonstrates basic data fetching and display using the MVC pattern.

## Project Outline

*   **Backend:** Laravel
*   **Frontend:** Blade templates with Tailwind CSS (via Vite)
*   **Features:**
    *   **User Catalog Display:** A single page view located at `resources/views/user-cat/index.blade.php` designed to list users.
*   **Styling:**
    *   Utilizes Tailwind CSS for modern styling.
    *   Base styles and imports are configured in `resources/css/app.css`.
    *   The primary font is "Instrument Sans".
    *   The overall theme is dark, with a `bg-gray-900` background and `text-white`.

## Current Task: Implement User Catalog Logic

**Goal:** Make the User Catalog page functional by fetching users from the database and displaying them.

**Steps:**

1.  **Create `UserCatController`:** Generate a new controller to handle the request for the user catalog page.
2.  **Fetch Data:** Inside the controller, add logic to retrieve all users from the `User` model.
3.  **Create a Web Route:** Define a `GET` route in `routes/web.php` that maps the `/users` URL to the new controller method.
4.  **Update the Blade View:** Modify `resources/views/user-cat/index.blade.php` to loop through the user data passed from the controller and display each user's name and email in a list or table.
