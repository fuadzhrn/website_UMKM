/* =========================================================
   Bika Ambon & Cake Hannasa - Custom Script
   ========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    // Toggle sidebar pada tampilan mobile (dashboard user/admin)
    var sidebarToggle = document.getElementById("sidebarToggle");
    var sidebar = document.querySelector(".sidebar-hannasa");

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener("click", function () {
            sidebar.classList.toggle("show");
        });
    }

    // Tutup alert otomatis setelah beberapa detik
    var autoAlerts = document.querySelectorAll(".alert-auto-close");
    autoAlerts.forEach(function (alert) {
        setTimeout(function () {
            alert.classList.remove("show");
            alert.classList.add("fade");
            setTimeout(function () {
                alert.remove();
            }, 500);
        }, 3000);
    });

    // Konfirmasi sebelum hapus data (produk, user, dll)
    var deleteButtons = document.querySelectorAll(".btn-delete-confirm");
    deleteButtons.forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            var pesan = btn.getAttribute("data-confirm") || "Apakah Anda yakin ingin menghapus data ini?";
            if (!confirm(pesan)) {
                e.preventDefault();
            }
        });
    });

    // Update otomatis subtotal di halaman keranjang ketika jumlah diubah
    var qtyInputs = document.querySelectorAll(".qty-input");
    qtyInputs.forEach(function (input) {
        input.addEventListener("change", function () {
            var harga = parseFloat(input.getAttribute("data-harga")) || 0;
            var jumlah = parseInt(input.value) || 1;
            var subtotalEl = document.getElementById("subtotal-" + input.getAttribute("data-id"));
            if (subtotalEl) {
                var subtotal = harga * jumlah;
                subtotalEl.textContent = "Rp " + subtotal.toLocaleString("id-ID");
            }
        });
    });

    // Preview gambar sebelum upload (form tambah/edit produk)
    var inputGambar = document.getElementById("gambar");
    var previewGambar = document.getElementById("previewGambar");
    if (inputGambar && previewGambar) {
        inputGambar.addEventListener("change", function () {
            var file = inputGambar.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    previewGambar.src = e.target.result;
                    previewGambar.classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Aktifkan menu navbar/sidebar sesuai halaman yang sedang dibuka
    var currentPage = window.location.pathname.split("/").pop();
    var navLinks = document.querySelectorAll(".navbar-hannasa .nav-link, .sidebar-hannasa .nav-link");
    navLinks.forEach(function (link) {
        var href = link.getAttribute("href");
        if (href && href.indexOf(currentPage) !== -1 && currentPage !== "") {
            link.classList.add("active");
        }
    });
});
