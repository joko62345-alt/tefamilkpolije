<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- Flash messages -->
<div class="container" style="margin-top: 100px; margin-bottom: -80px; position: relative; z-index: 1000;">
    <?php Helper::flash(); ?>
</div>

<section class="hero-section">
    <div class="hero-background">
        <img src="<?= BASEURL; ?>/image/header-bg.png" class="hero-bg-img" alt="Hero Background">
    </div>
    <div class="hero-content">
        <h1>Dari Sumber Terbaik untuk Hidup Sehat</h1>
        <p>Rasakan perbedaan di setiap tegukan</p>
        <a class="hero-btn-primary" href="<?= BASEURL; ?>/catalog">Telusuri Produk</a>
        <a class="hero-btn-outline" href="<?= BASEURL; ?>/home/galery">Lihat Gallery Kami</a>
    </div>
</section>

<!-- PRODUK KAMI -->
<section class="produk-kami mb-5">
    <h2>PRODUK KAMI</h2>
    <div class="container produk-grid">
        <div class="produk-card">
            <img src="<?= BASEURL; ?>/image/pk1.jpg" alt="Susu Original">
            <h3>Susu Original</h3>
            <p>Nikmati kesegaran alami dari susu sapi pilihan yang diolah secara higienis. Kaya nutrisi dan cocok untuk konsumsi langsung maupun campuran minuman favorit Anda.</p>
        </div>
        <div class="produk-card">
            <img src="<?= BASEURL; ?>/image/pk2.jpg" alt="Susu Skim">
            <h3>Susu Skim</h3>
            <p>Susu rendah lemak dengan tetap mempertahankan kandungan protein dan kalsium. Ideal untuk gaya hidup sehat, diet, atau kebutuhan industri pangan.</p>
        </div>
        <div class="produk-card">
            <img src="<?= BASEURL; ?>/image/pk3.jpg" alt="Susu Cream">
            <h3>Susu Cream</h3>
            <p>Tekstur lembut dengan rasa lebih kaya, cocok untuk campuran kopi, dessert, atau produk olahan. Diolah dengan standar kualitas tinggi untuk hasil maksimal.</p>
        </div>
    </div>
</section>

<section class="best">
    <div class="container best-content">
        <div>
            <h2>RASA TERBAIK DARI PROSES</h2>
            <p>Susu TEFA dihasilkan langsung dari peternakan POLIJE dan diproses dengan standar higienis, modern, menghasilkan produk yang segar, berkualitas, dan alami.</p>
        </div>
        <div class="best-images">
            <img src="<?= BASEURL; ?>/image/proses1.jpg" alt="Proses 1">
            <img src="<?= BASEURL; ?>/image/proses2.jpg" alt="Proses 2">
            <img src="<?= BASEURL; ?>/image/proses3.jpg" alt="Proses 3">
        </div>
    </div>
</section>

<!-- PRODUK REKOMENDASI -->
<section class="rekomendasi mt-3">
    <h2>PRODUK REKOMENDASI</h2>
    <div class="container produk-reko-grid">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $prod): ?>
                <div class="reko-card">
                    <img src="<?= BASEURL; ?>/image/<?= $prod['image']; ?>" alt="<?= $prod['name']; ?>">
                    <h3><?= $prod['name']; ?></h3>
                    <p><?= substr($prod['description'], 0, 150) . (strlen($prod['description']) > 150 ? '...' : ''); ?></p>
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="harga d-block"><?= Helper::formatRupiah($prod['price']); ?></span>
                        </div>
                        <div class="col-6 text-end">
                            <a href="<?= BASEURL; ?>/catalog/detail/<?= $prod['id']; ?>" class="btn-reko text-center w-100 d-inline-block">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-4">
                <p class="text-muted">Tidak ada produk rekomendasi.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<div class="container mb-5 text-end">
    <a href="<?= BASEURL; ?>/catalog" class="btn-jelajahi">Jelajahi Katalog</a>
</div>

<?php require_once '../views/templates/footer.php'; ?>
