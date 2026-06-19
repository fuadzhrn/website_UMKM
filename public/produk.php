<?php
require_once __DIR__ . '/../config/koneksi.php';

$page_title = "Produk";

// Filter berdasarkan kategori (opsional, lewat ?kategori=id)
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
include __DIR__ . '/../includes/navbar.php';
?>

<div class="page-banner">
    <div class="container">
        <h1>Daftar Produk</h1>
        <p class="mb-0">Temukan Bika Ambon &amp; Cake favorit Anda</p>
    </div>
</div>

<section class="py-5">
    <div class="container">

        <!-- Filter Kategori -->
        <div class="mb-4 text-center">
            <a href="<?php echo BASE_URL; ?>/public/produk.php" class="btn btn-sm <?php echo $id_kategori == 0 ? 'btn-caramel' : 'btn-outline-caramel'; ?> me-2 mb-2">Semua</a>
            <?php if ($daftar_kategori) : while ($kat = mysqli_fetch_assoc($daftar_kategori)) : ?>
                <a href="<?php echo BASE_URL; ?>/public/produk.php?kategori=<?php echo $kat['id_kategori']; ?>" class="btn btn-sm <?php echo $id_kategori == $kat['id_kategori'] ? 'btn-caramel' : 'btn-outline-caramel'; ?> me-2 mb-2">
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
                                <p class="card-text text-muted small">
                                    <?php echo htmlspecialchars(mb_strimwidth($produk['deskripsi'], 0, 70, '...')); ?>
                                </p>
                                <p class="product-price mb-2">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                <a href="<?php echo BASE_URL; ?>/public/detail-produk.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-outline-caramel w-100">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-12 text-center text-muted py-5">
                    <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                    Belum ada produk tersedia.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
