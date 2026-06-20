<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="icon bg-warning text-white"><i class="bi bi-box-seam"></i></div>
                <div class="value"><?= $totalProducts; ?></div>
                <div class="label">Total Produk</div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="icon bg-info text-white"><i class="bi bi-people"></i></div>
                <div class="value"><?= $totalCustomers; ?></div>
                <div class="label">Total Pelanggan</div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="icon bg-success text-white"><i class="bi bi-bag-check"></i></div>
                <div class="value"><?= $totalOrders; ?></div>
                <div class="label">Total Transaksi</div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="icon bg-dark text-white"><i class="bi bi-cash-stack"></i></div>
                <div class="value"><?= Helper::formatRupiah($totalRevenue); ?></div>
                <div class="label">Total Pendapatan</div>
            </div>
        </div>
    </div>

    <div class="admin-table p-4">
        <h5 class="mb-4">Pesanan Terbaru</h5>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recentOrders)): ?>
                        <?php foreach ($recentOrders as $index => $order): ?>
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
                                    <a href="<?= BASEURL; ?>/admin/order_detail/<?= $order['id']; ?>" class="btn btn-sm btn-primary-custom">Lihat</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada pesanan terbaru.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../views/templates/admin_footer.php'; ?>