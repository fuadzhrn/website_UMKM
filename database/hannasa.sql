-- =========================================================
-- Database: hannasa_db
-- Website: Bika Ambon & Cake Hannasa
-- =========================================================

CREATE DATABASE IF NOT EXISTS hannasa_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE hannasa_db;

-- =========================================================
-- Tabel: users
-- =========================================================
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    no_hp VARCHAR(20),
    alamat TEXT,
    role ENUM('user','admin') DEFAULT 'user',
    status ENUM('aktif','nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- Tabel: kategori
-- =========================================================
CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- Tabel: produk
-- =========================================================
CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    id_kategori INT,
    nama_produk VARCHAR(150) NOT NULL,
    harga DECIMAL(12,2) NOT NULL,
    stok INT DEFAULT 0,
    gambar VARCHAR(255),
    deskripsi TEXT,
    status ENUM('tersedia','habis') DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) ON DELETE SET NULL
);

-- =========================================================
-- Tabel: keranjang
-- =========================================================
CREATE TABLE keranjang (
    id_keranjang INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_produk INT NOT NULL,
    jumlah INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE
);

-- =========================================================
-- Tabel: pesanan
-- =========================================================
CREATE TABLE pesanan (
    id_pesanan INT AUTO_INCREMENT PRIMARY KEY,
    kode_pesanan VARCHAR(50) NOT NULL,
    id_user INT NOT NULL,
    nama_penerima VARCHAR(100),
    no_hp VARCHAR(20),
    alamat_pengiriman TEXT,
    metode_pembayaran VARCHAR(50),
    total_harga DECIMAL(12,2) NOT NULL DEFAULT 0,
    status_pesanan ENUM('Menunggu Konfirmasi','Diproses','Dikirim','Selesai','Dibatalkan') DEFAULT 'Menunggu Konfirmasi',
    tanggal_pesanan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- =========================================================
-- Tabel: detail_pesanan
-- =========================================================
CREATE TABLE detail_pesanan (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_pesanan INT NOT NULL,
    id_produk INT,
    nama_produk VARCHAR(150),
    harga DECIMAL(12,2),
    jumlah INT,
    subtotal DECIMAL(12,2),
    FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan) ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE SET NULL
);

-- =========================================================
-- Data dummy: users
-- Password admin: admin123
-- Password user : user123
-- =========================================================
INSERT INTO users (nama, email, password, no_hp, alamat, role, status) VALUES
('Admin Hannasa', 'admin@hannasa.com', '$2y$10$0AFvzzKGskt/cJ2HkTH9UuWcrtMO/BodouR318y9IblZFMLihMaAi', '081234567890', 'Jl. Kue Manis No. 1, Medan', 'admin', 'aktif'),
('Siti Aminah', 'siti@gmail.com', '$2y$10$lJBzOeKsE1h1h3HwnCTwAeNmbFDPcbe9X03X90PGS5gIZvuIhR8aq', '081298765432', 'Jl. Mawar No. 10, Medan', 'user', 'aktif'),
('Budi Santoso', 'budi@gmail.com', '$2y$10$lJBzOeKsE1h1h3HwnCTwAeNmbFDPcbe9X03X90PGS5gIZvuIhR8aq', '081255566677', 'Jl. Melati No. 5, Medan', 'user', 'aktif');

-- =========================================================
-- Data dummy: kategori
-- =========================================================
INSERT INTO kategori (nama_kategori, deskripsi) VALUES
('Bika Ambon', 'Kue khas Medan dengan tekstur lembut dan rasa khas pandan/original'),
('Cake', 'Aneka cake lembut dengan berbagai varian rasa'),
('Paket Hampers', 'Paket kue untuk hadiah dan acara spesial');

-- =========================================================
-- Data dummy: produk
-- =========================================================
INSERT INTO produk (id_kategori, nama_produk, harga, stok, gambar, deskripsi, status) VALUES
(1, 'Bika Ambon Original', 45000, 25, 'assets/img/produk/bika-original.jpg', 'Bika Ambon original dengan rasa gula merah khas, lembut dan legit, dibuat dengan resep tradisional.', 'tersedia'),
(1, 'Bika Ambon Pandan', 48000, 20, 'assets/img/produk/bika-pandan.jpg', 'Bika Ambon dengan aroma pandan alami, warna hijau menarik dan rasa harum yang khas.', 'tersedia'),
(1, 'Bika Ambon Keju', 52000, 15, 'assets/img/produk/bika-keju.jpg', 'Bika Ambon dengan taburan keju premium di atasnya, perpaduan manis dan gurih.', 'tersedia'),
(2, 'Cake Coklat Hannasa', 75000, 10, 'assets/img/produk/cake-coklat.jpg', 'Cake coklat lembut dengan lapisan ganache coklat premium, cocok untuk acara spesial.', 'tersedia'),
(2, 'Cake Keju Hannasa', 80000, 10, 'assets/img/produk/cake-keju.jpg', 'Cake lembut dengan topping keju melimpah, rasa creamy dan gurih.', 'tersedia'),
(3, 'Paket Hampers Hannasa', 150000, 8, 'assets/img/produk/hampers.jpg', 'Paket hampers berisi kombinasi Bika Ambon dan Cake, cocok untuk hadiah dan acara spesial.', 'tersedia');
