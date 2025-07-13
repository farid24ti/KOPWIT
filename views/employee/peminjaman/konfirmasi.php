<?php include 'views/layouts/headeremployee.php'; ?>

<div class="container mt-4">
    <h4 class="mb-4 text-gray-800">Konfirmasi Peminjaman</h4>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Produk:</strong> <?= htmlspecialchars($peminjaman['nama_produk']) ?></li>
        <li class="list-group-item"><strong>Jumlah:</strong> <?= $peminjaman['quantity'] ?></li>
        <li class="list-group-item"><strong>Total Harga:</strong> Rp <?= number_format($peminjaman['total_harga'], 0, ',', '.') ?></li>
    </ul>
    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Pembayaran Akun Dana</strong>
        <a>Farid - 08388212878</a>
    </li>
    </ul>

    <form action="index.php?page=peminjaman_bayar" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $peminjaman['id'] ?>">
        <div class="form-group">
            <label>Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_bayar" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-success">Kirim</button>
        <a href="index.php?page=peminjaman_batal&id=<?= $peminjaman['id'] ?>" class="btn btn-danger">Batalkan</a>
    </form>
</div>

<?php include 'views/layouts/footeremployee.php'; ?>
