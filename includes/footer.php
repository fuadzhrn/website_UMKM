<?php
/**
 * includes/footer.php
 * Footer untuk halaman umum + penutup body/html.
 */
if (!defined('BASE_URL')) {
    define('BASE_URL', '/nayla');
}
?>
    <footer class="footer-hannasa">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <h5>Hannasa</h5>
                    <p>Toko kue khas Bika Ambon &amp; Cake Hannasa. Dibuat dengan bahan pilihan dan resep terbaik untuk momen spesial Anda.</p>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>/public/index.php">Beranda</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>/public/produk.php">Produk</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>/public/tentang.php">Tentang Kami</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>/public/kontak.php">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3">
                    <h5>Akun</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>/auth/login-user.php">Login User</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>/auth/register.php">Register</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>/auth/login-admin.php">Login Admin</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-whatsapp me-2"></i>0812-3456-7890</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>info@hannasa.com</li>
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Jl. Kue Manis No. 1, Medan</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center footer-bottom">
                &copy; <?php echo date('Y'); ?> Bika Ambon &amp; Cake Hannasa. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
