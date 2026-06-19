# Bika Ambon & Cake Hannasa

Website penjualan kue Bika Ambon & Cake Hannasa, dibangun dengan PHP Native, MySQL, dan Bootstrap 5.

## Teknologi

- PHP Native (mysqli, prepared statement)
- MySQL
- Bootstrap 5
- Google Fonts: Montserrat (heading) & Poppins (body)
- CSS kustom: `assets/css/style.css`
- JavaScript kustom: `assets/js/script.js`

## Cara Menjalankan (Laragon)

1. Pastikan project berada di `www/nayla` dan Laragon (Apache + MySQL) sudah running.
2. Buka `http://localhost/phpmyadmin`, lalu **Import** file `database/hannasa.sql` (otomatis membuat database `hannasa_db` beserta data dummy).
3. Akses website lewat browser:
   - `http://localhost/nayla/` (otomatis redirect ke beranda)
   - atau langsung `http://localhost/nayla/public/index.php`

> Seluruh link internal menggunakan konstanta `BASE_URL` (didefinisikan di `config/koneksi.php` sebagai `/nayla`). Jika folder project diganti nama atau dipindah, cukup ubah nilai `BASE_URL` di `config/koneksi.php`.

## Akun Dummy

| Role  | Email             | Password  |
|-------|-------------------|-----------|
| Admin | admin@hannasa.com | admin123  |
| User  | siti@gmail.com    | user123   |
| User  | budi@gmail.com    | user123   |

## Struktur Folder

```
nayla/
├── assets/            # CSS, JS, gambar (produk/banner/logo/icon), vendor
├── config/            # koneksi.php (koneksi database + BASE_URL)
├── public/            # Halaman umum (beranda, produk, detail, tentang, kontak)
├── auth/               # Login user, register, login admin, logout
├── user/               # Dashboard pelanggan
├── admin/              # Dashboard admin
├── proses/             # Handler form (login, register, keranjang, checkout, produk, pesanan)
├── includes/           # header, navbar, footer, sidebar-user, sidebar-admin
├── database/           # hannasa.sql
├── laporan/            # Laporan markdown
└── index.php           # Redirect ke public/index.php
```

## Catatan Gambar

Folder `assets/img/produk/`, `assets/img/banner/`, `assets/img/logo/`, `assets/img/icon/` sudah disiapkan tapi masih kosong. Path gambar di database mengikuti pola:

- `assets/img/produk/bika-original.jpg`
- `assets/img/produk/bika-pandan.jpg`
- `assets/img/produk/bika-keju.jpg`
- `assets/img/produk/cake-coklat.jpg`
- `assets/img/produk/cake-keju.jpg`
- `assets/img/produk/hampers.jpg`

Silakan masukkan gambar secara manual ke folder tersebut dengan nama file yang sama. Admin juga bisa mengunggah gambar produk baru langsung lewat halaman **Tambah Produk** / **Edit Produk**, yang otomatis tersimpan ke `assets/img/produk/`.

## Fitur Utama

**Pengunjung**: beranda, daftar produk, detail produk, tentang, kontak, login/register user, login admin.

**Pelanggan (setelah login)**: dashboard, lihat produk, tambah ke keranjang, kelola keranjang, checkout, riwayat pesanan, edit profil.

**Admin (setelah login)**: dashboard statistik, CRUD produk (dengan upload gambar), kelola & filter pesanan beserta update status, kelola status user (aktif/nonaktif).
