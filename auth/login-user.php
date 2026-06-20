<?php
require_once __DIR__ . '/../config/koneksi.php';

// Jika sudah login sebagai user, langsung arahkan ke dashboard
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'user') {
    header("Location: " . BASE_URL . "/user/dashboard.php");
    exit;
}

$page_title = "Login User";
$error = $_SESSION['error_login_user'] ?? '';
unset($_SESSION['error_login_user']);

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="auth-wrapper">
    <div class="auth-card user-card">
        <div class="text-center">
            <div class="auth-icon"><img src="<?php echo BASE_URL; ?>/assets/img/logo/logo.jpg" alt="Logo Hannasa"></div>
            <h3 class="fw-bold">Login Pelanggan</h3>
            <p class="text-muted">Masuk untuk mulai berbelanja di Hannasa</p>
        </div>

        <?php if ($error) : ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-login-user.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="email@anda.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-caramel w-100">Login</button>
        </form>

        <p class="text-center mt-3 mb-0">
            Belum punya akun? <a href="<?php echo BASE_URL; ?>/auth/register.php">Daftar di sini</a>
        </p>
        <p class="text-center mt-2 mb-0">
            <a href="<?php echo BASE_URL; ?>/auth/login-admin.php" class="text-muted small">Login sebagai Admin</a>
        </p>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
