<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<nav aria-label="breadcrumb" class="py-2 px-3" style="margin-top: 90px;">
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">
            <a href="<?= BASEURL; ?>/home/galery" class="fw-bold text-dark text-decoration-none">GALERI MILK</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            ULASAN TEFA MILK
        </li>
    </ol>
</nav>

<h1 class="page-title mb-4 text-center fw-bold">ULASAN PELANGGAN</h1>

<div class="container mb-5">
    <div class="row g-4">
        <?php if (!empty($reviews)): ?>
            <?php 
            $defaultImages = ['milk3.jpg', 'milk2.jpg', 'milk5.jpg']; 
            $idx = 0;
            ?>
            <?php foreach ($reviews as $rev): ?>
                <div class="col-md-4">
                    <div class="card review-card shadow-sm p-0 h-100">
                        <div class="position-relative">
                            <img src="<?= BASEURL; ?>/image/<?= !empty($rev['image']) ? htmlspecialchars($rev['image']) : $defaultImages[$idx % 3]; ?>" class="w-100 top-image" alt="Testimonial Image">
                            <div class="quote-circle">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="fw-bold mt-3 mb-1"><?= $rev['name']; ?></h5>
                                    <div class="stars text-warning mb-1">
                                        <?php for ($i = 0; $i < $rev['rating']; $i++): ?>
                                            <i class="fa-solid fa-star"></i>
                                        <?php endfor; ?>
                                        <?php for ($i = $rev['rating']; $i < 5; $i++): ?>
                                            <i class="fa-regular fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <span class="text-muted small mt-3"><?= date('d-m-Y', strtotime($rev['created_at'])); ?></span>
                            </div>

                            <p class="testimonial-text text-muted mb-0 flex-grow-1" id="text-<?= $rev['id']; ?>">
                                <?= $rev['message']; ?>
                            </p>
                            
                            <?php if (strlen($rev['message']) > 150): ?>
                                <span class="read-more-btn small mt-1" onclick="toggleReadMore(<?= $rev['id']; ?>)" id="btn-<?= $rev['id']; ?>">Baca Selengkapnya</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php $idx++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-4">
                <p class="text-muted">Belum ada ulasan pelanggan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function toggleReadMore(id) {
        const textElem = document.getElementById('text-' + id);
        const btnElem = document.getElementById('btn-' + id);
        
        if (textElem.classList.contains('expanded')) {
            textElem.classList.remove('expanded');
            textElem.style.display = '-webkit-box';
            textElem.style.webkitLineClamp = '3';
            textElem.style.webkitBoxOrient = 'vertical';
            textElem.style.overflow = 'hidden';
            btnElem.textContent = 'Baca Selengkapnya';
        } else {
            textElem.classList.add('expanded');
            textElem.style.display = 'block';
            textElem.style.overflow = 'visible';
            btnElem.textContent = 'Tutup';
        }
    }
</script>

<?php require_once '../views/templates/footer.php'; ?>
