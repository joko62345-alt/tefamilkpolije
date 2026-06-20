<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<div class="container mt-5 pt-4 mb-5">
    <h2 class="fw-bold mb-1">Checkout</h2>
    <p class="text-muted small mb-4">Lengkapi informasi pengiriman dan konfirmasi pesanan Anda</p>

    <?php Helper::flash(); ?>

    <form action="<?= BASEURL; ?>/cart/placeorder" method="POST" enctype="multipart/form-data" id="checkoutForm">
        <div class="row g-4">
            <!-- Shipping Info -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4 mb-4" style="background:#FAF3D6; border-radius:12px;">
                    <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2" style="color:#E4947D;"></i>Informasi Pengiriman</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Penerima</label>
                        <input type="text" class="form-control" value="<?= $user['name']; ?>" readonly style="background:#fff8ee; border-color:#E4947D;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nomor Telepon</label>
                        <input type="text" class="form-control" value="<?= $user['phone'] ?? '-'; ?>" readonly style="background:#fff8ee; border-color:#E4947D;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Alamat Pengiriman <span class="text-danger">*</span></label>
                        <textarea name="shipping_address" rows="3"
                                  class="form-control"
                                  placeholder="Masukkan alamat pengiriman lengkap"
                                  style="border-color:#E4947D;"
                                  required><?= $user['address'] ?? ''; ?></textarea>
                    </div>
                </div>

                <div class="card border-0 shadow-sm p-4" style="background:#FAF3D6; border-radius:12px;">
                    <h5 class="fw-bold mb-3"><i class="bi bi-credit-card me-2" style="color:#E4947D;"></i>Metode Pembayaran</h5>
                    <div class="d-flex flex-column gap-2" id="paymentMethods">
                        <label class="d-flex align-items-center gap-3 p-3 rounded border" style="cursor:pointer; border-color:#E4947D !important; background:#fff8ee;">
                            <input type="radio" name="payment_method" value="Transfer Bank" required> Transfer Bank (BRI / BNI / Mandiri)
                        </label>
                        <label class="d-flex align-items-center gap-3 p-3 rounded border" style="cursor:pointer;">
                            <input type="radio" name="payment_method" value="QRIS"> QRIS
                        </label>
                        <label class="d-flex align-items-center gap-3 p-3 rounded border" style="cursor:pointer;">
                            <input type="radio" name="payment_method" value="Tunai (COD)"> Tunai (COD) – Bayar saat diterima
                        </label>
                    </div>
                    
                    <!-- Upload bukti pembayaran untuk Transfer/QRIS -->
                    <div id="paymentProofSection" style="display:none; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e2d9b8;">
                        <label class="form-label fw-semibold small"><i class="bi bi-image me-2" style="color:#E4947D;"></i>Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                        <small class="text-muted d-block mb-2">Unggah screenshot atau foto bukti transfer/QRIS Anda (JPG, PNG, PDF)</small>
                        <input type="file" name="payment_proof" id="paymentProof" class="form-control" accept=".jpg,.jpeg,.png,.pdf" style="border-color:#E4947D;">
                    </div>
                </div>

                <script>
                    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
                    const paymentProofSection = document.getElementById('paymentProofSection');
                    const paymentProofInput = document.getElementById('paymentProof');
                    
                    paymentMethods.forEach(method => {
                        method.addEventListener('change', function() {
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
            </div>

            <!-- Order Summary -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4" style="background:#FAF3D6; border-radius:12px; position:sticky; top:100px;">
                    <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                    <?php foreach ($items as $item): ?>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="fw-semibold small"><?= $item['name']; ?></span>
                                <span class="text-muted small d-block">x<?= $item['quantity']; ?></span>
                            </div>
                            <span class="small fw-bold" style="color:#E4947D;">
                                <?= Helper::formatRupiah($item['price'] * $item['quantity']); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="d-flex justify-content-between mb-1 text-muted small">
                        <span>Ongkos Kirim</span>
                        <span class="text-success fw-semibold">Gratis</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold mt-2 mb-4">
                        <span>Total Pembayaran</span>
                        <span style="color:#E4947D; font-size:1.15rem;"><?= Helper::formatRupiah($total); ?></span>
                    </div>
                    <button type="button" class="btn w-100 text-white fw-bold py-2"
                            style="background:#E4947D; border:none; border-radius:8px;"
                            data-bs-toggle="modal" data-bs-target="#confirmModal">
                        <i class="bi bi-bag-check me-1"></i> Buat Pesanan
                    </button>
                    <a href="<?= BASEURL; ?>/cart" class="btn btn-outline-secondary w-100 mt-2" style="border-radius:8px;">
                        Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Konfirmasi Pesanan -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #E4947D 0%, #d47a63 100%); border-radius: 12px 12px 0 0;">
                    <h5 class="modal-title text-white fw-bold" id="confirmModalLabel">
                        <i class="bi bi-exclamation-circle me-2"></i> Konfirmasi Pesanan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="mb-3 text-center">
                        <i class="bi bi-bag-check" style="font-size: 48px; color: #E4947D;"></i>
                    </div>
                    <h6 class="text-center mb-3">Periksa kembali pesanan Anda sebelum melanjutkan</h6>
                    
                    <div style="background: #FAF3D6; border-radius: 8px; padding: 16px; margin-bottom: 16px;">
                        <p class="mb-2"><strong>Poin Penting:</strong></p>
                        <ul class="mb-0 ps-3" style="font-size: 14px; line-height: 1.8;">
                            <li>Pastikan alamat pengiriman sudah benar</li>
                            <li>Periksa metode pembayaran yang dipilih</li>
                            <li>Siapkan bukti pembayaran jika Transfer/QRIS</li>
                            <li>Pesanan tidak dapat dibatalkan setelah dikonfirmasi</li>
                        </ul>
                    </div>

                    <div class="alert alert-info small mb-0" style="border-radius: 8px;">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Informasi:</strong> Stok akan dikurangi setelah pesanan selesai diverifikasi.
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 gap-2">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">
                        Batal
                    </button>
                    <button type="button" class="btn text-white fw-bold" style="background: #E4947D; border: none; border-radius: 6px;" 
                            onclick="document.getElementById('checkoutForm').submit()">
                        <i class="bi bi-check-circle me-1"></i> Ya, Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/templates/footer.php'; ?>
