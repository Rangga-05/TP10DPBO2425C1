<?php
// Judul halaman
$pageTitle = 'Daftar Transaksi';
// Panggil header
include 'views/template/header.php';
?>

<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0" style="margin:0; font-size: 1.25rem;">Riwayat Transaksi</h3>
        <a href="index.php?page=add_transaksi" class="btn btn-light btn-sm">
            + Transaksi Baru
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <!-- Header Tabel -->
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Kendaraan</th>
                        <th>Layanan</th>
                        <th>Total (Rp)</th>
                        <th>Pegawai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($transaksiList)) {
                        $no = 1;
                        // LOOPING untuk setiap baris data transaksi
                        foreach ($transaksiList as $t) {
                            // Warna status pencucian
                            $badgeColor = '#95a5a6';
                            if($t['status'] == 'Selesai') $badgeColor = 'var(--success)'; // Hijau
                            if($t['status'] == 'Proses') $badgeColor = 'var(--warning)';  // Kuning
                    ?>
                        <tr>
                            <!-- Tampilkan data data pencucian -->
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= date('d/m/Y', strtotime($t['tanggal_transaksi'])); ?></td>
                            <td><?= $t['nama_pelanggan']; ?></td>
                            <td>
                                <b><?= $t['jenis_kendaraan']; ?></b><br>
                                <small class="text-secondary"><?= $t['nomor_plat']; ?></small>
                            </td>
                            <td><?= $t['nama_layanan']; ?></td>
                            <td class="text-end"><?= number_format($t['total_bayar'], 0, ',', '.'); ?></td>
                            <td><?= $t['nama_pegawai']; ?></td>
                            <td class="text-center">
                                <span style="background-color: <?= $badgeColor ?>; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem;">
                                    <?= $t['status']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?page=edit_transaksi&id=<?= $t['id_transaksi']; ?>" class="btn btn-warning btn-sm" style="padding: 2px 5px; font-size: 0.7rem;">Edit</a>
                                <a href="index.php?action=delete_transaksi&id=<?= $t['id_transaksi']; ?>" class="btn btn-danger btn-sm" style="padding: 2px 5px; font-size: 0.7rem;" onclick="return confirm('Hapus transaksi ini?');">X</a>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="9" class="text-center">Belum ada data transaksi.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Panggil footer -->
<?php include 'views/template/footer.php'; ?>