<?php
// judul halaman
$pageTitle = isset($pegawai) ? 'Edit Pegawai' : 'Tambah Pegawai';
// Panggil header
include 'views/template/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header" style="background-color: #0b1c2c; color: white;">
                <h4 class="mb-0"><?= isset($pegawai) ? 'Edit Pegawai' : 'Tambah Pegawai Baru' ?></h4>
            </div>
            <div class="card-body">
                <?php
                // Logika penentuan URL aksi
                $actionUrl = isset($pegawai) ? 'index.php?action=update_pegawai' : 'index.php?action=save_pegawai';
                ?>

                <!-- Form akan disubmit ke URL Aksi -->
                <form action="<?= $actionUrl ?>" method="POST">
                    
                    <?php if (isset($pegawai)): ?>
                        <!-- Hidden Field hanya ada jika mode Edit, menyimpan ID Pegawai yang akan diubah -->
                        <input type="hidden" name="id_pegawai" value="<?= $pegawai['id_pegawai'] ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" name="nama_pegawai" 
                               value="<?= isset($pegawai) ? $pegawai['nama_pegawai'] : '' ?>" 
                               required placeholder="Nama lengkap pegawai">
                    </div>

                    <div class="mb-3">
                        <label for="posisi" class="form-label">Posisi / Jabatan</label>
                        <!-- Select posisi, dropdown untuk memilih jabatan -->
                        <select class="form-control" name="posisi" id="posisi" required>
                            <option value="">-- Pilih Posisi --</option>
                            <option value="Washer" <?= (isset($pegawai) && $pegawai['posisi'] == 'Washer') ? 'selected' : '' ?>>Washer (Pencuci)</option>
                            <option value="Detailer" <?= (isset($pegawai) && $pegawai['posisi'] == 'Detailer') ? 'selected' : '' ?>>Detailer (Poles/Coating)</option>
                            <option value="Kasir" <?= (isset($pegawai) && $pegawai['posisi'] == 'Kasir') ? 'selected' : '' ?>>Kasir</option>
                            <option value="Manager" <?= (isset($pegawai) && $pegawai['posisi'] == 'Manager') ? 'selected' : '' ?>>Manager</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php?page=pegawai" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">
                            <?= isset($pegawai) ? 'Update Data' : 'Simpan Data' ?>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Panggil footer -->
<?php include 'views/template/footer.php'; ?>