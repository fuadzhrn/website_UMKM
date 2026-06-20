<?php
require_once __DIR__ . '/../config/koneksi.php';

if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    header("Location: " . BASE_URL . "/admin/dashboard.php");
    exit;
}

$page_title = "Login Admin";
$error = $_SESSION['error_login_admin'] ?? '';
unset($_SESSION['error_login_admin']);

include __DIR__ . '/../includes/header.php';
?>

<div class="auth-wrapper admin-login-bg" style="min-height:100vh;">
    <div class="auth-card admin-card">
        <div class="text-center">
            <div class="auth-icon"><img src="<?php echo BASE_URL; ?>/assets/img/logo/logo.jpg" alt="Logo Hannasa"></div>
            <h3 class="fw-bold">Login Admin</h3>
            <p class="text-muted">Khusus untuk administrator Hannasa</p>
        </div>

        <?php if ($error) : ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-login-admin.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email Admin</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="admin@hannasa.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-dark w-100" style="background-color:#3E2723;">Masuk sebagai Admin</button>
        </form>

        <p class="text-center mt-3 mb-0">
            <a href="<?php echo BASE_URL; ?>/public/index.php" class="text-muted small"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
        </p>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
