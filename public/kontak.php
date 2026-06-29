<?php
$page_title = "Kontak";
$pesan_sukses = "";

// Proses sederhana form kontak (tanpa simpan ke database)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pesan = trim($_POST['pesan'] ?? '');

    if ($nama != '' && $email != '' && $pesan != '') {
        $pesan_sukses = "Terima kasih, $nama. Pesan Anda sudah kami terima dan akan segera kami balas.";
    }
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="page-banner">
    <div class="container">
        <h1>Kontak Kami</h1>
        <p class="mb-0">Kami siap membantu pertanyaan dan pemesanan Anda</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card-hannasa p-4 h-100">
                    <h5 class="mb-3">Informasi Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-whatsapp me-2 text-success"></i> 0812-6424-7270</li>
                        <li class="mb-3"><i class="bi bi-envelope me-2 text-secondary"></i> info@hannasa.com</li>
                        <li class="mb-3"><i class="bi bi-geo-alt me-2 text-secondary"></i> Jl. Pandawa Desa karang Rejo Psr 2, Stabat, Sumatera Utara, Indonesia</li>
                        <li class="mb-3"><i class="bi bi-clock me-2 text-secondary"></i> Senin - Minggu, 08.00 - 20.00 WIB</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-hannasa p-4">
                    <h5 class="mb-3">Kirim Pesan</h5>

                    <?php if ($pesan_sukses) : ?>
                        <div class="alert alert-success alert-auto-close"><?php echo htmlspecialchars($pesan_sukses); ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@anda.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="4" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-caramel">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Peta Lokasi -->
        <div class="row mt-5">
            <div class="col-12">
                <h5 class="mb-3"><i class="bi bi-geo-alt-fill me-2" style="color:var(--color-caramel);"></i>Lokasi Kami</h5>
                <div class="card-hannasa p-0 overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.4574725593243!2d98.50438!3d3.7098991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3036d512c8febed1%3A0xcb864a9b53ac070!2sHannasa%20Bika%20Ambon%20%26%20Cake!5e0!3m2!1sid!2sid!4v1782704436015!5m2!1sid!2sid"
                        width="100%"
                        height="420"
                        style="border:0; display:block;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                        title="Lokasi Hannasa Bika Ambon & Cake">
                    </iframe>
                </div>
                <p class="text-muted mt-2 small"><i class="bi bi-info-circle me-1"></i>Jl. Pandawa Desa Karang Rejo Psr 2, Stabat, Sumatera Utara, Indonesia</p>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
