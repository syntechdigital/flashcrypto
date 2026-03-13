<?php
$config = include("payment_config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crypto Payments</title>
</head>
<body style="font-family:Arial, sans-serif; background:#87CEEB; margin:0; padding:0;">

<div style="max-width:900px; margin:40px auto; background:#fff; padding:30px; border-radius:10px;">

    <!-- BTC Section -->
    <h2>BTC Payment Instructions</h2>
    <p>Software Price: <strong><?php echo $config['btc_price']; ?></strong></p>
    <div style="text-align:center; margin:20px 0;">
        <img src="<?php echo $config['btc_qr']; ?>" alt="BTC QR Code" width="160">
    </div>
    <p><strong><?php echo $config['btc_address']; ?></strong></p>

    <!-- USDT Section -->
    <h2>USDT Payment Instructions</h2>
    <p>Software Price: <strong><?php echo $config['usdt_price']; ?></strong></p>
    <div style="text-align:center; margin:20px 0;">
        <img src="<?php echo $config['usdt_qr']; ?>" alt="USDT QR Code" width="160">
    </div>
    <p><strong><?php echo $config['usdt_address']; ?></strong></p>

</div>
</body>
</html>
