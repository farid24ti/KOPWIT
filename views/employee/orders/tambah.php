<?php include 'views/layouts/headeremployee.php'; ?>

<div class="container mt-4">
    <h4 class="text-gray-800 mb-4">Tambah Order</h4>

    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="index.php?page=order_tambah">
                <div class="form-group">
                    <label for="product_id">Pilih Produk</label>
                    <select name="product_id" id="product_id" class="form-control" required onchange="tampilkanDetailProduk()">
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produk as $p): ?>
                            <option 
                                value="<?= $p['id'] ?>" 
                                data-deskripsi="<?= htmlspecialchars($p['deskripsi']) ?>"
                                data-harga="<?= $p['harga'] ?>"
                                data-type="<?= $p['type'] ?>"
                            >
                                <?= $p['nama'] ?> - Rp<?= number_format($p['harga'], 0, ',', '.') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="detail-produk" style="display:none;" class="mb-3">
                    <div class="border p-3 rounded bg-light">
                        <p><strong>Deskripsi:</strong> <span id="detail-deskripsi"></span></p>
                        <p><strong>Harga:</strong> Rp <span id="detail-harga"></span></p>
                        <p><strong>Tipe:</strong> <span id="detail-type"></span></p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="quantity">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                <a href="index.php?page=order_index" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
    function tampilkanDetailProduk() {
        const select = document.getElementById('product_id');
        const selected = select.options[select.selectedIndex];

        if (select.value) {
            document.getElementById('detail-deskripsi').textContent = selected.getAttribute('data-deskripsi');
            document.getElementById('detail-harga').textContent = Number(selected.getAttribute('data-harga')).toLocaleString('id-ID');
            document.getElementById('detail-type').textContent = selected.getAttribute('data-type');
            document.getElementById('detail-produk').style.display = 'block';
        } else {
            document.getElementById('detail-produk').style.display = 'none';
        }
    }
</script>

<?php include 'views/layouts/footeremployee.php'; ?>
