<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Admin – TEFA MILK'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
        body { background: #f4f6f9; margin: 0; }

        /* Sidebar */
        #sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #2d2a26 0%, #3d3a34 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: 0.3s;
            overflow-y: auto;
        }
        #sidebar .sidebar-brand {
            padding: 22px 20px 14px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        #sidebar .sidebar-brand img { height: 38px; }
        #sidebar .sidebar-brand span {
            color: #E4947D;
            font-weight: 700;
            font-size: 1.15rem;
            display: block;
            margin-top: 4px;
        }
        #sidebar .sidebar-brand small { color: rgba(255,255,255,0.5); font-size: 0.72rem; }
        #sidebar nav { padding: 10px 0; }
        #sidebar .nav-section {
            color: rgba(255,255,255,0.35);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 14px 20px 4px;
        }
        #sidebar a.nav-link {
            color: rgba(255,255,255,0.75);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.88rem;
            font-weight: 500;
            border-radius: 0;
            transition: 0.2s;
        }
        #sidebar a.nav-link:hover,
        #sidebar a.nav-link.active {
            background: rgba(228,148,125,0.18);
            color: #E4947D;
            border-left: 3px solid #E4947D;
        }
        #sidebar a.nav-link i { font-size: 1rem; width: 20px; text-align: center; }

        /* Content */
        #content {
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Bar */
        #topbar {
            background: #fff;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }
        #topbar .topbar-title { font-weight: 600; font-size: 1.05rem; color: #2d2a26; }
        #topbar .admin-info { display: flex; align-items: center; gap: 12px; }
        #topbar .admin-avatar {
            width: 36px; height: 36px;
            background: #E4947D;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }
        #topbar .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }
        #topbar .logout-btn:hover {
            background: #c82333;
            color: white;
        }

        /* Page content area */
        .page-content { padding: 28px; flex: 1; }

        /* Stat cards */
        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            transition: 0.25s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
        .stat-card .icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 12px;
        }
        .stat-card .value { font-size: 1.9rem; font-weight: 700; color: #2d2a26; line-height: 1; }
        .stat-card .label { color: #888; font-size: 0.82rem; margin-top: 4px; }

        /* Table styles */
        .admin-table { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.05); }
        .admin-table th { background: #FAF3D6; color: #2d2a26; font-weight: 600; font-size: 0.85rem; }
        .admin-table td { vertical-align: middle; font-size: 0.88rem; }

        /* Form cards */
        .form-card { background: white; border-radius: 14px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.05); }
        .form-card label { font-weight: 600; font-size: 0.85rem; color: #444; }
        .btn-primary-custom { background: #E4947D; color: white; border: none; border-radius: 8px; padding: 8px 22px; font-weight: 600; }
        .btn-primary-custom:hover { background: #d6836c; color: white; }

        @media (max-width: 768px) {
            #sidebar { width: 0; overflow: hidden; }
            #content { margin-left: 0; }
        }
    </style>
</head>
<body>
<!-- SIDEBAR -->
<div id="sidebar">
    <div class="sidebar-brand">
        <img src="<?= BASEURL; ?>/image/polije.png" alt="Logo">
        <span>TEFA MILK</span>
        <small>Admin Dashboard</small>
    </div>
    <nav>
        <?php
        $cur = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
        function adminActive($path) {
            global $cur;
            return $cur === $path ? 'active' : '';
        }
        ?>
        <div class="nav-section">Utama</div>
        <a href="<?= BASEURL; ?>/admin" class="nav-link <?= adminActive('admin'); ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section">Produk</div>
        <a href="<?= BASEURL; ?>/admin/categories" class="nav-link <?= adminActive('admin/categories'); ?>">
            <i class="bi bi-tags"></i> Kategori
        </a>
        <a href="<?= BASEURL; ?>/admin/products" class="nav-link <?= adminActive('admin/products'); ?>">
            <i class="bi bi-box-seam"></i> Produk
        </a>

        <div class="nav-section">Pelanggan</div>
        <a href="<?= BASEURL; ?>/admin/customers" class="nav-link <?= adminActive('admin/customers'); ?>">
            <i class="bi bi-people"></i> Pelanggan
        </a>

        <div class="nav-section">Transaksi</div>
        <a href="<?= BASEURL; ?>/admin/orders" class="nav-link <?= adminActive('admin/orders'); ?>">
            <i class="bi bi-bag-check"></i> Kelola Pesanan
        </a>
        <a href="<?= BASEURL; ?>/admin/report" class="nav-link <?= adminActive('admin/report'); ?>">
            <i class="bi bi-bar-chart-line"></i> Laporan Penjualan
        </a>

        <div class="nav-section">Konten</div>
        <a href="<?= BASEURL; ?>/admin/gallery" class="nav-link <?= adminActive('admin/gallery'); ?>">
            <i class="bi bi-images"></i> Galeri
        </a>
        <a href="<?= BASEURL; ?>/admin/partners" class="nav-link <?= adminActive('admin/partners'); ?>">
            <i class="bi bi-people-fill"></i> Mitra
        </a>
        <a href="<?= BASEURL; ?>/admin/reviews" class="nav-link <?= adminActive('admin/reviews'); ?>">
            <i class="bi bi-chat-square-text"></i> Ulasan
        </a>

        <div class="nav-section">Akun</div>
        <a href="<?= BASEURL; ?>/home" class="nav-link">
            <i class="bi bi-house"></i> Lihat Website
        </a>
        <a href="<?= BASEURL; ?>/auth/logout" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </nav>
</div>

<!-- TOP BAR -->
<div id="content">
    <div id="topbar">
        <span class="topbar-title"><?= isset($pageTitle) ? $pageTitle : 'Dashboard'; ?></span>
        <div class="admin-info">
            <div class="admin-avatar"><?= strtoupper(substr(Helper::getUserName(), 0, 1)); ?></div>
            <div>
                <div class="fw-semibold small"><?= Helper::getUserName(); ?></div>
                <div class="text-muted" style="font-size:0.72rem;">Administrator</div>
            </div>
            <a href="<?= BASEURL; ?>/auth/logout" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>
    <div class="page-content">
