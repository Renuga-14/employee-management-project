# Employee Management System

This repository contains the source code for the Employee Management System. This project is built using Laravel and provides API endpoints for managing employee records.

## Table of Contents

- [Setup Instructions](#setup-instructions)
- [Running the Application](#running-the-application)
- [API Documentation](#api-documentation)


## Setup Instructions

### Prerequisites

- PHP >= 7.4
- Composer
- Node.js & npm
- MySQL

### Installation

1. **Clone the repository**:

    ```bash
    git clone https://github.com/Renuga-14/Employee-Management.git
    cd employee-management-system
    ```

2. **Install dependencies**:

    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Set up environment variables**:

    Copy the `.env.example` file to `.env` and update the environment variables as needed.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure the database**:

    Update the `.env` file with your database credentials.

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=employee_management
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Run the database migrations**:

    ```bash
    php artisan migrate
    ```

### Running the Application

1. **Serve the application**:

    ```bash
    php artisan serve
    ```

2. **Access the application**:

    Open your web browser and go to `http://localhost:8000`.

