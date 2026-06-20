<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="form-card" style="max-width: 800px;">
        <h5 class="mb-4">Edit Produk</h5>
        <form action="<?= BASEURL; ?>/admin/update_product" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $product['id']; ?>">

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id']; ?>" <?= $product['category_id'] == $category['id'] ? 'selected' : ''; ?>><?= htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']); ?></textarea>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control" min="0" step="0.01" value="<?= $product['price']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stock" class="form-control" min="0" value="<?= $product['stock']; ?>" required>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Gambar Produk</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <?php if (!empty($product['image'])): ?>
                    <div class="mt-3">
                        <small>Gambar saat ini:</small><br>
                        <img src="<?= BASEURL; ?>/image/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" style="max-width: 200px; border-radius: 10px; border: 1px solid #ddd; margin-top: 10px;">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary-custom">Perbarui Produk</button>
            <a href="<?= BASEURL; ?>/admin/products" class="btn btn-outline-secondary ms-2">Batal</a>
        </form>
    </div>
</div>

<?php require_once '../views/templates/admin_footer.php'; ?>