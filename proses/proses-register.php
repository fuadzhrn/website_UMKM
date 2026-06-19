<?php
/**
 * proses/proses-register.php
 * Memproses pendaftaran user baru. Password disimpan dengan password_hash().
 */
require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: " . BASE_URL . "/auth/register.php");
    exit;
}

$nama = trim($_POST['nama']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$no_hp = trim($_POST['no_hp']);
$alamat = trim($_POST['alamat']);

// Validasi sederhana
if ($nama == '' || $email == '' || $password == '' || $no_hp == '' || $alamat == '') {
    $_SESSION['error_register'] = "Semua field wajib diisi.";
    header("Location: " . BASE_URL . "/auth/register.php");
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['error_register'] = "Password minimal 6 karakter.";
    header("Location: " . BASE_URL . "/auth/register.php");
    exit;
}

// Cek apakah email sudah terdaftar
$cek = mysqli_prepare($koneksi, "SELECT id_user FROM users WHERE email = ?");
mysqli_stmt_bind_param($cek, "s", $email);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);

if (mysqli_stmt_num_rows($cek) > 0) {
    $_SESSION['error_register'] = "Email sudah terdaftar. Gunakan email lain.";
    header("Location: " . BASE_URL . "/auth/register.php");
    exit;
}

// Simpan password dalam bentuk hash (bukan plain text)
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$insert = mysqli_prepare($koneksi, "INSERT INTO users (nama, email, password, no_hp, alamat, role, status) VALUES (?, ?, ?, ?, ?, 'user', 'aktif')");
mysqli_stmt_bind_param($insert, "sssss", $nama, $email, $password_hash, $no_hp, $alamat);

if (mysqli_stmt_execute($insert)) {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
} else {
    $_SESSION['error_register'] = "Pendaftaran gagal. Silakan coba lagi.";
    header("Location: " . BASE_URL . "/auth/register.php");
    exit;
}
