<?php include 'views/layouts/headerdashboard.php'; ?>

<div class="container mt-4">
    <h2 class="h4 text-gray-800 mb-4">Edit User Employee</h2>

    <form method="POST" action="index.php?page=edit_user&id=<?= $data['id'] ?>">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['name']) ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="index.php?page=datauser" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include 'views/layouts/footerdashboard.php'; ?>
