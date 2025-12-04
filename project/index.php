<?php
// Load semua viewmodel
require_once 'viewmodels/PelangganViewModel.php';
require_once 'viewmodels/LayananViewModel.php';
require_once 'viewmodels/PegawaiViewModel.php';
require_once 'viewmodels/TransaksiViewModel.php';

// Inisialisasi viewmodel
$pelangganVM = new PelangganViewModel();
$layananVM = new LayananViewModel();
$pegawaiVM = new PegawaiViewModel();
$transaksiVM = new TransaksiViewModel();

// Ambil parameter dari URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Logika routing (controller)
// Modul pelanggan
// Aksi 'save_pelanggan' (create)
if ($action == 'save_pelanggan') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pelangganVM->addPelanggan($_POST['nama_pelanggan'], $_POST['no_hp'], $_POST['alamat']);
        header("Location: index.php"); exit;
    }
}
// Aksi 'update_pelanggan' (update)
elseif ($action == 'update_pelanggan') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pelangganVM->updatePelanggan($_POST['id_pelanggan'], $_POST['nama_pelanggan'], $_POST['no_hp'], $_POST['alamat']);
        header("Location: index.php"); exit;
    }
}
// Aksi 'delete_pelanggan' (delete)
elseif ($action == 'delete_pelanggan') {
    if (isset($_GET['id'])) {
        $pelangganVM->deletePelanggan($_GET['id']);
        header("Location: index.php"); exit;
    }
}
// Halaman yang diminta form tambah data pelanggan
elseif ($page == 'add_pelanggan') {
    include 'views/pelanggan_form.php';
}
// Halaman yang diminta form edit data pelanggan
elseif ($page == 'edit_pelanggan') {
    if (isset($_GET['id'])) {
        $pelanggan = $pelangganVM->getPelangganById($_GET['id']);
        include 'views/pelanggan_form.php';
    }
}

// Modul Layanan
// Aksi 'save_layanan' (create)
elseif ($action == 'save_layanan') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $layananVM->addLayanan($_POST['nama_layanan'], $_POST['harga'], $_POST['durasi_menit']);
        header("Location: index.php?page=layanan"); exit;
    }
}
// Aksi 'update_layanan' (update)
elseif ($action == 'update_layanan') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $layananVM->updateLayanan($_POST['id_layanan'], $_POST['nama_layanan'], $_POST['harga'], $_POST['durasi_menit']);
        header("Location: index.php?page=layanan"); exit;
    }
}
// Aksi 'delete_layanan' (delete)
elseif ($action == 'delete_layanan') {
    if (isset($_GET['id'])) {
        $layananVM->deleteLayanan($_GET['id']);
        header("Location: index.php?page=layanan"); exit;
    }
}
// Tampilkan daftar layanan
elseif ($page == 'layanan') {
    $layananList = $layananVM->showAllLayanan();
    include 'views/layanan_list.php';
}
// Halaman yang diminta form tambah data layanan
elseif ($page == 'add_layanan') {
    include 'views/layanan_form.php';
}
// Halaman yang diminta form edit data pelanggan
elseif ($page == 'edit_layanan') {
    if (isset($_GET['id'])) {
        $layanan = $layananVM->getLayananById($_GET['id']);
        include 'views/layanan_form.php';
    }
}

// Modul Pegawai
// Aksi 'save_pegawai' (create)
elseif ($action == 'save_pegawai') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pegawaiVM->addPegawai($_POST['nama_pegawai'], $_POST['posisi']);
        header("Location: index.php?page=pegawai"); exit;
    }
}
// Aksi 'update_pegawai' (update)
elseif ($action == 'update_pegawai') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pegawaiVM->updatePegawai($_POST['id_pegawai'], $_POST['nama_pegawai'], $_POST['posisi']);
        header("Location: index.php?page=pegawai"); exit;
    }
}
// Aksi 'delete_pegawai' (delete)
elseif ($action == 'delete_pegawai') {
    if (isset($_GET['id'])) {
        $pegawaiVM->deletePegawai($_GET['id']);
        header("Location: index.php?page=pegawai"); exit;
    }
}
// Tampilkan daftar pegawai
elseif ($page == 'pegawai') {
    $pegawaiList = $pegawaiVM->showAllPegawai();
    include 'views/pegawai_list.php';
}
// Halaman yang diminta form tambah data pegawai
elseif ($page == 'add_pegawai') {
    include 'views/pegawai_form.php';
}
// Halaman yang diminta form edit data pegawai
elseif ($page == 'edit_pegawai') {
    if (isset($_GET['id'])) {
        $pegawai = $pegawaiVM->getPegawaiById($_GET['id']);
        include 'views/pegawai_form.php';
    }
}

// Modul Transaksi
// Aksi 'save_transaksi' (create)
elseif ($action == 'save_transaksi') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $transaksiVM->addTransaksi($_POST);
        header("Location: index.php?page=transaksi"); exit;
    }
}
// Aksi 'update_transaksi' (update)
elseif ($action == 'update_transaksi') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $transaksiVM->updateTransaksi($_POST);
        header("Location: index.php?page=transaksi"); exit;
    }
}
// Aksi 'delete_transaksi' (delete)
elseif ($action == 'delete_transaksi') {
    if (isset($_GET['id'])) {
        $transaksiVM->deleteTransaksi($_GET['id']);
        header("Location: index.php?page=transaksi"); exit;
    }
}
// Tampilkan daftar transaksi
elseif ($page == 'transaksi') {
    $transaksiList = $transaksiVM->showAllTransaksi();
    include 'views/transaksi_list.php';
}
// Halaman yang diminta form tambah data transaksi
elseif ($page == 'add_transaksi') {
    // Data dropdown untuk form
    $dataPelanggan = $transaksiVM->getListPelanggan();
    $dataLayanan = $transaksiVM->getListLayanan();
    $dataPegawai = $transaksiVM->getListPegawai();
    include 'views/transaksi_form.php';
}
// Halaman yang diminta form edit data transaksi
elseif ($page == 'edit_transaksi') {
    if (isset($_GET['id'])) {
        $transaksi = $transaksiVM->getTransaksiById($_GET['id']);
        // Data dropdown untuk edit
        $dataPelanggan = $transaksiVM->getListPelanggan();
        $dataLayanan = $transaksiVM->getListLayanan();
        $dataPegawai = $transaksiVM->getListPegawai();
        include 'views/transaksi_form.php';
    }
}

// Default / home page (daftar pelanggan)
else {
    $pelangganList = $pelangganVM->showAllPelanggan();
    include 'views/pelanggan_list.php';
}
?>