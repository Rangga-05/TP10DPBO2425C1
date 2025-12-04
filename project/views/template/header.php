<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Aplikasi Car Wash' ?></title>
    
    <style>
        /* --- 1. VARIABEL WARNA (Biru Gelap Theme) --- */
        :root {
            --primary-dark: #0b1c2c;       /* Biru Gelap Utama */
            --secondary-dark: #163450;     /* Biru Agak Terang */
            --accent-color: #3498db;       /* Biru Aksen */
            --text-dark: #2c3e50;
            --bg-light: #f4f7f6;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #c0392b;
            --light: #f8f9fa;
        }

        /* --- 2. RESET & DASAR --- */
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: var(--bg-light);
            margin: 0; padding: 0;
            color: var(--text-dark);
            display: flex; flex-direction: column; min-height: 100vh;
        }

        /* --- 3. LAYOUT --- */
        .container {
            width: 90%; max-width: 1000px; margin: 0 auto; padding: 0 15px;
        }
        .main-content { flex: 1; padding-top: 20px; }
        
        /* Helpers */
        .mt-5 { margin-top: 3rem; } .mb-3 { margin-bottom: 1rem; } .mb-0 { margin-bottom: 0; } .mt-4 { margin-top: 1.5rem; }
        .d-flex { display: flex; } 
        .justify-content-between { justify-content: space-between; }
        .justify-content-center { justify-content: center; }
        .align-items-center { align-items: center; }
        .text-center { text-align: center; }
        .text-white { color: white; }

        /* --- 4. NAVBAR --- */
        .navbar {
            background-color: var(--primary-dark);
            padding: 1rem 0; box-shadow: 0 2px 5px rgba(0,0,0,0.2); margin-bottom: 20px;
        }
        .navbar .container { display: flex; justify-content: space-between; align-items: center; }
        .navbar-brand { color: white; font-size: 1.5rem; font-weight: bold; text-decoration: none; }
        .navbar-nav { list-style: none; margin: 0; padding: 0; display: flex; gap: 20px; }
        
        .nav-link { color: rgba(255,255,255,0.6); text-decoration: none; font-weight: 500; transition: color 0.3s; }
        .nav-link:hover { color: white; }
        
        /* Menu Aktif */
        .nav-link.active { color: white; font-weight: bold; border-bottom: 2px solid var(--accent-color); }

        /* --- 5. CARD --- */
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #ddd; }
        .card-header { padding: 15px 20px; background-color: var(--primary-dark); color: white; border-bottom: 1px solid #eee; }
        .card-body { padding: 20px; }
        .shadow { box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); }

        /* --- 6. TABEL (Pengganti Bootstrap Table) --- */
        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 1rem; }
        .table th, .table td { padding: 12px; border: 1px solid #dee2e6; text-align: left; }
        .table thead { background-color: #e9ecef; }
        .table th { font-weight: 600; color: var(--secondary-dark); }
        .table-hover tbody tr:hover { background-color: rgba(0,0,0,0.05); }

        /* --- 7. BUTTONS & FORM --- */
        .btn { display: inline-block; padding: 8px 16px; font-size: 0.9rem; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; transition: 0.2s; font-family: inherit; }
        .btn-sm { padding: 5px 10px; font-size: 0.8rem; }
        .btn-light { background: #f8f9fa; color: #000; }
        .btn-primary { background: var(--primary-dark); color: white; }
        .btn-success { background: var(--success); color: white; }
        .btn-warning { background: var(--warning); color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        
        .form-label { font-weight: 600; margin-bottom: 5px; display: block; color: var(--secondary-dark); }
        .form-control { width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">🚗 SteamWash Pro Anjay Mabar</a>
            
            <!-- Logika Menu Aktif -->
            <?php 
            $p = isset($_GET['page']) ? $_GET['page'] : 'home'; 
            ?>
            
            <ul class="navbar-nav">
                <!-- Menu Pelanggan -->
                <li>
                    <a class="nav-link <?= ($p == 'home' || $p == 'add_pelanggan' || $p == 'edit_pelanggan') ? 'active' : '' ?>" href="index.php">
                        Pelanggan
                    </a>
                </li>
                
                <!-- Menu Layanan -->
                <li>
                    <a class="nav-link <?= ($p == 'layanan' || $p == 'add_layanan' || $p == 'edit_layanan') ? 'active' : '' ?>" href="index.php?page=layanan">
                        Layanan
                    </a>
                </li>
                
                <!-- Menu Pegawai (Akan datang) -->
                <li>
                    <a class="nav-link <?= ($p == 'pegawai') ? 'active' : '' ?>" href="index.php?page=pegawai">
                        Pegawai
                    </a>
                </li>
                
                <!-- Menu Transaksi (Akan datang) -->
                <li>
                    <a class="nav-link <?= ($p == 'transaksi') ? 'active' : '' ?>" href="index.php?page=transaksi">
                        Transaksi
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container main-content">