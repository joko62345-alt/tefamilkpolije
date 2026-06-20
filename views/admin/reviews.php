<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="form-card text-center">
                <h6 class="text-muted mb-2">Total Ulasan Disetujui</h6>
                <div class="fs-3 fw-bold" style="color: #E4947D;"><?= $totalReviews; ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-card text-center">
                <h6 class="text-muted mb-2">Rating Rata-rata</h6>
                <div class="fs-3 fw-bold" style="color: #E4947D;">
                    <?= $avgRating; ?> <i class="bi bi-star-fill" style="font-size: 1.2rem; color: #ffc107;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-card text-center">
                <h6 class="text-muted mb-2">Ulasan Menunggu</h6>
                <div class="fs-3 fw-bold text-warning"><?= count($reviews); ?></div>
            </div>
        </div>
    </div>

    <!-- Pending Reviews -->
    <div class="admin-table p-4 mb-4">
        <h5 class="mb-4">Ulasan Menunggu Persetujuan</h5>
        
        <?php if (!empty($reviews)): ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pelanggan</th>
                            <th>Rating</th>
                            <th>Judul</th>
                            <th>Pesan</th>
                            <th>Gambar</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reviews as $index => $review): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($review['name']); ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($review['email']); ?></small>
                                </td>
                                <td>
                                    <div style="color: #ffc107;">
                                        <?php for($i = 0; $i < $review['rating']; $i++): ?>
                                            <i class="bi bi-star-fill"></i>
                                        <?php endfor; ?>
                                        <?php for($i = $review['rating']; $i < 5; $i++): ?>
                                            <i class="bi bi-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($review['title'] ?? 'Tidak ada judul'); ?></td>
                                <td>
                                    <small><?= htmlspecialchars(substr($review['message'], 0, 50)) . '...'; ?></small>
                                </td>
                                <td>
                                    <?php if (!empty($review['image'])): ?>
                                        <a href="<?= BASEURL; ?>/image/<?= htmlspecialchars($review['image']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                            Lihat
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d M Y', strtotime($review['created_at'])); ?></td>
                                <td>
                                    <a href="<?= BASEURL; ?>/admin/approve_review/<?= $review['id']; ?>" class="btn btn-sm btn-success">Setujui</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal" data-review-id="<?= $review['id']; ?>">Tolak</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <p class="text-muted mt-3">Tidak ada ulasan menunggu persetujuan</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Approved Reviews -->
    <div class="admin-table p-4">
        <h5 class="mb-4">Testimoni Disetujui</h5>
        <?php if (!empty($approvedReviews)): ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pelanggan</th>
                            <th>Rating</th>
                            <th>Judul</th>
                            <th>Pesan</th>
                            <th>Gambar</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($approvedReviews as $index => $review): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><strong><?= htmlspecialchars($review['name']); ?></strong></td>
                                <td>
                                    <div style="color: #ffc107;">
                                        <?php for($i = 0; $i < $review['rating']; $i++): ?>
                                            <i class="bi bi-star-fill"></i>
                                        <?php endfor; ?>
                                        <?php for($i = $review['rating']; $i < 5; $i++): ?>
                                            <i class="bi bi-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($review['title'] ?? 'Tidak ada judul'); ?></td>
                                <td><small><?= htmlspecialchars(substr($review['message'], 0, 50)) . '...'; ?></small></td>
                                <td>
                                    <?php if (!empty($review['image'])): ?>
                                        <a href="<?= BASEURL; ?>/image/<?= htmlspecialchars($review['image']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d M Y', strtotime($review['created_at'])); ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteApprovedModal" data-review-id="<?= $review['id']; ?>">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <p class="text-muted mt-3">Tidak ada testimoni disetujui.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Testimoni Disetujui -->
<div class="modal fade" id="deleteApprovedModal" tabindex="-1" aria-labelledby="deleteApprovedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white fw-bold" id="deleteApprovedModalLabel">
                    <i class="bi bi-trash3 me-2"></i> Hapus Testimoni
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="mb-3 text-center">
                    <i class="bi bi-x-circle" style="font-size: 48px; color: #dc3545;"></i>
                </div>
                <p class="text-center mb-3">Apakah Anda yakin ingin menghapus testimoni ini?</p>
                <div class="alert alert-warning small mb-0" style="border-radius: 8px;">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Catatan:</strong> Testimoni akan dihapus secara permanen.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">
                    Batal
                </button>
                <form action="" method="POST" id="deleteApprovedForm" style="display: inline;">
                    <button type="submit" class="btn btn-danger fw-bold" style="border-radius: 6px;">
                        <i class="bi bi-trash3 me-1"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteApprovedModal = document.getElementById('deleteApprovedModal');
    if (deleteApprovedModal) {
        deleteApprovedModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const reviewId = button.getAttribute('data-review-id');
            document.getElementById('deleteApprovedForm').setAttribute('action', '<?= BASEURL; ?>/admin/delete_review/' + reviewId);
        });
    }
</script>

<!-- Modal Konfirmasi Tolak -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white fw-bold" id="rejectModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i> Tolak Ulasan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="mb-3 text-center">
                    <i class="bi bi-x-circle" style="font-size: 48px; color: #dc3545;"></i>
                </div>
                <p class="text-center mb-3">Apakah Anda yakin ingin menolak ulasan ini?</p>
                <div class="alert alert-warning small mb-0" style="border-radius: 8px;">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Catatan:</strong> Ulasan akan dihapus dan pelanggan tidak akan melihatnya.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">
                    Batal
                </button>
                <form action="" method="POST" id="rejectForm" style="display: inline;">
                    <button type="submit" class="btn btn-danger fw-bold" style="border-radius: 6px;">
                        <i class="bi bi-x-circle me-1"></i> Ya, Tolak
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const rejectModal = document.getElementById('rejectModal');
    if (rejectModal) {
        rejectModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const reviewId = button.getAttribute('data-review-id');
            document.getElementById('rejectForm').setAttribute('action', '<?= BASEURL; ?>/admin/reject_review/' + reviewId);
        });
    }
</script>

<?php require_once '../views/templates/admin_footer.php'; ?>
