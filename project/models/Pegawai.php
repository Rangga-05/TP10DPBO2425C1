<?php
class Pegawai {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "pegawai";

    // Atribut pegawai
    public $id_pegawai;
    public $nama_pegawai;
    public $posisi;

    // Konstruktor menerima koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read, ambil semua data
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_pegawai ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read one, ambil 1 data untuk edit
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_pegawai = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->id_pegawai);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Jika data ada, isi atribut
        if($row) {
            $this->nama_pegawai = $row['nama_pegawai'];
            $this->posisi = $row['posisi'];
            return $row;
        }
        return null;
    }

    // Create, tambah data
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_pegawai=:nama, posisi=:posisi";
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->nama_pegawai = htmlspecialchars(strip_tags($this->nama_pegawai));
        $this->posisi = htmlspecialchars(strip_tags($this->posisi));

        // Binding data
        $stmt->bindParam(":nama", $this->nama_pegawai);
        $stmt->bindParam(":posisi", $this->posisi);

        if($stmt->execute()) return true;
        return false;
    }

    // Update, edit data
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_pegawai=:nama, posisi=:posisi WHERE id_pegawai=:id";
        
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->nama_pegawai = htmlspecialchars(strip_tags($this->nama_pegawai));
        $this->posisi = htmlspecialchars(strip_tags($this->posisi));
        $this->id_pegawai = htmlspecialchars(strip_tags($this->id_pegawai));

        // Binding data
        $stmt->bindParam(":nama", $this->nama_pegawai);
        $stmt->bindParam(":posisi", $this->posisi);
        $stmt->bindParam(":id", $this->id_pegawai);

        if($stmt->execute()) return true;
        return false;
    }

    // Delete, hapus data
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_pegawai = ?";
        $stmt = $this->conn->prepare($query);
        // Bersihkan ID
        $this->id_pegawai = htmlspecialchars(strip_tags($this->id_pegawai));
        $stmt->bindParam(1, $this->id_pegawai);

        if($stmt->execute()) return true;
        return false;
    }
}
?>