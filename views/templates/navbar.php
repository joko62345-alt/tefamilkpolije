<?php
$current_page = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

// Calculate cart count dynamically
$cartCount = 0;
if (Helper::isLoggedIn() && Helper::getUserRole() === 'customer') {
    try {
        $db = new Database();
        $db->query("SELECT SUM(quantity) as count FROM cart_items ci 
                    JOIN carts c ON ci.cart_id = c.id 
                    WHERE c.user_id = :user_id");
        $db->bind(':user_id', Helper::getUserId());
        $res = $db->single();
        $cartCount = $res['count'] ? $res['count'] : 0;
    } catch (Exception $e) {
        $cartCount = 0;
    }
}
?>

<nav class="navbar navbar-expand-lg custom-navbar fixed-top">
    <div class="container px-4">
        <!-- Logo & Brand -->
        <a class="navbar-brand d-flex align-items-center" href="<?= BASEURL; ?>/home">
            <img src="<?= BASEURL; ?>/image/polije.png" alt="Logo Politeknik" class="navbar-logo" style="max-height: 40px;">
            <span class="ms-3 fw-bold fs-5" style="color: #1E293B;">TEFA MILK</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- HAPUS class nav-underline di sini! -->
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Menu Beranda -->
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page === '' || $current_page === 'home' || $current_page === 'home/index') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/home">Beranda</a>
                </li>
                
                <!-- Dropdown Profil -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= (strpos($current_page, 'home/profil') !== false || $current_page === 'home/tentang') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/home/profil_perusahaan">Profil Perusahaan</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/home/profil_tim">Profil Tim</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/home/tentang">Tentang Kami</a></li>
                    </ul>
                </li>
                
                <!-- Menu Lainnya -->
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($current_page, 'catalog') !== false) ? 'active' : ''; ?>" href="<?= BASEURL; ?>/catalog">Katalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page === 'home/galery') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/home/galery">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page === 'home/mitra_kerjasama') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/home/mitra_kerjasama">Mitra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page === 'home/kontak') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/home/kontak">Kontak</a>
                </li>

                <!-- Separator -->
                <div class="mx-2 d-none d-lg-block" style="width: 1px; height: 24px; background: #E2E8F0;"></div>

                <!-- User Session Actions -->
                <?php if (Helper::isLoggedIn()): ?>
                    <?php if (Helper::getUserRole() === 'customer'): ?>
                        <!-- Cart Icon -->
                        <li class="nav-item me-2 position-relative">
                            <a class="nav-link px-2" href="<?= BASEURL; ?>/cart">
                                <i class="bi bi-cart3 fs-5"></i>
                                <?php if ($cartCount > 0): ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #2563EB; font-size: 0.65rem;">
                                        <?= $cartCount; ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                        
                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; background: #F0F9FF;">
                                    <i class="bi bi-person-fill" style="color: #2563EB;"></i>
                                </div>
                                <span class="fw-medium d-none d-lg-block"><?= explode(' ', Helper::getUserName())[0]; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>/profile"><i class="bi bi-person me-2"></i>Edit Profil</a></li>
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>/cart/history"><i class="bi bi-bag-check me-2"></i>Riwayat Pesanan</a></li>
                                <li><hr class="dropdown-divider my-2"></li>
                                <li><a class="dropdown-item text-danger" href="<?= BASEURL; ?>/auth/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </li>

                    <?php elseif (Helper::getUserRole() === 'admin'): ?>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-primary btn-sm px-3 py-2" href="<?= BASEURL; ?>/admin">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-outline-danger btn-sm px-3 py-2" href="<?= BASEURL; ?>/auth/logout">Logout</a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Guest Buttons - UBAH class-nya! -->
                    <li class="nav-item ms-lg-2 d-flex gap-2">
                        <a class="btn btn-outline-primary btn-sm px-4 py-2 fw-medium" href="<?= BASEURL; ?>/auth/login">Login</a>
                        <a class="btn btn-primary btn-sm px-4 py-2 fw-medium" href="<?= BASEURL; ?>/auth/register">Daftar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>