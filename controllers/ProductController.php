<?php
require_once 'models/Product.php';

class ProductController
{
    public function index()
    {
        $product = new Product();
        $produk = $product->getAll();
        include 'views/admin/produk/index.php';
    }

    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = new Product();
            $nama = $_POST['nama'];
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $type = $_POST['type'];

            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmp, "uploads/" . $image);

            $product->create($nama, $deskripsi, $harga, $image, $type);
            header('Location: index.php?page=produk');
        } else {
            include 'views/admin/produk/tambah.php';
        }
    }

    public function edit()
    {
        $product = new Product();
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $type = $_POST['type'];

            $image = $_FILES['image']['name'];
            if ($image != "") {
                $tmp = $_FILES['image']['tmp_name'];
                move_uploaded_file($tmp, "uploads/" . $image);
            } else {
                $image = $_POST['image_lama'];
            }

            $product->update($id, $nama, $deskripsi, $harga, $image, $type);
            header('Location: index.php?page=produk');
        } else {
            $data = $product->getById($id);
            include 'views/admin/produk/edit.php';
        }
    }

    public function hapus()
    {
        $product = new Product();
        $id = $_GET['id'];
        $product->delete($id);
        header('Location: index.php?page=produk');
    }

    public function list_produk()
    {
        $productModel = new Product();
        $type = $_GET['type'] ?? null;

        if ($type) {
            $produk = $productModel->getByType($type);
        } else {
            $produk = $productModel->getAll();
        }

        include 'views/employee/produk.php';
    }
}
