<?php
/**
 * includes/navbar.php
 * Navbar untuk halaman umum (pengunjung).
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!defined('BASE_URL')) {
    define('BASE_URL', '/nayla');
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-hannasa sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>/public/index.php">Hannasa<span>.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHannasa">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHannasa">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/public/index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'produk.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/public/produk.php">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'tentang.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/public/tentang.php">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'kontak.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/public/kontak.php">Kontak</a>
                </li>

                <?php if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'user') : ?>
                    <li class="nav-item ms-lg-2">
                        <a class="nav-link btn-login" href="<?php echo BASE_URL; ?>/user/dashboard.php"><i class="bi bi-person-circle me-1"></i> Dashboard</a>
                    </li>
                <?php elseif (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') : ?>
                    <li class="nav-item ms-lg-2">
                        <a class="nav-link btn-login" href="<?php echo BASE_URL; ?>/admin/dashboard.php"><i class="bi bi-speedometer2 me-1"></i> Dashboard Admin</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item ms-lg-2">
                        <a class="nav-link btn-login" href="<?php echo BASE_URL; ?>/auth/login-user.php"><i class="bi bi-box-arrow-in-right me-1"></i> Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
