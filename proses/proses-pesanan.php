<?php
/**
 * proses/proses-pesanan.php
 * Memproses update status pesanan. Hanya admin yang boleh mengakses.
 */
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . "/auth/login-admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: " . BASE_URL . "/admin/pesanan.php");
    exit;
}

$id_pesanan = (int) $_POST['id_pesanan'];
$status_pesanan = $_POST['status_pesanan'];

$status_valid = ['Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
if (!in_array($status_pesanan, $status_valid)) {
    header("Location: " . BASE_URL . "/admin/detail-pesanan.php?id=" . $id_pesanan);
    exit;
}

$stmt = mysqli_prepare($koneksi, "UPDATE pesanan SET status_pesanan = ? WHERE id_pesanan = ?");
mysqli_stmt_bind_param($stmt, "si", $status_pesanan, $id_pesanan);
mysqli_stmt_execute($stmt);

$_SESSION['msg_pesanan_admin'] = "Status pesanan berhasil diperbarui menjadi \"$status_pesanan\".";
header("Location: " . BASE_URL . "/admin/detail-pesanan.php?id=" . $id_pesanan);
exit;
