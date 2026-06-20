<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- Hero Banner -->
<section class="checkout-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb modern-breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/home"><i class="bi bi-house-fill me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/cart">Keranjang</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </ol>
        </nav>
        <div class="banner-content">
            <span class="banner-label"><i class="bi bi-bag-check me-2"></i>CHECKOUT</span>
            <h1 class="banner-title">Selesaikan Pesanan</h1>
            <p class="banner-description">Lengkapi informasi pengiriman dan konfirmasi pesanan Anda</p>
        </div>
    </div>
</section>

<!-- Checkout Section -->
<section class="checkout-section">
    <div class="container">
        <?php Helper::flash(); ?>

        <form action="<?= BASEURL; ?>/cart/placeorder" method="POST" enctype="multipart/form-data" id="checkoutForm">
            <div class="row g-4">
                <!-- Left: Shipping & Payment -->
                <div class="col-lg-7">
                    <!-- Shipping Info -->
                    <div class="checkout-card">
                        <div class="card-header-custom">
                            <div class="card-icon"><i class="bi bi-geo-alt-fill"></i></div>
                            <h5>Informasi Pengiriman</h5>
                        </div>
                        <div class="card-body-custom">
                            <div class="form-group-custom">
                                <label class="form-label-custom">Nama Penerima</label>
                                <input type="text" class="form-control-custom readonly" value="<?= $user['name']; ?>" readonly>
                            </div>
                            <div class="form-group-custom">
                                <label class="form-label-custom">Nomor Telepon</label>
                                <input type="text" class="form-control-custom readonly" value="<?= $user['phone'] ?? '-'; ?>" readonly>
                            </div>
                            <div class="form-group-custom">
                                <label class="form-label-custom">Alamat Pengiriman <span class="required">*</span></label>
                                <textarea name="shipping_address" rows="3" class="form-control-custom" placeholder="Masukkan alamat pengiriman lengkap" required><?= $user['address'] ?? ''; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="checkout-card">
                        <div class="card-header-custom">
                            <div class="card-icon"><i class="bi bi-credit-card-fill"></i></div>
                            <h5>Metode Pembayaran</h5>
                        </div>
                        <div class="card-body-custom">
                            <div class="payment-methods">
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="Transfer Bank" required>
                                    <div class="payment-content">
                                        <i class="bi bi-bank"></i>
                                        <div>
                                            <strong>Transfer Bank</strong>
                                            <small>BRI / BNI / Mandiri</small>
                                        </div>
                                    </div>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="QRIS">
                                    <div class="payment-content">
                                        <i class="bi bi-qr-code"></i>
                                        <div>
                                            <strong>QRIS</strong>
                                            <small>Scan & Bayar</small>
                                        </div>
                                    </div>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="Tunai (COD)">
                                    <div class="payment-content">
                                        <i class="bi bi-cash-stack"></i>
                                        <div>
                                            <strong>Tunai (COD)</strong>
                                            <small>Bayar saat diterima</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            
                            <!-- Upload Bukti -->
                            <div id="paymentProofSection" class="payment-proof-section">
                                <label class="form-label-custom">
                                    <i class="bi bi-image me-1"></i>Upload Bukti Pembayaran <span class="required">*</span>
                                </label>
                                <small class="form-hint">Unggah screenshot atau foto bukti transfer/QRIS Anda (JPG, PNG, PDF)</small>
                                <input type="file" name="payment_proof" id="paymentProof" class="form-control-custom" accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Summary -->
                <div class="col-lg-5">
                    <div class="order-summary-card">
                        <div class="summary-header">
                            <i class="bi bi-receipt-cutoff"></i>
                            <h5>Ringkasan Pesanan</h5>
                        </div>
                        <div class="summary-body">
                            <?php foreach ($items as $item): ?>
                                <div class="summary-item">
                                    <div class="summary-item-info">
                                        <span class="item-name"><?= $item['name']; ?></span>
                                        <span class="item-qty">x<?= $item['quantity']; ?></span>
                                    </div>
                                    <span class="item-price"><?= Helper::formatRupiah($item['price'] * $item['quantity']); ?></span>
                                </div>
                            <?php endforeach; ?>

                            <div class="summary-divider"></div>

                            <div class="summary-row">
                                <span>Ongkos Kirim</span>
                                <span class="free-shipping"><i class="bi bi-truck me-1"></i>Gratis</span>
                            </div>

                            <div class="summary-total">
                                <span>Total Pembayaran</span>
                                <span class="total-value"><?= Helper::formatRupiah($total); ?></span>
                            </div>

                            <button type="button" class="btn-place-order" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                <i class="bi bi-bag-check-fill me-2"></i>Buat Pesanan
                            </button>

                            <a href="<?= BASEURL; ?>/cart" class="btn-back-cart">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header">
                <div class="modal-icon-wrapper"><i class="bi bi-bag-check-fill"></i></div>
                <h5 class="modal-title">Konfirmasi Pesanan</h5>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <p class="modal-text">Periksa kembali pesanan Anda sebelum melanjutkan</p>
                <div class="modal-note-box">
                    <p class="note-title"><strong>Poin Penting:</strong></p>
                    <ul>
                        <li>Pastikan alamat pengiriman sudah benar</li>
                        <li>Periksa metode pembayaran yang dipilih</li>
                        <li>Siapkan bukti pembayaran jika Transfer/QRIS</li>
                        <li>Pesanan tidak dapat dibatalkan setelah dikonfirmasi</li>
                    </ul>
                </div>
                <div class="modal-info">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Stok akan dikurangi setelah pesanan selesai diverifikasi.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-confirm" onclick="document.getElementById('checkoutForm').submit()">
                    <i class="bi bi-check-circle me-1"></i>Ya, Pesan Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
const paymentProofSection = document.getElementById('paymentProofSection');
const paymentProofInput = document.getElementById('paymentProof');

paymentMethods.forEach(method => {
    method.addEventListener('change', function() {
        document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('active'));
        this.closest('.payment-option').classList.add('active');
        
        if (this.value === 'Transfer Bank' || this.value === 'QRIS') {
            paymentProofSection.style.display = 'block';
            paymentProofInput.setAttribute('required', '');
        } else {
            paymentProofSection.style.display = 'none';
            paymentProofInput.removeAttribute('required');
        }
    });
});
</script>

<?php require_once '../views/templates/footer.php'; ?>