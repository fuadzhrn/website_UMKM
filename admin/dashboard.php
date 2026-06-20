<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}

$page_title = "Dashboard Admin";

$total_produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM produk"))['total'] ?? 0;
$total_pesanan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesanan"))['total'] ?? 0;
$total_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users WHERE role = 'user'"))['total'] ?? 0;
$total_pendapatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_harga) AS total FROM pesanan WHERE status_pesanan = 'Selesai'"))['total'] ?? 0;

$q_terbaru = mysqli_query($koneksi, "SELECT p.*, u.nama AS nama_pelanggan FROM pesanan p
                                      JOIN users u ON p.id_user = u.id_user
                                      ORDER BY p.tanggal_pesanan DESC LIMIT 8");

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-admin.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?></h5>
                <small class="text-muted">Selamat datang di dashboard admin Hannasa</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon bg-caramel-light"><i class="bi bi-box-seam"></i></div>
                    <div class="stat-value"><?php echo (int) $total_produk; ?></div>
                    <div class="stat-label">Total Produk</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon bg-gold-light"><i class="bi bi-receipt"></i></div>
                    <div class="stat-value"><?php echo (int) $total_pesanan; ?></div>
                    <div class="stat-label">Total Pesanan</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon bg-cream-light"><i class="bi bi-people"></i></div>
                    <div class="stat-value"><?php echo (int) $total_user; ?></div>
                    <div class="stat-label">Total User</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color:#5cb85c22; color:#5cb85c;"><i class="bi bi-cash-stack"></i></div>
                    <div class="stat-value" style="font-size:1.2rem;">Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></div>
                    <div class="stat-label">Pendapatan (Selesai)</div>
                </div>
            </div>
        </div>

        <div class="card-hannasa p-4">
            <h5 class="mb-3">Pesanan Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-hannasa align-middle">
                    <thead>
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($q_terbaru && mysqli_num_rows($q_terbaru) > 0) : ?>
                            <?php while ($p = mysqli_fetch_assoc($q_terbaru)) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($p['kode_pesanan']); ?></td>
                                    <td><?php echo htmlspecialchars($p['nama_pelanggan']); ?></td>
                                    <td><?php echo date('d M Y', strtotime($p['tanggal_pesanan'])); ?></td>
                                    <td>Rp <?php echo number_format($p['total_harga'], 0, ',', '.'); ?></td>
                                    <td><span class="badge text-white badge-status-<?php echo strtolower(str_replace(' ', '', $p['status_pesanan'])); ?>"><?php echo htmlspecialchars($p['status_pesanan']); ?></span></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr><td colspan="5" class="text-center text-muted">Belum ada pesanan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
