<?php
/**
 * index.php (root)
 * Redirect otomatis ke halaman beranda di public/index.php
 * sehingga website bisa diakses langsung lewat http://localhost/nayla/
 */
require_once __DIR__ . '/config/koneksi.php';

header("Location: " . BASE_URL . "/public/index.php");
exit;
