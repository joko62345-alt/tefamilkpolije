<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- HERO -->
<section class="hero-section">
    <div class="hero-background"><div class="hero-ellipse"></div></div>
    <div class="hero-content">
        <h1 class="hero-title">GALERI MILK</h1>
        <p class="hero-subtitle">Temukan momen, pengalaman, dan informasi menarik tentang TEFA Milk di sini.</p>
    </div>
</section>

<!-- KEGIATAN -->
<section class="section kegiatan-section">
    <div class="section-header">
        <h2 class="section-title">KEGIATAN KAMI</h2>
        <a href="<?= BASEURL; ?>/home/tentang"><button class="view-more-btn">Lihat Lainnya</button></a>
    </div>

    <div class="gallery-container kegiatan-gallery">
        <?php if (!empty($kegiatan)): ?>
            <?php foreach ($kegiatan as $kg): ?>
                <div class="gallery-card">
                    <img src="<?= (strpos($kg['image'], 'http') === 0) ? $kg['image'] : BASEURL . '/image/' . $kg['image']; ?>" class="gallery-item" alt="<?= $kg['title']; ?>">
                    <div class="gallery-caption">
                        <h6 class="mb-1"><?= htmlspecialchars($kg['title']); ?></h6>
                        <p class="small text-muted mb-0"><?= htmlspecialchars($kg['description'] ?? ''); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted ps-3">Belum ada foto kegiatan.</p>
        <?php endif; ?>
    </div>

    <div class="gallery-navigation kegiatan-nav">
        <img src="<?= BASEURL; ?>/image/kiri2.png" class="nav-arrow left" alt="Prev">
        <img src="<?= BASEURL; ?>/image/kanan2.png" class="nav-arrow right" alt="Next">
    </div>
</section>

<!-- ARTIKEL -->
<section class="section artikel-section">
    <div class="section-header">
        <h2 class="section-title">ARTIKEL TEFA MILK</h2>
        <a href="<?= BASEURL; ?>/home/artikel"><button class="view-more-btn">Lihat Lainnya</button></a>
    </div>

    <div class="gallery-container artikel-gallery">
        <?php if (!empty($artikel)): ?>
            <?php foreach ($artikel as $art): ?>
                <div class="gallery-card">
                    <img src="<?= (strpos($art['image'], 'http') === 0) ? $art['image'] : BASEURL . '/image/' . $art['image']; ?>" class="gallery-item" alt="<?= $art['title']; ?>">
                    <div class="gallery-caption">
                        <h6 class="mb-1"><?= htmlspecialchars($art['title']); ?></h6>
                        <p class="small text-muted mb-0"><?= htmlspecialchars($art['description'] ?? ''); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted ps-3">Belum ada foto artikel.</p>
        <?php endif; ?>
    </div>

    <div class="gallery-navigation artikel-nav">
        <img src="<?= BASEURL; ?>/image/kiri2.png" class="nav-arrow left" alt="Prev">
        <img src="<?= BASEURL; ?>/image/kanan2.png" class="nav-arrow right" alt="Next">
    </div>
</section>

<!-- TESTIMONI -->
<section class="section testimoni-section">
    <div class="section-header">
        <h2 class="section-title">TESTIMONI TEFA MILK</h2>
        <a href="<?= BASEURL; ?>/home/ulasan"><button class="view-more-btn">Lihat Lainnya</button></a>
    </div>

    <!-- Horizontal Scroll Wrapper -->
    <div class="gallery-container testimoni-gallery" style="padding-bottom: 20px;">
        <?php if (!empty($reviews)): ?>
            <?php 
            $images = ['milk3.jpg', 'milk2.jpg', 'milk5.jpg']; 
            $idx = 0;
            ?>
            <?php foreach ($reviews as $rev): ?>
                <div class="card review-card" style="min-width: 350px;">
                    <div class="position-relative">
                        <img src="<?= BASEURL; ?>/image/<?= $images[$idx % 3]; ?>" class="top-image" alt="Review Image">
                        <div class="quote-circle"><i class="fa-solid fa-quote-left"></i></div>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold mt-3 mb-1"><?= $rev['name']; ?></h5>
                        <div class="stars text-warning mb-1">
                            <?php for ($i = 0; $i < $rev['rating']; $i++): ?>
                                <i class="fa-solid fa-star"></i>
                            <?php endfor; ?>
                            <?php for ($i = $rev['rating']; $i < 5; $i++): ?>
                                <i class="fa-regular fa-star"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-muted clamp-3"><?= $rev['message']; ?></p>
                    </div>
                </div>
                <?php $idx++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted ps-3">Belum ada ulasan pelanggan.</p>
        <?php endif; ?>
    </div>

    <div class="gallery-navigation testimoni-nav">
        <img src="<?= BASEURL; ?>/image/kiri2.png" class="nav-arrow left" alt="Prev">
        <img src="<?= BASEURL; ?>/image/kanan2.png" class="nav-arrow right" alt="Next">
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>
