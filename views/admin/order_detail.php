<?php require_once '../views/templates/admin_header.php'; ?>

<?php Helper::flash(); ?>

<div class="container-fluid px-0">
    <div class="form-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-1">Detail Pesanan #<?= $order['id']; ?></h5>
                <small class="text-muted">Tanggal: <?= date('d M Y, H:i', strtotime($order['order_date'])); ?></small>
            </div>
            <div>
                <span class="badge bg-<?= ($order['status'] === 'Selesai' ? 'success' : ($order['status'] === 'Diproses' ? 'info' : 'warning')); ?> fs-6"><?= $order['status']; ?></span>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="mb-3"><strong>Pelanggan</strong><br><?= htmlspecialchars($order['customer_name']); ?></div>
                <div class="mb-3"><strong>Email</strong><br><?= htmlspecialchars($order['email']); ?></div>
                <div class="mb-3"><strong>Telepon</strong><br><?= htmlspecialchars($order['phone']); ?></div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3"><strong>Alamat Pengiriman</strong><br><?= nl2br(htmlspecialchars($order['shipping_address'])); ?></div>
                <div class="mb-3"><strong>Metode Pembayaran</strong><br><?= htmlspecialchars($order['payment_method']); ?></div>
            </div>
        </div>

        <!-- Bukti Pembayaran -->
        <?php if (!empty($order['payment_proof'])): ?>
            <div class="row g-3 mt-3 pt-3 border-top">
                <div class="col-lg-6">
                    <h6>Bukti Pembayaran</h6>
                    <a href="<?= BASEURL; ?>/proofs/payment/<?= htmlspecialchars($order['payment_proof']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-image me-1"></i>Lihat Bukti
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Bukti Penerimaan -->
        <?php if (!empty($order['delivery_proof'])): ?>
            <div class="row g-3 mt-3 pt-3 border-top">
                <div class="col-lg-6">
                    <h6>Bukti Penerimaan Susu</h6>
                    <a href="<?= BASEURL; ?>/proofs/delivery/<?= htmlspecialchars($order['delivery_proof']); ?>" target="_blank" class="btn btn-sm btn-outline-success">
                        <i class="bi bi-image me-1"></i>Lihat Bukti
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="admin-table p-4 mb-4">
        <h5 class="mb-4">Detail Produk</h5>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($item['name']); ?></td>
                            <td><?= Helper::formatRupiah($item['price']); ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td><?= Helper::formatRupiah($item['price'] * $item['quantity']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="form-card mb-4">
        <div>
            <h6 class="mb-3">Update Status Pesanan</h6>
            <small class="text-muted d-block mb-3">Ubah status pesanan ini jika sudah diproses atau selesai.</small>
            
            <!-- Status requirements info -->
            <div class="alert alert-info small mb-3">
                <strong>Catatan Verifikasi:</strong><br>
                <?php if ($order['payment_method'] !== 'Tunai (COD)' && empty($order['payment_proof'])): ?>
                    <i class="bi bi-exclamation-circle"></i> Bukti pembayaran belum diupload<br>
                <?php endif; ?>
                <?php if ($order['status'] === 'Diproses' && empty($order['delivery_proof'])): ?>
                    <i class="bi bi-exclamation-circle"></i> Bukti penerimaan belum diupload<br>
                <?php endif; ?>
                <?php if ($order['status'] === 'Selesai'): ?>
                    <i class="bi bi-check-circle"></i> Pesanan sudah selesai<br>
                <?php endif; ?>
            </div>

            <form action="<?= BASEURL; ?>/admin/update_status" method="POST" class="d-flex gap-2 align-items-center flex-wrap">
                <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                <select name="status" class="form-select" required>
                    <?php foreach (['Menunggu', 'Diproses', 'Selesai'] as $status): ?>
                        <option value="<?= $status; ?>" <?= $order['status'] === $status ? 'selected' : ''; ?>><?= $status; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary-custom">Simpan</button>
            </form>
        </div>
    </div>

    <div class="form-card text-end">
        <h6>Total Pesanan</h6>
        <div class="fs-4 fw-bold text-<?= $order['status'] === 'Selesai' ? 'success' : 'dark'; ?>"><?= Helper::formatRupiah($order['total_price']); ?></div>
        <a href="<?= BASEURL; ?>/admin/orders" class="btn btn-outline-secondary mt-3">Kembali ke daftar pesanan</a>
    </div>
</div>

<?php require_once '../views/templates/admin_footer.php'; ?>