<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- ============================================
     HERO BANNER - Detail Produk
     ============================================ -->
<section class="detail-hero-banner">
    <div class="banner-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center py-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb modern-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= BASEURL; ?>/home" class="text-decoration-none">
                                <i class="bi bi-house-fill me-1"></i>Beranda
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= BASEURL; ?>/catalog" class="text-decoration-none">Katalog Produk</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Detail Produk
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION DETAIL PRODUK
     ============================================ -->
<section class="product-detail-section">
    <div class="container">
        <?php Helper::flash(); ?>

        <div class="row g-5 align-items-start">
            <!-- LEFT: IMAGE -->
            <div class="col-lg-6">
                <div class="product-image-container">
                    <div class="product-image-wrapper">
                        <img src="<?= BASEURL; ?>/image/<?= $product['image']; ?>"
                             class="product-image"
                             alt="<?= htmlspecialchars($product['name']); ?>"
                             id="mainProductImage">
                    </div>
                    
                    <!-- Badge Status -->
                    <div class="product-status-badge <?= $product['stock'] > 0 ? 'in-stock' : 'out-of-stock'; ?>">
                        <?php if ($product['stock'] > 0): ?>
                            <i class="bi bi-check-circle-fill"></i> Tersedia (<?= $product['stock']; ?> unit)
                        <?php else: ?>
                            <i class="bi bi-x-circle-fill"></i> Stok Habis
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- RIGHT: DETAILS -->
            <div class="col-lg-6">
                <!-- Category -->
                <div class="product-category">
                    <span class="category-badge"><?= htmlspecialchars($product['category_name']); ?></span>
                </div>

                <!-- Product Name -->
                <h1 class="product-title"><?= htmlspecialchars($product['name']); ?></h1>

                <!-- Price -->
                <div class="product-price-box">
                    <span class="price-label">Harga</span>
                    <span class="price-value"><?= Helper::formatRupiah($product['price']); ?></span>
                </div>

                <!-- Description -->
                <div class="product-description-box">
                    <h5 class="description-title">
                        <i class="bi bi-info-circle me-2"></i>Deskripsi Produk
                    </h5>
                    <p class="description-text"><?= nl2br(htmlspecialchars($product['description'])); ?></p>
                </div>

                <!-- Action Area -->
                <div class="product-action-box">
                    <?php if (Helper::isLoggedIn() && Helper::getUserRole() === 'customer'): ?>
                        <form action="<?= BASEURL; ?>/cart/add" method="POST" class="add-to-cart-form">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <div class="quantity-selector">
                                <label class="quantity-label">Jumlah:</label>
                                <div class="quantity-control">
                                    <button type="button" class="qty-btn" onclick="adjustQty(-1)">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" 
                                           name="quantity" 
                                           id="qty" 
                                           value="1" 
                                           min="1" 
                                           max="<?= $product['stock']; ?>"
                                           class="qty-input"
                                           readonly>
                                    <button type="button" class="qty-btn" onclick="adjustQty(1)">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                                <small class="text-muted mt-2 d-block">
                                    <i class="bi bi-box-seam me-1"></i>Stok tersedia: <?= $product['stock']; ?> unit
                                </small>
                            </div>

                            <?php if ($product['stock'] > 0): ?>
                                <button type="submit" class="btn-add-to-cart">
                                    <i class="bi bi-cart-plus-fill me-2"></i>
                                    Tambah ke Keranjang
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn-add-to-cart disabled" disabled>
                                    <i class="bi bi-x-circle me-2"></i>
                                    Stok Habis
                                </button>
                            <?php endif; ?>
                        </form>

                        <!-- WhatsApp Button -->
                        <a href="https://wa.me/6287729664976?text=Halo, saya ingin memesan <?= urlencode($product['name']); ?> (Rp <?= number_format($product['price'],0,',','.'); ?>)"
                           target="_blank"
                           class="btn-whatsapp">
                            <i class="bi bi-whatsapp me-2"></i>
                            Chat WhatsApp untuk Pemesanan
                        </a>
                    <?php elseif (Helper::isLoggedIn() && Helper::getUserRole() === 'admin'): ?>
                        <div class="alert-admin">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            Anda login sebagai Admin
                        </div>
                    <?php else: ?>
                        <div class="alert-login">
                            <i class="bi bi-lock me-2"></i>
                            <p class="mb-2">Silakan login untuk menambahkan produk ke keranjang</p>
                            <div class="login-buttons">
                                <a href="<?= BASEURL; ?>/auth/login" class="btn-login">Login</a>
                                <a href="<?= BASEURL; ?>/auth/register" class="btn-register">Daftar</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Product Info Cards -->
                <div class="product-info-cards">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div class="info-text">
                            <h6>Pengiriman Cepat</h6>
                            <p>Proses pesanan & kirim di hari yang sama</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="info-text">
                            <h6>Produk Terjamin</h6>
                            <p>100% asli & berkualitas tinggi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION PRODUK SERUPA (Optional)
     ============================================ -->
<?php if (isset($relatedProducts) && !empty($relatedProducts)): ?>
<section class="related-products-section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Rekomendasi</span>
            <h2 class="section-heading-title">Produk Serupa</h2>
        </div>
        
        <div class="row g-4">
            <?php foreach ($relatedProducts as $related): ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="<?= BASEURL; ?>/catalog/detail/<?= $related['id']; ?>" class="related-product-card">
                        <div class="related-image-wrapper">
                            <img src="<?= BASEURL; ?>/image/<?= $related['image']; ?>" 
                                 class="related-image" 
                                 alt="<?= htmlspecialchars($related['name']); ?>">
                        </div>
                        <h6 class="related-name"><?= htmlspecialchars($related['name']); ?></h6>
                        <p class="related-price"><?= Helper::formatRupiah($related['price']); ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
function adjustQty(delta) {
    const input = document.getElementById('qty');
    const max = parseInt(input.max);
    let val = parseInt(input.value) + delta;
    if (val < 1) val = 1;
    if (val > max) val = max;
    input.value = val;
}
</script>

<?php require_once '../views/templates/footer.php'; ?>