<?php
// judul halaman
$pageTitle = 'Daftar Pegawai';
// Panggil header
include 'views/template/header.php';
?>

<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0" style="margin:0; font-size: 1.25rem;">Daftar Pegawai</h3>
        <!-- Link tombol arah ke halaman tambah pegawai baru -->
        <a href="index.php?page=add_pegawai" class="btn btn-light btn-sm">
            + Tambah Pegawai
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <!-- Header Kolom -->
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Pegawai</th>
                        <th>Posisi / Jabatan</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($pegawaiList)) {
                        $no = 1;
                        // LOOPING untuk setiap baris data pegawai
                        foreach ($pegawaiList as $p) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <!-- Tampilkan data Pegawai -->
                            <td><?= $p['nama_pegawai']; ?></td>
                            <td>
                                <span style="background: #eee; padding: 2px 8px; border-radius: 4px; font-size: 0.9em;">
                                    <?= $p['posisi']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?page=edit_pegawai&id=<?= $p['id_pegawai']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?action=delete_pegawai&id=<?= $p['id_pegawai']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pegawai ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data pegawai.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Panggil footer -->
<?php include 'views/template/footer.php'; ?>