<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$config = include("payment_config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $config['btc_price'] = $_POST['btc_price'];
    $config['btc_address'] = $_POST['btc_address'];
    $config['usdt_price'] = $_POST['usdt_price'];
    $config['usdt_address'] = $_POST['usdt_address'];

    if (!empty($_FILES['btc_qr']['name'])) {
        $btc_qr_path = "uploads/" . basename($_FILES['btc_qr']['name']);
        move_uploaded_file($_FILES['btc_qr']['tmp_name'], $btc_qr_path);
        $config['btc_qr'] = $btc_qr_path;
    }

    if (!empty($_FILES['usdt_qr']['name'])) {
        $usdt_qr_path = "uploads/" . basename($_FILES['usdt_qr']['name']);
        move_uploaded_file($_FILES['usdt_qr']['tmp_name'], $usdt_qr_path);
        $config['usdt_qr'] = $usdt_qr_path;
    }

    file_put_contents("payment_config.php", "<?php\nreturn " . var_export($config, true) . ";");
    $message = "Payment details updated successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        img {
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            background: #007BFF;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
        .logout {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }
        .logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <?php if(isset($message)) echo "<p class='message'>$message</p>"; ?>
        <form method="POST" enctype="multipart/form-data">
            <label>BTC Price</label>
            <input type="text" name="btc_price" value="<?php echo $config['btc_price']; ?>">

            <label>BTC Address</label>
            <input type="text" name="btc_address" value="<?php echo $config['btc_address']; ?>">

            <label>BTC QR Image</label>
            <input type="file" name="btc_qr">
            <?php if (!empty($config['btc_qr'])): ?>
                <img src="<?php echo $config['btc_qr']; ?>" width="100">
            <?php endif; ?>

            <label>USDT Price</label>
            <input type="text" name="usdt_price" value="<?php echo $config['usdt_price']; ?>">

            <label>USDT Address</label>
            <input type="text" name="usdt_address" value="<?php echo $config['usdt_address']; ?>">

            <label>USDT QR Image</label>
            <input type="file" name="usdt_qr">
            <?php if (!empty($config['usdt_qr'])): ?>
                <img src="<?php echo $config['usdt_qr']; ?>" width="100">
            <?php endif; ?>

            <button type="submit">Save Changes</button>
        </form>
        <a class="logout" href="logout.php">Logout</a>
    </div>
    <!-- Footer -->
    <div style="margin-top:40px; font-size:14px; color:#666; text-align:center; background:#f1f1f1; padding:15px; border-radius:6px;">
        <p></p>
        <p>Copyright © 2026 FLASH CRYPTO GENERATOR</p>
    </div>
</body>
</html>
