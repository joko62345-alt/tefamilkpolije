<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- ============================================
     HERO BANNER - Galeri Milk
     ============================================ -->
<section class="gallery-hero-banner">
    <div class="banner-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <span class="banner-label">
                    <i class="bi bi-images me-2"></i>GALERI TEFA MILK
                </span>
                <h1 class="banner-title">Galeri Milk</h1>
                <p class="banner-description mx-auto">
                    Temukan momen, pengalaman, dan informasi menarik tentang TEFA Milk di sini.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION KEGIATAN KAMI
     ============================================ -->
<section class="gallery-content-section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Dokumentasi</span>
            <h2 class="section-heading-title">Kegiatan Kami</h2>
            <p class="section-heading-desc">
                Momen berharga dan aktivitas sehari-hari di TEFA Milk Polije
            </p>
        </div>

        <?php if (!empty($kegiatan)): ?>
            <div class="gallery-grid">
                <?php foreach ($kegiatan as $kg): ?>
                    <div class="gallery-card">
                        <div class="gallery-image-wrapper">
                            <img src="<?= (strpos($kg['image'], 'http') === 0) ? $kg['image'] : BASEURL . '/image/' . $kg['image']; ?>" 
                                 class="gallery-image" 
                                 alt="<?= htmlspecialchars($kg['title']); ?>">
                            <div class="gallery-overlay">
                                <div class="gallery-zoom-icon">
                                    <i class="bi bi-zoom-in"></i>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-content">
                            <h5 class="gallery-title"><?= htmlspecialchars($kg['title']); ?></h5>
                            <?php if (!empty($kg['description'])): ?>
                                <p class="gallery-desc"><?= htmlspecialchars($kg['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-camera"></i>
                </div>
                <h4 class="empty-title">Belum Ada Foto Kegiatan</h4>
                <p class="empty-text">Dokumentasi kegiatan akan segera ditambahkan.</p>
            </div>
        <?php endif; ?>

        <div class="section-cta">
            <a href="<?= BASEURL; ?>/home/galery" class="btn btn-outline-primary btn-lg">
                Lihat Lainnya <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION ARTIKEL TEFA MILK
     ============================================ -->
<section class="gallery-content-section bg-light-alt">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Informasi</span>
            <h2 class="section-heading-title">Artikel TEFA Milk</h2>
            <p class="section-heading-desc">
                Berita dan informasi seputar dunia persusuan dan TEFA Milk
            </p>
        </div>

        <?php if (!empty($artikel)): ?>
            <div class="gallery-grid">
                <?php foreach ($artikel as $art): ?>
                    <div class="gallery-card">
                        <div class="gallery-image-wrapper">
                            <img src="<?= (strpos($art['image'], 'http') === 0) ? $art['image'] : BASEURL . '/image/' . $art['image']; ?>" 
                                 class="gallery-image" 
                                 alt="<?= htmlspecialchars($art['title']); ?>">
                            <div class="gallery-overlay">
                                <div class="gallery-zoom-icon">
                                    <i class="bi bi-zoom-in"></i>
                                </div>
                            </div>
                            <div class="article-badge">
                                <i class="bi bi-newspaper"></i> Artikel
                            </div>
                        </div>
                        <div class="gallery-content">
                            <h5 class="gallery-title"><?= htmlspecialchars($art['title']); ?></h5>
                            <?php if (!empty($art['description'])): ?>
                                <p class="gallery-desc"><?= htmlspecialchars($art['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-journal-text"></i>
                </div>
                <h4 class="empty-title">Belum Ada Artikel</h4>
                <p class="empty-text">Artikel menarik akan segera dipublikasikan.</p>
            </div>
        <?php endif; ?>

        <div class="section-cta">
            <a href="<?= BASEURL; ?>/home/artikel" class="btn btn-outline-primary btn-lg">
                Lihat Lainnya <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION TESTIMONI
     ============================================ -->
<?php if (!empty($reviews)): ?>
<!-- ============================================
     SECTION TESTIMONI
     ============================================ -->
<section class="testimoni-section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Ulasan</span>
            <h2 class="section-heading-title">Testimoni TEFA Milk</h2>
            <p class="section-heading-desc">
                Apa kata pelanggan kami tentang produk TEFA Milk
            </p>
        </div>

        <div class="testimoni-slider">
            <?php 
            $defaultImages = ['milk3.jpg', 'milk2.jpg', 'milk5.jpg']; 
            $idx = 0;
            ?>
            <?php foreach (array_slice($reviews, 0, 3) as $rev): ?>
                <div class="testimoni-card">
                    <div class="testimoni-header">
                        <div class="testimoni-avatar">
                            <img src="<?= BASEURL; ?>/image/<?= !empty($rev['image']) ? htmlspecialchars($rev['image']) : $defaultImages[$idx % 3]; ?>" alt="Review Image">
                        </div>
                        <div class="testimoni-quote">
                            <i class="bi bi-quote"></i>
                        </div>
                    </div>
                    <div class="testimoni-body">
                        <h5 class="testimoni-name"><?= htmlspecialchars($rev['name']); ?></h5>
                        <div class="testimoni-stars">
                            <?php for ($i = 0; $i < $rev['rating']; $i++): ?>
                                <i class="bi bi-star-fill"></i>
                            <?php endfor; ?>
                            <?php for ($i = $rev['rating']; $i < 5; $i++): ?>
                                <i class="bi bi-star"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="testimoni-message"><?= htmlspecialchars($rev['message']); ?></p>
                    </div>
                </div>
                <?php $idx++; ?>
            <?php endforeach; ?>
        </div>

        <div class="section-cta">
            <a href="<?= BASEURL; ?>/home/ulasan" class="btn btn-outline-primary btn-lg">
                Lihat Lainnya <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once '../views/templates/footer.php'; ?>