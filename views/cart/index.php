<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<div class="container mt-5 pt-4 mb-5">
    <h2 class="fw-bold mb-1">Keranjang Belanja</h2>
    <p class="text-muted small mb-4">Kelola produk yang ingin Anda beli dari TEFA MILK</p>

    <?php Helper::flash(); ?>

    <?php if (empty($items)): ?>
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 4rem; color: #E4947D;"></i>
            <h5 class="mt-3 text-muted">Keranjang Anda masih kosong</h5>
            <a href="<?= BASEURL; ?>/catalog" class="btn mt-3 text-white fw-bold px-4" style="background:#E4947D; border-radius:8px;">
                Jelajahi Katalog
            </a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <?php foreach ($items as $item): ?>
                    <div class="card border-0 shadow-sm mb-3 p-3" style="background:#FAF3D6; border-radius:12px;">
                        <div class="row align-items-center g-3">
                            <div class="col-3 col-md-2">
                                <img src="<?= BASEURL; ?>/image/<?= $item['image']; ?>"
                                     alt="<?= $item['name']; ?>"
                                     style="width:100%; height:70px; object-fit:cover; border-radius:8px;">
                            </div>
                            <div class="col-5 col-md-6">
                                <h6 class="fw-bold mb-1"><?= $item['name']; ?></h6>
                                <span class="text-muted small"><?= Helper::formatRupiah($item['price']); ?> / unit</span>
                            </div>
                            <div class="col-4 col-md-4 text-end">
                                <!-- Update quantity -->
                                <form action="<?= BASEURL; ?>/cart/update" method="POST" class="d-flex align-items-center justify-content-end gap-2 mb-2">
                                    <input type="hidden" name="item_id" value="<?= $item['id']; ?>">
                                    <input type="number" name="quantity" value="<?= $item['quantity']; ?>"
                                           min="1" max="<?= $item['stock']; ?>"
                                           class="form-control form-control-sm text-center fw-bold"
                                           style="width:60px; border-color:#E4947D;">
                                    <button type="submit" class="btn btn-sm text-white" style="background:#E4947D; border:none; border-radius:6px; padding:4px 10px;">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </form>
                                <!-- Remove -->
                                <button type="button" class="btn btn-sm btn-outline-danger" style="border-radius:6px; font-size:0.8rem;"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                        data-item-id="<?= $item['id']; ?>" data-product-name="<?= htmlspecialchars($item['name']); ?>">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                                <div class="fw-bold mt-2 text-end" style="color:#E4947D;">
                                    <?= Helper::formatRupiah($item['price'] * $item['quantity']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4" style="background:#FAF3D6; border-radius:12px; position:sticky; top:100px;">
                    <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                    <div class="d-flex justify-content-between mb-2 text-muted small">
                        <span>Subtotal</span>
                        <span><?= Helper::formatRupiah($total); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-muted small">
                        <span>Ongkos Kirim</span>
                        <span class="text-success fw-semibold">Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold mb-4">
                        <span>Total</span>
                        <span style="color:#E4947D; font-size:1.1rem;"><?= Helper::formatRupiah($total); ?></span>
                    </div>
                    <a href="<?= BASEURL; ?>/cart/checkout"
                       class="btn w-100 text-white fw-bold py-2"
                       style="background:#E4947D; border:none; border-radius:8px;">
                        <i class="bi bi-credit-card me-1"></i> Lanjut ke Checkout
                    </a>
                    <a href="<?= BASEURL; ?>/catalog" class="btn btn-outline-secondary w-100 mt-2" style="border-radius:8px;">
                        Lanjutkan Belanja
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white fw-bold" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i> Hapus dari Keranjang
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="mb-3 text-center">
                    <i class="bi bi-trash3" style="font-size: 48px; color: #dc3545;"></i>
                </div>
                <p class="text-center mb-3">Apakah Anda yakin ingin menghapus <strong id="productName">produk ini</strong> dari keranjang?</p>
                <div class="alert alert-warning small mb-0" style="border-radius: 8px;">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Catatan:</strong> Anda dapat menambahkannya kembali ke keranjang kapan saja.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">
                    Batal
                </button>
                <form action="<?= BASEURL; ?>/cart/remove" method="POST" id="deleteForm" style="display: inline;">
                    <input type="hidden" name="item_id" id="itemId" value="">
                    <button type="submit" class="btn btn-danger fw-bold" style="border-radius: 6px;">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
