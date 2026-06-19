<?php
/**
 * proses/proses-login-user.php
 * Memproses login untuk role 'user' menggunakan password_verify().
 */
require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}

$email = trim($_POST['email']);
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = ? AND role = 'user'";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    if ($user['status'] != 'aktif') {
        $_SESSION['error_login_user'] = "Akun Anda tidak aktif. Silakan hubungi admin.";
        header("Location: " . BASE_URL . "/auth/login-user.php");
        exit;
    }

    // Simpan data session
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    header("Location: " . BASE_URL . "/user/dashboard.php");
    exit;
} else {
    $_SESSION['error_login_user'] = "Email atau password salah.";
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}
