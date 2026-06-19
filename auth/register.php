<?php
require_once __DIR__ . '/../config/koneksi.php';

if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'user') {
    header("Location: " . BASE_URL . "/user/dashboard.php");
    exit;
}

$page_title = "Register";
$error = $_SESSION['error_register'] ?? '';
unset($_SESSION['error_register']);

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="auth-wrapper">
    <div class="auth-card user-card" style="max-width: 560px;">
        <div class="text-center">
            <div class="auth-icon"><i class="bi bi-person-plus"></i></div>
            <h3 class="fw-bold">Daftar Akun Baru</h3>
            <p class="text-muted">Buat akun untuk mulai berbelanja di Hannasa</p>
        </div>

        <?php if ($error) : ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-register.php">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap Anda" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="email@anda.com" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter" minlength="6" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap Anda" required></textarea>
            </div>
            <button type="submit" class="btn btn-caramel w-100">Daftar</button>
        </form>

        <p class="text-center mt-3 mb-0">
            Sudah punya akun? <a href="<?php echo BASE_URL; ?>/auth/login-user.php">Login di sini</a>
        </p>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
