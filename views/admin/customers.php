<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="admin-table p-4">
        <h5 class="mb-4">Daftar Pelanggan</h5>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers)): ?>
                        <?php foreach ($customers as $index => $customer): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($customer['name']); ?></td>
                                <td><?= htmlspecialchars($customer['username']); ?></td>
                                <td><?= htmlspecialchars($customer['email']); ?></td>
                                <td><?= htmlspecialchars($customer['phone'] ?? '-'); ?></td>
                                <td><?= htmlspecialchars($customer['address'] ?? '-'); ?></td>
                                <td><?= date('d M Y', strtotime($customer['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada pelanggan terdaftar.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../views/templates/admin_footer.php'; ?>