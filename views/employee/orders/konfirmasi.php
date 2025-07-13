<?php include 'views/layouts/headeremployee.php'; ?>
<div class="container mt-4">
    <h4 class="mb-4 text-gray-800">Upload Bukti Pembayaran</h4>

    <?php
    $pending = $_SESSION['pending_order'];
    $product = (new Product())->getById($pending['product_id']);
    $total_harga = $product['harga'] * $pending['quantity'];
    ?>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Produk:</strong> <?= $product['nama'] ?></li>
        <li class="list-group-item"><strong>Jumlah:</strong> <?= $pending['quantity'] ?></li>
        <li class="list-group-item"><strong>Total:</strong> Rp <?= number_format($total_harga, 0, ',', '.') ?></li>
    </ul>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Pembayaran Akun Dana</strong>
        <a>Farid - 08388212878</a>
    </li>
    </ul>
    
    <form action="index.php?page=order_bayar" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="bukti">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-success">Kirim</button>
        <a href="index.php?page=order_batal" class="btn btn-danger">Batalkan</a>
    </form>
</div>
<?php include 'views/layouts/footeremployee.php'; ?>
