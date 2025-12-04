<?php
class Pelanggan {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "pelanggan";

    // Atribut pelanggan
    public $id_pelanggan;
    public $nama_pelanggan;
    public $no_hp;
    public $alamat;

    // Konstruktor menerima koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read, ambil semua data
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_pelanggan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read one, ambil 1 data untuk edit
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_pelanggan = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->id_pelanggan);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Jika data ada, isi atribut
        if($row) {
            $this->nama_pelanggan = $row['nama_pelanggan'];
            $this->no_hp = $row['no_hp'];
            $this->alamat = $row['alamat'];
            return $row;
        }
        
        return null;
    }

    // Create, tambah data
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_pelanggan=:nama, no_hp=:hp, alamat=:alamat";
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->nama_pelanggan = htmlspecialchars(strip_tags($this->nama_pelanggan));
        $this->no_hp = htmlspecialchars(strip_tags($this->no_hp));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));

        // Binding data
        $stmt->bindParam(":nama", $this->nama_pelanggan);
        $stmt->bindParam(":hp", $this->no_hp);
        $stmt->bindParam(":alamat", $this->alamat);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update, edit data
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_pelanggan=:nama, no_hp=:hp, alamat=:alamat WHERE id_pelanggan=:id";
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->nama_pelanggan = htmlspecialchars(strip_tags($this->nama_pelanggan));
        $this->no_hp = htmlspecialchars(strip_tags($this->no_hp));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        $this->id_pelanggan = htmlspecialchars(strip_tags($this->id_pelanggan));

        // Binding data
        $stmt->bindParam(":nama", $this->nama_pelanggan);
        $stmt->bindParam(":hp", $this->no_hp);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":id", $this->id_pelanggan);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete, hapus data
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_pelanggan = ?";
        $stmt = $this->conn->prepare($query);
        // Bersihkan ID
        $this->id_pelanggan = htmlspecialchars(strip_tags($this->id_pelanggan));
        $stmt->bindParam(1, $this->id_pelanggan);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>