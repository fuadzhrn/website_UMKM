<?php
/**
 * includes/sidebar-user.php
 * Sidebar untuk halaman dashboard pelanggan.
 * Wajib di-include setelah session user aktif (lihat config/koneksi.php).
 */
if (!defined('BASE_URL')) {
    define('BASE_URL', '/nayla');
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar-hannasa">
    <a href="<?php echo BASE_URL; ?>/user/dashboard.php" class="sidebar-brand">
        <span class="logo-badge">
            <img src="<?php echo BASE_URL; ?>/assets/img/logo/logo.jpg" alt="Logo Hannasa">
        </span>
        Hannasa<span>.</span>
    </a>
    <nav class="nav flex-column">
        <a class="nav-link <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/user/dashboard.php">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a class="nav-link <?php echo $current_page == 'produk.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/user/produk.php">
            <i class="bi bi-box-seam"></i> Produk
        </a>
        <a class="nav-link <?php echo $current_page == 'keranjang.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/user/keranjang.php">
            <i class="bi bi-cart3"></i> Keranjang Belanja
        </a>
        <a class="nav-link <?php echo $current_page == 'checkout.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/user/checkout.php">
            <i class="bi bi-credit-card"></i> Checkout
        </a>
        <a class="nav-link <?php echo $current_page == 'pesanan.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/user/pesanan.php">
            <i class="bi bi-receipt"></i> Pesanan Saya
        </a>
        <a class="nav-link <?php echo $current_page == 'profil.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/user/profil.php">
            <i class="bi bi-person-circle"></i> Profil Saya
        </a>
        <hr class="text-secondary">
        <a class="nav-link" href="<?php echo BASE_URL; ?>/auth/logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </nav>
</aside>
