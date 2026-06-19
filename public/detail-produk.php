<?php
require_once __DIR__ . '/../config/koneksi.php';

$id_produk = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$query = "SELECT p.*, k.nama_kategori FROM produk p
          LEFT JOIN kategori k ON p.id_kategori = k.id_kategori
          WHERE p.id_produk = $id_produk";
$result = mysqli_query($koneksi, $query);
$produk = $result ? mysqli_fetch_assoc($result) : null;

$page_title = $produk ? $produk['nama_produk'] : "Produk Tidak Ditemukan";

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="page-banner">
    <div class="container">
        <h1><?php echo $produk ? htmlspecialchars($produk['nama_produk']) : 'Produk Tidak Ditemukan'; ?></h1>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <?php if ($produk) : ?>
            <div class="row g-4 align-items-start">
                <div class="col-lg-6">
                    <div class="card-hannasa p-2">
                        <img src="<?php echo BASE_URL; ?>/<?php echo htmlspecialchars($produk['gambar']); ?>" class="img-fluid rounded w-100" style="object-fit:cover; max-height:420px;" alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/produk/placeholder.jpg'">
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="badge badge-kategori mb-2"><?php echo htmlspecialchars($produk['nama_kategori']); ?></span>
                    <h2 class="fw-bold"><?php echo htmlspecialchars($produk['nama_produk']); ?></h2>
                    <p class="product-price fs-3"><strong>Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></strong></p>

                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-box-seam me-2 text-secondary"></i> Stok: <strong><?php echo (int) $produk['stok']; ?></strong></li>
                        <li class="mb-2"><i class="bi bi-tag me-2 text-secondary"></i> Kategori: <strong><?php echo htmlspecialchars($produk['nama_kategori']); ?></strong></li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle me-2 text-secondary"></i> Status:
                            <strong><?php echo $produk['status'] == 'tersedia' ? 'Tersedia' : 'Habis'; ?></strong>
                        </li>
                    </ul>

                    <h5>Deskripsi</h5>
                    <p class="text-muted"><?php echo nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>

                    <a href="<?php echo BASE_URL; ?>/auth/login-user.php" class="btn btn-caramel btn-lg mt-2">
                        <i class="bi bi-cart-plus me-1"></i> Login untuk Beli
                    </a>
                    <a href="<?php echo BASE_URL; ?>/public/produk.php" class="btn btn-outline-caramel btn-lg mt-2">Kembali ke Produk</a>
                </div>
            </div>
        <?php else : ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-exclamation-circle fs-1 d-block mb-2"></i>
                Produk tidak ditemukan.
                <br>
                <a href="<?php echo BASE_URL; ?>/public/produk.php" class="btn btn-outline-caramel mt-3">Kembali ke Produk</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
