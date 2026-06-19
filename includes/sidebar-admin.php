<?php
/**
 * includes/sidebar-admin.php
 * Sidebar untuk halaman dashboard admin.
 * Wajib di-include setelah session admin aktif (lihat config/koneksi.php).
 */
if (!defined('BASE_URL')) {
    define('BASE_URL', '/nayla');
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar-hannasa">
    <a href="<?php echo BASE_URL; ?>/admin/dashboard.php" class="sidebar-brand">Hannasa<span> Admin</span></a>
    <nav class="nav flex-column">
        <a class="nav-link <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/admin/dashboard.php">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a class="nav-link <?php echo in_array($current_page, ['produk.php', 'tambah-produk.php', 'edit-produk.php']) ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/admin/produk.php">
            <i class="bi bi-box-seam"></i> Kelola Produk
        </a>
        <a class="nav-link <?php echo in_array($current_page, ['pesanan.php', 'detail-pesanan.php']) ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/admin/pesanan.php">
            <i class="bi bi-receipt"></i> Kelola Pesanan
        </a>
        <a class="nav-link <?php echo $current_page == 'user.php' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/admin/user.php">
            <i class="bi bi-people"></i> Kelola User
        </a>
        <hr class="text-secondary">
        <a class="nav-link" href="<?php echo BASE_URL; ?>/auth/logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </nav>
</aside>
