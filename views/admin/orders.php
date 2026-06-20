<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="admin-table p-4">
        <h5 class="mb-4">Kelola Pesanan</h5>
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
                        <th>Aksi</th>
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
                                <td>
                                    <a href="<?= BASEURL; ?>/admin/order_detail/<?= $order['id']; ?>" class="btn btn-sm btn-primary-custom">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada pesanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../views/templates/admin_footer.php'; ?>