<?php
/**
 * proses/proses-checkout.php
 * Memproses checkout: membuat pesanan, detail pesanan, mengurangi stok,
 * lalu mengosongkan keranjang. Menggunakan transaksi agar data tetap konsisten.
 */
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'user') {
    header("Location: " . BASE_URL . "/auth/login-user.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: " . BASE_URL . "/user/checkout.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$nama_penerima = trim($_POST['nama_penerima']);
$no_hp = trim($_POST['no_hp']);
$alamat_pengiriman = trim($_POST['alamat_pengiriman']);
$metode_pembayaran = trim($_POST['metode_pembayaran']);

if ($nama_penerima == '' || $no_hp == '' || $alamat_pengiriman == '' || $metode_pembayaran == '') {
    $_SESSION['msg_keranjang'] = "Semua data pengiriman wajib diisi.";
    header("Location: " . BASE_URL . "/user/checkout.php");
    exit;
}

// Ambil isi keranjang user beserta harga & stok terbaru dari tabel produk
$query = "SELECT k.id_produk, k.jumlah, p.nama_produk, p.harga, p.stok
          FROM keranjang k
          JOIN produk p ON k.id_produk = p.id_produk
          WHERE k.id_user = $id_user";
$result = mysqli_query($koneksi, $query);

$items = [];
$total_harga = 0;
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
        $total_harga += $row['harga'] * $row['jumlah'];
    }
}

if (count($items) == 0) {
    $_SESSION['msg_keranjang'] = "Keranjang kosong, tidak ada yang bisa di-checkout.";
    header("Location: " . BASE_URL . "/user/keranjang.php");
    exit;
}

// Pastikan stok masih cukup untuk semua item
foreach ($items as $item) {
    if ($item['jumlah'] > $item['stok']) {
        $_SESSION['msg_keranjang'] = "Stok produk \"" . $item['nama_produk'] . "\" tidak cukup.";
        header("Location: " . BASE_URL . "/user/keranjang.php");
        exit;
    }
}

// Buat kode pesanan otomatis, contoh: HNS-20260618-001
$tanggal_kode = date('Ymd');
$q_count = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesanan WHERE DATE(tanggal_pesanan) = CURDATE()");
$urutan = (mysqli_fetch_assoc($q_count)['total'] ?? 0) + 1;
$kode_pesanan = "HNS-" . $tanggal_kode . "-" . str_pad($urutan, 3, "0", STR_PAD_LEFT);

mysqli_begin_transaction($koneksi);

try {
    $insert_pesanan = mysqli_prepare($koneksi, "INSERT INTO pesanan (kode_pesanan, id_user, nama_penerima, no_hp, alamat_pengiriman, metode_pembayaran, total_harga, status_pesanan) VALUES (?, ?, ?, ?, ?, ?, ?, 'Menunggu Konfirmasi')");
    mysqli_stmt_bind_param($insert_pesanan, "sissssd", $kode_pesanan, $id_user, $nama_penerima, $no_hp, $alamat_pengiriman, $metode_pembayaran, $total_harga);
    if (!mysqli_stmt_execute($insert_pesanan)) {
        throw new Exception("Gagal membuat pesanan.");
    }
    $id_pesanan = mysqli_insert_id($koneksi);

    foreach ($items as $item) {
        $subtotal = $item['harga'] * $item['jumlah'];

        $insert_detail = mysqli_prepare($koneksi, "INSERT INTO detail_pesanan (id_pesanan, id_produk, nama_produk, harga, jumlah, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert_detail, "iisdid", $id_pesanan, $item['id_produk'], $item['nama_produk'], $item['harga'], $item['jumlah'], $subtotal);
        if (!mysqli_stmt_execute($insert_detail)) {
            throw new Exception("Gagal menyimpan detail pesanan.");
        }

        $update_stok = mysqli_prepare($koneksi, "UPDATE produk SET stok = stok - ? WHERE id_produk = ? AND stok >= ?");
        mysqli_stmt_bind_param($update_stok, "iii", $item['jumlah'], $item['id_produk'], $item['jumlah']);
        if (!mysqli_stmt_execute($update_stok) || mysqli_stmt_affected_rows($update_stok) == 0) {
            throw new Exception("Stok produk tidak cukup.");
        }
    }

    // Tandai produk yang stoknya jadi 0 sebagai 'habis'
    mysqli_query($koneksi, "UPDATE produk SET status = 'habis' WHERE stok <= 0");

    // Kosongkan keranjang user setelah checkout berhasil
    $delete_keranjang = mysqli_prepare($koneksi, "DELETE FROM keranjang WHERE id_user = ?");
    mysqli_stmt_bind_param($delete_keranjang, "i", $id_user);
    mysqli_stmt_execute($delete_keranjang);

    mysqli_commit($koneksi);

    $_SESSION['msg_pesanan'] = "Pesanan berhasil dibuat dengan kode $kode_pesanan.";
    header("Location: " . BASE_URL . "/user/pesanan.php");
    exit;

} catch (Exception $e) {
    mysqli_rollback($koneksi);
    $_SESSION['msg_keranjang'] = "Checkout gagal: " . $e->getMessage();
    header("Location: " . BASE_URL . "/user/checkout.php");
    exit;
}
