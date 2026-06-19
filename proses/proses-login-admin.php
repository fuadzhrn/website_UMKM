<?php
/**
 * proses/proses-login-admin.php
 * Memproses login untuk role 'admin' menggunakan password_verify().
 */
require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}

$email = trim($_POST['email']);
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = ? AND role = 'admin'";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$admin = mysqli_fetch_assoc($result);

if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['id_user'] = $admin['id_user'];
    $_SESSION['nama'] = $admin['nama'];
    $_SESSION['email'] = $admin['email'];
    $_SESSION['role'] = $admin['role'];

    header("Location: " . BASE_URL . "/admin/dashboard.php");
    exit;
} else {
    $_SESSION['error_login_admin'] = "Email atau password admin salah.";
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}
