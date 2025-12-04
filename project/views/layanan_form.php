<?php
// judul halaman
$pageTitle = isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan';
// Panggil header
include 'views/template/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header" style="background-color: #0b1c2c; color: white;">
                <h4 class="mb-0"><?= isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan Baru' ?></h4>
            </div>
            <div class="card-body">
                <?php
                // Logika untuk aksi
                $actionUrl = isset($layanan) ? 'index.php?action=update_layanan' : 'index.php?action=save_layanan';
                ?>

                 <!-- Form akan disubmit ke URL Aksi -->
                <form action="<?= $actionUrl ?>" method="POST">
                    
                    <?php if (isset($layanan)): ?>
                        <input type="hidden" name="id_layanan" value="<?= $layanan['id_layanan'] ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="nama" name="nama_layanan" 
                               value="<?= isset($layanan) ? $layanan['nama_layanan'] : '' ?>" 
                               required placeholder="Contoh: Cuci Snow + Vakum">
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga (Rp)</label>
                        <input type="number" class="form-control" id="harga" name="harga" 
                               value="<?= isset($layanan) ? $layanan['harga'] : '' ?>" 
                               required placeholder="Contoh: 45000">
                    </div>

                    <div class="mb-3">
                        <label for="durasi" class="form-label">Estimasi Durasi (Menit)</label>
                        <input type="number" class="form-control" id="durasi" name="durasi_menit" 
                               value="<?= isset($layanan) ? $layanan['durasi_menit'] : '' ?>" 
                               required placeholder="Contoh: 45">
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php?page=layanan" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">
                            <?= isset($layanan) ? 'Update Data' : 'Simpan Data' ?>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Panggil footer -->
<?php include 'views/template/footer.php'; ?>