<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$page_title = "Dashboard Pelanggan";

// Hitung jumlah item di keranjang
$q_keranjang = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM keranjang WHERE id_user = $id_user");
$total_keranjang = mysqli_fetch_assoc($q_keranjang)['total'] ?? 0;

// Hitung jumlah pesanan
$q_pesanan = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesanan WHERE id_user = $id_user");
$total_pesanan = mysqli_fetch_assoc($q_pesanan)['total'] ?? 0;

// Hitung jumlah pesanan per status
function hitung_status_pesanan($koneksi, $id_user, $status)
{
    $status_aman = mysqli_real_escape_string($koneksi, $status);
    $q = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesanan WHERE id_user = $id_user AND status_pesanan = '$status_aman'");
    return mysqli_fetch_assoc($q)['total'] ?? 0;
}

$total_menunggu = hitung_status_pesanan($koneksi, $id_user, 'Menunggu Konfirmasi');
$total_diproses = hitung_status_pesanan($koneksi, $id_user, 'Diproses');
$total_dikirim = hitung_status_pesanan($koneksi, $id_user, 'Dikirim');
$total_selesai = hitung_status_pesanan($koneksi, $id_user, 'Selesai');

// Pesanan terbaru
$q_terbaru = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_user = $id_user ORDER BY tanggal_pesanan DESC LIMIT 5");

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-user.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?></h5>
                <small class="text-muted">Selamat datang di dashboard pelanggan Hannasa</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon bg-caramel-light"><i class="bi bi-cart3"></i></div>
                    <div class="stat-value"><?php echo (int) $total_keranjang; ?></div>
                    <div class="stat-label">Item di Keranjang</div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon bg-cream-light"><i class="bi bi-receipt"></i></div>
                    <div class="stat-value"><?php echo (int) $total_pesanan; ?></div>
                    <div class="stat-label">Total Pesanan</div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color:#f0ad4e22; color:#f0ad4e;"><i class="bi bi-hourglass-split"></i></div>
                    <div class="stat-value"><?php echo (int) $total_menunggu; ?></div>
                    <div class="stat-label">Menunggu Konfirmasi</div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color:#5bc0de22; color:#5bc0de;"><i class="bi bi-gear"></i></div>
                    <div class="stat-value"><?php echo (int) $total_diproses; ?></div>
                    <div class="stat-label">Diproses</div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color:#428bca22; color:#428bca;"><i class="bi bi-truck"></i></div>
                    <div class="stat-value"><?php echo (int) $total_dikirim; ?></div>
                    <div class="stat-label">Dikirim</div>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color:#5cb85c22; color:#5cb85c;"><i class="bi bi-check-circle"></i></div>
                    <div class="stat-value"><?php echo (int) $total_selesai; ?></div>
                    <div class="stat-label">Selesai</div>
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
                                    <td><?php echo date('d M Y', strtotime($p['tanggal_pesanan'])); ?></td>
                                    <td>Rp <?php echo number_format($p['total_harga'], 0, ',', '.'); ?></td>
                                    <td><span class="badge text-white badge-status-<?php echo strtolower(str_replace(' ', '', $p['status_pesanan'])); ?>"><?php echo htmlspecialchars($p['status_pesanan']); ?></span></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr><td colspan="4" class="text-center text-muted">Belum ada pesanan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
