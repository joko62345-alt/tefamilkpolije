<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<nav aria-label="breadcrumb" class="py-2 px-3" style="margin-top: 90px;">
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">
            <a href="<?= BASEURL; ?>/home/galery" class="fw-bold text-dark text-decoration-none">GALERI MILK</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            KEGIATAN TEFA MILK
        </li>
    </ol>
</nav>

<!-- Page Title -->
<h1 class="page-title text-center my-4 fw-bold">KEGIATAN KAMI</h1>

<!-- Gallery -->
<div class="gallery-container px-4">
    <?php if (!empty($galleries)): ?>
        <?php foreach ($galleries as $item): ?>
            <div class="gallery-item mb-4">
                <img src="<?= (strpos($item['image'], 'http') === 0) ? $item['image'] : BASEURL . '/image/' . $item['image']; ?>" alt="<?= htmlspecialchars($item['title']); ?>" style="width:100%; border-radius:10px; max-height: 400px; object-fit: cover;">
                <div class="gallery-caption text-center mt-2 fw-semibold"><?= htmlspecialchars($item['title']); ?></div>
                <div class="gallery-description text-center text-muted mt-1"><?= htmlspecialchars($item['description'] ?? ''); ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5">
            <p class="text-muted">Belum ada kegiatan tersedia.</p>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../views/templates/footer.php'; ?>
