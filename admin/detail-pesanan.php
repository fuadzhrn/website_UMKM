<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}

$id_pesanan = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$q_pesanan = mysqli_query($koneksi, "SELECT p.*, u.nama AS nama_pelanggan, u.email FROM pesanan p
                                      JOIN users u ON p.id_user = u.id_user
                                      WHERE p.id_pesanan = $id_pesanan");
$pesanan = $q_pesanan ? mysqli_fetch_assoc($q_pesanan) : null;

if (!$pesanan) {
    header("Location: " . BASE_URL . "/admin/pesanan.php");
    exit;
}

$page_title = "Detail Pesanan";
$daftar_status = ['Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];

$q_detail = mysqli_query($koneksi, "SELECT * FROM detail_pesanan WHERE id_pesanan = $id_pesanan");

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-admin.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Detail Pesanan</h5>
                <small class="text-muted">Kode Pesanan: <?php echo htmlspecialchars($pesanan['kode_pesanan']); ?></small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <?php if (isset($_SESSION['msg_pesanan_admin'])) : ?>
            <div class="alert alert-success alert-auto-close"><?php echo htmlspecialchars($_SESSION['msg_pesanan_admin']); ?></div>
            <?php unset($_SESSION['msg_pesanan_admin']); ?>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card-hannasa p-4">
                    <h5 class="mb-3">Produk yang Dipesan</h5>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr>
                            </thead>
                            <tbody>
                                <?php while ($d = mysqli_fetch_assoc($q_detail)) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($d['nama_produk']); ?></td>
                                        <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
                                        <td><?php echo $d['jumlah']; ?></td>
                                        <td>Rp <?php echo number_format($d['subtotal'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total Harga</strong></td>
                                    <td><strong class="product-price">Rp <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card-hannasa p-4 mb-4">
                    <h5 class="mb-3">Informasi Pesanan</h5>
                    <p class="mb-1"><strong>Pelanggan:</strong> <?php echo htmlspecialchars($pesanan['nama_pelanggan']); ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?php echo htmlspecialchars($pesanan['email']); ?></p>
                    <p class="mb-1"><strong>No. HP:</strong> <?php echo htmlspecialchars($pesanan['no_hp']); ?></p>
                    <p class="mb-1"><strong>Alamat Pengiriman:</strong> <?php echo htmlspecialchars($pesanan['alamat_pengiriman']); ?></p>
                    <p class="mb-1"><strong>Metode Pembayaran:</strong> <?php echo htmlspecialchars($pesanan['metode_pembayaran']); ?></p>
                    <p class="mb-1"><strong>Tanggal Pesanan:</strong> <?php echo date('d M Y H:i', strtotime($pesanan['tanggal_pesanan'])); ?></p>
                    <p class="mb-0"><strong>Status Saat Ini:</strong>
                        <span class="badge text-white badge-status-<?php echo strtolower(str_replace(' ', '', $pesanan['status_pesanan'])); ?>"><?php echo htmlspecialchars($pesanan['status_pesanan']); ?></span>
                    </p>
                </div>

                <div class="card-hannasa p-4">
                    <h5 class="mb-3">Update Status Pesanan</h5>
                    <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-pesanan.php">
                        <input type="hidden" name="id_pesanan" value="<?php echo $pesanan['id_pesanan']; ?>">
                        <div class="mb-3">
                            <select name="status_pesanan" class="form-select">
                                <?php foreach ($daftar_status as $status) : ?>
                                    <option value="<?php echo $status; ?>" <?php echo $pesanan['status_pesanan'] == $status ? 'selected' : ''; ?>><?php echo $status; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-caramel w-100">Simpan Status</button>
                    </form>
                </div>

                <a href="<?php echo BASE_URL; ?>/admin/pesanan.php" class="btn btn-outline-caramel w-100 mt-3">
                    <i class="bi bi-arrow-left"></i> Kembali ke Kelola Pesanan
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
