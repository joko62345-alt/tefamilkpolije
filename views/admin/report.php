<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="form-card mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
            <div>
                <h5 class="mb-2">Laporan Penjualan</h5>
                <p class="text-muted mb-0">Filter laporan berdasarkan tanggal dan cetak PDF.</p>
            </div>
            <form action="<?= BASEURL; ?>/admin/report" method="GET" class="d-flex gap-2 align-items-center">
                <div>
                    <label class="form-label small mb-1">Dari</label>
                    <input type="date" name="from" class="form-control" value="<?= htmlspecialchars($from); ?>" required>
                </div>
                <div>
                    <label class="form-label small mb-1">Sampai</label>
                    <input type="date" name="to" class="form-control" value="<?= htmlspecialchars($to); ?>" required>
                </div>
                <div class="align-self-end">
                    <button type="submit" class="btn btn-primary-custom">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="admin-table p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Hasil Laporan</h5>
            <a href="<?= BASEURL; ?>/admin/report_preview?from=<?= urlencode($from); ?>&to=<?= urlencode($to); ?>" target="_blank" class="btn btn-primary-custom">
                <i class="bi bi-printer me-2"></i>Preview & Cetak
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $index => $order): ?>
                            <?php
                                $statusColor = ['Menunggu' => 'warning', 'Diproses' => 'info', 'Selesai' => 'success'];
                                $badge = isset($statusColor[$order['status']]) ? $statusColor[$order['status']] : 'secondary';
                            ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td>#<?= $order['id']; ?></td>
                                <td><?= htmlspecialchars($order['customer_name']); ?></td>
                                <td><?= date('d M Y', strtotime($order['order_date'])); ?></td>
                                <td><span class="badge bg-<?= $badge; ?>"><?= $order['status']; ?></span></td>
                                <td><?= Helper::formatRupiah($order['total_price']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data pada rentang tanggal ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4 text-end">
            <h6 class="mb-1">Total Pendapatan (Selesai)</h6>
            <div class="fs-4 fw-bold text-success"><?= Helper::formatRupiah($revenue); ?></div>
        </div>
    </div>
</div>

<?php require_once '../views/templates/admin_footer.php'; ?>