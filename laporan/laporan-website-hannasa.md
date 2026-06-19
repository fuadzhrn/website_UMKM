# PERANCANGAN WEBSITE PENJUALAN BIKA AMBON & CAKE HANNASA BERBASIS WEB

---

## BAB I PENDAHULUAN

### 1.1 Latar Belakang

Perkembangan teknologi informasi yang semakin pesat telah membawa perubahan besar dalam berbagai sektor kehidupan, termasuk sektor perdagangan dan usaha mikro, kecil, dan menengah (UMKM). Kehadiran internet memungkinkan pelaku usaha untuk memasarkan produknya secara lebih luas tanpa dibatasi oleh waktu dan tempat. Salah satu bentuk pemanfaatan teknologi informasi tersebut adalah pembuatan website sebagai media penjualan online.

Bika Ambon & Cake Hannasa merupakan usaha yang bergerak di bidang kuliner, khususnya penjualan kue khas Bika Ambon dan berbagai jenis Cake. Selama ini proses pemasaran dan pemesanan produk masih dilakukan secara konvensional, seperti melalui komunikasi langsung atau pesan pribadi, sehingga proses pencatatan pesanan, pengelolaan stok produk, dan pemantauan data pelanggan menjadi kurang efisien. Oleh karena itu, dibutuhkan sebuah website yang dapat menampilkan katalog produk secara menarik, memudahkan pelanggan dalam melakukan pemesanan, serta membantu pihak admin dalam mengelola data produk, pesanan, dan pelanggan secara terstruktur.

Berdasarkan permasalahan tersebut, dirancanglah sebuah website penjualan berbasis PHP Native dan MySQL dengan tampilan modern menggunakan Bootstrap 5, yang diberi nama "Bika Ambon & Cake Hannasa". Website ini diharapkan dapat menjadi solusi digital bagi toko dalam menjalankan proses bisnis penjualan secara online.

### 1.2 Tujuan

Tujuan dari pembuatan website Bika Ambon & Cake Hannasa adalah sebagai berikut:

a. Membuat media penjualan berbasis web yang dapat diakses oleh pelanggan kapan saja dan di mana saja.

b. Memudahkan pelanggan dalam melihat informasi produk, melakukan pemesanan, dan memantau status pesanan secara online.

c. Membantu admin dalam mengelola data produk, data pesanan, dan data pengguna (user) secara lebih efisien melalui dashboard administrasi.

d. Meningkatkan jangkauan pemasaran toko Bika Ambon & Cake Hannasa agar tidak hanya dikenal secara lokal, tetapi juga dapat menjangkau pelanggan yang lebih luas melalui media digital.

### 1.3 Manfaat

Manfaat dari pembuatan website ini dapat dirasakan oleh beberapa pihak, antara lain:

**Bagi Pemilik Toko**, website ini membantu mempermudah proses pemasaran produk, pengelolaan stok, serta pemantauan transaksi penjualan secara digital dan terdokumentasi dengan baik.

**Bagi Pelanggan**, website ini memberikan kemudahan dalam melihat katalog produk, melakukan pemesanan tanpa harus datang langsung ke toko, serta memantau status pesanan secara mandiri melalui akun yang telah didaftarkan.

**Bagi Akademisi**, hasil perancangan website ini dapat dijadikan sebagai referensi maupun studi kasus dalam pembelajaran pengembangan sistem informasi penjualan berbasis web, khususnya yang menggunakan PHP Native dan MySQL.

---

## BAB II LANDASAN TEORI

### 2.1 Website

Website merupakan kumpulan halaman yang berisi informasi dalam bentuk teks, gambar, maupun multimedia lainnya yang dapat diakses melalui jaringan internet menggunakan peramban (browser). Website dapat bersifat statis maupun dinamis. Website statis memiliki konten yang tetap dan tidak berubah kecuali diubah langsung pada kode sumbernya, sedangkan website dinamis memiliki konten yang dapat berubah secara otomatis sesuai dengan data yang tersimpan pada basis data. Website Bika Ambon & Cake Hannasa termasuk ke dalam kategori website dinamis karena konten produk, pesanan, dan data pengguna dapat berubah sesuai dengan data yang tersimpan di dalam database.

### 2.2 Database

Database atau basis data adalah kumpulan data yang terorganisir dan saling berhubungan, yang disimpan secara terstruktur sehingga dapat diakses, dikelola, dan diperbarui dengan mudah. Dalam website Bika Ambon & Cake Hannasa, database digunakan untuk menyimpan data produk, data kategori produk, data pengguna (admin dan pelanggan), data keranjang belanja, data pesanan, serta data detail pesanan. Sistem manajemen basis data yang digunakan adalah MySQL, yang merupakan salah satu Relational Database Management System (RDBMS) open source yang paling banyak digunakan dalam pengembangan website.

### 2.3 Sistem Informasi

Sistem informasi merupakan suatu kumpulan komponen yang saling bekerja sama untuk mengumpulkan, mengolah, menyimpan, dan menyebarkan informasi guna mendukung pengambilan keputusan dan proses bisnis suatu organisasi. Pada website ini, sistem informasi diterapkan dalam bentuk pengelolaan data penjualan, mulai dari proses pemilihan produk oleh pelanggan, proses checkout, hingga pengelolaan status pesanan oleh admin. Dengan adanya sistem informasi yang terintegrasi, proses bisnis penjualan dapat berjalan lebih efisien dan terdokumentasi dengan baik.

### 2.4 PHP

PHP (Hypertext Preprocessor) merupakan bahasa pemrograman berbasis server (server-side scripting) yang digunakan untuk membangun website dinamis. PHP memungkinkan halaman website untuk berinteraksi dengan database, memproses data dari pengguna melalui form, serta menghasilkan output HTML secara dinamis. Pada website Bika Ambon & Cake Hannasa, PHP digunakan secara native (tanpa framework) untuk membangun seluruh logika aplikasi, mulai dari autentikasi pengguna, pengelolaan produk, proses keranjang belanja, hingga proses checkout dan pengelolaan pesanan.

### 2.5 Bootstrap

Bootstrap merupakan framework front-end berbasis HTML, CSS, dan JavaScript yang digunakan untuk mempercepat proses pembuatan tampilan website yang responsif dan konsisten di berbagai ukuran perangkat, baik desktop, tablet, maupun smartphone. Bootstrap menyediakan berbagai komponen siap pakai seperti navbar, card, modal, tabel, dan form yang dapat disesuaikan dengan tema warna tertentu. Pada website ini, Bootstrap 5 digunakan sebagai dasar tampilan, kemudian disesuaikan dengan tema warna khas toko, yaitu cream, coklat caramel, gold, putih, dan coklat tua, melalui file CSS kustom (assets/css/style.css).

---

## BAB III HASIL DAN PEMBAHASAN

Pada bab ini akan dijelaskan hasil implementasi dari setiap halaman yang terdapat pada website Bika Ambon & Cake Hannasa.

### 3.1 Halaman Utama

Halaman utama merupakan halaman pertama yang ditampilkan ketika pengunjung mengakses website. Halaman ini menampilkan bagian hero section berisi judul "Bika Ambon & Cake Hannasa", subjudul promosi, serta tombol untuk menuju halaman produk. Selain itu, halaman utama juga menampilkan beberapa produk unggulan, keunggulan toko, dan bagian call to action untuk mengarahkan pengunjung melakukan pemesanan.

[Gambar 3.1 Halaman Utama]

### 3.2 Halaman Produk

Halaman produk menampilkan seluruh daftar produk yang tersedia dalam bentuk card Bootstrap, lengkap dengan gambar, nama produk, kategori, harga, dan tombol untuk melihat detail produk. Data produk diambil secara langsung dari database melalui koneksi PHP, sehingga setiap perubahan data produk oleh admin akan langsung terlihat pada halaman ini.

[Gambar 3.2 Halaman Produk]

### 3.3 Halaman Detail Produk

Halaman detail produk menampilkan informasi lengkap mengenai satu produk tertentu, meliputi gambar, nama produk, harga, stok, kategori, status ketersediaan, dan deskripsi produk. Pada halaman ini juga terdapat tombol "Login untuk Beli" yang mengarahkan pengunjung untuk melakukan login terlebih dahulu sebelum dapat melakukan pemesanan.

[Gambar 3.3 Halaman Detail Produk]

### 3.4 Halaman Tentang

Halaman tentang berisi informasi mengenai profil toko Bika Ambon & Cake Hannasa, termasuk penjelasan mengenai kualitas bahan baku, proses pembuatan, dan layanan pemesanan yang ditawarkan. Halaman ini disajikan menggunakan card Bootstrap agar informasi lebih mudah dibaca dan terlihat menarik.

[Gambar 3.4 Halaman Tentang]

### 3.5 Halaman Kontak

Halaman kontak menampilkan informasi kontak toko seperti nomor WhatsApp, email, alamat, dan jam operasional. Selain itu, terdapat pula form kontak sederhana yang dapat digunakan pengunjung untuk mengirimkan pertanyaan atau pesan kepada pihak toko.

[Gambar 3.5 Halaman Kontak]

### 3.6 Halaman Login User

Halaman login user digunakan oleh pelanggan yang telah memiliki akun untuk masuk ke dalam sistem. Proses autentikasi dilakukan dengan mencocokkan email dan password yang dimasukkan dengan data yang tersimpan di database menggunakan fungsi password_verify(), sehingga keamanan password pengguna tetap terjaga.

[Gambar 3.6 Halaman Login User]

### 3.7 Halaman Register User

Halaman register digunakan oleh pengunjung baru untuk mendaftarkan diri sebagai pelanggan. Data yang diminta meliputi nama, email, password, nomor telepon, dan alamat. Password yang dimasukkan pengguna akan disimpan dalam bentuk hash menggunakan fungsi password_hash(), bukan dalam bentuk teks biasa, sehingga keamanan data pengguna lebih terjamin.

[Gambar 3.7 Halaman Register User]

### 3.8 Dashboard Pelanggan

Dashboard pelanggan merupakan halaman utama yang ditampilkan setelah pelanggan berhasil login. Halaman ini menampilkan ucapan selamat datang beserta nama pelanggan, ringkasan jumlah item di keranjang, jumlah pesanan berdasarkan status (Menunggu Konfirmasi, Diproses, Dikirim, dan Selesai), serta tabel pesanan terbaru milik pelanggan tersebut.

[Gambar 3.8 Dashboard Pelanggan]

### 3.9 Halaman Produk Pelanggan

Halaman ini menampilkan seluruh produk yang dapat dipesan oleh pelanggan, lengkap dengan tombol "Tambah ke Keranjang". Produk yang stoknya habis atau berstatus "habis" tidak dapat ditambahkan ke keranjang, sehingga mencegah pelanggan memesan produk yang tidak tersedia.

[Gambar 3.9 Halaman Produk Pelanggan]

### 3.10 Halaman Keranjang

Halaman keranjang menampilkan seluruh produk yang telah ditambahkan oleh pelanggan, termasuk gambar produk, harga, jumlah, dan subtotal. Pelanggan dapat mengubah jumlah produk maupun menghapus produk dari keranjang. Total belanja akan dihitung secara otomatis, dan pelanggan dapat melanjutkan ke halaman checkout apabila keranjang tidak kosong.

[Gambar 3.10 Halaman Keranjang]

### 3.11 Halaman Checkout

Halaman checkout menampilkan ringkasan produk yang akan dipesan beserta form data pengiriman, meliputi nama penerima, nomor HP, alamat pengiriman, dan metode pembayaran (Transfer Bank, COD, atau E-Wallet). Setelah data diisi, sistem akan membuat data pesanan baru secara otomatis menggunakan mekanisme transaksi database agar data tetap konsisten.

[Gambar 3.11 Halaman Checkout]

### 3.12 Halaman Pesanan Saya

Halaman ini menampilkan seluruh riwayat pesanan milik pelanggan yang sedang login, lengkap dengan kode pesanan, tanggal, total harga, metode pembayaran, dan status pesanan yang ditampilkan menggunakan badge Bootstrap. Pelanggan dapat melihat detail pesanan melalui modal yang menampilkan daftar produk, jumlah, harga, dan subtotal.

[Gambar 3.12 Halaman Pesanan Saya]

### 3.13 Halaman Profil

Halaman profil menampilkan data diri pelanggan yang tersimpan di database, seperti nama, email, nomor HP, dan alamat. Pelanggan dapat memperbarui data tersebut melalui form edit profil, termasuk mengganti password apabila diperlukan.

[Gambar 3.13 Halaman Profil]

### 3.14 Halaman Login Admin

Halaman login admin memiliki desain yang sedikit berbeda dari halaman login pelanggan, dengan nuansa warna coklat tua agar terlihat lebih formal dan profesional. Hanya pengguna dengan role "admin" yang dapat berhasil login melalui halaman ini.

[Gambar 3.14 Halaman Login Admin]

### 3.15 Dashboard Admin

Dashboard admin menampilkan ringkasan data toko secara keseluruhan, meliputi total produk, total pesanan, total user, dan total pendapatan dari pesanan yang sudah berstatus "Selesai". Selain itu, dashboard ini juga menampilkan tabel pesanan terbaru yang masuk ke sistem.

[Gambar 3.15 Dashboard Admin]

### 3.16 Halaman Kelola Produk

Halaman kelola produk menampilkan seluruh data produk dalam bentuk tabel, lengkap dengan gambar, nama produk, kategori, harga, stok, status, dan aksi (edit/hapus). Admin juga dapat melakukan pencarian produk berdasarkan nama melalui fitur pencarian sederhana yang tersedia pada halaman ini.

[Gambar 3.16 Halaman Kelola Produk]

### 3.17 Halaman Tambah Produk

Halaman tambah produk berisi form untuk menambahkan produk baru, meliputi nama produk, kategori, harga, stok, gambar, deskripsi, dan status. Gambar produk yang diunggah akan disimpan ke folder assets/img/produk/, dan nama file gambar tersebut akan disimpan ke dalam database.

[Gambar 3.17 Halaman Tambah Produk]

### 3.18 Halaman Edit Produk

Halaman edit produk digunakan untuk memperbarui data produk yang sudah ada. Admin dapat mengubah seluruh data produk, termasuk mengganti gambar. Apabila admin tidak mengunggah gambar baru, sistem akan tetap menggunakan gambar lama yang sudah tersimpan sebelumnya.

[Gambar 3.18 Halaman Edit Produk]

### 3.19 Halaman Kelola Pesanan

Halaman kelola pesanan menampilkan seluruh data pesanan dari pelanggan, lengkap dengan kode pesanan, nama pelanggan, tanggal, metode pembayaran, total harga, dan status pesanan. Admin dapat memfilter pesanan berdasarkan status, seperti Menunggu Konfirmasi, Diproses, Dikirim, Selesai, atau Dibatalkan.

[Gambar 3.19 Halaman Kelola Pesanan]

### 3.20 Halaman Detail Pesanan

Halaman detail pesanan menampilkan informasi lengkap mengenai satu pesanan, meliputi data pelanggan, alamat pengiriman, metode pembayaran, daftar produk yang dibeli beserta jumlah dan subtotal, serta total harga keseluruhan. Pada halaman ini, admin dapat memperbarui status pesanan melalui form yang tersedia.

[Gambar 3.20 Halaman Detail Pesanan]

### 3.21 Halaman Kelola User

Halaman kelola user menampilkan daftar pelanggan yang terdaftar pada sistem, meliputi nama, email, nomor HP, alamat, status akun, dan tanggal pendaftaran. Admin dapat mengubah status akun pelanggan menjadi aktif atau nonaktif, namun tidak melakukan penghapusan data pelanggan secara permanen.

[Gambar 3.21 Halaman Kelola User]

### 3.22 Tampilan Database

Database hannasa_db terdiri dari enam tabel utama, yaitu tabel users, kategori, produk, keranjang, pesanan, dan detail_pesanan. Tabel-tabel tersebut saling berelasi menggunakan foreign key untuk menjaga integritas data, misalnya tabel pesanan berelasi dengan tabel users, dan tabel detail_pesanan berelasi dengan tabel pesanan serta tabel produk.

[Gambar 3.22 Tampilan Database]

### 3.23 Tampilan Coding PHP dan Bootstrap

Seluruh halaman website dibangun menggunakan PHP Native yang dikombinasikan dengan komponen Bootstrap 5 untuk tampilan, serta Google Fonts Montserrat dan Poppins untuk tipografi. Struktur kode dipisahkan ke dalam beberapa folder seperti config, includes, proses, public, auth, user, dan admin agar kode lebih terorganisir dan mudah dipahami.

[Gambar 3.23 Tampilan Coding PHP dan Bootstrap]

---

## BAB IV PENUTUP

### 4.1 Kesimpulan

Berdasarkan hasil perancangan dan implementasi yang telah dilakukan, dapat disimpulkan bahwa website Bika Ambon & Cake Hannasa berhasil dibangun menggunakan PHP Native, MySQL, dan Bootstrap 5 dengan tampilan yang rapi, modern, dan responsif. Website ini telah berhasil membantu proses promosi produk, mempermudah pelanggan dalam melakukan pemesanan secara online, serta membantu admin dalam mengelola data produk, pesanan, dan pengguna secara lebih terstruktur melalui dashboard administrasi yang tersedia.

### 4.2 Saran

Untuk pengembangan lebih lanjut, terdapat beberapa saran yang dapat dipertimbangkan, antara lain:

a. Menambahkan fitur pembayaran online melalui payment gateway agar proses transaksi lebih praktis dan otomatis.

b. Menambahkan fitur notifikasi melalui WhatsApp untuk memberi tahu pelanggan terkait status pesanan secara real-time.

c. Menambahkan fitur laporan penjualan otomatis dalam bentuk grafik maupun rekap periodik untuk membantu admin dalam menganalisis performa penjualan.

d. Menambahkan fitur upload bukti pembayaran oleh pelanggan untuk mempermudah proses verifikasi pesanan oleh admin.

---

## DAFTAR PUSTAKA

1. Sutabri, T. (2012). *Konsep Sistem Informasi*. Yogyakarta: Andi Offset.

2. Kadir, A. (2018). *Dasar Pemrograman Web Dinamis Menggunakan PHP*. Yogyakarta: Andi Offset.

3. Solichin, A. (2016). *Pemrograman Web dengan PHP dan MySQL*. Jakarta: Universitas Budi Luhur.

4. Bootstrap Team. *Bootstrap Documentation*. Diakses dari situs resmi dokumentasi Bootstrap.

5. World Wide Web Consortium (W3C). *HTML and CSS Standards Documentation*.

6. MySQL AB / Oracle Corporation. *MySQL Reference Manual*.
