<?php include 'views/layouts/headerdashboard.php'; ?>

<div class="container mt-4">
    <h4 class="mb-3">Data Produk</h4>

    <div class="card shadow">
        <div class="card-body">
            <a href="index.php?page=tambah_produk" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data Produk
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($produk as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['deskripsi'] ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><img src="uploads/<?= $row['image'] ?>" width="60"></td>
                            <td><?= $row['type'] ?></td>
                            <td>
                                <a href="index.php?page=edit_produk&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=hapus_produk&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'views/layouts/footerdashboard.php'; ?>