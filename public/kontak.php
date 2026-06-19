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
                        <li class="mb-3"><i class="bi bi-whatsapp me-2 text-success"></i> 0812-3456-7890</li>
                        <li class="mb-3"><i class="bi bi-envelope me-2 text-secondary"></i> info@hannasa.com</li>
                        <li class="mb-3"><i class="bi bi-geo-alt me-2 text-secondary"></i> Jl. Kue Manis No. 1, Medan, Sumatera Utara</li>
                        <li class="mb-3"><i class="bi bi-clock me-2 text-secondary"></i> Senin - Sabtu, 08.00 - 20.00 WIB</li>
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
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
