<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<?php if ($gallery): ?>
<!-- Breadcrumb -->
<nav class="container" style="margin-top: 100px;">
    <small class="text-secondary">
        <a href="<?= BASEURL; ?>/home/galery" class="text-decoration-none text-secondary">GALERI MILK</a> /
        <a href="<?= BASEURL; ?>/home/artikel" class="text-decoration-none text-secondary">ARTIKEL TEFA MILK</a> /
        <span class="text-dark"><?= htmlspecialchars($gallery['title']); ?></span>
    </small>
</nav>

<!-- Judul Halaman -->
<div class="container text-center mt-3">
    <h2 class="fw-bold text-dark">ARTIKEL TEFA MILK</h2>
</div>

<!-- Main Content -->
<main class="container my-5">
    <div class="row g-4 align-items-start justify-content-center">
        <!-- Gambar -->
        <div class="col-lg-4 d-flex justify-content-center">
            <img src="<?= (strpos($gallery['image'], 'http') === 0) ? $gallery['image'] : BASEURL . '/image/' . $gallery['image']; ?>" class="img-fluid rounded shadow w-100" style="max-width: 300px;" alt="<?= htmlspecialchars($gallery['title']); ?>">
        </div>

        <!-- Teks Artikel -->
        <div class="col-lg-8">
            <div class="p-4 rounded shadow" style="background-color: #fff7dd;">
                <h3 class="fw-bold text-dark mb-2"><?= htmlspecialchars($gallery['title']); ?></h3>
                <p class="text-muted small"><?= date('d - m - Y', strtotime($gallery['created_at'])); ?></p>

                <p class="text-dark lh-lg">
                    <?= htmlspecialchars($gallery['description'] ?? 'Tidak ada deskripsi'); ?>
                </p>
            </div>
        </div>
    </div>
</main>
<?php else: ?>
    <div class="container text-center py-5" style="margin-top: 100px;">
        <p class="text-muted">Artikel tidak ditemukan.</p>
        <a href="<?= BASEURL; ?>/home/artikel" class="btn btn-primary">Kembali ke Artikel</a>
    </div>
<?php endif; ?>

<?php require_once '../views/templates/footer.php'; ?>
