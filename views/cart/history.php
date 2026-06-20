<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- Hero Banner -->
<section class="history-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb modern-breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/home"><i class="bi bi-house-fill me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item active">Riwayat Pesanan</li>
            </ol>
        </nav>
        <div class="banner-content">
            <span class="banner-label"><i class="bi bi-clock-history me-2"></i>ORDER HISTORY</span>
            <h1 class="banner-title">Riwayat Pesanan</h1>
            <p class="banner-description">Daftar pesanan yang pernah Anda buat di TEFA MILK</p>
        </div>
    </div>
</section>

<!-- History Section -->
<section class="history-section">
    <div class="container">
        <?php Helper::flash(); ?>

        <?php if (empty($orders)): ?>
            <!-- Empty State -->
            <div class="empty-history-state">
                <div class="empty-icon-wrapper">
                    <i class="bi bi-bag-x"></i>
                </div>
                <h3 class="empty-title">Belum Ada Pesanan</h3>
                <p class="empty-text">Yuk, mulai belanja dan temukan produk susu segar favorit Anda!</p>
                <a href="<?= BASEURL; ?>/catalog" class="btn-shop-now">
                    <i class="bi bi-bag-fill me-2"></i>Belanja Sekarang
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <!-- Order Header -->
                    <div class="order-header">
                        <div class="order-info">
                            <span class="order-number">Pesanan #<?= $order['id']; ?></span>
                            <span class="order-date">
                                <i class="bi bi-calendar3 me-1"></i>
                                <?= date('d M Y, H:i', strtotime($order['order_date'])); ?>
                            </span>
                        </div>
                        <?php
                        $statusClass = [
                            'Menunggu' => 'status-waiting',
                            'Diproses' => 'status-processing',
                            'Selesai' => 'status-completed'
                        ];
                        $statusIcon = [
                            'Menunggu' => 'bi-hourglass-split',
                            'Diproses' => 'bi-truck',
                            'Selesai' => 'bi-check-circle-fill'
                        ];
                        $class = $statusClass[$order['status']] ?? 'status-default';
                        $icon = $statusIcon[$order['status']] ?? 'bi-circle';
                        ?>
                        <span class="order-status <?= $class; ?>">
                            <i class="bi <?= $icon; ?>"></i>
                            <?= $order['status']; ?>
                        </span>
                    </div>

                    <!-- Order Items -->
                    <div class="order-body">
                        <?php foreach ($order['details'] as $detail): ?>
                            <div class="order-item">
                                <div class="item-image-wrapper">
                                    <img src="<?= BASEURL; ?>/image/<?= $detail['image']; ?>" alt="<?= $detail['name']; ?>" class="item-image">
                                </div>
                                <div class="item-info">
                                    <h6 class="item-name"><?= $detail['name']; ?></h6>
                                    <p class="item-price-qty">
                                        <?= Helper::formatRupiah($detail['price']); ?> x <?= $detail['quantity']; ?>
                                    </p>
                                </div>
                                <div class="item-subtotal">
                                    <?= Helper::formatRupiah($detail['price'] * $detail['quantity']); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Order Footer Info -->
                        <div class="order-footer-info">
                            <div class="info-left">
                                <div class="info-row">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span><?= $order['shipping_address']; ?></span>
                                </div>
                                <div class="info-row">
                                    <i class="bi bi-credit-card-fill"></i>
                                    <span><?= $order['payment_method']; ?></span>
                                </div>
                            </div>
                            <div class="info-right">
                                <span class="total-label">Total Pembayaran</span>
                                <span class="total-value"><?= Helper::formatRupiah($order['total_price']); ?></span>
                            </div>
                        </div>

                        <!-- Payment Proof -->
                        <?php if (!empty($order['payment_proof'])): ?>
                            <div class="proof-section">
                                <small class="proof-label">Bukti Pembayaran:</small>
                                <a href="<?= BASEURL; ?>/proofs/payment/<?= htmlspecialchars($order['payment_proof']); ?>" 
                                   target="_blank" 
                                   class="btn-view-proof">
                                    <i class="bi bi-eye-fill me-1"></i>Lihat Bukti
                                </a>
                            </div>
                        <?php endif; ?>

                        <!-- Upload Delivery Proof (Status: Diproses) -->
                        <?php if ($order['status'] === 'Diproses'): ?>
                            <?php if (empty($order['delivery_proof'])): ?>
                                <div class="upload-section">
                                    <form action="<?= BASEURL; ?>/cart/upload_delivery_proof" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                        <label class="upload-label">
                                            <i class="bi bi-image me-1"></i>Upload foto produk yang sudah Anda terima:
                                        </label>
                                        <div class="upload-row">
                                            <input type="file" name="delivery_proof" class="form-control-custom" accept=".jpg,.jpeg,.png" required>
                                            <button type="submit" class="btn-upload">
                                                <i class="bi bi-cloud-upload me-1"></i>Unggah Bukti
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            <?php else: ?>
                                <div class="proof-uploaded-section">
                                    <small class="proof-label">Bukti penerimaan sudah diupload. Anda dapat memberikan ulasan sekarang.</small>
                                    <div class="proof-actions">
                                        <a href="<?= BASEURL; ?>/proofs/delivery/<?= htmlspecialchars($order['delivery_proof']); ?>" 
                                           target="_blank" 
                                           class="btn-view-proof success">
                                            <i class="bi bi-eye-fill me-1"></i>Lihat Bukti
                                        </a>
                                        <button type="button" 
                                                class="btn-review"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#reviewModal"
                                                data-order-id="<?= $order['id']; ?>">
                                            <i class="bi bi-chat-square-heart me-1"></i>Berikan Ulasan
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php elseif ($order['status'] === 'Menunggu'): ?>
                            <div class="waiting-section">
                                <i class="bi bi-hourglass-split"></i>
                                <span>Pesanan Anda sedang menunggu verifikasi pembayaran atau proses admin.</span>
                            </div>
                        <?php endif; ?>

                        <!-- Review Button (Status: Selesai) -->
                        <?php if ($order['status'] === 'Selesai'): ?>
                            <?php if (!empty($order['delivery_proof'])): ?>
                                <div class="proof-section">
                                    <small class="proof-label">Bukti penerimaan:</small>
                                    <a href="<?= BASEURL; ?>/proofs/delivery/<?= htmlspecialchars($order['delivery_proof']); ?>" 
                                       target="_blank" 
                                       class="btn-view-proof success">
                                        <i class="bi bi-eye-fill me-1"></i>Lihat Bukti
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="review-section">
                                <button type="button" 
                                        class="btn-review primary"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#reviewModal"
                                        data-order-id="<?= $order['id']; ?>">
                                    <i class="bi bi-chat-square-heart me-1"></i>Berikan Ulasan
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Modal Review -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content custom-modal">
            <div class="modal-header">
                <div class="modal-icon-wrapper"><i class="bi bi-star-fill"></i></div>
                <h5 class="modal-title">Berikan Ulasan</h5>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/cart/add_review" method="POST" enctype="multipart/form-data" id="reviewForm">
                    <input type="hidden" name="order_id" id="orderId">
                    
                    <!-- Rating -->
                    <div class="form-group-custom">
                        <label class="form-label-custom">Rating <span class="required">*</span></label>
                        <div class="rating-stars" id="ratingStars">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="bi bi-star rating-star" data-value="<?= $i; ?>" onclick="setRating(<?= $i; ?>)"></i>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" name="rating" id="ratingValue" value="5">
                    </div>

                    <!-- Title -->
                    <div class="form-group-custom">
                        <label class="form-label-custom">Judul Ulasan</label>
                        <input type="text" name="title" class="form-control-custom" placeholder="Contoh: Produk Berkualitas" value="Produk Bagus">
                    </div>

                    <!-- Message -->
                    <div class="form-group-custom">
                        <label class="form-label-custom">Ulasan <span class="required">*</span></label>
                        <textarea name="message" class="form-control-custom" rows="4" placeholder="Bagikan pengalaman Anda menggunakan produk ini..." required></textarea>
                    </div>

                    <!-- Image -->
                    <div class="form-group-custom">
                        <label class="form-label-custom">Foto (Opsional)</label>
                        <input type="file" name="review_image" class="form-control-custom" accept="image/jpeg,image/png">
                        <small class="form-hint">Format: JPG, PNG (Max 3MB)</small>
                    </div>

                    <div class="modal-footer-custom">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-submit-review">
                            <i class="bi bi-send me-1"></i>Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function setRating(value) {
    document.getElementById('ratingValue').value = value;
    const stars = document.querySelectorAll('.rating-star');
    stars.forEach((star, idx) => {
        if (idx < value) {
            star.classList.remove('bi-star');
            star.classList.add('bi-star-fill');
        } else {
            star.classList.add('bi-star');
            star.classList.remove('bi-star-fill');
        }
    });
}

const reviewModal = document.getElementById('reviewModal');
if (reviewModal) {
    reviewModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const orderId = button.getAttribute('data-order-id');
        document.getElementById('orderId').value = orderId;
        setRating(5);
    });
}
</script>

<?php require_once '../views/templates/footer.php'; ?>