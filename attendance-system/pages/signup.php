<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Sign Up</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .signup-box {
      background: white;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 350px;
    }

    .signup-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .signup-box input {
      width: 100%;
      padding: 10px 15px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .signup-box button {
      width: 100%;
      padding: 10px;
      background-color: #28a745;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .signup-box button:hover {
      background-color: #1e7e34;
    }

    .signup-box .options {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .signup-box .options a {
      color: #007BFF;
      text-decoration: none;
    }

    .signup-box .options a:hover {
      text-decoration: underline;
    }
    .success-message {
  background-color: #d4edda;
  color: #155724;
  padding: 10px;
  border-radius: 6px;
  margin-bottom: 10px;
  text-align: center;
}

  </style>
</head>
<body>

<div class="signup-box">
  <h2>Create an Account</h2>
  <?php if (isset($_GET['error'])): ?>
  <div class="error-message"><?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>
<?php if (isset($_GET['msg'])): ?>
  <div class="success-message"><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

  <form action="../php/signup_handler.php" method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="employee_id" placeholder="Employee ID" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Sign Up</button>
  </form>
  <div class="options">
    <p>Already registered? <a href="login.php">Login Here</a></p>
  </div>
</div>

</body>
</html>
