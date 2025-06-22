# 🕒 Employee Attendance Management System

This is a simple web-based Employee Attendance System built using **HTML**, **CSS**, **JavaScript**, and **PHP**, with a MySQL backend. It allows employees to log in, check in/out for attendance, and view their attendance reports. An admin can also manage employees and view all records.

---

## 🔧 Features

* Employee Login & Signup
* Secure authentication
* Check-In / Check-Out attendance
* View individual attendance report
* Admin panel to:

  * View all employees' attendance
  * Delete registered employee accounts
* Real-time attendance timestamps
* Simple UI and responsive design

---

## 💠 Technologies Used

* **Frontend:** HTML, CSS, JavaScript
* **Backend:** PHP
* **Database:** MySQL
* **Optional Mobile App:** Flutter (for mobile version)

---

## 🚀 How to Run the Project

### Step 1: Clone the Repository

```bash
git clone https://github.com/your-username/attendance-system.git
cd attendance-system
```

### Step 2: Setup with XAMPP/Laragon

1. Install [XAMPP](https://www.apachefriends.org/) or [Laragon](https://laragon.org/)

2. Copy the project folder into the `htdocs` (XAMPP) or `www` (Laragon) directory:

   ```
   C:\xampp\htdocs\attendance-system
   ```

3. Start **Apache** and **MySQL** from your control panel.

4. Open your browser and go to:

   ```
   http://localhost/attendance-system/
   ```

---

## 💾 Database Setup

1. Open **phpMyAdmin** from your browser:

   ```
   http://localhost/phpmyadmin
   ```

2. Create a new database, e.g., `attendance_db`

3. Import the included SQL file:

   ```
   /database/attendance_db.sql
   ```

4. Update your PHP config file (`config.php` or similar) with your local DB settings:

```php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "attendance_db";
$conn = new mysqli($host, $user, $pass, $dbname);
```

---

## 🌐 Access from Other Devices (Optional)

* Find your PC's IP using `ipconfig` (e.g. `192.168.1.10`)
* Share the link:

  ```
  http://192.168.1.10/attendance-system/
  ```

> Make sure your firewall allows connections to Apache (port 80)

---

## 📱 Mobile Version (Optional)

If you want to run this as a mobile app, a Flutter frontend can be used to interact with the same PHP backend.

---

## 📄 License

This project is open-source and free to use under the MIT License.

---

## 🙋‍♂️ Contributing

Pull requests are welcome! If you have suggestions, feel free to open an issue or contribute directly.

---

## 📬 Contact

Created by Sushil Bhattarai
📧 [sushilbhattarai280@gmail.com](mailto:sushilbhattarai280@gmail.com)
