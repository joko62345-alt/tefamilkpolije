<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="form-card mb-4">
        <a href="<?= BASEURL; ?>/admin/partners" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <h5 class="mb-4">Edit Mitra Kerjasama</h5>
        <form action="<?= BASEURL; ?>/admin/update_partner" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $partner['id']; ?>">

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nama Mitra</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($partner['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat mitra..."><?= htmlspecialchars($partner['description'] ?? ''); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo / Foto Mitra Baru (Opsional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Logo / Foto Mitra Saat Ini</label>
                        <?php
                            $imagePath = BASEURL . '/image/' . htmlspecialchars($partner['image']);
                            if (strpos($partner['image'], 'http') === 0) {
                                $imagePath = $partner['image'];
                            }
                        ?>
                        <div style="width: 100%; height: 220px; border-radius: 12px; overflow: hidden; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                            <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($partner['name']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary-custom">Simpan Perubahan</button>
                <a href="<?= BASEURL; ?>/admin/partners" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../views/templates/admin_footer.php'; ?>
