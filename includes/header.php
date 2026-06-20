<?php
/**
 * includes/header.php
 * Bagian <head> dan pembuka <body> untuk semua halaman.
 * Variabel $page_title bisa diisi di halaman sebelum include file ini.
 */
if (!isset($page_title)) {
    $page_title = "Bika Ambon & Cake Hannasa";
}
if (!defined('BASE_URL')) {
    define('BASE_URL', '/nayla');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> | Hannasa</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?php echo BASE_URL; ?>/assets/img/logo/logo.jpg">

    <!-- Google Fonts: Montserrat (heading) & Poppins (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS (lokal, lihat assets/vendor/bootstrap) -->
    <link href="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (lokal, lihat assets/vendor/bootstrap-icons) -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/vendor/bootstrap-icons/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
