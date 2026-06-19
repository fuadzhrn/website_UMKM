<?php
/**
 * File koneksi database
 * Menggunakan mysqli - cocok untuk pemula
 */

// Alamat dasar website (folder project di htdocs/www).
// Karena diakses lewat http://localhost/nayla/, semua link internal
// memakai BASE_URL agar tidak rusak.
if (!defined('BASE_URL')) {
    define('BASE_URL', '/nayla');
}

// Konfigurasi database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hannasa_db";

// Membuat koneksi ke database
$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Cek apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set karakter encoding menjadi UTF-8
mysqli_set_charset($koneksi, "utf8mb4");

// Mulai session jika belum dimulai (dipakai untuk login user/admin)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
