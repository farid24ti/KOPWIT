<?php include 'views/layouts/headerdashboard.php'; ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="text-primary m-0">Tambah User Employee</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php?page=tambah_user">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="index.php?page=userdata" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php include 'views/layouts/footerdashboard.php'; ?>
