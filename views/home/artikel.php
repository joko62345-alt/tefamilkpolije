<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<nav aria-label="breadcrumb" class="py-2 px-3" style="margin-top: 90px;">
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">
            <a href="<?= BASEURL; ?>/home/galery" class="fw-bold text-dark text-decoration-none">GALERI MILK</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            ARTIKEL TEFA MILK
        </li>
    </ol>
</nav>

<!-- Page Title -->
<h1 class="page-title text-center my-4 fw-bold">ARTIKEL TEFA MILK</h1>

<!-- Gallery -->
<div class="artikel-content container mb-5">
    <div class="row g-4 justify-content-center">
        <?php if (!empty($galleries)): ?>
            <?php foreach ($galleries as $item): ?>
                <div class="col-md-4 text-center">
                    <div class="gallery-item shadow-sm p-2 rounded bg-white">
                        <a href="<?= BASEURL; ?>/home/artikeldetail/<?= $item['id']; ?>">
                            <img src="<?= (strpos($item['image'], 'http') === 0) ? $item['image'] : BASEURL . '/image/' . $item['image']; ?>" class="img-fluid rounded object-cover w-100" style="height: 220px;" alt="<?= htmlspecialchars($item['title']); ?>">
                        </a>
                        <div class="fw-semibold mt-2"><?= htmlspecialchars($item['title']); ?></div>
                        <div class="small text-muted mt-1"><?= htmlspecialchars(substr($item['description'] ?? '', 0, 60)); ?>...</div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada artikel tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../views/templates/footer.php'; ?>
