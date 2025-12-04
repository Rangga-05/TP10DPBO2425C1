<?php
class Transaksi {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "transaksi";

    // Atribut transaksi
    public $id_transaksi;
    public $tanggal_transaksi;
    public $id_pelanggan;
    public $id_layanan;
    public $id_pegawai;
    public $jenis_kendaraan;
    public $nomor_plat;
    public $total_bayar;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read, ambil semua data dengan JOIN 3 Tabel Lain
    public function read() {
        // JOIN tabel pelanggan, layanan, dan pegawai
        $query = "SELECT t.*, 
                         p.nama_pelanggan, 
                         l.nama_layanan, 
                         pg.nama_pegawai 
                  FROM " . $this->table_name . " t
                  JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                  JOIN layanan l ON t.id_layanan = l.id_layanan
                  JOIN pegawai pg ON t.id_pegawai = pg.id_pegawai
                  ORDER BY t.tanggal_transaksi DESC, t.id_transaksi DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read one, ambil 1 data untuk edit
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_transaksi = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->id_transaksi);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Jika data ada, isi atribut
        if($row) {
            $this->tanggal_transaksi = $row['tanggal_transaksi'];
            $this->id_pelanggan = $row['id_pelanggan'];
            $this->id_layanan = $row['id_layanan'];
            $this->id_pegawai = $row['id_pegawai'];
            $this->jenis_kendaraan = $row['jenis_kendaraan'];
            $this->nomor_plat = $row['nomor_plat'];
            $this->total_bayar = $row['total_bayar'];
            $this->status = $row['status'];
            return $row;
        }
        return null;
    }

    // Create, tambah data
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET tanggal_transaksi=:tgl, id_pelanggan=:id_p, id_layanan=:id_l, id_pegawai=:id_pg, jenis_kendaraan=:jenis, nomor_plat=:plat, 
        total_bayar=:total, status=:status";
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->nomor_plat = htmlspecialchars(strip_tags($this->nomor_plat));

        // Binding data
        $stmt->bindParam(":tgl", $this->tanggal_transaksi);
        $stmt->bindParam(":id_p", $this->id_pelanggan);
        $stmt->bindParam(":id_l", $this->id_layanan);
        $stmt->bindParam(":id_pg", $this->id_pegawai);
        $stmt->bindParam(":jenis", $this->jenis_kendaraan);
        $stmt->bindParam(":plat", $this->nomor_plat);
        $stmt->bindParam(":total", $this->total_bayar);
        $stmt->bindParam(":status", $this->status);

        if($stmt->execute()) return true;
        return false;
    }

    // Update, edit data
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET tanggal_transaksi=:tgl, id_pelanggan=:id_p, id_layanan=:id_l, id_pegawai=:id_pg, jenis_kendaraan=:jenis, nomor_plat=:plat, 
        total_bayar=:total, status=:status WHERE id_transaksi=:id";
        $stmt = $this->conn->prepare($query);

        // Binding data
        $stmt->bindParam(":tgl", $this->tanggal_transaksi);
        $stmt->bindParam(":id_p", $this->id_pelanggan);
        $stmt->bindParam(":id_l", $this->id_layanan);
        $stmt->bindParam(":id_pg", $this->id_pegawai);
        $stmt->bindParam(":jenis", $this->jenis_kendaraan);
        $stmt->bindParam(":plat", $this->nomor_plat);
        $stmt->bindParam(":total", $this->total_bayar);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id_transaksi);

        if($stmt->execute()) return true;
        return false;
    }

    // Delete, hapus data
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_transaksi = ?";
        $stmt = $this->conn->prepare($query);
        // Bersihkan ID
        $stmt->bindParam(1, $this->id_transaksi);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>