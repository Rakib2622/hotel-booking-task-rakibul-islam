

# 🏨 Laravel Hotel Booking System

A hotel room booking management system built with **Laravel**, featuring:
- Room categories (Premium Deluxe, Super Deluxe, Standard Deluxe)
- Dynamic pricing (weekend surcharge + discount for 3+ nights)
- Real-time room availability (max 3 rooms per category per day)
- Validation for booking dates, email, and phone
- Thank You confirmation page with booking summary
- Admin dashboard with booking stats

---

## ⚙️ Requirements

Before installing, make sure you have the following installed:

- PHP >= 8.1  
- Composer  
- MySQL or MariaDB  
- Node.js & npm (for Laravel Mix/Vite assets if needed)  
- Git (optional)

---

## 🚀 Installation Steps

### 1. Clone or Copy the Project

```bash
git clone https://github.com/Rakib2622/hotel-booking-task-rakibul-islam.git
cd hotel-booking-system

Or, if you copied the files manually, just open the project folder in your terminal.

2. Install Dependencies
Install PHP dependencies:
composer install

Install Node dependencies (optional, if you’re using frontend assets):
npm install


3. Configure the Environment
Duplicate .env.example and rename it to .env:
cp .env.example .env

Now edit .env with your database credentials:
APP_NAME="Hotel Booking System"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotel_booking
DB_USERNAME=root
DB_PASSWORD=


4. Generate Application Key
php artisan key:generate


5. Run Database Migrations
php artisan migrate

This will create all necessary tables including:


room_categories


bookings


daily_availabilities



6. (Optional) Seed Default Room Categories
You can seed the 3 default categories (Premium Deluxe, Super Deluxe, Standard Deluxe):
php artisan tinker

Then run this inside Tinker:
use App\Models\RoomCategory;

RoomCategory::insert([
    ['name' => 'Premium Deluxe', 'base_price' => 12000],
    ['name' => 'Super Deluxe', 'base_price' => 10000],
    ['name' => 'Standard Deluxe', 'base_price' => 8000],
]);
exit;


7. Run the Development Server
php artisan serve

The app will be available at:
👉 http://localhost:8000

📄 Admin Dashboard
Visit /admin/dashboard to see booking statistics (total rooms, bookings, recent reservations, etc.).

🧠 Booking Logic Summary


3 Rooms per Category per Day


Weekend Surcharge: +20% on Fridays & Saturdays


Discount: 10% off total price for bookings ≥ 3 nights


Availability: If 3 rooms already booked for a date, that category/date becomes unavailable


Validations:


Email must be valid format


Phone: 10–15 digits


Dates cannot be in the past


to_date ≥ from_date





📦 Folder Structure (Simplified)
app/
 ├─ Http/Controllers/
 │   ├─ BookingController.php
 │   └─ Admin/DashboardController.php
 ├─ Models/
 │   ├─ Booking.php
 │   ├─ RoomCategory.php
 │   └─ DailyAvailability.php
resources/
 ├─ views/
 │   ├─ frontend/
 │   │   ├─ layout.blade.php
 │   │   ├─ booking/
 │   │   │   ├─ create.blade.php
 │   │   │   └─ thankyou.blade.php
 │   └─ admin/dashboard.blade.php
routes/
 └─ web.php


💡 Common Artisan Commands
php artisan migrate:fresh       # Reset and re-run all migrations
php artisan db:seed             # Run seeders (if added)
php artisan route:list          # View all routes
php artisan cache:clear         # Clear application cache


🧰 Troubleshooting
ProblemPossible FixSQLSTATE[HY000] [1049] Unknown databaseMake sure you created the database name in .env manually in phpMyAdmin500 Server ErrorCheck .env settings and file permissionsBooking date mismatchEnsure your local timezone matches project timezone (config/app.php or .env)

📜 License
This project is open-source and free to use for educational or personal projects.
Attribution is appreciated but not required.

Developed by: Rakibul Islam
Framework: Laravel 10+
Language: PHP 8+

🎯 Enjoy your stay at the Hotel Booking System!

---

Would you like me to include a **SQL seed file** (so you can import all room categories automatically instead of using Tinker)?
