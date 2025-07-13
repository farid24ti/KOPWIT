<?php include 'views/layouts/headeremployee.php'; ?>
<div class="container mt-4">
    <h4 class="text-gray-800 mb-4">Form Peminjaman</h4>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="index.php?page=peminjaman_tambah">
                <div class="form-group">
                    <label>Pilih Produk</label>
                    <select name="product_id" class="form-control" required>
                        <?php foreach ($produk as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?> - <?= ucfirst($p['type']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="quantity" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Pinjam</button>
                <a href="index.php?page=peminjaman_index" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?php include 'views/layouts/footeremployee.php'; ?>