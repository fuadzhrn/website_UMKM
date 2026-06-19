<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}

$page_title = "Kelola User";

// Ubah status user aktif/nonaktif langsung dari halaman ini
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aksi']) && $_POST['aksi'] == 'ubah_status') {
    $id_user_target = (int) $_POST['id_user'];
    $status_baru = $_POST['status_baru'] == 'aktif' ? 'aktif' : 'nonaktif';

    $stmt = mysqli_prepare($koneksi, "UPDATE users SET status = ? WHERE id_user = ? AND role = 'user'");
    mysqli_stmt_bind_param($stmt, "si", $status_baru, $id_user_target);
    mysqli_stmt_execute($stmt);

    $_SESSION['msg_user'] = "Status user berhasil diubah menjadi \"$status_baru\".";
    header("Location: " . BASE_URL . "/admin/user.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM users WHERE role = 'user' ORDER BY created_at DESC");

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-admin.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Kelola User</h5>
                <small class="text-muted">Daftar pelanggan yang terdaftar di Hannasa</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <?php if (isset($_SESSION['msg_user'])) : ?>
            <div class="alert alert-success alert-auto-close"><?php echo htmlspecialchars($_SESSION['msg_user']); ?></div>
            <?php unset($_SESSION['msg_user']); ?>
        <?php endif; ?>

        <div class="card-hannasa p-4">
            <div class="table-responsive">
                <table class="table table-hannasa align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0) : ?>
                            <?php while ($u = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($u['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                                    <td><?php echo htmlspecialchars($u['no_hp']); ?></td>
                                    <td><?php echo htmlspecialchars(mb_strimwidth($u['alamat'], 0, 40, '...')); ?></td>
                                    <td>
                                        <?php if ($u['status'] == 'aktif') : ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else : ?>
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('d M Y', strtotime($u['created_at'])); ?></td>
                                    <td>
                                        <form method="POST" action="">
                                            <input type="hidden" name="aksi" value="ubah_status">
                                            <input type="hidden" name="id_user" value="<?php echo $u['id_user']; ?>">
                                            <?php if ($u['status'] == 'aktif') : ?>
                                                <input type="hidden" name="status_baru" value="nonaktif">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Nonaktifkan</button>
                                            <?php else : ?>
                                                <input type="hidden" name="status_baru" value="aktif">
                                                <button type="submit" class="btn btn-sm btn-outline-success">Aktifkan</button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr><td colspan="7" class="text-center text-muted">Belum ada user terdaftar.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
