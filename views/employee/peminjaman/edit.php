<?php include 'views/layouts/headeremployee.php'; ?>

<div class="container mt-4">
    <h4 class="text-gray-800 mb-4">Edit Peminjaman</h4>

    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="product_id">Pilih Produk</label>
                    <select name="product_id" id="product_id" class="form-control" required onchange="tampilkanDetailProduk()">
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produk as $p): ?>
                            <option 
                                value="<?= $p['id'] ?>" 
                                data-deskripsi="<?= htmlspecialchars($p['deskripsi']) ?>"
                                data-harga="<?= $p['type'] === 'egrek' ? 10000 : 15000 ?>"
                                data-type="<?= $p['type'] ?>"
                                <?= $p['id'] == $data['product_id'] ? 'selected' : '' ?>
                            >
                                <?= $p['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="detail-produk" class="mb-3" style="display:block;">
                    <div class="border p-3 rounded bg-light">
                        <p><strong>Harga Sewa:</strong> Rp <span id="detail-harga"></span></p>
                        <p><strong>Tipe:</strong> <span id="detail-type"></span></p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="quantity">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="<?= $data['quantity'] ?>" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=peminjaman_index" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
    function tampilkanDetailProduk() {
        const select = document.getElementById('product_id');
        const selected = select.options[select.selectedIndex];

        if (select.value) {
            document.getElementById('detail-harga').textContent = Number(selected.getAttribute('data-harga')).toLocaleString('id-ID');
            document.getElementById('detail-type').textContent = selected.getAttribute('data-type');
            document.getElementById('detail-produk').style.display = 'block';
        } else {
            document.getElementById('detail-produk').style.display = 'none';
        }
    }

    // Panggil fungsi saat halaman dimuat
    window.onload = tampilkanDetailProduk;
</script>

<?php include 'views/layouts/footeremployee.php'; ?>
