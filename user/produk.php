<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}

$page_title = "Produk";

$id_kategori = isset($_GET['kategori']) ? (int) $_GET['kategori'] : 0;

$query = "SELECT p.*, k.nama_kategori FROM produk p
          LEFT JOIN kategori k ON p.id_kategori = k.id_kategori";
if ($id_kategori > 0) {
    $query .= " WHERE p.id_kategori = " . $id_kategori;
}
$query .= " ORDER BY p.id_produk ASC";

$result = mysqli_query($koneksi, $query);
$daftar_kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-user.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Produk</h5>
                <small class="text-muted">Pilih Bika Ambon &amp; Cake favorit Anda</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <div class="mb-4">
            <a href="<?php echo BASE_URL; ?>/user/produk.php" class="btn btn-sm <?php echo $id_kategori == 0 ? 'btn-caramel' : 'btn-outline-caramel'; ?> me-2 mb-2">Semua</a>
            <?php if ($daftar_kategori) : while ($kat = mysqli_fetch_assoc($daftar_kategori)) : ?>
                <a href="<?php echo BASE_URL; ?>/user/produk.php?kategori=<?php echo $kat['id_kategori']; ?>" class="btn btn-sm <?php echo $id_kategori == $kat['id_kategori'] ? 'btn-caramel' : 'btn-outline-caramel'; ?> me-2 mb-2">
                    <?php echo htmlspecialchars($kat['nama_kategori']); ?>
                </a>
            <?php endwhile; endif; ?>
        </div>

        <div class="row g-4">
            <?php if ($result && mysqli_num_rows($result) > 0) : ?>
                <?php while ($produk = mysqli_fetch_assoc($result)) : ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-hannasa">
                            <img src="<?php echo BASE_URL; ?>/<?php echo htmlspecialchars($produk['gambar']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/produk/placeholder.jpg'">
                            <div class="card-body">
                                <span class="badge badge-kategori mb-2"><?php echo htmlspecialchars($produk['nama_kategori']); ?></span>
                                <h5 class="card-title"><?php echo htmlspecialchars($produk['nama_produk']); ?></h5>
                                <p class="product-price mb-2">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                <p class="text-muted small mb-2">Stok: <?php echo (int) $produk['stok']; ?></p>

                                <?php if ($produk['status'] == 'tersedia' && $produk['stok'] > 0) : ?>
                                    <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-keranjang.php" class="d-flex gap-2">
                                        <input type="hidden" name="id_produk" value="<?php echo $produk['id_produk']; ?>">
                                        <input type="number" name="jumlah" value="1" min="1" max="<?php echo $produk['stok']; ?>" class="form-control form-control-sm" style="width:70px;">
                                        <button type="submit" name="aksi" value="tambah" class="btn btn-caramel btn-sm flex-grow-1">
                                            <i class="bi bi-cart-plus"></i> Tambah
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <button class="btn btn-secondary btn-sm w-100" disabled>Stok Habis</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-12 text-center text-muted py-5">Belum ada produk tersedia.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
