<?php
// Memuat file Database dan model Pegawai
require_once 'config/Database.php';
require_once 'models/Pegawai.php';

class PegawaiViewModel {
    private $db;
    private $pegawaiModel;

    // Konstruktor, dijalankan saat class dipanggil
    public function __construct() {
        // Membuat koneksi ke database
        $database = new Database();
        $this->db = $database->getConnection();
        // Menyiapkan model Pegawai siap dipakai
        $this->pegawaiModel = new Pegawai($this->db);
    }

    // Fungsi untuk mengambil semua data pegawai
    public function showAllPegawai() {
        // Minta model untuk membaca data dari database
        $stmt = $this->pegawaiModel->read();
        $data = [];
        // Ubah hasil query menjadi array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data; // Kembalikan array data ke View
    }

    // Fungsi untuk mengambil satu data berdasarkan ID untuk edit
    public function getPegawaiById($id) {
        $this->pegawaiModel->id_pegawai = $id;
        return $this->pegawaiModel->readOne();
    }

    // Fungsi untuk menambah data baru
    public function addPegawai($nama, $posisi) {
        // Set data ke model
        $this->pegawaiModel->nama_pegawai = $nama;
        $this->pegawaiModel->posisi = $posisi;
        // Panggil fungsi create di model untuk simpan ke DB
        return $this->pegawaiModel->create();
    }

    // Fungsi untuk mengupdate data yang sudah ada
    public function updatePegawai($id, $nama, $posisi) {
        // Set ID dan data baru ke model
        $this->pegawaiModel->id_pegawai = $id;
        $this->pegawaiModel->nama_pegawai = $nama;
        $this->pegawaiModel->posisi = $posisi;
        // Panggil fungsi update di model
        return $this->pegawaiModel->update();
    }

    // Fungsi untuk menghapus data
    public function deletePegawai($id) {
        $this->pegawaiModel->id_pegawai = $id;
        // Panggil fungsi delete di model
        return $this->pegawaiModel->delete();
    }
}
?>