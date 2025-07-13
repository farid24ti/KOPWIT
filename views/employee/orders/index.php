<?php include 'views/layouts/headeremployee.php'; ?>

<?php
// Fungsi menentukan warna badge berdasarkan status
function badgeClass($status)
{
    return match ($status) {
        'menunggu' => 'badge-secondary',
        'diproses' => 'badge-warning',
        'diterima' => 'badge-primary',
        'selesai'  => 'badge-success',
        'ditolak'  => 'badge-danger',
        default    => 'badge-light',
    };
}
?>

<div class="container mt-4">
    <h4 class="mb-4 text-gray-800">Riwayat Pemesanan</h4>
    <a href="index.php?page=order_tambah" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah Order</a>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($orders as $o): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($o['nama_produk']) ?></td>
                            <td><?= $o['quantity'] ?></td>
                            <td>Rp <?= number_format($o['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <span class="badge <?= badgeClass($o['status']) ?>">
                                    <?= ucfirst($o['status']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="index.php?page=order_detail&id=<?= $o['id'] ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>

                                <?php if ($o['status'] === 'menunggu'): ?>
                                    <a href="index.php?page=order_edit&id=<?= $o['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="index.php?page=order_hapus&id=<?= $o['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($o['bukti_bayar']): ?>
                                    <a href="uploads/bukti/<?= $o['bukti_bayar'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        Lihat Bukti
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">Belum diupload</span>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pesanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'views/layouts/footeremployee.php'; ?>