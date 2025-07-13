<?php include 'views/layouts/headeremployee.php'; ?>

<div class="container mt-4">
    <h4 class="mb-4 text-gray-800">Edit Order</h4>

    <?php if ($order['status'] !== 'menunggu'): ?>
        <div class="alert alert-warning">
            Order tidak dapat diedit karena status saat ini adalah <strong><?= $order['status'] ?></strong>.
        </div>
        <a href="index.php?page=order_index" class="btn btn-secondary">Kembali</a>
    <?php else: ?>
        <div class="card shadow">
            <div class="card-body">
                <form action="index.php?page=order_edit&id=<?= $order['id'] ?>" method="POST">
                    <div class="form-group">
                        <label for="product_id">Produk</label>
                        <select name="product_id" class="form-control" required>
                            <?php foreach ($products as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= $p['id'] == $order['product_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($p['nama']) ?> - Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Jumlah</label>
                        <input type="number" name="quantity" class="form-control" value="<?= $order['quantity'] ?>" min="1" required>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                    <a href="index.php?page=order_index" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'views/layouts/footeremployee.php'; ?>
