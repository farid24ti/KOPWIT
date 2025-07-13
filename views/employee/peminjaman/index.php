<?php include 'views/layouts/headeremployee.php'; ?>
<div class="container mt-4">
    <h4 class="text-gray-800 mb-4">Riwayat Peminjaman</h4>
    <a href="index.php?page=peminjaman_tambah" class="btn btn-success mb-3">Tambah Peminjaman</a>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['nama'] ?></td>
                            <td><?= $d['quantity'] ?></td>
                            <td>
                                <?php
                                $status = $d['status'];
                                $badgeClass = 'secondary';

                                if ($status === 'belum_dibayar') {
                                    $badgeClass = 'warning';
                                } elseif ($status === 'menunggu') {
                                    $badgeClass = 'info';
                                } elseif ($status === 'diproses') {
                                    $badgeClass = 'primary';
                                } elseif ($status === 'diterima') {
                                    $badgeClass = 'success';
                                } elseif ($status === 'selesai') {
                                    $badgeClass = 'dark';
                                } elseif ($status === 'ditolak') {
                                    $badgeClass = 'danger';
                                }
                                ?>
                                <span class="badge badge-<?= $badgeClass ?>"><?= ucfirst($status) ?></span>
                            </td>
                            <td>
                                <?php if (in_array($d['status'], ['belum_dibayar', 'menunggu'])): ?>
                                    <a href="index.php?page=peminjaman_edit&id=<?= $d['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=peminjaman_hapus&id=<?= $d['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan peminjaman ini?')">Hapus</a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data)): ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada peminjaman.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'views/layouts/footeremployee.php'; ?>