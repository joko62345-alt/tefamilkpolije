<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan TEFA MILK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            color: #333;
        }

        .report-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .print-controls {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }

        .print-controls button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-print {
            background-color: #E4947D;
            color: white;
        }

        .btn-print:hover {
            background-color: #d47a63;
        }

        .btn-close {
            background-color: #6c757d;
            color: white;
        }

        .btn-close:hover {
            background-color: #5a6268;
        }

        /* Report Header */
        .report-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #E4947D;
            padding-bottom: 15px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2D2A26;
            margin-bottom: 5px;
        }

        .report-title {
            font-size: 20px;
            font-weight: 600;
            color: #E4947D;
            margin-bottom: 5px;
        }

        .report-period {
            font-size: 14px;
            color: #666;
            margin-bottom: 3px;
        }

        .report-date {
            font-size: 12px;
            color: #999;
        }

        /* Table */
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .report-table thead {
            background-color: #E4947D;
            color: white;
        }

        .report-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #ddd;
        }

        .report-table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
        }

        .report-table tbody tr:nth-child(even) {
            background-color: #FAF3D6;
        }

        .report-table tbody tr:hover {
            background-color: #f0e8c8;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: 600;
        }

        /* Summary */
        .summary-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }

        .summary-box {
            background-color: #FAF3D6;
            border: 2px solid #E4947D;
            border-radius: 6px;
            padding: 20px;
            width: 400px;
        }

        .summary-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .summary-value {
            font-size: 24px;
            font-weight: bold;
            color: #E4947D;
            word-break: break-all;
        }

        /* Footer */
        .report-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }

        .footer-section {
            text-align: center;
        }

        .footer-title {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #666;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 10px;
            padding-top: 5px;
            font-size: 12px;
            color: #666;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .report-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }

            .print-controls {
                display: none;
            }

            .report-table tbody tr:hover {
                background-color: #FAF3D6;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .report-container {
                padding: 20px;
            }

            .report-table {
                font-size: 12px;
            }

            .report-table th,
            .report-table td {
                padding: 8px;
            }

            .summary-box {
                width: 100%;
            }

            .report-footer {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <!-- Print Controls -->
        <div class="print-controls">
            <button class="btn-print" onclick="window.print()">
                <i class="bi bi-printer"></i> Cetak / Simpan PDF
            </button>
            <button class="btn-close" onclick="window.history.back()">
                <i class="bi bi-x-circle"></i> Kembali
            </button>
        </div>

        <!-- Report Header -->
        <div class="report-header">
            <div class="company-name">🥛 TEFA MILK</div>
            <div class="report-title">LAPORAN PENJUALAN</div>
            <div class="report-period">
                Periode: <?= date('d M Y', strtotime($from)); ?> s/d <?= date('d M Y', strtotime($to)); ?>
            </div>
            <div class="report-date">Dicetak: <?= date('d M Y H:i'); ?></div>
        </div>

        <!-- Report Table -->
        <?php if (!empty($orders)): ?>
            <table class="report-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th style="width: 12%;">Tgl Pesan</th>
                        <th style="width: 18%;">Pelanggan</th>
                        <th style="width: 20%;">Alamat Pengiriman</th>
                        <th style="width: 15%;">Metode Bayar</th>
                        <th class="text-center" style="width: 10%;">Status</th>
                        <th class="text-right" style="width: 20%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($orders as $order): ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td><?= date('d/m/Y', strtotime($order['order_date'])); ?></td>
                            <td><?= htmlspecialchars($order['customer_name']); ?></td>
                            <td><?= htmlspecialchars(substr($order['shipping_address'], 0, 50)); ?></td>
                            <td><?= htmlspecialchars($order['payment_method']); ?></td>
                            <td class="text-center">
                                <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;
                                    background-color: <?= $order['status'] === 'Selesai' ? '#d4edda' : ($order['status'] === 'Diproses' ? '#cfe2ff' : '#fff3cd'); ?>;
                                    color: <?= $order['status'] === 'Selesai' ? '#155724' : ($order['status'] === 'Diproses' ? '#0c5de4' : '#856404'); ?>;">
                                    <?= $order['status']; ?>
                                </span>
                            </td>
                            <td class="text-right"><?= Helper::formatRupiah($order['total_price']); ?></td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Summary -->
            <div class="summary-section">
                <div class="summary-box">
                    <div class="summary-label">Total Pendapatan (Status: Selesai)</div>
                    <div class="summary-value"><?= Helper::formatRupiah($revenue); ?></div>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p><i class="bi bi-inbox"></i></p>
                <p>Tidak ada data penjualan untuk periode ini</p>
            </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="report-footer">
            <div class="footer-section">
                <div class="footer-title">Dibuat Oleh</div>
                <div class="signature-line">______________________</div>
            </div>
            <div class="footer-section">
                <div class="footer-title">Disetujui Oleh</div>
                <div class="signature-line">______________________</div>
            </div>
        </div>
    </div>

    <script>
        // Print hint
        window.addEventListener('afterprint', function() {
            console.log('Print dialog closed');
        });
    </script>
</body>
</html>
