<?php
/**
 * proses/proses-produk.php
 * Memproses tambah, edit, dan hapus produk (khusus admin).
 */
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}

$aksi = $_POST['aksi'] ?? '';

/**
 * Fungsi sederhana untuk meng-upload gambar produk.
 * Mengembalikan path relatif gambar (contoh: assets/img/produk/167xxx.jpg)
 * atau null jika tidak ada file yang di-upload.
 */
function upload_gambar_produk($file)
{
    if (!isset($file['error']) || $file['error'] == UPLOAD_ERR_NO_FILE) {
        return null;
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $ekstensi_diizinkan = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensi = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ekstensi, $ekstensi_diizinkan)) {
        return false;
    }

    $nama_file = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
    $tujuan = __DIR__ . '/../assets/img/produk/' . $nama_file;

    if (move_uploaded_file($file['tmp_name'], $tujuan)) {
        return 'assets/img/produk/' . $nama_file;
    }
    return false;
}

if ($aksi == 'tambah') {
    $nama_produk = trim($_POST['nama_produk']);
    $id_kategori = (int) $_POST['id_kategori'];
    $harga = (float) $_POST['harga'];
    $stok = (int) $_POST['stok'];
    $status = $_POST['status'];
    $deskripsi = trim($_POST['deskripsi']);

    if ($nama_produk == '' || $id_kategori == 0) {
        $_SESSION['error_produk'] = "Nama produk dan kategori wajib diisi.";
        header("Location: " . BASE_URL . "/admin/tambah-produk.php");
        exit;
    }

    $gambar = upload_gambar_produk($_FILES['gambar']);
    if ($gambar === false) {
        $_SESSION['error_produk'] = "Gagal mengupload gambar. Pastikan format jpg/jpeg/png/webp.";
        header("Location: " . BASE_URL . "/admin/tambah-produk.php");
        exit;
    }
    if ($gambar === null) {
        $gambar = 'assets/img/produk/placeholder.jpg';
    }

    $stmt = mysqli_prepare($koneksi, "INSERT INTO produk (id_kategori, nama_produk, harga, stok, gambar, deskripsi, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isdisss", $id_kategori, $nama_produk, $harga, $stok, $gambar, $deskripsi, $status);
    mysqli_stmt_execute($stmt);

    $_SESSION['msg_produk'] = "Produk berhasil ditambahkan.";
    header("Location: " . BASE_URL . "/admin/produk.php");
    exit;

} elseif ($aksi == 'edit') {
    $id_produk = (int) $_POST['id_produk'];
    $nama_produk = trim($_POST['nama_produk']);
    $id_kategori = (int) $_POST['id_kategori'];
    $harga = (float) $_POST['harga'];
    $stok = (int) $_POST['stok'];
    $status = $_POST['status'];
    $deskripsi = trim($_POST['deskripsi']);
    $gambar_lama = $_POST['gambar_lama'];

    if ($nama_produk == '' || $id_kategori == 0) {
        $_SESSION['error_produk'] = "Nama produk dan kategori wajib diisi.";
        header("Location: " . BASE_URL . "/admin/edit-produk.php?id=" . $id_produk);
        exit;
    }

    $gambar_baru = upload_gambar_produk($_FILES['gambar']);
    if ($gambar_baru === false) {
        $_SESSION['error_produk'] = "Gagal mengupload gambar baru. Pastikan format jpg/jpeg/png/webp.";
        header("Location: " . BASE_URL . "/admin/edit-produk.php?id=" . $id_produk);
        exit;
    }
    $gambar = $gambar_baru ?? $gambar_lama;

    $stmt = mysqli_prepare($koneksi, "UPDATE produk SET id_kategori = ?, nama_produk = ?, harga = ?, stok = ?, gambar = ?, deskripsi = ?, status = ? WHERE id_produk = ?");
    mysqli_stmt_bind_param($stmt, "isdisssi", $id_kategori, $nama_produk, $harga, $stok, $gambar, $deskripsi, $status, $id_produk);
    mysqli_stmt_execute($stmt);

    $_SESSION['msg_produk'] = "Produk berhasil diperbarui.";
    header("Location: " . BASE_URL . "/admin/produk.php");
    exit;

} elseif ($aksi == 'hapus') {
    $id_produk = (int) $_POST['id_produk'];

    $stmt = mysqli_prepare($koneksi, "DELETE FROM produk WHERE id_produk = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_produk);
    mysqli_stmt_execute($stmt);

    $_SESSION['msg_produk'] = "Produk berhasil dihapus.";
    header("Location: " . BASE_URL . "/admin/produk.php");
    exit;

} else {
    header("Location: " . BASE_URL . "/admin/produk.php");
    exit;
}
