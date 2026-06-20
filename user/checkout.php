<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$page_title = "Checkout";

// Ambil isi keranjang user
$query = "SELECT k.id_keranjang, k.jumlah, p.id_produk, p.nama_produk, p.harga, p.gambar
          FROM keranjang k
          JOIN produk p ON k.id_produk = p.id_produk
          WHERE k.id_user = $id_user";
$result = mysqli_query($koneksi, $query);

$items = [];
$total_belanja = 0;
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $row['subtotal'] = $row['harga'] * $row['jumlah'];
        $total_belanja += $row['subtotal'];
        $items[] = $row;
    }
}

// Ambil data profil user untuk mengisi form otomatis
$q_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = $id_user");
$data_user = mysqli_fetch_assoc($q_user);

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-user.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Checkout</h5>
                <small class="text-muted">Lengkapi data pengiriman untuk menyelesaikan pesanan</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <?php if (count($items) == 0) : ?>
            <div class="card-hannasa p-4 text-center text-muted">
                <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                Keranjang Anda kosong, tidak ada yang bisa di-checkout.
                <br>
                <a href="<?php echo BASE_URL; ?>/user/produk.php" class="btn btn-outline-caramel mt-3">Belanja Sekarang</a>
            </div>
        <?php else : ?>
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="card-hannasa p-4">
                        <h5 class="mb-3">Data Pengiriman</h5>
                        <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-checkout.php">
                            <div class="mb-3">
                                <label class="form-label">Nama Penerima</label>
                                <input type="text" name="nama_penerima" class="form-control" value="<?php echo htmlspecialchars($data_user['nama']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No. HP</label>
                                <input type="text" name="no_hp" class="form-control" value="<?php echo htmlspecialchars($data_user['no_hp']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Pengiriman</label>
                                <textarea name="alamat_pengiriman" class="form-control" rows="3" required><?php echo htmlspecialchars($data_user['alamat']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-select" required>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                    <option value="COD (Bayar di Tempat)">COD (Bayar di Tempat)</option>
                                    <option value="E-Wallet">E-Wallet</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-caramel w-100">Buat Pesanan</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="summary-box">
                        <h5 class="mb-3">Ringkasan Pesanan</h5>
                        <?php foreach ($items as $item) : ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo htmlspecialchars($item['nama_produk']); ?> x<?php echo $item['jumlah']; ?></span>
                                <span>Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></span>
                            </div>
                        <?php endforeach; ?>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong class="product-price">Rp <?php echo number_format($total_belanja, 0, ',', '.'); ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
