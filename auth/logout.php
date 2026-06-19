<?php
/**
 * auth/logout.php
 * Menghapus session login (user maupun admin) lalu mengarahkan ke beranda.
 */
require_once __DIR__ . '/../config/koneksi.php';

session_unset();
session_destroy();

header("Location: " . BASE_URL . "/public/index.php");
exit;
