<?php
require "db.php"; // include your PDO connection here

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin) {
        // Generate reset token
        $token = bin2hex(random_bytes(50));
        $stmt = $pdo->prepare("UPDATE admins SET reset_token = ?, reset_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
        $stmt->execute([$token, $email]);

        // Reset link
        $resetLink = "http://yourdomain.com/reset_password.php?token=$token";

        // Send email (basic PHP mail, replace with PHPMailer for production)
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password:\n\n$resetLink";
        mail($email, $subject, $message);

        $success = "Password reset link has been sent to your email.";
    } else {
        $error = "No account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow-sm p-4" style="max-width: 500px; margin:auto;">
    <h2 class="text-center mb-4">Forgot Password</h2>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-warning w-100">Send Reset Link</button>
    </form>
    <div class="text-center mt-3">
      <a href="login.php" class="text-decoration-none">Back to Login</a>
    </div>
  </div>
</div>
</body>
</html>
