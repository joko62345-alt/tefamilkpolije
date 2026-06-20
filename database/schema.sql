-- Database Creation
CREATE DATABASE IF NOT EXISTS tefasusu;
USE tefasusu;

-- Table users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    address TEXT DEFAULT NULL,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT DEFAULT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table carts
CREATE TABLE IF NOT EXISTS carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table cart_items
CREATE TABLE IF NOT EXISTS cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table orders
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date DATETIME NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('Menunggu', 'Diproses', 'Selesai') DEFAULT 'Menunggu',
    shipping_address TEXT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    payment_proof VARCHAR(255) DEFAULT NULL,
    delivery_proof VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table order_details
CREATE TABLE IF NOT EXISTS order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table galleries
CREATE TABLE IF NOT EXISTS galleries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT DEFAULT NULL,
    image VARCHAR(255) NOT NULL,
    type ENUM('kegiatan', 'artikel') NOT NULL DEFAULT 'kegiatan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table partners
CREATE TABLE IF NOT EXISTS partners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table contacts
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    rating INT DEFAULT 0,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table reviews (ulasan dari customer untuk pesanan selesai)
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL DEFAULT 5,
    title VARCHAR(100) DEFAULT NULL,
    message TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    status ENUM('pending', 'approved') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==================== SEEDING DATA ====================

-- Users Seed (Admin & Customer)
-- admin / admin123
-- customer / customer123
INSERT INTO users (username, email, password, name, phone, address, role) VALUES 
('admin', 'admin@tefasusu.com', '$2y$10$HLkxtA.lc78m1VrNCn7CuOZ.9rvFWq0L2a79kMlwqB33Oygg5.Gkq', 'Administrator TEFA', '08123456789', 'Gedung TEFA POLIJE, Jember', 'admin'),
('customer', 'customer@gmail.com', '$2y$10$gYHGc.d2eAOGjEq7o6PQA.r2Iqln2jKZYAauyAXbrcAYK3RucT8OW', 'Budi Santoso', '087729664976', 'Jl. Mastrip No. 12, Sumbersari, Jember', 'customer');

-- Categories Seed
INSERT INTO categories (name) VALUES 
('Susu Segar'),
('Susu Pasteurisasi'),
('Susu UHT'),
('Susu Krim'),
('Susu Skim');

-- Products Seed
INSERT INTO products (category_id, name, description, price, stock, image) VALUES 
(1, 'Susu Segar Original', 'Susu segar original dengan rasa alami tanpa campuran. Diproses higienis langsung dari peternakan TEFA Milk, kaya gizi, dan cocok untuk konsumsi harian.', 10000.00, 50, 'produk-1.png'),
(1, 'Susu Segar Coklat', 'Susu segar dengan varian rasa coklat dengan rasa alami tanpa campuran. Diproses higienis langsung dari peternakan TEFA Milk, kaya gizi, dan cocok untuk konsumsi harian.', 10000.00, 50, 'produk-1.png'),
(2, 'Susu Pasteurisasi Stroberi', 'Susu pasteurisasi yang diproses dengan suhu terkontrol untuk menjaga rasa alami dan kualitas gizinya. Cocok diminum langsung dan aman untuk semua usia.', 10000.00, 30, 'produk-2.png'),
(2, 'Susu Pasteurisasi Original', 'Susu pasteurisasi yang diproses dengan suhu terkontrol untuk menjaga rasa alami dan kualitas gizinya. Cocok diminum langsung dan aman untuk semua usia.', 10000.00, 30, 'produk-3.png'),
(3, 'Susu UHT Original', 'Susu UHT berkualitas yang diproses dengan pemanasan tinggi sehingga tahan lama tanpa mengurangi nilai gizi. Praktis, aman, dan cocok untuk konsumsi harian.', 6000.00, 40, 'produk-1.png'),
(4, 'Susu Cream', 'Tekstur lembut dengan rasa lebih kaya, cocok untuk campuran kopi, dessert, atau produk olahan. Diolah dengan standar kualitas tinggi untuk hasil maksimal.', 15000.00, 20, 'pk3.jpg'),
(5, 'Susu Skim', 'Susu rendah lemak dengan tetap mempertahankan kandungan protein dan kalsium. Ideal untuk gaya hidup sehat, diet, atau kebutuhan industri pangan.', 12000.00, 25, 'pk2.jpg');

-- Galleries Seed
INSERT INTO galleries (title, image, type) VALUES 
('Kegiatan Produksi 1', 'https://c.animaapp.com/k4vTRFWx/img/whatsapp-image-2025-09-04-at-10-24-50-1-1.png', 'kegiatan'),
('Kegiatan Produksi 2', 'https://c.animaapp.com/k4vTRFWx/img/screenshot-2025-10-01-095421-1-1.png', 'kegiatan'),
('Kegiatan Sanitasi', 'https://c.animaapp.com/k4vTRFWx/img/screenshot-2025-10-01-094251-1-1.png', 'kegiatan'),
('Kegiatan Packing', 'https://c.animaapp.com/k4vTRFWx/img/image-9-2.png', 'kegiatan'),
('Artikel Gizi Susu', 'https://c.animaapp.com/k4vTRFWx/img/screenshot-2025-10-01-094251-1-1.png', 'artikel'),
('Artikel Manfaat Pasteurisasi', 'https://c.animaapp.com/k4vTRFWx/img/image-9-2.png', 'artikel'),
('Artikel Peternakan Polije', 'https://c.animaapp.com/k4vTRFWx/img/whatsapp-image-2025-09-04-at-10-24-50-1-1.png', 'artikel'),
('Artikel Standard Mutu', 'https://c.animaapp.com/k4vTRFWx/img/screenshot-2025-10-01-095421-1-1.png', 'artikel');

-- Partners Seed
INSERT INTO partners (name, image, description) VALUES 
('KUD BLITAR', 'pk1.jpg', 'Mitra distribusi dan pengembangan produk susu bersama Polije melalui CV Kerjen Rukun Santoso.'),
('Benaya Victorius Jaya', 'pk2.jpg', 'Program pengembangan kapasitas, integrasi kurikulum, dan inovasi produk bersama S4C & BFH-HAFL Swiss.');

-- Reviews / Contacts Seed (Testimonials)
INSERT INTO contacts (name, email, rating, message) VALUES 
('Marsh', 'marsh@gmail.com', 5, 'Susu segar original dari TEFA Milk sangat segar dan murni. Sangat direkomendasikan!'),
('Andrew Weltsomn', 'andrew@gmail.com', 5, 'Susu pasteurisasi stroberi rasanya enak banget, tidak eneg dan kemasannya rapi.'),
('Levina Jessica', 'levina@gmail.com', 5, 'Susu UHT-nya cocok untuk stok di rumah, rasanya gurih dan harganya terjangkau.');
