<?php
session_start();
require "db.php"; // include your PDO connection here

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $error = "Account already exists!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $password]);
        $success = "Account created successfully! You can now log in.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow-sm p-4" style="max-width: 500px; margin:auto;">
    <h2 class="text-center mb-4">Create Admin Account</h2>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Register</button>
    </form>
    <div class="text-center mt-3">
      <a href="login.php" class="text-decoration-none">Back to Login</a>
    </div>
  </div>
</div>
<!-- Footer -->
    <div style="margin-top:40px; font-size:14px; color:#666; text-align:center; background:#f1f1f1; padding:15px; border-radius:6px;">
        <p></p>
        <p>Copyright © 2026 FLASH CRYPTO GENERATOR</p>
    </div>
</body>
</html>
