<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Login</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #2980b9, #6dd5fa);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background: white;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 350px;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 10px 15px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .login-box button {
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .login-box button:hover {
      background-color: #0056b3;
    }

    .login-box .options {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .login-box .options a {
      color: #007BFF;
      text-decoration: none;
    }

    .login-box .options a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Employee Login</h2>
  <form action="../php/login_handler.php" method="POST">
    <input type="text" name="employee_id" placeholder="Employee ID" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <div class="options">
    <p><a href="#">Forgot Password?</a></p>
    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
  </div>
</div>

</body>
</html>
