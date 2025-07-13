<?php include 'views/layouts/headeremployee.php'; ?>

<div class="container mt-4">
    <h4 class="mb-3 text-gray-800">Detail Order</h4>

    <div class="card shadow">
        <div class="card-body">
            <p><strong>Produk:</strong> <?= $detail['nama_produk'] ?></p>
            <p><strong>Jumlah:</strong> <?= $detail['quantity'] ?></p>
            <p><strong>Total:</strong> Rp <?= number_format($detail['total_harga'], 0, ',', '.') ?></p>
            <p><strong>Status:</strong> <?= ucfirst($detail['status']) ?></p>
            <p><strong>Waktu:</strong> <?= $detail['created_at'] ?></p>
            <a href="index.php?page=order_index" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

<?php include 'views/layouts/footeremployee.php'; ?>
