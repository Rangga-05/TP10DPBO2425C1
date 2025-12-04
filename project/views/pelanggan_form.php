<?php
// Judul halaman
$pageTitle = isset($pelanggan) ? 'Edit Data Pelanggan' : 'Tambah Pelanggan Baru';
// Panggil header
include 'views/template/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <!-- Header Card menampilkan judul dinamis -->
            <div class="card-header card-header-dark-blue">
                <h5 class="mb-0 fw-bold">
                    <?= isset($pelanggan) ? '✏️ Edit Pelanggan' : '➕ Tambah Pelanggan' ?>
                </h5>
            </div>
            
            <div class="card-body p-4">
                <?php
                // Logika untuk menentukan URL aksi
                $actionUrl = isset($pelanggan) ? 'index.php?action=update_pelanggan' : 'index.php?action=save_pelanggan';
                ?>

                <!-- Form akan disubmit ke URL aksi yang sudah ditentukan -->
                <form action="<?= $actionUrl ?>" method="POST">
                    
                    <!-- Hidden ID jika edit -->
                    <?php if (isset($pelanggan)): ?>
                        <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan'] ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="nama" class="form-label text-secondary fw-bold">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama" name="nama_pelanggan" 
                               value="<?= isset($pelanggan) ? $pelanggan['nama_pelanggan'] : '' ?>" 
                               required placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="mb-3">
                        <label for="hp" class="form-label text-secondary fw-bold">Nomor HP</label>
                        <input type="number" class="form-control" id="hp" name="no_hp" 
                               value="<?= isset($pelanggan) ? $pelanggan['no_hp'] : '' ?>" 
                               required placeholder="Contoh: 08123456789">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label text-secondary fw-bold">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required placeholder="Masukkan alamat lengkap"><?= isset($pelanggan) ? $pelanggan['alamat'] : '' ?></textarea>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php" class="text-decoration-none text-secondary">
                            &laquo; Kembali
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <?= isset($pelanggan) ? 'Update Data' : 'Simpan Data' ?>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php 
// Panggil footer
include 'views/template/footer.php'; 
?>