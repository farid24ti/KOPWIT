<?php include 'views/layouts/headerdashboard.php'; ?>

<div class="container mt-4">
    <h4 class="mb-4 text-gray-800">Detail Pesanan</h4>

    <div class="card shadow">
        <div class="card-body">
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">
                    <strong>Nama User:</strong> <?= htmlspecialchars($detail['nama_user']) ?> (<?= htmlspecialchars($detail['email']) ?>)
                </li>
                <li class="list-group-item">
                    <strong>Produk:</strong> <?= htmlspecialchars($detail['nama_produk']) ?>
                </li>
                <li class="list-group-item">
                    <strong>Jumlah:</strong> <?= $detail['quantity'] ?>
                </li>
                <li class="list-group-item">
                    <strong>Total Harga:</strong> Rp <?= number_format($detail['total_harga'], 0, ',', '.') ?>
                </li>
                <li class="list-group-item">
                    <strong>Status:</strong>
                    <span class="badge badge-<?= $detail['status'] === 'menunggu' ? 'secondary' : ($detail['status'] === 'diproses' ? 'warning' : ($detail['status'] === 'diterima' ? 'primary' : 'success')) ?>">
                        <?= ucfirst($detail['status']) ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <strong>Tanggal Order:</strong> <?= date('d M Y, H:i', strtotime($detail['created_at'])) ?>
                </li>
                <li class="list-group-item">
                    <strong>Bukti Pembayaran:</strong><br>
                    <?php if (!empty($detail['bukti_bayar'])): ?>
                        <img src="uploads/bukti/<?= $detail['bukti_bayar'] ?>" alt="Bukti Pembayaran" class="img-thumbnail mt-2" style="max-width: 300px;">
                        <br>
                        <a href="uploads/bukti/<?= $detail['bukti_bayar'] ?>" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                            Lihat Gambar Asli
                        </a>
                    <?php else: ?>
                        <span class="text-danger">Belum ada bukti pembayaran.</span>
                    <?php endif; ?>
                </li>
            </ul>

            <a href="index.php?page=admin_orders" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

<?php include 'views/layouts/footerdashboard.php'; ?>
