-- Buat Database
CREATE DATABASE IF NOT EXISTS db_tempatcucikendaraan;
USE db_tempatcucikendaraan;

-- Tabel Pelanggan
CREATE TABLE pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    alamat TEXT
);

-- Tabel Layanan
CREATE TABLE layanan (
    id_layanan INT AUTO_INCREMENT PRIMARY KEY,
    nama_layanan VARCHAR(50) NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    durasi_menit INT NOT NULL
);

-- Tabel Pegawai
CREATE TABLE pegawai (
    id_pegawai INT AUTO_INCREMENT PRIMARY KEY,
    nama_pegawai VARCHAR(100) NOT NULL,
    posisi VARCHAR(50) NOT NULL
);

-- Tabel Transaksi
CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    tanggal_transaksi DATE NOT NULL,
    id_pelanggan INT NOT NULL,
    id_layanan INT NOT NULL,
    id_pegawai INT NOT NULL,
    jenis_kendaraan ENUM('Mobil', 'Motor') NOT NULL, 
    nomor_plat VARCHAR(20) NOT NULL,
    
    total_bayar DECIMAL(10, 2) NOT NULL,
    status ENUM('Antri', 'Proses', 'Selesai') DEFAULT 'Antri',
    
    -- Foreign Keys
    CONSTRAINT fk_pelanggan FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE,
    CONSTRAINT fk_layanan FOREIGN KEY (id_layanan) REFERENCES layanan(id_layanan) ON DELETE CASCADE,
    CONSTRAINT fk_pegawai FOREIGN KEY (id_pegawai) REFERENCES pegawai(id_pegawai) ON DELETE CASCADE
);

-- Data Dummy
-- Insert Data Layanan
INSERT INTO layanan (nama_layanan, harga, durasi_menit) VALUES 
('Cuci Regular (Body Only)', 25000, 30),
('Cuci Snow + Vakum', 45000, 45),
('Paket Lengkap + Wax', 80000, 60),
('Auto Detailing', 250000, 120);

-- Insert Data Pegawai
INSERT INTO pegawai (nama_pegawai, posisi) VALUES 
('Pablo', 'Manager'),
('Budi', 'Washer'),
('Samsudin', 'Washer'),
('Ahmad', 'Detailer'),
('Junaedi', 'Detailer'),
('Siti', 'Kasir');

-- Insert Data Pelanggan
INSERT INTO pelanggan (nama_pelanggan, no_hp, alamat) VALUES 
('Rangga Sigma', '089128435971', 'Jl. Proklamasi No. 5'),
('Rizky Febian', '081234567890', 'Jl. Merdeka No. 10'),
('Mahalini', '089876543210', 'Jl. Sudirman No. 15');

-- Insert Data Transaksi
INSERT INTO transaksi (tanggal_transaksi, id_pelanggan, id_layanan, id_pegawai, jenis_kendaraan, nomor_plat, total_bayar, status) VALUES 
(CURRENT_DATE, 1, 3, 5, 'Mobil', 'B 0506 MDR', 80000, 'Proses'),
(CURRENT_DATE, 2, 2, 2, 'Mobil', 'D 1234 ABC', 45000, 'Selesai'),
(CURRENT_DATE, 3, 4, 4, 'Mobil', 'B 5678 DEF', 250000, 'Proses'),
(CURRENT_DATE, 2, 1, 3, 'Motor', 'D 4321 GHI', 25000, 'Antri');