<?php
require_once 'models/Order.php';
require_once 'models/Product.php';

class OrderController
{
    private function auth($role)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
            exit('Akses ditolak!');
        }
    }

    public function index()
    {
        $this->auth('employee');

        $orderModel = new Order();
        $orders = $orderModel->getAllByUser($_SESSION['user']['id']);

        include 'views/employee/orders/index.php';
    }

    public function detail($id)
    {
        $this->auth('employee');

        $orderModel = new Order();
        $detail = $orderModel->getById($id);

        if (!$detail || $detail['user_id'] !== $_SESSION['user']['id']) {
            exit('Tidak bisa akses order orang lain.');
        }

        include 'views/employee/orders/detail.php';
    }

    public function tambah()
    {
        $this->auth('employee');

        $productModel = new Product();
        $produk = $productModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            $produkItem = $productModel->getById($product_id);
            $harga = $produkItem['harga'];
            $total_harga = $harga * $quantity;

            $_SESSION['pending_order'] = [
                'product_id' => $product_id,
                'user_id' => $_SESSION['user']['id'],
                'quantity' => $quantity,
                'total_harga' => $total_harga
            ];

            header("Location: index.php?page=order_konfirmasi");
            exit;
        }

        include 'views/employee/orders/tambah.php';
    }


    public function konfirmasi()
    {
        $this->auth('employee');

        if (!isset($_SESSION['pending_order'])) {
            header('Location: index.php?page=order_index');
            exit;
        }

        $order = $_SESSION['pending_order'];
        include 'views/employee/orders/konfirmasi.php';
    }

    public function bayar()
    {
        $this->auth('employee');

        if (!isset($_SESSION['pending_order'])) {
            header("Location: index.php?page=order_index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bukti'])) {
            $file = $_FILES['bukti'];

            if ($file['error'] === UPLOAD_ERR_OK) {
                $filename = uniqid() . '_' . $file['name'];
                $targetPath = 'uploads/bukti/' . $filename;

                if (!is_dir('uploads/bukti')) {
                    mkdir('uploads/bukti', 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    $orderData = $_SESSION['pending_order'];

                    $orderModel = new Order();
                    $orderModel->createWithBukti(
                        $orderData['product_id'],
                        $orderData['user_id'],
                        $orderData['quantity'],
                        $orderData['total_harga'],
                        $filename,
                        'menunggu'
                    );

                    unset($_SESSION['pending_order']);
                    header("Location: index.php?page=order_index");
                    exit;
                }
            }
        }

        echo "Upload gagal.";
    }

    public function batal()
    {
        $this->auth('employee');
        unset($_SESSION['pending_order']);
        header("Location: index.php?page=order_index");
    }


    public function edit()
    {
        $this->auth('employee');

        $orderModel = new Order();
        $productModel = new Product();

        $id = $_GET['id'];
        $order_data = $orderModel->getById($id);

        if ($order_data['user_id'] !== $_SESSION['user']['id'] || $order_data['status'] !== 'menunggu') {
            exit("Akses ditolak atau tidak bisa edit status.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            $product_data = $productModel->getById($product_id);
            $total_harga = $product_data['harga'] * $quantity;

            $orderModel->update($id, $product_id, $quantity, $total_harga);
            header("Location: index.php?page=order_index");
        } else {
            $products = $productModel->getAll();
            $order = $order_data;
            include 'views/employee/orders/edit.php';
        }
    }

    public function hapus()
    {
        $this->auth('employee');

        $orderModel = new Order();
        $id = $_GET['id'];
        $order_data = $orderModel->getById($id);

        if ($order_data['user_id'] === $_SESSION['user']['id'] && $order_data['status'] === 'menunggu') {
            $orderModel->delete($id);
        }

        header("Location: index.php?page=order_index");
    }

    public function adminIndex()
    {
        $this->auth('admin');

        $orderModel = new Order();
        $orders = $orderModel->getAll();

        include 'views/admin/orders/index.php';
    }

    public function adminUpdateStatus()
    {
        $this->auth('admin');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status'];

            $orderModel = new Order();
            $orderModel->updateStatus($id, $status);

            header("Location: index.php?page=admin_orders");
        }
    }

    public function adminDetail()
    {
        $this->auth('admin');

        $orderModel = new Order();
        $detail = $orderModel->getByIdWithUserProduct($_GET['id']);

        include 'views/admin/orders/detail.php';
    }
}
