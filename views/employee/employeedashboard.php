<?php include 'views/layouts/headeremployee.php'; ?>

<h2>Halo Employee, selamat datang!</h2>
<a href="/kopwit/logout">Logout</a>

<form method="POST" action="index.php?page=order_produk">
    <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
    <input type="number" name="quantity" class="form-control form-control-sm d-inline-block" style="width:80px;" min="1" value="1" required>
    <button type="submit" class="btn btn-success btn-sm">
        <i class="fas fa-shopping-cart"></i> Beli
    </button>
</form>

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

                        <form method="POST" action="index.php?page=order_produk" class="mt-2">
                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                            <div class="input-group">
                                <input type="number" name="quantity" min="1" value="1" class="form-control form-control-sm" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-shopping-cart"></i> Beli</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'views/layouts/footeremployee.php'; ?>