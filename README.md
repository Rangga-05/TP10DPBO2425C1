# 🚗 TP10DPBO2425C1
TP 10 DPBO Model-View-ViewModel (MVVM) Membuat Steam Wash System

# Janji
Saya Muhammad Rangga Nur Praditha dengan Nim 2400297 mengerjakan Tugas Praktikum 10 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan. Aamiin

# 📐 Desain Arsitektur Program: MVVM
Aplikasi manajemen sederhana untuk pencucian kendaraan, dibuat sebagai tugas praktikum menggunakan arsitektur MVVM (Model-View-ViewModel) dengan desain biru gelap yang elegan. Proyek ini dibangun di atas fondasi MVVM untuk memastikan pemisahan tugas (Separation of Concerns) yang jelas antar komponen.

Arsitektur MVVM membagi fungsionalitas aplikasi menjadi beberapa komponen utama:
1. **Controller (Router) di `index.php`:** Mengatur routing URL, mendeteksi aksi (`save`, `delete`), dan menentukan View mana yang harus ditampilkan.
2. **ViewModel (`viewmodels/`):** Jembatan logika. Bertugas mengambil data dari Model, memprosesnya, dan menyajikannya ke View.
3. **Model (`models/`):** Logika data. Berinteraksi langsung dengan database, bertanggung jawab atas query SQL, sanitasi data, dan parameter binding.
4. **View (`views/`):** Antarmuka pengguna (HTML). Hanya berfungsi sebagai tampilan.
5. **Config (`config/Database.php`):** File konfigurasi krusial yang menyimpan detail koneksi ke database (host, username, password, dan nama DB), memastikan Model dapat terhubung dan beroperasi.
6. **Database (`database/db_tempatcucikendaraan.sql`):** File skema database lengkap beserta data dummy.

# 💾 Skema Database dan Relasi
Database aplikasi terdiri dari 4 tabel utama: `pelanggan`, `layanan`, `pegawai`, dan `transaksi`.

Tiga tabel pertama (`pelanggan`, `layanan`, dan `pegawai`) berfungsi sebagai tabel master untuk menyimpan data dasar. File `database/db_tempatcucikendaraan.sql` menyimpan skema lengkap database yang siap diimpor.

Tabel terpenting adalah `transaksi`, yang menyimpan semua catatan penjualan jasa. Tabel `transaksi` ini memiliki **tiga relasi Foreign Key** yang sangat penting:
1. Relasi ke tabel **Pelanggan (`id_pelanggan`)** untuk mencatat siapa yang menggunakan jasa.
2. Relasi ke tabel **Layanan (`id_layanan`)** untuk mencatat jasa cuci apa yang dipilih, termasuk harga.
3. Relasi ke tabel **Pegawai (`id_pegawai`)** untuk mencatat siapa pegawai yang bertugas melakukan pencucian.

Ketiga relasi ini memastikan integritas data dan memenuhi kriteria minimal dua relasi (Primary Key - Foreign Key).

# 🔄 Penjelasan Alur Program (Request Flow CRUD)
Alur dasar ini berlaku untuk semua modul (Pelanggan, Layanan, Pegawai, dan Transaksi) dan menunjukkan bagaimana setiap permintaan diproses oleh arsitektur MVVM.

1. **Alur CREATE (Menambah Data)**
- **View:** Pengguna mengisi formulir di `pelanggan_form.php` atau `transaksi_form.php` dan menekan tombol Simpan. Form disubmit ke `index.php?action=save_modul`.
- **Controller (`index.php`):** Mendeteksi `action=save_modul`. Mengambil data dari `$_POST` dan memanggil fungsi `addModul()` di ViewModel yang bersangkutan.
- **ViewModel:** Menerima data. Mengatur properti di Model.
- **Model:** Melakukan **Pembersihan Data** (Anti-XSS) dan **Parameter Binding** (Anti-SQL Injection). Mengeksekusi query INSERT ke database.
- **Controller:** Melakukan `header("Location: ...")` untuk kembali ke halaman daftar.

2. **Alur READ (Menampilkan Daftar)**
- **Controller (`index.php`):** Mendeteksi `page=modul`.
- **Controller:** Memanggil fungsi `showAllModul()` di ViewModel.
- **ViewModel:** Memanggil fungsi `read()` di Model. Memproses hasil query menjadi array PHP.
- **Controller:** Menerima array data (`$modulList`) dan memasukkannya ke View.
- **View:** Menerima `$modulList` dan melakukan looping PHP (`foreach`) untuk mencetak setiap baris data ke dalam tabel.

3. **Alur UPDATE (Mengubah Data)**
- **Controller (Edit Page):** Mendeteksi `page=edit_modul&id=X`. Memanggil `getModulById(X)` di ViewModel untuk mengambil data lama.
- **View (Form):** Menampilkan form, mengisi nilai awal (`value="<?= $modul['data'] ?>"`) dengan data lama (Data Binding). Form disubmit ke `index.php?action=update_modul`.
- **Controller (Update Action):** Menerima data baru dari `$_POST`. Memanggil fungsi `updateModul()` di ViewModel.
- **Model:** Melakukan pembersihan data, binding, dan mengeksekusi query `UPDATE`.
- **Controller:** Redirect kembali ke halaman daftar.

# ✨ Fitur Utama
- **CRUD Lengkap (Create, Read, Update, Delete)** untuk 4 modul utama: Pelanggan, Layanan, Pegawai, dan Transaksi.
- **Templating Template:** Menggunakan file `header.php` dan `footer.php` untuk konsistensi tampilan.
- **Custom Design:** Menggunakan CSS dengan tema biru gelap.
- **Data Binding:** Data transaksi (seperti nama, layanan, pegawai) diambil melalui JOIN SQL dan ditampilkan secara terintegrasi di tabel daftar. Form Edit juga otomatis memuat data lama.

# 📸 Dokumentasi
https://github.com/user-attachments/assets/029eae7b-77f9-40ee-b795-c26bef3a6b10
