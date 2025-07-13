<?php include 'views/layouts/headerdashboard.php'; ?>

<div class="container mt-4">
    <h4 class="mb-3">Detail Peminjaman</h4>

    <div class="card">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Nama User:</strong> <?= $data['nama_user'] ?? '-' ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?= $data['email'] ?? '-' ?></li>
                <li class="list-group-item"><strong>Produk:</strong> <?= $data['nama_produk'] ?? '-' ?></li>
                <li class="list-group-item"><strong>Jumlah:</strong> <?= $data['quantity'] ?></li>
                <li class="list-group-item"><strong>Total Harga:</strong> Rp <?= number_format($data['total_harga'], 0, ',', '.') ?></li>
                <li class="list-group-item"><strong>Status:</strong> <?= $data['status'] ?></li>
                <li class="list-group-item">
                    <strong>Bukti Bayar:</strong><br>
                    <?php if (!empty($data['bukti_bayar'])): ?>
                        <a href="uploads/peminjaman/<?= $data['bukti_bayar'] ?>" target="_blank">
                            <img src="uploads/peminjaman/<?= $data['bukti_bayar'] ?>" width="200">
                        </a>
                    <?php else: ?>
                        <em>Belum diupload</em>
                    <?php endif; ?>
                </li>
            </ul>

            <a href="index.php?page=admin_peminjaman" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>

<?php include 'views/layouts/footerdashboard.php'; ?>
