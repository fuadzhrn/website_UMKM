<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$page_title = "Pesanan Saya";

$query = "SELECT * FROM pesanan WHERE id_user = $id_user ORDER BY tanggal_pesanan DESC";
$result = mysqli_query($koneksi, $query);

$daftar_pesanan = [];
if ($result) {
    while ($p = mysqli_fetch_assoc($result)) {
        $q_detail = mysqli_query($koneksi, "SELECT * FROM detail_pesanan WHERE id_pesanan = " . $p['id_pesanan']);
        $p['items'] = [];
        while ($d = mysqli_fetch_assoc($q_detail)) {
            $p['items'][] = $d;
        }
        $daftar_pesanan[] = $p;
    }
}

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-user.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Pesanan Saya</h5>
                <small class="text-muted">Riwayat dan status pesanan Anda</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <?php if (isset($_SESSION['msg_pesanan'])) : ?>
            <div class="alert alert-success alert-auto-close"><?php echo htmlspecialchars($_SESSION['msg_pesanan']); ?></div>
            <?php unset($_SESSION['msg_pesanan']); ?>
        <?php endif; ?>

        <div class="card-hannasa p-4">
            <?php if (count($daftar_pesanan) > 0) : ?>
                <div class="table-responsive">
                    <table class="table table-hannasa align-middle">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Metode Bayar</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($daftar_pesanan as $i => $p) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($p['kode_pesanan']); ?></td>
                                    <td><?php echo date('d M Y', strtotime($p['tanggal_pesanan'])); ?></td>
                                    <td>Rp <?php echo number_format($p['total_harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo htmlspecialchars($p['metode_pembayaran']); ?></td>
                                    <td><span class="badge text-white badge-status-<?php echo strtolower(str_replace(' ', '', $p['status_pesanan'])); ?>"><?php echo htmlspecialchars($p['status_pesanan']); ?></span></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-caramel" data-bs-toggle="modal" data-bs-target="#modalPesanan<?php echo $i; ?>">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Detail Pesanan -->
                                <div class="modal fade" id="modalPesanan<?php echo $i; ?>" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Pesanan - <?php echo htmlspecialchars($p['kode_pesanan']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-1"><strong>Penerima:</strong> <?php echo htmlspecialchars($p['nama_penerima']); ?></p>
                                                <p class="mb-1"><strong>No. HP:</strong> <?php echo htmlspecialchars($p['no_hp']); ?></p>
                                                <p class="mb-1"><strong>Alamat Pengiriman:</strong> <?php echo htmlspecialchars($p['alamat_pengiriman']); ?></p>
                                                <p class="mb-3"><strong>Status:</strong>
                                                    <span class="badge text-white badge-status-<?php echo strtolower(str_replace(' ', '', $p['status_pesanan'])); ?>"><?php echo htmlspecialchars($p['status_pesanan']); ?></span>
                                                </p>
                                                <table class="table table-sm align-middle">
                                                    <thead>
                                                        <tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($p['items'] as $d) : ?>
                                                            <tr>
                                                                <td><?php echo htmlspecialchars($d['nama_produk']); ?></td>
                                                                <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
                                                                <td><?php echo $d['jumlah']; ?></td>
                                                                <td>Rp <?php echo number_format($d['subtotal'], 0, ',', '.'); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                                            <td><strong class="product-price">Rp <?php echo number_format($p['total_harga'], 0, ',', '.'); ?></strong></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="text-center text-muted py-5">
                    <i class="bi bi-receipt fs-1 d-block mb-2"></i>
                    Anda belum memiliki pesanan.
                    <br>
                    <a href="<?php echo BASE_URL; ?>/user/produk.php" class="btn btn-outline-caramel mt-3">Belanja Sekarang</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
