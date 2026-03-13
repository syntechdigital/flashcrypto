<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Access</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .card {
      max-width: 400px;
      margin: 50px auto;
    }
    .form-toggle {
      cursor: pointer;
      color: #0d6efd;
      text-decoration: underline;
    }
  </style>
</head>
<body>
<div class="card shadow">
  <div class="card-body">
    <h3 class="text-center mb-4" id="form-title">Admin Login</h3>

    <!-- Login Form -->
    <form id="login-form" method="POST" action="admin_auth.php">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
      <div class="text-center mt-3">
        <span class="form-toggle" onclick="showForm('register')">Register</span> | 
        <span class="form-toggle" onclick="showForm('forgot')">Forgot Password</span>
      </div>
    </form>

    <!-- Registration Form -->
    <form id="register-form" method="POST" action="register.php" style="display:none;">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Register</button>
      <div class="text-center mt-3">
        <span class="form-toggle" onclick="showForm('login')">Back to Login</span>
      </div>
    </form>

    <!-- Forgot Password Form -->
    <form id="forgot-form" method="POST" action="forgot_password.php" style="display:none;">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-warning w-100">Send Reset Link</button>
      <div class="text-center mt-3">
        <span class="form-toggle" onclick="showForm('login')">Back to Login</span>
      </div>
    </form>
  </div>
</div>

<script>
function showForm(form) {
  document.getElementById('login-form').style.display = (form === 'login') ? 'block' : 'none';
  document.getElementById('register-form').style.display = (form === 'register') ? 'block' : 'none';
  document.getElementById('forgot-form').style.display = (form === 'forgot') ? 'block' : 'none';
  document.getElementById('form-title').innerText =
    form === 'login' ? 'Admin Login' :
    form === 'register' ? 'Register Admin' :
    'Forgot Password';
}
</script>
</body>
</html>
