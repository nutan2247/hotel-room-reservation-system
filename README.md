# 🏨 Hotel Room Reservation System

A Laravel 10-based Hotel Room Reservation System built as part of an SDE 3 assessment. It dynamically assigns rooms based on proximity and travel time rules, mimicking real-world hotel booking logic with visual booking representation and admin tools.

---

## 🚀 Features

- 📐 97 rooms across 10 floors (floor 10 has 7 rooms)
- 🧠 Smart booking logic:
  - Prioritizes same-floor bookings
  - Minimizes total horizontal (1 min/room) and vertical (2 min/floor) travel time
- 🎯 Guest can book up to 5 rooms
- 🖥️ Visual room layout (color-coded availability)
- 🎲 Generate random room occupancy
- 🔁 Reset all room bookings
- 📋 View 5 most recent bookings
- 🧾 Booking form with guest name input

---
<!-- 
## 📷 Screenshots

> Add screenshots here if you want (optional)

--- -->

## ⚙️ Tech Stack

- **Laravel 10**
- **MySQL / SQLite**
- **Bootstrap 5**
- **Blade Templates**

---

## 🛠️ Setup Instructions (Local)

1. Clone the repo  
   `git clone https://github.com/nutan2247/hotel-room-reservation-system.git`

2. Install dependencies  
   `composer install`

3. Copy `.env` and configure database  
   `cp .env.example .env`  
   Set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

4. Generate app key  
   `php artisan key:generate`

5. Run migrations & seed rooms  
   `php artisan migrate --seed`

6. Start development server  
   `php artisan serve`

---

<!-- ## 🌐 Live Demo

[Click here to view the live app](https://your-live-url.com)  
_(Replace with your Render or ngrok link)_

--- -->

## 📁 Folder Structure

- `app/Models/Room.php`, `Booking.php`
- `app/Http/Controllers/RoomController.php`, `BookingController.php`
- `resources/views/welcome.blade.php`
- `database/seeders/RoomSeeder.php`

---

## 📄 Assessment Notes

- Developed for SDE 3 evaluation
- Optimized room selection based on proximity logic
- Designed for scalability and clean UX
- All inputs validated with user feedback

---

## 📧 Contact

Built with ❤️ by [Nutan Kumar](https://github.com/nutan2247)  
For queries: nutan2247.developer@gmail.com
