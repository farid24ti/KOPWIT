<?php
// File: controllers/PeminjamanController.php
require_once 'models/Product.php';
require_once 'models/Peminjaman.php';

class PeminjamanController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $model = new Peminjaman();
        $data = $model->getAllByUser($_SESSION['user']['id']);
        include 'views/employee/peminjaman/index.php';
    }

    public function tambah()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $productModel = new Product();
        $produk = $productModel->getByType(['dodos', 'egrek']); // filter hanya produk tipe dodos dan egrek

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            $produkItem = $productModel->getById($product_id);

            // Tentukan harga sewa
            $harga_per_item = $produkItem['type'] === 'egrek' ? 20000 : 30000;
            $total_harga = $harga_per_item * $quantity;

            $peminjamanModel = new Peminjaman();
            $peminjamanModel->create($product_id, $_SESSION['user']['id'], $quantity, $total_harga, 'belum_dibayar');

            $id = $peminjamanModel->getLastInsertId();
            header("Location: index.php?page=peminjaman_konfirmasi&id=$id");
            exit;
        }

        include 'views/employee/peminjaman/tambah.php';
    }

    public function bayar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $peminjamanModel = new Peminjaman();
            $data = $peminjamanModel->getById($id);

            if ($data['user_id'] === $_SESSION['user']['id']) {
                if (isset($_FILES['bukti_bayar']) && $_FILES['bukti_bayar']['error'] === UPLOAD_ERR_OK) {
                    $filename = uniqid() . '_' . $_FILES['bukti_bayar']['name'];
                    $target = 'uploads/peminjaman/' . $filename;
                    if (!is_dir('uploads/peminjaman')) {
                        mkdir('uploads/peminjaman', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], $target)) {
                        $peminjamanModel->uploadBukti($id, $filename);
                    }
                }
            }

            header('Location: index.php?page=peminjaman_index');
        }
    }

    public function batal()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_GET['id'];
        $model = new Peminjaman();
        $data = $model->getById($id);

        if ($data && $data['status'] === 'belum_dibayar' && $data['user_id'] === $_SESSION['user']['id']) {
            $model->delete($id);
        }

        header('Location: index.php?page=peminjaman_index');
    }

    public function konfirmasi()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php?page=peminjaman_index');
            exit;
        }

        $peminjamanModel = new Peminjaman();
        $peminjaman = $peminjamanModel->getById($_GET['id']);

        if (!$peminjaman || $peminjaman['user_id'] !== $_SESSION['user']['id']) {
            echo "Akses ditolak atau data tidak ditemukan.";
            exit;
        }

        include 'views/employee/peminjaman/konfirmasi.php';
    }

    public function hapus()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SESSION['user']['role'] !== 'employee') exit("Akses ditolak.");

        $id = $_GET['id'] ?? null;
        if (!$id) exit("ID tidak valid.");

        $model = new Peminjaman();
        $data = $model->getById($id);

        if (!$data || $data['user_id'] != $_SESSION['user']['id'] || !in_array($data['status'], ['belum_dibayar', 'menunggu'])) {
            exit("Tidak bisa hapus data ini.");
        }

        $model->delete($id);
        header('Location: index.php?page=peminjaman_index');
        exit;
    }


    public function adminIndex()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SESSION['user']['role'] !== 'admin') {
            exit('Akses ditolak!');
        }

        $model = new Peminjaman();
        $data = $model->getAll(); // ambil semua data peminjaman (dari semua user)

        include 'views/admin/peminjaman/index.php';
    }

    public function adminUpdateStatus()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SESSION['user']['role'] !== 'admin') exit('Akses ditolak!');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status'];

            $model = new Peminjaman();
            $model->updateStatus($id, $status);

            header('Location: index.php?page=admin_peminjaman');
        }
    }

    public function adminDetail()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SESSION['user']['role'] !== 'admin') {
            exit('Akses ditolak!');
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID tidak ditemukan.";
            return;
        }

        $model = new Peminjaman();
        $data = $model->getById($id);

        include 'views/admin/peminjaman/detail.php';
    }

    public function edit()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SESSION['user']['role'] !== 'employee') exit("Akses ditolak.");

        $id = $_GET['id'] ?? null;
        $model = new Peminjaman();
        $data = $model->getById($id);

        if (!$data || $data['user_id'] != $_SESSION['user']['id'] || !in_array($data['status'], ['belum_dibayar', 'menunggu'])) {
            exit("Tidak bisa edit data ini.");
        }

        $productModel = new Product();
        $produk = $productModel->getByType(['dodos', 'egrek']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            $produkItem = $productModel->getById($product_id);
            $harga_per_item = $produkItem['type'] === 'egrek' ? 10000 : 15000;
            $total_harga = $harga_per_item * $quantity;

            $model->update($id, $product_id, $quantity, $total_harga);
            header("Location: index.php?page=peminjaman_index");
            exit;
        }

        include 'views/employee/peminjaman/edit.php';
    }
}
