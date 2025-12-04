<?php
// Memuat file Database dan semua model yang dibutuhkan untuk Transaksi
require_once 'config/Database.php';
require_once 'models/Transaksi.php';
require_once 'models/Pelanggan.php';
require_once 'models/Layanan.php';
require_once 'models/Pegawai.php';

class TransaksiViewModel {
    private $db;
    private $transaksiModel;

    // Konstruktor, dijalankan saat class dipanggil
    public function __construct() {
        // Membuat koneksi ke database
        $database = new Database();
        $this->db = $database->getConnection();
        // Menyiapkan model Pelanggan siap dipakai
        $this->transaksiModel = new Transaksi($this->db);
    }

    // Fungsi untuk mengambil semua data transaksi
    public function showAllTransaksi() {
        // Minta model untuk membaca data dari database termasuk yang di JOIN
        $stmt = $this->transaksiModel->read();
        $data = [];
        // Ubah hasil query menjadi array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data; // Kembalikan array data ke View
    }

    // Fungsi untuk mengambil satu data berdasarkan ID untuk edit
    public function getTransaksiById($id) {
        $this->transaksiModel->id_transaksi = $id;
        return $this->transaksiModel->readOne();
    }

    // Fungsi untuk menambah data baru
    public function addTransaksi($data) {
        // Set data ke model
        $this->transaksiModel->tanggal_transaksi = $data['tanggal_transaksi'];
        $this->transaksiModel->id_pelanggan = $data['id_pelanggan'];
        $this->transaksiModel->id_layanan = $data['id_layanan'];
        $this->transaksiModel->id_pegawai = $data['id_pegawai'];
        $this->transaksiModel->jenis_kendaraan = $data['jenis_kendaraan'];
        $this->transaksiModel->nomor_plat = $data['nomor_plat'];
        $this->transaksiModel->total_bayar = $data['total_bayar']; 
        $this->transaksiModel->status = $data['status'];
        // Panggil fungsi create di model untuk simpan ke DB
        return $this->transaksiModel->create();
    }

    // Fungsi untuk mengupdate data yang sudah ada
    public function updateTransaksi($data) {
        // Set ID dan data baru ke model
        $this->transaksiModel->id_transaksi = $data['id_transaksi'];
        $this->transaksiModel->tanggal_transaksi = $data['tanggal_transaksi'];
        $this->transaksiModel->id_pelanggan = $data['id_pelanggan'];
        $this->transaksiModel->id_layanan = $data['id_layanan'];
        $this->transaksiModel->id_pegawai = $data['id_pegawai'];
        $this->transaksiModel->jenis_kendaraan = $data['jenis_kendaraan'];
        $this->transaksiModel->nomor_plat = $data['nomor_plat'];
        $this->transaksiModel->total_bayar = $data['total_bayar'];
        $this->transaksiModel->status = $data['status'];
        // Panggil fungsi update di model
        return $this->transaksiModel->update();
    }

    // Fungsi untuk menghapus data
    public function deleteTransaksi($id) {
        $this->transaksiModel->id_transaksi = $id;
        // Panggil fungsi delete di model
        return $this->transaksiModel->delete();
    }

    // Fungsi untuk mengambil daftar semua pelanggan, untuk dropdown
    public function getListPelanggan() {
        $pelanggan = new Pelanggan($this->db);
        $stmt = $pelanggan->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengambil daftar semua layanan, untuk dropdown
    public function getListLayanan() {
        $layanan = new Layanan($this->db);
        $stmt = $layanan->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengambil daftar semua pegawai, untuk dropdown
    public function getListPegawai() {
        $pegawai = new Pegawai($this->db);
        $stmt = $pegawai->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>