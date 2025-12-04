<?php
// judul halaman
$pageTitle = 'Daftar Layanan';
// Panggil header
include 'views/template/header.php';
?>

<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0" style="margin:0; font-size: 1.25rem;">Daftar Layanan Cuci</h3>
        <a href="index.php?page=add_layanan" class="btn btn-light btn-sm">
            + Tambah Layanan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <!-- Header Kolom Tabel -->
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Layanan</th>
                        <th>Harga (Rp)</th>
                        <th>Durasi (Menit)</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($layananList)) {
                        $no = 1;
                        // LOOPING untuk setiap baris data layanan
                        foreach ($layananList as $l) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <!-- Tampilkan data dari kolom database -->
                            <td><?= $l['nama_layanan']; ?></td>
                            <td>Rp <?= number_format($l['harga'], 0, ',', '.'); ?></td>
                            <td><?= $l['durasi_menit']; ?> Menit</td>
                            <td class="text-center">
                                <a href="index.php?page=edit_layanan&id=<?= $l['id_layanan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?action=delete_layanan&id=<?= $l['id_layanan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus layanan ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data layanan.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Panggil footer -->
<?php include 'views/template/footer.php'; ?>