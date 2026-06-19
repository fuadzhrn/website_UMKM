<?php
/**
 * proses/proses-keranjang.php
 * Memproses tambah, update jumlah, dan hapus item keranjang.
 */
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$aksi = $_POST['aksi'] ?? '';

if ($aksi == 'tambah') {
    $id_produk = (int) $_POST['id_produk'];
    $jumlah = (int) $_POST['jumlah'];
    if ($jumlah < 1) {
        $jumlah = 1;
    }

    // Cek stok produk
    $q_produk = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id_produk = $id_produk AND status = 'tersedia'");
    $produk = $q_produk ? mysqli_fetch_assoc($q_produk) : null;

    if (!$produk || $produk['stok'] < 1) {
        $_SESSION['msg_keranjang'] = "Produk tidak tersedia atau stok habis.";
        header("Location: " . BASE_URL . "/user/produk.php");
        exit;
    }

    // Cek apakah produk sudah ada di keranjang user
    $stmt = mysqli_prepare($koneksi, "SELECT id_keranjang, jumlah FROM keranjang WHERE id_user = ? AND id_produk = ?");
    mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_produk);
    mysqli_stmt_execute($stmt);
    $existing = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($existing) {
        $jumlah_baru = min($existing['jumlah'] + $jumlah, $produk['stok']);
        $update = mysqli_prepare($koneksi, "UPDATE keranjang SET jumlah = ? WHERE id_keranjang = ?");
        mysqli_stmt_bind_param($update, "ii", $jumlah_baru, $existing['id_keranjang']);
        mysqli_stmt_execute($update);
    } else {
        $jumlah = min($jumlah, $produk['stok']);
        $insert = mysqli_prepare($koneksi, "INSERT INTO keranjang (id_user, id_produk, jumlah) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($insert, "iii", $id_user, $id_produk, $jumlah);
        mysqli_stmt_execute($insert);
    }

    $_SESSION['msg_keranjang'] = "Produk berhasil ditambahkan ke keranjang.";
    header("Location: " . BASE_URL . "/user/keranjang.php");
    exit;

} elseif ($aksi == 'update') {
    $id_keranjang = (int) $_POST['id_keranjang'];
    $jumlah = (int) $_POST['jumlah'];
    if ($jumlah < 1) {
        $jumlah = 1;
    }

    // Pastikan item keranjang ini memang milik user yang login
    $stmt = mysqli_prepare($koneksi, "UPDATE keranjang SET jumlah = ? WHERE id_keranjang = ? AND id_user = ?");
    mysqli_stmt_bind_param($stmt, "iii", $jumlah, $id_keranjang, $id_user);
    mysqli_stmt_execute($stmt);

    $_SESSION['msg_keranjang'] = "Jumlah produk berhasil diperbarui.";
    header("Location: " . BASE_URL . "/user/keranjang.php");
    exit;

} elseif ($aksi == 'hapus') {
    $id_keranjang = (int) $_POST['id_keranjang'];

    $stmt = mysqli_prepare($koneksi, "DELETE FROM keranjang WHERE id_keranjang = ? AND id_user = ?");
    mysqli_stmt_bind_param($stmt, "ii", $id_keranjang, $id_user);
    mysqli_stmt_execute($stmt);

    $_SESSION['msg_keranjang'] = "Produk berhasil dihapus dari keranjang.";
    header("Location: " . BASE_URL . "/user/keranjang.php");
    exit;

} else {
    header("Location: " . BASE_URL . "/user/keranjang.php");
    exit;
}
