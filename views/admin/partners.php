<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="row g-4 mb-4">
        <div class="col-lg-5">
            <div class="form-card">
                <h5 class="mb-4">Tambah Mitra Kerjasama</h5>
                <form action="<?= BASEURL; ?>/admin/store_partner" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nama Mitra</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: KUD BLITAR" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Tambahkan keterangan singkat tentang mitra..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo / Foto Mitra</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <small class="text-muted">Format: JPG, PNG, WEBP (Max 5MB)</small>
                    </div>
                    <button type="submit" class="btn btn-primary-custom">Tambah Mitra</button>
                </form>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="admin-table p-4">
                <h5 class="mb-4">Daftar Mitra Kerjasama</h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>Nama Mitra</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($partners)): ?>
                                <?php foreach ($partners as $index => $partner): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td>
                                            <?php
                                                $imagePath = BASEURL . '/image/' . htmlspecialchars($partner['image']);
                                                if (strpos($partner['image'], 'http') === 0) {
                                                    $imagePath = $partner['image'];
                                                }
                                            ?>
                                            <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($partner['name']); ?>" style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                                        </td>
                                        <td><?= htmlspecialchars($partner['name']); ?></td>
                                        <td><?= htmlspecialchars(substr($partner['description'] ?? '-', 0, 80)); ?><?= !empty($partner['description']) && strlen($partner['description']) > 80 ? '...' : ''; ?></td>
                                        <td><?= date('d M Y', strtotime($partner['created_at'])); ?></td>
                                        <td>
                                            <a href="<?= BASEURL; ?>/admin/edit_partner/<?= $partner['id']; ?>" class="btn btn-sm btn-outline-dark">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-action-url="<?= BASEURL; ?>/admin/delete_partner/<?= $partner['id']; ?>" data-item-name="<?= htmlspecialchars($partner['name']); ?>">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada mitra kerja sama.</td>
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
                    <i class="bi bi-exclamation-triangle me-2"></i> Hapus Mitra
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="mb-3 text-center">
                    <i class="bi bi-trash3" style="font-size: 48px; color: #dc3545;"></i>
                </div>
                <p class="text-center mb-3">Apakah Anda yakin ingin menghapus <strong id="itemName">mitra ini</strong>?</p>
                <div class="alert alert-warning small mb-0" style="border-radius: 8px;">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <strong>Peringatan:</strong> Data mitra akan dihapus secara permanen.
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
