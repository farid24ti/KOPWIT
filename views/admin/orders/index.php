<?php include 'views/layouts/headerdashboard.php'; ?>

<div class="container mt-4">
    <h4 class="mb-4 text-gray-800">Kelola Pesanan</h4>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                        <th>Bukti Bayar</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($orders as $o): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($o['nama_user']) ?></td>
                            <td><?= htmlspecialchars($o['nama_produk']) ?></td>
                            <td><?= $o['quantity'] ?></td>
                            <td>Rp <?= number_format($o['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <span class="badge 
        <?= $o['status'] == 'selesai' ? 'badge-success' : ($o['status'] == 'diproses' ? 'badge-warning' : ($o['status'] == 'diterima' ? 'badge-primary' : ($o['status'] == 'ditolak' ? 'badge-danger' : 'badge-secondary'))) ?>">
                                    <?= ucfirst($o['status']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($o['status'] !== 'selesai'): ?>
                                    <form action="index.php?page=admin_order_update" method="POST" class="d-flex">
                                        <input type="hidden" name="id" value="<?= $o['id'] ?>">
                                        <select name="status" class="form-control form-control-sm mr-2" required>
                                            <option value="menunggu" <?= $o['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                            <option value="diproses" <?= $o['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                            <option value="selesai" <?= $o['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                            <option value="ditolak" <?= $o['status'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                        </select>

                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">Selesai</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($o['bukti_bayar']): ?>
                                    <a href="uploads/bukti/<?= $o['bukti_bayar'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-image"></i> Lihat
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">Belum Upload</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="index.php?page=admin_order_detail&id=<?= $o['id'] ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada pesanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'views/layouts/footerdashboard.php'; ?>