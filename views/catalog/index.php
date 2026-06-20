<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<?php
function getCategoryFilter($name) {
    $lower = strtolower($name);
    if (strpos($lower, 'segar') !== false) return 'segar';
    if (strpos($lower, 'pasteurisasi') !== false) return 'pasteurisasi';
    if (strpos($lower, 'uht') !== false) return 'uht';
    if (strpos($lower, 'krim') !== false || strpos($lower, 'cream') !== false) return 'krim';
    if (strpos($lower, 'skim') !== false) return 'skim';
    return str_replace(' ', '-', strtolower($name));
}
?>

<!-- ============================================
     HERO BANNER - Katalog Produk
     ============================================ -->
<section class="catalog-hero-banner">
    <div class="banner-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center py-5">
            <div class="col-lg-6">
                <span class="banner-label">
                    <i class="bi bi-bag-fill me-2"></i>KATALOG PRODUK
                </span>
                <h1 class="banner-title">
                    Pilihan Susu Berkualitas
                    <span class="script-text">untuk Keluarga Sehat</span>
                </h1>
                <p class="banner-description">
                    Tefa Milk Polije menghadirkan berbagai produk susu berkualitas tinggi dengan nutrisi terbaik untuk mendukung gaya hidup sehat Anda.
                </p>

                <!-- Fitur Unggulan -->
                <div class="hero-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-droplet-fill"></i>
                        </div>
                        <div class="feature-text">
                            <h6>Susu Segar Berkualitas</h6>
                            <p>Diproses dengan standar higienis</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="feature-text">
                            <h6>Aman & Bersertifikasi</h6>
                            <p>Memenuhi standar keamanan pangan</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-seedling"></i>
                        </div>
                        <div class="feature-text">
                            <h6>Tanpa Pengawet Buatan</h6>
                            <p>100% alami dan sehat</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="feature-text">
                            <h6>Untuk Seluruh Keluarga</h6>
                            <p>Cocok untuk semua usia</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Gambar Produk -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-product-showcase">
                    <img src="<?= BASEURL; ?>/image/2.png" alt="Produk TEFA Milk" class="hero-product-img">
                </div>
            </div>
        </div>
    </div>

    
<!-- ============================================
     SECTION KATALOG PRODUK
     ============================================ -->
<section id="katalog" class="catalog-section">
    <div class="container">
        <?php Helper::flash(); ?>

        <div class="section-heading">
            <span class="section-label">Produk Kami</span>
            <h2 class="section-heading-title">Katalog Produk</h2>
            <p class="section-heading-desc">
                Susu berkualitas premium untuk kesehatan keluarga Anda
            </p>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-wrapper">
            <button class="btn filter-btn active" data-filter="all">
                <i class="bi bi-grid-fill me-1"></i>Semua
            </button>
            <?php foreach ($categories as $cat): ?>
                <?php $filterVal = getCategoryFilter($cat['name']); ?>
                <button class="btn filter-btn" data-filter="<?= $filterVal; ?>">
                    <?= $cat['name']; ?>
                </button>
            <?php endforeach; ?>
        </div>
        
        <!-- Product Grid -->
        <div class="row g-4">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $prod): ?>
                    <?php $filterAttr = getCategoryFilter($prod['category_name']); ?>
                    <div class="col-lg-4 col-md-6 product-card" data-category="<?= $filterAttr; ?>">
                        <div class="product-card-inner">
                            <!-- Badge Kategori -->
                            <div class="product-category-badge">
                                <?= $prod['category_name']; ?>
                            </div>

                            <!-- Gambar Produk (FULL terlihat, tidak terpotong) -->
                            <div class="product-image-wrapper">
                                <img src="<?= BASEURL; ?>/image/<?= $prod['image']; ?>" 
                                     class="product-image" 
                                     alt="<?= $prod['name']; ?>">
                            </div>

                            <!-- Info Produk -->
                            <div class="product-info">
                                <h5 class="product-name"><?= $prod['name']; ?></h5>
                                <p class="product-description"><?= substr($prod['description'], 0, 80) . (strlen($prod['description']) > 80 ? '...' : ''); ?></p>
                                
                                <div class="product-meta">
                                    <div class="product-price">
                                        <span class="price-label">Harga</span>
                                        <span class="price-value"><?= Helper::formatRupiah($prod['price']); ?></span>
                                    </div>
                                    <div class="product-stock">
                                        <i class="bi bi-box-seam"></i>
                                        <span>Stok: <?= $prod['stock']; ?></span>
                                    </div>
                                </div>

                                <a href="<?= BASEURL; ?>/catalog/detail/<?= $prod['id']; ?>" class="btn btn-detail">
                                    <i class="bi bi-eye-fill me-1"></i>Detail Produk
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-bag-x"></i>
                        </div>
                        <h4 class="empty-title">Produk Tidak Tersedia</h4>
                        <p class="empty-text">Silakan cek kembali nanti untuk produk terbaru kami.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Script Filter -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active from all
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            productCards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
});
</script>

<?php require_once '../views/templates/footer.php'; ?>