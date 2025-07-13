<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$user = $_SESSION['user'] ?? null;

if (!$user) {
    header('Location: index.php?page=login');
    exit;
}
?>

<?php
if ($user['role'] === 'admin') {
    include 'views/layouts/headerdashboard.php';
} else {
    include 'views/layouts/headeremployee.php';
}
?>

<div class="container mt-4">
    <h4 class="text-gray-800 mb-4">Profil Pengguna</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td><?= htmlspecialchars($user['nama']) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Bergabung</th>
                    <td><?= $user['created_at'] ?? '-' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php
if ($user['role'] === 'admin') {
    include 'views/layouts/footerdashboard.php';
} else {
    include 'views/layouts/footeremployee.php';
}
?>