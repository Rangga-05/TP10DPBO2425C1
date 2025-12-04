<?php
// Judul halaman
$pageTitle = 'Daftar Pelanggan';
// Panggil header
include 'views/template/header.php';
?>

<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0" style="margin:0; font-size: 1.25rem;">Daftar Pelanggan</h3>
        <!-- Tombol Tambah -->
        <a href="index.php?page=add_pelanggan" class="btn btn-light btn-sm">
            + Tambah Pelanggan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <!-- Header Tabel -->
                        <th width="5%">No</th>
                        <th>Nama Pelanggan</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($pelangganList)) {
                        $no = 1;
                        // LOOPING untuk setiap baris data pelanggan
                        foreach ($pelangganList as $p) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $p['nama_pelanggan']; ?></td>
                            <td><?= $p['no_hp']; ?></td>
                            <td><?= $p['alamat']; ?></td>
                            <td>
                                <a href="index.php?page=edit_pelanggan&id=<?= $p['id_pelanggan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?action=delete_pelanggan&id=<?= $p['id_pelanggan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data pelanggan.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
// Panggil footer
include 'views/template/footer.php'; 
?>