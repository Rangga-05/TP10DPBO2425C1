<?php
// Judul halaman
$pageTitle = isset($transaksi) ? 'Edit Transaksi' : 'Transaksi Baru';
// Panggil header
include 'views/template/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header" style="background-color: #0b1c2c; color: white;">
                <h4 class="mb-0"><?= isset($transaksi) ? 'Edit Transaksi' : 'Input Transaksi Baru' ?></h4>
            </div>
            <div class="card-body">
                <?php
                // Logika penentuan URL Aksi
                $actionUrl = isset($transaksi) ? 'index.php?action=update_transaksi' : 'index.php?action=save_transaksi';
                ?>

                <!-- Form disubmit ke URL Aksi -->
                <form action="<?= $actionUrl ?>" method="POST">
                    
                    <?php if (isset($transaksi)): ?>
                        <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">
                    <?php endif; ?>

                    <div class="row">
                        <!-- Kolom kiri (informasi umum transaksi) -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_transaksi" 
                                       value="<?= isset($transaksi) ? $transaksi['tanggal_transaksi'] : date('Y-m-d') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pelanggan</label>
                                <!-- Dropdown pelanggan -->
                                <select class="form-control" name="id_pelanggan" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    <?php foreach($dataPelanggan as $p): ?>
                                        <option value="<?= $p['id_pelanggan'] ?>" 
                                            <?= (isset($transaksi) && $transaksi['id_pelanggan'] == $p['id_pelanggan']) ? 'selected' : '' ?>>
                                            <?= $p['nama_pelanggan'] ?> (<?= $p['no_hp'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pegawai (Pencuci)</label>
                                <!-- Dropdown pegawai -->
                                <select class="form-control" name="id_pegawai" required>
                                    <option value="">-- Pilih Pegawai --</option>
                                    <?php foreach($dataPegawai as $pg): ?>
                                        <option value="<?= $pg['id_pegawai'] ?>"
                                            <?= (isset($transaksi) && $transaksi['id_pegawai'] == $pg['id_pegawai']) ? 'selected' : '' ?>>
                                            <?= $pg['nama_pegawai'] ?> - <?= $pg['posisi'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Kolom kanan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Kendaraan</label>
                                <!-- Dropdown kendaraan -->
                                <select class="form-control" name="jenis_kendaraan" required>
                                    <option value="Mobil" <?= (isset($transaksi) && $transaksi['jenis_kendaraan'] == 'Mobil') ? 'selected' : '' ?>>Mobil</option>
                                    <option value="Motor" <?= (isset($transaksi) && $transaksi['jenis_kendaraan'] == 'Motor') ? 'selected' : '' ?>>Motor</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor Plat</label>
                                <!-- Plat nomor kendaraan -->
                                <input type="text" class="form-control" name="nomor_plat" 
                                       value="<?= isset($transaksi) ? $transaksi['nomor_plat'] : '' ?>" 
                                       placeholder="Cth: B 1234 ABC" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Layanan</label>
                                <!-- Dropdown layanan -->
                                <select class="form-control" name="id_layanan" id="selectLayanan" onchange="updateHarga()" required>
                                    <option value="" data-harga="0">-- Pilih Layanan --</option>
                                    <?php foreach($dataLayanan as $l): ?>
                                        <option value="<?= $l['id_layanan'] ?>" data-harga="<?= $l['harga'] ?>"
                                            <?= (isset($transaksi) && $transaksi['id_layanan'] == $l['id_layanan']) ? 'selected' : '' ?>>
                                            <?= $l['nama_layanan'] ?> - Rp <?= number_format($l['harga'],0,',','.') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status Pengerjaan</label>
                                <!-- Dropdown status pencucian -->
                                <select class="form-control" name="status">
                                    <option value="Antri" <?= (isset($transaksi) && $transaksi['status'] == 'Antri') ? 'selected' : '' ?>>Antri</option>
                                    <option value="Proses" <?= (isset($transaksi) && $transaksi['status'] == 'Proses') ? 'selected' : '' ?>>Sedang Dikerjakan</option>
                                    <option value="Selesai" <?= (isset($transaksi) && $transaksi['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="mb-3">
                                <label class="form-label">Total Bayar (Rp)</label>
                                <!-- Total bayar -->
                                <input type="number" class="form-control" name="total_bayar" id="totalBayar"
                                       value="<?= isset($transaksi) ? $transaksi['total_bayar'] : '' ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php?page=transaksi" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">
                            <?= isset($transaksi) ? 'Update Transaksi' : 'Simpan Transaksi' ?>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk update harga otomatis saat pilih layanan -->
<script>
function updateHarga() {
    var select = document.getElementById('selectLayanan');
    var harga = select.options[select.selectedIndex].getAttribute('data-harga');
    document.getElementById('totalBayar').value = harga;
}
</script>

<!-- Panggil footer -->
<?php include 'views/template/footer.php'; ?>