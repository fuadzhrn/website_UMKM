<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}

$page_title = "Kelola Pesanan";

$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
$daftar_status = ['Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];

$query = "SELECT p.*, u.nama AS nama_pelanggan FROM pesanan p
          JOIN users u ON p.id_user = u.id_user";
if ($status_filter != '' && in_array($status_filter, $daftar_status)) {
    $status_aman = mysqli_real_escape_string($koneksi, $status_filter);
    $query .= " WHERE p.status_pesanan = '$status_aman'";
}
$query .= " ORDER BY p.tanggal_pesanan DESC";

$result = mysqli_query($koneksi, $query);

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-admin.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Kelola Pesanan</h5>
                <small class="text-muted">Pantau dan kelola seluruh pesanan pelanggan</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <?php if (isset($_SESSION['msg_pesanan_admin'])) : ?>
            <div class="alert alert-success alert-auto-close"><?php echo htmlspecialchars($_SESSION['msg_pesanan_admin']); ?></div>
            <?php unset($_SESSION['msg_pesanan_admin']); ?>
        <?php endif; ?>

        <div class="card-hannasa p-4">
            <div class="mb-3">
                <a href="<?php echo BASE_URL; ?>/admin/pesanan.php" class="btn btn-sm <?php echo $status_filter == '' ? 'btn-caramel' : 'btn-outline-caramel'; ?> me-2 mb-2">Semua</a>
                <?php foreach ($daftar_status as $status) : ?>
                    <a href="<?php echo BASE_URL; ?>/admin/pesanan.php?status=<?php echo urlencode($status); ?>" class="btn btn-sm <?php echo $status_filter == $status ? 'btn-caramel' : 'btn-outline-caramel'; ?> me-2 mb-2">
                        <?php echo htmlspecialchars($status); ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="table-responsive">
                <table class="table table-hannasa align-middle">
                    <thead>
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Metode Bayar</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0) : ?>
                            <?php while ($p = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($p['kode_pesanan']); ?></td>
                                    <td><?php echo htmlspecialchars($p['nama_pelanggan']); ?></td>
                                    <td><?php echo date('d M Y', strtotime($p['tanggal_pesanan'])); ?></td>
                                    <td><?php echo htmlspecialchars($p['metode_pembayaran']); ?></td>
                                    <td>Rp <?php echo number_format($p['total_harga'], 0, ',', '.'); ?></td>
                                    <td><span class="badge text-white badge-status-<?php echo strtolower(str_replace(' ', '', $p['status_pesanan'])); ?>"><?php echo htmlspecialchars($p['status_pesanan']); ?></span></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>/admin/detail-pesanan.php?id=<?php echo $p['id_pesanan']; ?>" class="btn btn-sm btn-outline-caramel">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr><td colspan="7" class="text-center text-muted">Belum ada pesanan.</td></tr>
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
