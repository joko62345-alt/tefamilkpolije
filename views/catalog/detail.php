<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<div class="container mt-5 pt-5 mb-5">

    <p class="text-uppercase small mb-4">
        <a href="<?= BASEURL; ?>/catalog" class="text-dark text-decoration-none">Katalog Produk</a>
        &gt; <span class="fw-bold">Detail Produk</span>
    </p>

    <?php Helper::flash(); ?>

    <div class="row align-items-start g-4">
        <!-- LEFT: IMAGE -->
        <div class="col-md-5">
            <img src="<?= BASEURL; ?>/image/<?= $product['image']; ?>"
                 class="img-fluid rounded shadow-sm border"
                 alt="<?= $product['name']; ?>"
                 style="max-height: 380px; object-fit: contain; width: 100%;">
        </div>

        <!-- RIGHT: DETAILS -->
        <div class="col-md-7">
            <p class="small text-muted mb-1"><b>Kategori:</b> <?= $product['category_name']; ?></p>

            <h2 class="fw-bold mb-1"><?= $product['name']; ?></h2>
            <h4 class="fw-semibold mb-2" style="color: #E4947D;"><?= Helper::formatRupiah($product['price']); ?></h4>

            <!-- Stock info -->
            <?php if ($product['stock'] > 0): ?>
                <span class="badge mb-3" style="background:#4caf50;">Tersedia (<?= $product['stock']; ?> unit)</span>
            <?php else: ?>
                <span class="badge bg-danger mb-3">Stok Habis</span>
            <?php endif; ?>

            <h6 class="fw-bold mt-3">Deskripsi</h6>
            <p class="mb-4 text-muted"><?= $product['description']; ?></p>

            <!-- Action Buttons -->
            <?php if (Helper::isLoggedIn() && Helper::getUserRole() === 'customer'): ?>
                <form action="<?= BASEURL; ?>/cart/add" method="POST" class="d-flex align-items-center gap-3 mb-3">
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <div class="d-flex align-items-center border rounded" style="border-color: #E4947D !important;">
                        <button type="button" class="btn btn-sm px-3" id="btnMin" onclick="adjustQty(-1)" style="background: none; border: none; font-size: 1.3rem; color: #E4947D;">−</button>
                        <input type="number" name="quantity" id="qty" value="1" min="1" max="<?= $product['stock']; ?>"
                               class="form-control form-control-sm text-center border-0 fw-bold"
                               style="width: 60px; background: transparent;">
                        <button type="button" class="btn btn-sm px-3" onclick="adjustQty(1)" style="background: none; border: none; font-size: 1.3rem; color: #E4947D;">+</button>
                    </div>
                    <?php if ($product['stock'] > 0): ?>
                        <button type="submit" class="btn fw-bold px-4 py-2 text-white" style="background: #E4947D; border: none; border-radius: 8px;">
                            <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn fw-bold px-4 py-2 text-white" disabled style="background: #bbb; border: none; border-radius: 8px;">
                            Stok Habis
                        </button>
                    <?php endif; ?>
                </form>
            <?php elseif (Helper::isLoggedIn() && Helper::getUserRole() === 'admin'): ?>
                <div class="alert alert-info">Anda login sebagai Admin.</div>
            <?php else: ?>
                <div class="alert" style="background: #FAF3D6; border: 1.5px solid #E4947D; color: #2d2a26;">
                    <i class="bi bi-info-circle me-2"></i>
                    <a href="<?= BASEURL; ?>/auth/login" class="fw-bold text-decoration-none" style="color: #E4947D;">Login</a> atau
                    <a href="<?= BASEURL; ?>/auth/register" class="fw-bold text-decoration-none" style="color: #E4947D;">Daftar</a>
                    untuk menambahkan produk ke keranjang.
                </div>
            <?php endif; ?>

            <!-- WhatsApp -->
            <a href="https://wa.me/6287729664976?text=Halo, saya ingin memesan <?= urlencode($product['name']); ?> (Rp <?= number_format($product['price'],0,',','.'); ?>)"
               target="_blank"
               class="btn d-flex align-items-center gap-2 fw-semibold mt-2"
               style="background: #25D366; color: white; border: none; border-radius: 8px; width: fit-content; padding: 9px 22px;">
                <i class="fab fa-whatsapp fs-5"></i> Chat WhatsApp
            </a>
        </div>
    </div>
</div>

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
