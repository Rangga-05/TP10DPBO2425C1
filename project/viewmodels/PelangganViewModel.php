<?php
// Memuat file Database dan model Pelanggan
require_once 'config/Database.php';
require_once 'models/Pelanggan.php';

class PelangganViewModel {
    private $db;
    private $pelangganModel;

    // Konstruktor, dijalankan saat class dipanggil
    public function __construct() {
        // Membuat koneksi ke database
        $database = new Database();
        $this->db = $database->getConnection();
        // Menyiapkan model Pelanggan siap dipakai
        $this->pelangganModel = new Pelanggan($this->db);
    }

    // Fungsi untuk mengambil semua data pelanggan
    public function showAllPelanggan() {
        // Minta model untuk membaca data dari database
        $stmt = $this->pelangganModel->read();
        $dataPelanggan = [];
        // Ubah hasil query menjadi array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dataPelanggan[] = $row;
        }
        return $dataPelanggan; // Kembalikan array data ke View
    }

    // Fungsi untuk mengambil satu data berdasarkan ID untuk edit
    public function getPelangganById($id) {
        $this->pelangganModel->id_pelanggan = $id;
        return $this->pelangganModel->readOne();
    }

    // Fungsi untuk menambah data baru
    public function addPelanggan($nama, $hp, $alamat) {
        // Set data ke model
        $this->pelangganModel->nama_pelanggan = $nama;
        $this->pelangganModel->no_hp = $hp;
        $this->pelangganModel->alamat = $alamat;
        // Panggil fungsi create di model untuk simpan ke DB
        return $this->pelangganModel->create();
    }

    // Fungsi untuk mengupdate data yang sudah ada
    public function updatePelanggan($id, $nama, $hp, $alamat) {
        // Set ID dan data baru ke model
        $this->pelangganModel->id_pelanggan = $id;
        $this->pelangganModel->nama_pelanggan = $nama;
        $this->pelangganModel->no_hp = $hp;
        $this->pelangganModel->alamat = $alamat;
        // Panggil fungsi update di model
        return $this->pelangganModel->update();
    }

    // Fungsi untuk menghapus data
    public function deletePelanggan($id) {
        $this->pelangganModel->id_pelanggan = $id;
        // Panggil fungsi delete di model
        return $this->pelangganModel->delete();
    }
}
?>