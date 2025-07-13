<?php include 'views/layouts/headeremployee.php'; ?>

<div class="container mt-4">
    <h2 class="h4 text-gray-800 mb-4">Produk Tersedia</h2>

    <div class="row">
        <?php foreach ($produk as $row): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($row['image'])): ?>
                        <img src="uploads/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['nama'] ?>" style="height:200px; object-fit:cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['nama']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['deskripsi']) ?></p>
                        <p class="card-text"><strong>Rp <?= number_format($row['harga'], 0, ',', '.') ?></strong></p>
                        <p class="badge badge-info"><?= ucfirst($row['type']) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'views/layouts/footeremployee.php'; ?>