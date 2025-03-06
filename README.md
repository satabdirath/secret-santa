  README - Secret Santa Management

🎅 Secret Santa Management System
=================================

**Secret Santa Management** is a Laravel-based web application that allows users to import employees, randomly assign Secret Santa pairs, and export the assignments.

🚀 Features
-----------

*   Upload employee list via CSV file.
*   Generate random Secret Santa assignments.
*   Download the generated assignments.
*   Admin panel interface using Laravel Breeze.

## 📋 Prerequisites

Before installing and running this project, ensure you have the following installed on your system:

- **PHP 8.1 or later** (Check with `php -v`)
- **Composer** (Check with `composer -V`)
- **Node.js & NPM** (Check with `node -v` and `npm -v`)
- **MySQL or MariaDB** (Ensure a database is set up)
- **Xampp server** 

📦 Installation
---------------

    git clone https://github.com/your-repo/secret-santa.git
    cd secret-santa
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    

🔧 Configuration
----------------

Update your `.env` file with the necessary database credentials:

    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    

Then, run migrations:

    php artisan migrate

⚡ Running the Application
-------------------------

Start the local development server:

    php artisan serve

📌 Usage
--------

1.  Log in to the admin panel.(email- satabdirath2000@gmail.com, password-12345678)
2.  Upload the employee list in CSV format.
3.  Click the "Generate Secret Santa" button.
4.  Download the assignments for distribution.

🎭 Technologies Used
--------------------

*   Laravel 12
*   Laravel Breeze
*   MySQL
*   Tailwind CSS

![Screenshot 2](https://ik.imagekit.io/h39n86spm/Screenshot%20(36).png?updatedAt=1741265295910)  

![Screenshot 1](https://ik.imagekit.io/h39n86spm/Screenshot%20(35).png?updatedAt=1741265295790)  






