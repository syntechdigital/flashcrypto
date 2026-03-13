-- Create the database (only once)
CREATE DATABASE IF NOT EXISTS flash_crypto;
USE flash_crypto;

-- Admin accounts table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    reset_token VARCHAR(255) DEFAULT NULL,
    reset_expires DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Payment details table
CREATE TABLE payment_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coin VARCHAR(10) NOT NULL,       -- e.g. BTC, USDT
    price VARCHAR(50) NOT NULL,      -- e.g. "0.035 BTC"
    address VARCHAR(255) NOT NULL,   -- wallet address
    qr_path VARCHAR(255) NOT NULL    -- path to QR image file
);

-- Insert sample BTC and USDT records
INSERT INTO payment_details (coin, price, address, qr_path)
VALUES 
('BTC', '0.035 BTC', '3KfST1wMpEXAxi9Wtyu9R9CmWBcCzyDwHk', 'uploads/btc_qr.png'),
('USDT', '3500 USDT', 'TFZBaQQCdAJBQDkG2CffVqo77kFm4uQupX', 'uploads/usdt_qr.png');
