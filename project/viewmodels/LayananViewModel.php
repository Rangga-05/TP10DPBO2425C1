<?php
// Memuat file Database dan model Layanan
require_once 'config/Database.php';
require_once 'models/Layanan.php';

class LayananViewModel {
    private $db;
    private $layananModel;

    // Konstruktor, dijalankan saat class dipanggil
    public function __construct() {
        // Membuat koneksi ke database
        $database = new Database();
        $this->db = $database->getConnection();
        // Menyiapkan model Layanan siap dipakai
        $this->layananModel = new Layanan($this->db);
    }

    // Fungsi untuk mengambil semua data layanan
    public function showAllLayanan() {
        // Minta model untuk membaca data dari database
        $stmt = $this->layananModel->read();
        $data = [];
        // Ubah hasil query menjadi array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data; // Kembalikan array data ke View
    }

    // Fungsi untuk mengambil satu data berdasarkan ID untuk edit
    public function getLayananById($id) {
        $this->layananModel->id_layanan = $id;
        return $this->layananModel->readOne();
    }

    // Fungsi untuk menambah data baru
    public function addLayanan($nama, $harga, $durasi) {
        // Set data ke model
        $this->layananModel->nama_layanan = $nama;
        $this->layananModel->harga = $harga;
        $this->layananModel->durasi_menit = $durasi;
        // Panggil fungsi create di model untuk simpan ke DB
        return $this->layananModel->create();
    }

    // Fungsi untuk mengupdate data yang sudah ada
    public function updateLayanan($id, $nama, $harga, $durasi) {
        // Set ID dan data baru ke model
        $this->layananModel->id_layanan = $id;
        $this->layananModel->nama_layanan = $nama;
        $this->layananModel->harga = $harga;
        $this->layananModel->durasi_menit = $durasi;
        // Panggil fungsi update di model
        return $this->layananModel->update();
    }

    // Fungsi untuk menghapus data
    public function deleteLayanan($id) {
        $this->layananModel->id_layanan = $id;
        // Panggil fungsi delete di model
        return $this->layananModel->delete();
    }
}
?>