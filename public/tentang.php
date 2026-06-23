<?php
$page_title = "Tentang Kami";
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="page-banner">
    <div class="container">
        <h1>Tentang Hannasa</h1>
        <p class="mb-0">Mengenal lebih dekat toko Bika Ambon &amp; Cake Hannasa</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center gy-4 mb-5">
            <div class="col-lg-6">
                <div class="hero-img-wrapper" style="background-color:#f1e3d6; border-color:#c9a876;">
                    <img src="<?php echo BASE_URL; ?>/assets/img/banner/hero.jpg" alt="Foto Toko Hannasa" class="hero-img" onerror="this.remove(); document.getElementById('tokoPlaceholder').classList.remove('d-none');">
                    <span id="tokoPlaceholder" class="text-secondary d-none"><i class="bi bi-shop fs-1"></i><br>Foto Toko Hannasa</span>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Cerita Kami</h2>
                <p>Bika Ambon &amp; Cake Hannasa berawal dari kecintaan terhadap kue tradisional. Sejak awal berdiri, kami berkomitmen menghadirkan Bika Ambon dan Cake dengan rasa autentik, tekstur lembut, dan kualitas terbaik untuk setiap pelanggan.</p>
                <p>Setiap produk dibuat menggunakan bahan baku pilihan, diolah dengan proses higienis, dan melalui resep yang telah disempurnakan agar menghasilkan cita rasa khas yang konsisten di setiap pesanan.</p>
            </div>
        </div>

        <div class="text-center mb-4">
            <h2 class="section-title">Keunggulan Kami</h2>
            <p class="section-subtitle">Komitmen kami untuk memberikan yang terbaik</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-flower1"></i></div>
                    <h5>Bahan Berkualitas</h5>
                    <p class="text-muted mb-0">Menggunakan telur, gula, santan, dan tepung pilihan yang segar untuk menghasilkan rasa terbaik.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-gear"></i></div>
                    <h5>Proses Pembuatan Higienis</h5>
                    <p class="text-muted mb-0">Setiap kue dibuat dengan standar kebersihan tinggi dan diawasi langsung oleh tim dapur berpengalaman.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-headset"></i></div>
                    <h5>Layanan Pemesanan Mudah</h5>
                    <p class="text-muted mb-0">Pesan secara online melalui website, proses cepat, dan pengiriman tepat waktu ke alamat Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
