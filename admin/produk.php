<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}

$page_title = "Kelola Produk";

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$keyword_aman = mysqli_real_escape_string($koneksi, $keyword);

$query = "SELECT p.*, k.nama_kategori FROM produk p
          LEFT JOIN kategori k ON p.id_kategori = k.id_kategori";
if ($keyword_aman != '') {
    $query .= " WHERE p.nama_produk LIKE '%$keyword_aman%'";
}
$query .= " ORDER BY p.id_produk DESC";

$result = mysqli_query($koneksi, $query);

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-admin.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Kelola Produk</h5>
                <small class="text-muted">Daftar seluruh produk Hannasa</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <?php if (isset($_SESSION['msg_produk'])) : ?>
            <div class="alert alert-success alert-auto-close"><?php echo htmlspecialchars($_SESSION['msg_produk']); ?></div>
            <?php unset($_SESSION['msg_produk']); ?>
        <?php endif; ?>

        <div class="card-hannasa p-4">
            <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
                <form method="GET" action="" class="d-flex gap-2">
                    <input type="text" name="cari" class="form-control" placeholder="Cari nama produk..." value="<?php echo htmlspecialchars($keyword); ?>">
                    <button type="submit" class="btn btn-outline-caramel"><i class="bi bi-search"></i></button>
                </form>
                <a href="<?php echo BASE_URL; ?>/admin/tambah-produk.php" class="btn btn-caramel">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Produk
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hannasa align-middle">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0) : ?>
                            <?php while ($produk = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><img src="<?php echo BASE_URL; ?>/<?php echo htmlspecialchars($produk['gambar']); ?>" alt="" style="width:60px;height:60px;object-fit:cover;border-radius:8px;" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/produk/placeholder.jpg'"></td>
                                    <td><?php echo htmlspecialchars($produk['nama_produk']); ?></td>
                                    <td><?php echo htmlspecialchars($produk['nama_kategori'] ?? '-'); ?></td>
                                    <td>Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo (int) $produk['stok']; ?></td>
                                    <td>
                                        <?php if ($produk['status'] == 'tersedia') : ?>
                                            <span class="badge bg-success">Tersedia</span>
                                        <?php else : ?>
                                            <span class="badge bg-secondary">Habis</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="<?php echo BASE_URL; ?>/admin/edit-produk.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-sm btn-outline-caramel"><i class="bi bi-pencil-square"></i></a>
                                            <form method="POST" action="<?php echo BASE_URL; ?>/proses/proses-produk.php">
                                                <input type="hidden" name="id_produk" value="<?php echo $produk['id_produk']; ?>">
                                                <input type="hidden" name="aksi" value="hapus">
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-delete-confirm" data-confirm="Hapus produk &quot;<?php echo htmlspecialchars($produk['nama_produk']); ?>&quot;?">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr><td colspan="7" class="text-center text-muted">Produk tidak ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
