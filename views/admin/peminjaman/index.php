<?php include 'views/layouts/headerdashboard.php'; ?>

<div class="container mt-4">
    <h4 class="mb-3">Daftar Peminjaman</h4>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                         <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_user'] ?></td>
                            <td><?= $row['nama_produk'] ?></td>
                            <td><?= $row['quantity'] ?></td>
                            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                            <td><span class="badge badge-info"><?= $row['status'] ?></span></td>
                            <td>
                                <?php if (!empty($row['bukti_bayar'])): ?>
                                    <a href="uploads/peminjaman/<?= $row['bukti_bayar'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-image"></i> Lihat</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Aksi ubah status jika diperlukan -->
                                <form method="POST" action="index.php?page=admin_peminjaman_update">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="menunggu" <?= $row['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                        <option value="diproses" <?= $row['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                        <option value="diterima" <?= $row['status'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                                        <option value="selesai" <?= $row['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                        <option value="ditolak" <?= $row['status'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                                </form>
                            </td>
                            <td>
                                <a href="index.php?page=admin_peminjaman_detail&id=<?= $row['id'] ?>" class="btn btn-sm btn-info mt-1">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'views/layouts/footerdashboard.php'; ?>