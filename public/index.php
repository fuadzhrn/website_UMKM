<?php
require_once __DIR__ . '/../config/koneksi.php';

$page_title = "Beranda";

// Ambil 4 produk unggulan dari database
$produk_unggulan = [];
$query = "SELECT p.*, k.nama_kategori FROM produk p
          LEFT JOIN kategori k ON p.id_kategori = k.id_kategori
          WHERE p.status = 'tersedia'
          ORDER BY p.id_produk ASC
          LIMIT 4";
$result = mysqli_query($koneksi, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $produk_unggulan[] = $row;
    }
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6">
                <span class="badge-gold"><i class="bi bi-stars me-1"></i>kue manis</span>
                <h1>Bika Ambon &amp; Cake Hannasa</h1>
                <p class="lead">Kelembutan dan cita rasa otentik dalam setiap gigitan. Dibuat dari bahan pilihan untuk menemani momen spesial Anda.</p>
                <a href="<?php echo BASE_URL; ?>/public/produk.php" class="btn btn-gold btn-lg mt-2">Lihat Produk <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="col-lg-6">
                <div class="hero-img-wrapper">
                    <img src="<?php echo BASE_URL; ?>/assets/img/banner/hero.jpg" alt="Bika Ambon & Cake Hannasa" class="hero-img" onerror="this.remove(); document.getElementById('heroPlaceholder').classList.remove('d-none');">
                    <span id="heroPlaceholder" class="text-white-50 d-none"><i class="bi bi-image fs-1"></i><br>Foto Produk Hannasa</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Produk Unggulan -->
<section class="py-5">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Produk Unggulan</h2>
            <p class="section-subtitle">Pilihan favorit pelanggan Hannasa</p>
        </div>
        <div class="row g-4">
            <?php if (count($produk_unggulan) > 0) : ?>
                <?php foreach ($produk_unggulan as $produk) : ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-hannasa">
                            <img src="<?php echo BASE_URL; ?>/<?php echo htmlspecialchars($produk['gambar']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/produk/placeholder.jpg'">
                            <div class="card-body">
                                <span class="badge badge-kategori mb-2"><?php echo htmlspecialchars($produk['nama_kategori']); ?></span>
                                <h5 class="card-title"><?php echo htmlspecialchars($produk['nama_produk']); ?></h5>
                                <p class="product-price mb-2">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                <a href="<?php echo BASE_URL; ?>/public/detail-produk.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-outline-caramel w-100">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12 text-center text-muted">Belum ada produk tersedia. Pastikan database sudah di-import.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Keunggulan Toko -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Kenapa Pilih Hannasa?</h2>
            <p class="section-subtitle">Kualitas dan kepuasan pelanggan adalah prioritas kami</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-egg-fried"></i></div>
                    <h5>Bahan Pilihan</h5>
                    <p class="text-muted mb-0">Menggunakan bahan baku berkualitas dan segar setiap hari.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-hand-thumbs-up"></i></div>
                    <h5>Resep Otentik</h5>
                    <p class="text-muted mb-0">Resep turun-temurun yang terjaga kualitasnya.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-truck"></i></div>
                    <h5>Pengiriman Cepat</h5>
                    <p class="text-muted mb-0">Pesanan dikemas rapi dan dikirim tepat waktu.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-emoji-smile"></i></div>
                    <h5>Pelayanan Ramah</h5>
                    <p class="text-muted mb-0">Tim kami siap membantu setiap pemesanan Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="cta-section text-center">
            <h2>Yuk, Pesan Bika Ambon &amp; Cake Hannasa Sekarang!</h2>
            <p class="mb-4">Daftar sebagai member untuk menikmati kemudahan belanja dan promo menarik.</p>
            <a href="<?php echo BASE_URL; ?>/auth/register.php" class="btn btn-gold btn-lg me-2">Daftar Sekarang</a>
            <a href="<?php echo BASE_URL; ?>/public/kontak.php" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
