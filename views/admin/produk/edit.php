<?php include 'views/layouts/headerdashboard.php'; ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="text-warning m-0">Edit Produk</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php?page=edit_produk&id=<?= $data['id'] ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Gambar Produk</label><br>
                    <?php if (!empty($data['image'])): ?>
                        <img src="uploads/<?= $data['image'] ?>" width="100" class="mb-2">
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control-file">
                    <input type="hidden" name="image_lama" value="<?= $data['image'] ?>">
                </div>

                <div class="form-group">
                    <label>Tipe Produk</label>
                    <select name="type" class="form-control" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="pupuk" <?= isset($data) && $data['type'] == 'pupuk' ? 'selected' : '' ?>>Pupuk</option>
                        <option value="dodos" <?= isset($data) && $data['type'] == 'dodos' ? 'selected' : '' ?>>Dodos</option>
                        <option value="obat-obat sawit" <?= isset($data) && $data['type'] == 'obat-obat sawit' ? 'selected' : '' ?>>Obat-obat Sawit</option>
                        <option value="egrek" <?= isset($data) && $data['type'] == 'egrek' ? 'selected' : '' ?>>Egrek</option>
                        <option value="racun" <?= isset($data) && $data['type'] == 'racun' ? 'selected' : '' ?>>Racun</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Perbarui</button>
                <a href="index.php?page=produk" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include 'views/layouts/footerdashboard.php'; ?>