<?php
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$page_title = "Profil Saya";
$pesan_sukses = "";
$pesan_error = "";

// Proses update profil (form mengirim ke halaman ini sendiri)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $no_hp = trim($_POST['no_hp']);
    $alamat = trim($_POST['alamat']);
    $password_baru = trim($_POST['password_baru']);

    if ($nama == '' || $email == '' || $no_hp == '' || $alamat == '') {
        $pesan_error = "Nama, Email, No. HP, dan Alamat wajib diisi.";
    } else {
        if ($password_baru != '') {
            // Update termasuk password baru
            $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($koneksi, "UPDATE users SET nama = ?, email = ?, no_hp = ?, alamat = ?, password = ? WHERE id_user = ?");
            mysqli_stmt_bind_param($stmt, "sssssi", $nama, $email, $no_hp, $alamat, $password_hash, $id_user);
        } else {
            // Update tanpa mengubah password
            $stmt = mysqli_prepare($koneksi, "UPDATE users SET nama = ?, email = ?, no_hp = ?, alamat = ? WHERE id_user = ?");
            mysqli_stmt_bind_param($stmt, "ssssi", $nama, $email, $no_hp, $alamat, $id_user);
        }

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['nama'] = $nama;
            $_SESSION['email'] = $email;
            $pesan_sukses = "Profil berhasil diperbarui.";
        } else {
            $pesan_error = "Gagal memperbarui profil. Email mungkin sudah digunakan.";
        }
    }
}

$q_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = $id_user");
$data_user = mysqli_fetch_assoc($q_user);

include __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-wrapper">
    <?php include __DIR__ . '/../includes/sidebar-user.php'; ?>

    <div class="main-content">
        <div class="topbar-hannasa">
            <div>
                <h5 class="mb-0">Profil Saya</h5>
                <small class="text-muted">Lihat dan ubah data diri Anda</small>
            </div>
            <button class="btn btn-outline-caramel d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
        </div>

        <?php if ($pesan_sukses) : ?>
            <div class="alert alert-success alert-auto-close"><?php echo htmlspecialchars($pesan_sukses); ?></div>
        <?php endif; ?>
        <?php if ($pesan_error) : ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($pesan_error); ?></div>
        <?php endif; ?>

        <div class="card-hannasa p-4" style="max-width:600px;">
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($data_user['nama']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($data_user['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?php echo htmlspecialchars($data_user['no_hp']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required><?php echo htmlspecialchars($data_user['alamat']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password_baru" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>
                <button type="submit" class="btn btn-caramel">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
