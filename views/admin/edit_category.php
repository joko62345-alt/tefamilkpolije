<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="form-card" style="max-width: 700px;">
        <h5 class="mb-4">Edit Kategori</h5>
        <form action="<?= BASEURL; ?>/admin/update_category" method="POST">
            <input type="hidden" name="id" value="<?= $category['id']; ?>">
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($category['name']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary-custom">Perbarui Kategori</button>
            <a href="<?= BASEURL; ?>/admin/categories" class="btn btn-outline-secondary ms-2">Batal</a>
        </form>
    </div>
</div>

<?php require_once '../views/templates/admin_footer.php'; ?>