<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- ============================================
     HERO BANNER - Keranjang
     ============================================ -->
<section class="cart-hero-banner">
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
                        <li class="breadcrumb-item active" aria-current="page">
                            Keranjang Belanja
                        </li>
                    </ol>
                </nav>
                <div class="banner-content">
                    <span class="banner-label">
                        <i class="bi bi-cart3 me-2"></i>SHOPPING CART
                    </span>
                    <h1 class="banner-title">Keranjang Belanja</h1>
                    <p class="banner-description">
                        Kelola produk yang ingin Anda beli dari TEFA MILK
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION KERANJANG
     ============================================ -->
<section class="cart-section">
    <div class="container">
        <?php Helper::flash(); ?>

        <?php if (empty($items)): ?>
            <!-- Empty State -->
            <div class="empty-cart-state">
                <div class="empty-icon-wrapper">
                    <i class="bi bi-cart-x"></i>
                </div>
                <h3 class="empty-title">Keranjang Anda Masih Kosong</h3>
                <p class="empty-text">Yuk, jelajahi katalog kami dan temukan produk susu segar favorit Anda!</p>
                <a href="<?= BASEURL; ?>/catalog" class="btn-explore-catalog">
                    <i class="bi bi-bag-fill me-2"></i>Jelajahi Katalog
                </a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="cart-header">
                        <h4 class="cart-header-title">
                            <i class="bi bi-bag-check me-2"></i>
                            Item di Keranjang
                            <span class="cart-count-badge"><?= count($items); ?></span>
                        </h4>
                    </div>

                    <?php foreach ($items as $item): ?>
                        <div class="cart-item-card">
                            <div class="row align-items-center g-3">
                                <!-- Image -->
                                <div class="col-3 col-md-2">
                                    <div class="cart-item-image-wrapper">
                                        <img src="<?= BASEURL; ?>/image/<?= $item['image']; ?>"
                                             alt="<?= htmlspecialchars($item['name']); ?>"
                                             class="cart-item-image">
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="col-9 col-md-5">
                                    <h6 class="cart-item-name"><?= htmlspecialchars($item['name']); ?></h6>
                                    <p class="cart-item-price">
                                        <?= Helper::formatRupiah($item['price']); ?> <span>/ unit</span>
                                    </p>
                                    <div class="cart-item-stock">
                                        <i class="bi bi-box-seam"></i>
                                        Stok: <?= $item['stock']; ?> unit
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="col-12 col-md-5">
                                    <div class="cart-item-actions">
                                        <!-- Quantity Control -->
                                        <form action="<?= BASEURL; ?>/cart/update" method="POST" class="quantity-form">
                                            <input type="hidden" name="item_id" value="<?= $item['id']; ?>">
                                            <div class="quantity-control">
                                                <button type="button" class="qty-btn" onclick="adjustQty(this, -1)">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="number" 
                                                       name="quantity" 
                                                       value="<?= $item['quantity']; ?>"
                                                       min="1" 
                                                       max="<?= $item['stock']; ?>"
                                                       class="qty-input">
                                                <button type="button" class="qty-btn" onclick="adjustQty(this, 1)">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                                <button type="submit" class="qty-update-btn" title="Update">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            </div>
                                        </form>

                                        <!-- Subtotal -->
                                        <div class="cart-item-subtotal">
                                            <span class="subtotal-label">Subtotal</span>
                                            <span class="subtotal-value">
                                                <?= Helper::formatRupiah($item['price'] * $item['quantity']); ?>
                                            </span>
                                        </div>

                                        <!-- Remove Button -->
                                        <button type="button" 
                                                class="btn-remove-item"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal" 
                                                data-item-id="<?= $item['id']; ?>" 
                                                data-product-name="<?= htmlspecialchars($item['name']); ?>">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="order-summary-card">
                        <div class="summary-header">
                            <i class="bi bi-receipt-cutoff"></i>
                            <h5>Ringkasan Pesanan</h5>
                        </div>

                        <div class="summary-body">
                            <div class="summary-row">
                                <span class="summary-label">Subtotal</span>
                                <span class="summary-value"><?= Helper::formatRupiah($total); ?></span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Ongkos Kirim</span>
                                <span class="summary-value free-shipping">
                                    <i class="bi bi-truck me-1"></i>Gratis
                                </span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Jumlah Item</span>
                                <span class="summary-value"><?= count($items); ?> produk</span>
                            </div>
                        </div>

                        <div class="summary-divider"></div>

                        <div class="summary-total">
                            <span class="total-label">Total Pembayaran</span>
                            <span class="total-value"><?= Helper::formatRupiah($total); ?></span>
                        </div>

                        <a href="<?= BASEURL; ?>/cart/checkout" class="btn-checkout">
                            <i class="bi bi-credit-card-fill me-2"></i>Lanjut ke Checkout
                        </a>

                        <a href="<?= BASEURL; ?>/catalog" class="btn-continue-shopping">
                            <i class="bi bi-arrow-left me-2"></i>Lanjutkan Belanja
                        </a>

                        <!-- Trust Badges -->
                        <div class="trust-badges">
                            <div class="trust-badge">
                                <i class="bi bi-shield-check"></i>
                                <span>Aman</span>
                            </div>
                            <div class="trust-badge">
                                <i class="bi bi-truck"></i>
                                <span>Cepat</span>
                            </div>
                            <div class="trust-badge">
                                <i class="bi bi-patch-check"></i>
                                <span>Terpercaya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============================================
     MODAL KONFIRMASI HAPUS
     ============================================ -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header">
                <div class="modal-icon-wrapper">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <h5 class="modal-title" id="deleteModalLabel">Hapus dari Keranjang?</h5>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                    Apakah Anda yakin ingin menghapus <strong id="productName">produk ini</strong> dari keranjang?
                </p>
                <div class="modal-note">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Anda dapat menambahkannya kembali ke keranjang kapan saja.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">
                    Batal
                </button>
                <form action="<?= BASEURL; ?>/cart/remove" method="POST" id="deleteForm">
                    <input type="hidden" name="item_id" id="itemId" value="">
                    <button type="submit" class="btn-confirm-delete">
                        <i class="bi bi-trash3 me-1"></i>Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Adjust quantity
function adjustQty(button, delta) {
    const form = button.closest('form');
    const input = form.querySelector('.qty-input');
    const max = parseInt(input.max);
    let val = parseInt(input.value) + delta;
    if (val < 1) val = 1;
    if (val > max) val = max;
    input.value = val;
}

// Handle delete modal
const deleteModal = document.getElementById('deleteModal');
if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const itemId = button.getAttribute('data-item-id');
        const productName = button.getAttribute('data-product-name');
        
        document.getElementById('itemId').value = itemId;
        document.getElementById('productName').textContent = productName;
    });
}
</script>

<?php require_once '../views/templates/footer.php'; ?>