<?php
class Layanan {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "layanan";

    // Atribut layanan
    public $id_layanan;
    public $nama_layanan;
    public $harga;
    public $durasi_menit;

    // Konstruktor menerima koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read, ambil semua data
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_layanan ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read one, ambil 1 data untuk edit
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_layanan = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->id_layanan);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Jika data ada, isi atribut
        if($row) {
            $this->nama_layanan = $row['nama_layanan'];
            $this->harga = $row['harga'];
            $this->durasi_menit = $row['durasi_menit'];
            return $row;
        }
        return null;
    }

    // Create, tambah data
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_layanan=:nama, harga=:harga, durasi_menit=:durasi";
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->nama_layanan = htmlspecialchars(strip_tags($this->nama_layanan));
        $this->harga = htmlspecialchars(strip_tags($this->harga));
        $this->durasi_menit = htmlspecialchars(strip_tags($this->durasi_menit));

        // Binding data
        $stmt->bindParam(":nama", $this->nama_layanan);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":durasi", $this->durasi_menit);

        if($stmt->execute()) return true;
        return false;
    }

    // Update, edit data
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_layanan=:nama, harga=:harga, durasi_menit=:durasi WHERE id_layanan=:id";
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->nama_layanan = htmlspecialchars(strip_tags($this->nama_layanan));
        $this->harga = htmlspecialchars(strip_tags($this->harga));
        $this->durasi_menit = htmlspecialchars(strip_tags($this->durasi_menit));
        $this->id_layanan = htmlspecialchars(strip_tags($this->id_layanan));

        // Binding data
        $stmt->bindParam(":nama", $this->nama_layanan);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":durasi", $this->durasi_menit);
        $stmt->bindParam(":id", $this->id_layanan);

        if($stmt->execute()) return true;
        return false;
    }

    // Delete, hapus data
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_layanan = ?";
        $stmt = $this->conn->prepare($query);
        // Bersihkan ID
        $this->id_layanan = htmlspecialchars(strip_tags($this->id_layanan));
        $stmt->bindParam(1, $this->id_layanan);

        if($stmt->execute()) return true;
        return false;
    }
}
?>