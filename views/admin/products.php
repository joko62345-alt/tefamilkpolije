<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="row g-4 mb-4">
        <div class="col-lg-5">
            <div class="form-card">
                <h5 class="mb-4">Tambah Produk</h5>
                <form action="<?= BASEURL; ?>/admin/store_product" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>"><?= htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <input type="number" name="price" class="form-control" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stock" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Gambar Produk</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary-custom">Simpan Produk</button>
                </form>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="admin-table p-4">
                <h5 class="mb-4">Daftar Produk</h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $index => $product): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td class="d-flex align-items-center gap-3">
                                            <?php if (!empty($product['image'])): ?>
                                                <img src="<?= BASEURL; ?>/image/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                                            <?php endif; ?>
                                            <div>
                                                <div class="fw-semibold"><?= htmlspecialchars($product['name']); ?></div>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($product['category_name']); ?></td>
                                        <td><?= Helper::formatRupiah($product['price']); ?></td>
                                        <td><?= $product['stock']; ?></td>
                                        <td>
                                            <a href="<?= BASEURL; ?>/admin/edit_product/<?= $product['id']; ?>" class="btn btn-sm btn-outline-dark">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-action-url="<?= BASEURL; ?>/admin/delete_product/<?= $product['id']; ?>" data-item-name="<?= htmlspecialchars($product['name']); ?>">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada produk.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white fw-bold" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i> Hapus Produk
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="mb-3 text-center">
                    <i class="bi bi-trash3" style="font-size: 48px; color: #dc3545;"></i>
                </div>
                <p class="text-center mb-3">Apakah Anda yakin ingin menghapus <strong id="itemName">produk ini</strong>?</p>
                <div class="alert alert-warning small mb-0" style="border-radius: 8px;">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan. Semua data produk akan dihapus.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">
                    Batal
                </button>
                <form action="" method="POST" id="deleteForm" style="display: inline;">
                    <button type="submit" class="btn btn-danger fw-bold" style="border-radius: 6px;">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const actionUrl = button.getAttribute('data-action-url');
            const itemName = button.getAttribute('data-item-name');
            
            document.getElementById('itemName').textContent = itemName;
            document.getElementById('deleteForm').setAttribute('action', actionUrl);
        });
    }
</script>

<?php require_once '../views/templates/admin_footer.php'; ?>