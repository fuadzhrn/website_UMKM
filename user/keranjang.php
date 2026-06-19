<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$page_title = "Keranjang Belanja";

$query = "SELECT k.id_keranjang, k.jumlah, p.id_produk, p.nama_produk, p.harga, p.gambar, p.stok
          FROM keranjang k
          JOIN produk p ON k.id_produk = p.id_produk
          WHERE k.id_user = $id_user
          ORDER BY k.id_keranjang DESC";
$result = mysqli_query($koneksi, $query);

$total_belanja = 0;
$items = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $row['subtotal'] = $row['harga'] * $row['jumlah'];
        $total_belanja += $row['subtotal'];
        $items[] = $row;
    }
}

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-user.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Keranjang Belanja</h5>
                <small class="text-muted">Periksa kembali pesanan Anda sebelum checkout</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <?php if (isset($_SESSION['msg_keranjang'])) : ?>
            <div class="alert alert-success alert-auto-close"><?php echo htmlspecialchars($_SESSION['msg_keranjang']); ?></div>
            <?php unset($_SESSION['msg_keranjang']); ?>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card-hannasa p-4">
                    <?php if (count($items) > 0) : ?>
                        <div class="table-responsive">
                            <table class="table table-hannasa align-middle">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item) : ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <img src="<?php echo BASE_URL; ?>/<?php echo htmlspecialchars($item['gambar']); ?>" class="cart-item-img" alt="<?php echo htmlspecialchars($item['nama_produk']); ?>" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/produk/placeholder.jpg'">
                                                    <span><?php echo htmlspecialchars($item['nama_produk']); ?></span>
                                                </div>
                                            </td>
                                            <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                                            <td style="width:160px;">
                                                <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-keranjang.php" class="d-flex gap-2">
                                                    <input type="hidden" name="id_keranjang" value="<?php echo $item['id_keranjang']; ?>">
                                                    <input type="number" name="jumlah" value="<?php echo $item['jumlah']; ?>" min="1" max="<?php echo $item['stok']; ?>" class="form-control form-control-sm">
                                                    <button type="submit" name="aksi" value="update" class="btn btn-sm btn-outline-caramel"><i class="bi bi-arrow-repeat"></i></button>
                                                </form>
                                            </td>
                                            <td>Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                                            <td>
                                                <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-keranjang.php">
                                                    <input type="hidden" name="id_keranjang" value="<?php echo $item['id_keranjang']; ?>">
                                                    <button type="submit" name="aksi" value="hapus" class="btn btn-sm btn-outline-danger btn-delete-confirm" data-confirm="Hapus produk ini dari keranjang?"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                            Keranjang Anda masih kosong.
                            <br>
                            <a href="<?php echo BASE_URL; ?>/user/produk.php" class="btn btn-outline-caramel mt-3">Belanja Sekarang</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-box">
                    <h5 class="mb-3">Ringkasan Belanja</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total Item</span>
                        <span><?php echo count($items); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total Harga</strong>
                        <strong class="product-price">Rp <?php echo number_format($total_belanja, 0, ',', '.'); ?></strong>
                    </div>
                    <?php if (count($items) > 0) : ?>
                        <a href="<?php echo BASE_URL; ?>/user/checkout.php" class="btn btn-caramel w-100">Checkout Sekarang</a>
                    <?php else : ?>
                        <button class="btn btn-caramel w-100" disabled>Checkout Sekarang</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
