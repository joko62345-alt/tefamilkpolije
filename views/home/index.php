<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- Flash messages -->
<div class="container" style="margin-top: 100px; margin-bottom: -80px; position: relative; z-index: 1000;">
    <?php Helper::flash(); ?>
</div>
<section class="hero-section">
    <div class="hero-overlay"></div>
    
    <div class="container position-relative z-2">
        <div class="row align-items-center min-vh-100 py-5">
            <div class="col-lg-7 col-md-8 hero-content">
                <!-- Badge -->
                <div class="hero-badge">
                    <i class="bi bi-patch-check-fill"></i>
                    100% SUSU SEGAR
                </div>

                <!-- Judul -->
                <h1 class="hero-title">
                    Kebaikan Alami
                    <span class="script-text">Setiap Hari</span>
                </h1>

                <!-- Deskripsi -->
                <p class="hero-subtitle">
                    Susu segar berkualitas tinggi dengan nutrisi alami untuk keluarga sehat dan penuh energi.
                </p>

                <!-- Tombol -->
                <div class="hero-buttons">
                    <a href="<?= BASEURL; ?>/catalog" class="btn btn-primary btn-lg">
                        <i class="bi bi-bag-fill me-2"></i>Lihat Produk
                    </a>
                </div>

                <!-- Fitur/Keunggulan -->
                <div class="hero-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-droplet"></i>
                        </div>
                        <div class="feature-text">
                            <h6>100% Alami</h6>
                            <p>Tanpa bahan pengawet</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="feature-text">
                            <h6>Sumber Kalsium</h6>
                            <p>Untuk tulang kuat</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-droplet-fill"></i>
                        </div>
                        <div class="feature-text">
                            <h6>Protein Berkualitas</h6>
                            <p>Untuk tubuh sehat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- ============================================
     SECTION PRODUK REKOMENDASI
     ============================================ -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Rekomendasi</span>
            <h2 class="section-title">Produk Rekomendasi</h2>
            <p class="section-description">
                Produk pilihan yang paling disukai pelanggan kami
            </p>
        </div>

        <div class="row g-4">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $prod): ?>
                    <div class="col-md-4">
                        <div class="product-card-modern">
                            <div class="product-img-wrapper">
                                <span class="product-badge">Rekomendasi</span>
                                <img src="<?= BASEURL; ?>/image/<?= $prod['image']; ?>" alt="<?= $prod['name']; ?>">
                            </div>
                            <h3 class="product-title"><?= $prod['name']; ?></h3>
                            <p class="product-description"><?= substr($prod['description'], 0, 100) . (strlen($prod['description']) > 100 ? '...' : ''); ?></p>
                            <div class="product-price"><?= Helper::formatRupiah($prod['price']); ?></div>
                            <a href="<?= BASEURL; ?>/catalog/detail/<?= $prod['id']; ?>" class="btn btn-add-cart">
                                <i class="bi bi-eye"></i>Detail Produk
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Tidak ada produk rekomendasi.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?= BASEURL; ?>/catalog" class="btn btn-primary btn-lg px-5">
                Jelajahi Katalog <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION RASA TERBAIK (PROSES)
     ============================================ -->
<section class="section-padding" style="background: linear-gradient(135deg, #F0F9FF 0%, #FFFFFF 100%);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="section-subtitle">Proses Produksi</span>
                <h2 class="section-title text-start">Rasa Terbaik dari Proses</h2>
                <p class="section-description text-start" style="margin: 0;">
                    Susu TEFA dihasilkan langsung dari peternakan POLIJE dan diproses dengan standar higienis, modern, menghasilkan produk yang segar, berkualitas, dan alami.
                </p>
                
                <div class="row g-3 mt-4">
                    <div class="col-6">
                        <div class="process-stat">
                            <h3 class="stat-number">100%</h3>
                            <p class="stat-label">Susu Segar</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="process-stat">
                            <h3 class="stat-number">24h</h3>
                            <p class="stat-label">Proses Cepat</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="process-images-grid">
                    <img src="<?= BASEURL; ?>/image/proses1.jpg" alt="Proses 1" class="process-img">
                    <img src="<?= BASEURL; ?>/image/proses2.jpg" alt="Proses 2" class="process-img">
                    <img src="<?= BASEURL; ?>/image/proses3.jpg" alt="Proses 3" class="process-img">
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>