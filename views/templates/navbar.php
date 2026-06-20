<?php
$current_page = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

// Calculate cart count dynamically if customer is logged in
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
<nav class="navbar navbar-expand-lg navbar-light custom-navbar fixed-top">
    <div class="container px-4">
        <img src="<?= BASEURL; ?>/image/polije.png" alt="Logo Politeknik" class="navbar-logo" style="max-height: 40px;">
        <a class="navbar-brand ms-3 fw-bold" href="<?= BASEURL; ?>/home">TEFA MILK</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto nav-underline align-items-center">
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page === '' || $current_page === 'home' || $current_page === 'home/index') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/home">Beranda</a>
                </li>
                
                <!-- Dropdown for Profil pages -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= (strpos($current_page, 'home/profil') !== false || $current_page === 'home/tentang') ? 'active' : ''; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarDropdown" style="background-color: #FAF3D6;">
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/home/profil_perusahaan">Profil Perusahaan</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/home/profil_tim">Profil Tim</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/home/tentang">Tentang Kami</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($current_page, 'catalog') !== false) ? 'active' : ''; ?>" href="<?= BASEURL; ?>/catalog">Katalog Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page === 'home/galery') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/home/galery">Galeri Milk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page === 'home/mitra_kerjasama') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/home/mitra_kerjasama">Mitra Kerjasama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page === 'home/kontak') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/home/kontak">Kontak</a>
                </li>

                <!-- User Session Actions -->
                <?php if (Helper::isLoggedIn()): ?>
                    <?php if (Helper::getUserRole() === 'customer'): ?>
                        <li class="nav-item ms-lg-2 position-relative">
                            <a class="nav-link <?= (strpos($current_page, 'cart') !== false && strpos($current_page, 'history') === false) ? 'active' : ''; ?>" href="<?= BASEURL; ?>/cart">
                                <i class="bi bi-cart3 fs-5"></i>
                                <?php if ($cartCount > 0): ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                                        <?= $cartCount; ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="btn btn-outline-dark dropdown-toggle px-3 py-1 fw-semibold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 20px; border-color: #E4947D; color: #d6836c;">
                                <i class="bi bi-person-circle me-1"></i> <?= explode(' ', Helper::getUserName())[0]; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm" aria-labelledby="userDropdown" style="background-color: #FAF3D6;">
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>/profile"><i class="bi bi-person me-2"></i>Edit Profil</a></li>
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>/cart/history"><i class="bi bi-bag-check me-2"></i>Riwayat Pesanan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= BASEURL; ?>/auth/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php elseif (Helper::getUserRole() === 'admin'): ?>
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-dark px-3 py-1 fw-semibold me-2" href="<?= BASEURL; ?>/admin" style="background: #2d2a26; border: none; border-radius: 20px;">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-danger px-3 py-1 fw-semibold" href="<?= BASEURL; ?>/auth/logout" style="border-radius: 20px;">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-dark px-3 py-1 fw-semibold me-2" href="<?= BASEURL; ?>/auth/login" style="border-radius: 20px; border-color: #E4947D; color: #d6836c;">Login</a>
                        <a class="btn text-white px-3 py-1 fw-semibold" href="<?= BASEURL; ?>/auth/register" style="border-radius: 20px; background: #E4947D;">Daftar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
