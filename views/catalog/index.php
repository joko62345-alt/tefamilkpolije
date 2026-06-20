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

<section class="hero-section">
    <div class="hero-background">
        <img src="<?= BASEURL; ?>/image/header-bg.png" alt="hero-bg-img" class="hero-bg-img">
    </div>
    <div class="hero-content">
        <h1>Susu Segar • Rasa Asli • Kualitas Terbaik</h1>
        <p>Diproduksi dengan standar industri oleh mahasiswa berkompeten di TEFA Milk POLIJE.</p>
        <a href="#katalog" class="hero-btn-primary">Jelajahi Katalog</a>
    </div>
</section>

<!-- KATALOG -->
<section id="katalog" class="py-5">
    <div class="container">
        <?php Helper::flash(); ?>

        <h2 class="text-center fw-bold mb-2">KATALOG PRODUK</h2>
        <p class="text-center mb-4 text-muted">Susu berkualitas premium untuk kesehatan keluarga Anda</p>

        <!-- Filter Tabs -->
        <div class="filter-wrapper mb-4 text-center">
            <button class="btn filter-btn active" data-filter="all">Semua</button>
            <?php foreach ($categories as $cat): ?>
                <?php $filterVal = getCategoryFilter($cat['name']); ?>
                <button class="btn filter-btn" data-filter="<?= $filterVal; ?>"><?= $cat['name']; ?></button>
            <?php endforeach; ?>
        </div>
        
        <!-- Product Grid -->
        <div class="row g-4">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $prod): ?>
                    <?php $filterAttr = getCategoryFilter($prod['category_name']); ?>
                    <div class="col-md-4 product-card" data-category="<?= $filterAttr; ?>">
                        <div class="card shadow-sm border-0 p-3 h-100 d-flex flex-column justify-content-between" style="background: #FAF3D6; border: 1.5px solid #eee;">
                            <div>
                                <img src="<?= BASEURL; ?>/image/<?= $prod['image']; ?>" class="card-img-top rounded" alt="<?= $prod['name']; ?>" style="height: 200px; object-fit: cover;">
                                <div class="card-body px-0">
                                    <h5 class="fw-bold text-dark"><?= $prod['name']; ?></h5>
                                    <p class="text-muted small mb-0"><?= $prod['description']; ?></p>
                                </div>
                            </div>
                            <div class="row align-items-center mt-3">
                                <div class="col-6">
                                    <p class="fw-bold mb-0 text-dark" style="font-size: 1.05rem;"><?= Helper::formatRupiah($prod['price']); ?></p>
                                    <small class="text-muted">Stok: <?= $prod['stock']; ?></small>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="<?= BASEURL; ?>/catalog/detail/<?= $prod['id']; ?>" class="btn produk-button w-100 text-center py-2 fw-semibold" style="background: #E4947D; color: #fff; border: none; border-radius: 8px;">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Produk tidak tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>
