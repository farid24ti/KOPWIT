<?php include 'views/layouts/headerdashboard.php'; ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="text-primary m-0">Tambah Produk</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php?page=tambah_produk" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama produk" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi produk" required></textarea>
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" placeholder="Masukkan harga" required>
                </div>


                <div class="form-group">
                    <label>Gambar Produk</label>
                    <input type="file" name="image" class="form-control-file" required>
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


                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="index.php?page=produk" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include 'views/layouts/footerdashboard.php'; ?>