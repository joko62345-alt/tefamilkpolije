<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<div class="container mt-5 pt-4 mb-5">
    <h2 class="fw-bold mb-1">Riwayat Pesanan</h2>
    <p class="text-muted small mb-4">Daftar pesanan yang pernah Anda buat di TEFA MILK</p>

    <?php Helper::flash(); ?>

    <?php if (empty($orders)): ?>
        <div class="text-center py-5">
            <i class="bi bi-bag-x" style="font-size:4rem; color:#E4947D;"></i>
            <h5 class="mt-3 text-muted">Belum ada pesanan</h5>
            <a href="<?= BASEURL; ?>/catalog" class="btn mt-3 text-white fw-bold px-4" style="background:#E4947D; border-radius:8px;">
                Belanja Sekarang
            </a>
        </div>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px; overflow:hidden;">
                <!-- Order Header -->
                <div class="card-header d-flex justify-content-between align-items-center px-4 py-3"
                     style="background:#FAF3D6; border-bottom:1.5px solid #e2d9b8;">
                    <div>
                        <span class="fw-bold">Pesanan #<?= $order['id']; ?></span>
                        <span class="text-muted small ms-3">
                            <?= date('d M Y, H:i', strtotime($order['order_date'])); ?>
                        </span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <?php
                        $statusColor = ['Menunggu' => 'warning', 'Diproses' => 'info', 'Selesai' => 'success'];
                        $color = $statusColor[$order['status']] ?? 'secondary';
                        ?>
                        <span class="badge bg-<?= $color; ?> fs-6 px-3 py-2"><?= $order['status']; ?></span>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="card-body px-4 py-3 bg-white">
                    <?php foreach ($order['details'] as $detail): ?>
                        <div class="d-flex align-items-center gap-3 mb-2 pb-2 border-bottom">
                            <img src="<?= BASEURL; ?>/image/<?= $detail['image']; ?>"
                                 style="width:55px; height:55px; object-fit:cover; border-radius:8px;" alt="">
                            <div class="flex-grow-1">
                                <div class="fw-semibold small"><?= $detail['name']; ?></div>
                                <div class="text-muted small">
                                    <?= Helper::formatRupiah($detail['price']); ?> x <?= $detail['quantity']; ?>
                                </div>
                            </div>
                            <div class="fw-bold small" style="color:#E4947D;">
                                <?= Helper::formatRupiah($detail['price'] * $detail['quantity']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            <i class="bi bi-geo-alt me-1"></i><?= $order['shipping_address']; ?><br>
                            <i class="bi bi-credit-card me-1"></i><?= $order['payment_method']; ?>
                        </div>
                        <div class="text-end">
                            <div class="text-muted small">Total Pembayaran</div>
                            <div class="fw-bold fs-5" style="color:#E4947D;"><?= Helper::formatRupiah($order['total_price']); ?></div>
                        </div>
                    </div>

                    <!-- Bukti pembayaran jika ada -->
                    <?php if (!empty($order['payment_proof'])): ?>
                        <div class="mt-3 pt-3 border-top">
                            <small class="text-muted">Bukti Pembayaran:</small>
                            <a href="<?= BASEURL; ?>/proofs/payment/<?= htmlspecialchars($order['payment_proof']); ?>" target="_blank" class="btn btn-sm btn-outline-primary mt-2">Lihat Bukti</a>
                        </div>
                    <?php endif; ?>

                    <!-- Upload bukti penerimaan jika pesanan diproses dan belum ada delivery proof -->
                    <?php if ($order['status'] === 'Diproses'): ?>
                        <?php if (empty($order['delivery_proof'])): ?>
                            <div class="mt-3 pt-3 border-top">
                                <form action="<?= BASEURL; ?>/cart/upload_delivery_proof" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                    <small class="text-muted d-block mb-2"><i class="bi bi-image me-1" style="color:#E4947D;"></i>Upload foto produk yang sudah Anda terima untuk diverifikasi admin:</small>
                                    <div class="d-flex gap-2 flex-column flex-sm-row">
                                        <input type="file" name="delivery_proof" class="form-control form-control-sm" accept=".jpg,.jpeg,.png" required>
                                        <button type="submit" class="btn btn-sm text-white" style="background:#E4947D; border:none; border-radius:6px;">Unggah Bukti</button>
                                    </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="mt-3 pt-3 border-top">
                                <small class="text-muted d-block mb-2">Bukti penerimaan sudah diupload. Tunggu verifikasi admin untuk menyelesaikan pesanan.</small>
                                <a href="<?= BASEURL; ?>/proofs/delivery/<?= htmlspecialchars($order['delivery_proof']); ?>" target="_blank" class="btn btn-sm btn-outline-success">Lihat Bukti</a>
                            </div>
                        <?php endif; ?>
                    <?php elseif ($order['status'] === 'Menunggu'): ?>
                        <div class="mt-3 pt-3 border-top">
                            <small class="text-muted">Pesanan Anda sedang menunggu verifikasi pembayaran atau proses admin.</small>
                        </div>
                    <?php endif; ?>

                    <!-- Bukti penerimaan jika pesanan selesai -->
                    <?php if ($order['status'] === 'Selesai' && !empty($order['delivery_proof'])): ?>
                        <div class="mt-3 pt-3 border-top">
                            <small class="text-muted">Bukti penerimaan:</small>
                            <a href="<?= BASEURL; ?>/proofs/delivery/<?= htmlspecialchars($order['delivery_proof']); ?>" target="_blank" class="btn btn-sm btn-outline-success mt-2">Lihat Bukti</a>
                        </div>
                    <?php endif; ?>

                    <!-- Form review untuk pesanan selesai -->
                    <?php if ($order['status'] === 'Selesai'): ?>
                        <div class="mt-3 pt-3 border-top">
                            <button type="button" class="btn btn-sm text-white" style="background:#E4947D; border:none; border-radius:6px;"
                                    data-bs-toggle="modal" data-bs-target="#reviewModal" 
                                    data-order-id="<?= $order['id']; ?>" 
                                    data-order-num="<?= $order['id']; ?>">
                                <i class="bi bi-chat-square-heart me-1"></i> Berikan Ulasan
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Modal Review -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #E4947D 0%, #d47a63 100%); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white fw-bold" id="reviewModalLabel">
                    <i class="bi bi-star-fill me-2"></i> Berikan Ulasan untuk Pesanan #<span id="orderNum"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <form action="<?= BASEURL; ?>/cart/add_review" method="POST" enctype="multipart/form-data" id="reviewForm">
                    <input type="hidden" name="order_id" id="orderId">
                    
                    <!-- Rating -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Rating <span class="text-danger">*</span></label>
                        <div id="ratingStars" class="d-flex gap-2 fs-5">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="bi bi-star rating-star" data-value="<?= $i; ?>" style="cursor: pointer; color: #ddd;" onclick="setRating(<?= $i; ?>)"></i>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" name="rating" id="ratingValue" value="5">
                    </div>

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Ulasan</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Produk Berkualitas" value="Produk Bagus">
                    </div>

                    <!-- Pesan -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ulasan <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Bagikan pengalaman Anda menggunakan produk ini..." required></textarea>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto (Opsional)</label>
                        <input type="file" name="review_image" class="form-control" accept="image/jpeg,image/png">
                        <small class="text-muted">Format: JPG, PNG (Max 3MB)</small>
                    </div>

                    <div class="modal-footer border-0 pt-0 gap-2 px-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">
                            Batal
                        </button>
                        <button type="submit" class="btn text-white fw-bold" style="background: #E4947D; border: none; border-radius: 6px;">
                            <i class="bi bi-send me-1"></i> Kirim Ulasan
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
                star.style.color = '#ffc107';
            } else {
                star.classList.add('bi-star');
                star.classList.remove('bi-star-fill');
                star.style.color = '#ddd';
            }
        });
    }

    // Initialize rating modal
    const reviewModal = document.getElementById('reviewModal');
    if (reviewModal) {
        reviewModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const orderId = button.getAttribute('data-order-id');
            const orderNum = button.getAttribute('data-order-num');
            
            document.getElementById('orderId').value = orderId;
            document.getElementById('orderNum').textContent = orderNum;
            setRating(5); // Reset rating to 5 stars
        });
    }
</script>

<?php require_once '../views/templates/footer.php'; ?>
