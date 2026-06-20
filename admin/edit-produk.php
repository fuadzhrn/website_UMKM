<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}

$id_produk = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$q_produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = $id_produk");
$produk = $q_produk ? mysqli_fetch_assoc($q_produk) : null;

if (!$produk) {
    header("Location: " . BASE_URL . "/admin/produk.php");
    exit;
}

$page_title = "Edit Produk";
$error = $_SESSION['error_produk'] ?? '';
unset($_SESSION['error_produk']);

$daftar_kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-admin.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Edit Produk</h5>
                <small class="text-muted">Ubah data produk "<?php echo htmlspecialchars($produk['nama_produk']); ?>"</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <?php if ($error) : ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="card-hannasa p-4" style="max-width:700px;">
            <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-produk.php" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="edit">
                <input type="hidden" name="id_produk" value="<?php echo $produk['id_produk']; ?>">
                <input type="hidden" name="gambar_lama" value="<?php echo htmlspecialchars($produk['gambar']); ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" value="<?php echo htmlspecialchars($produk['nama_produk']); ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while ($kat = mysqli_fetch_assoc($daftar_kategori)) : ?>
                                <option value="<?php echo $kat['id_kategori']; ?>" <?php echo $kat['id_kategori'] == $produk['id_kategori'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($kat['nama_kategori']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="tersedia" <?php echo $produk['status'] == 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                            <option value="habis" <?php echo $produk['status'] == 'habis' ? 'selected' : ''; ?>>Habis</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" value="<?php echo $produk['harga']; ?>" min="0" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?php echo $produk['stok']; ?>" min="0" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="<?php echo BASE_URL; ?>/<?php echo htmlspecialchars($produk['gambar']); ?>" style="width:120px;height:120px;object-fit:cover;border-radius:8px;" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/produk/placeholder.jpg'">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Gambar (opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                    <img id="previewGambar" src="" class="d-none mt-2 rounded" style="max-width:160px;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-caramel">Simpan Perubahan</button>
                <a href="<?php echo BASE_URL; ?>/admin/produk.php" class="btn btn-outline-caramel">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
