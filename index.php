<?php
session_start();
require_once 'controllers/AuthController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/OrderController.php';
require_once 'controllers/PeminjamanController.php';

$page = $_GET['page'] ?? 'login';

$authController = new AuthController();
$productController = new ProductController();
$orderController = new OrderController();
$peminjamanController = new PeminjamanController();

switch ($page) {
    // Auth routes
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;

    // Admin Dashboard
    case 'dashboardadmin':
        $authController->dashboardAdmin();
        break;

    // Admin - User management
    case 'datauser':
        $authController->dataUser();
        break;
    case 'tambah_user':
        $authController->tambahUser();
        break;
    case 'edit_user':
        $authController->editUser();
        break;
    case 'hapus_user':
        $authController->hapusUser();
        break;

    // Admin - Product management
    case 'produk':
        $productController->index();
        break;
    case 'tambah_produk':
        $productController->tambah();
        break;
    case 'edit_produk':
        $productController->edit();
        break;
    case 'hapus_produk':
        $productController->hapus();
        break;

    // Admin - Order management
    case 'admin_orders':
        $orderController->adminIndex();
        break;
    case 'admin_order_update':
        $orderController->adminUpdateStatus();
        break;
    case 'admin_order_detail':
        $orderController->adminDetail();
        break;

    //admin - peminjaman management
    case 'admin_peminjaman':
        $peminjamanController->adminIndex();
        break;
    case 'admin_peminjaman_update':
        $peminjamanController->adminUpdateStatus();
        break;
    case 'admin_peminjaman_detail':
        $peminjamanController->adminDetail();
        break;
    case 'peminjaman_edit':
        $peminjamanController->edit();
        break;
    case 'peminjaman_hapus':
        $peminjamanController->hapus();
        break;
    case 'peminjaman_batal':
        $peminjamanController->batal();
        break;

    // Employee Dashboard
    case 'dashboardemployee':
        $authController->dashboardEmployee();
        break;

    // Employee - Product view
    case 'list_produk':
        $authController->list_produk();
        break;

    // Employee - Order routes
    case 'order_index':
        $orderController->index();
        break;
    case 'order_detail':
        $orderController->detail($_GET['id'] ?? null);
        break;
    case 'order_tambah':
        $orderController->tambah();
        break;
    case 'order_edit':
        $orderController->edit();
        break;
    case 'order_hapus':
        $orderController->hapus();
        break;
    case 'order_konfirmasi':
        $orderController->konfirmasi();
        break;
    case 'order_bayar':
        $orderController->bayar();
        break;
    case 'order_batal':
        $orderController->batal();
        break;

    case 'peminjaman_index':
        $peminjamanController->index();
        break;
    case 'peminjaman_tambah':
        $peminjamanController->tambah();
        break;
    case 'peminjaman_konfirmasi':
        $peminjamanController->konfirmasi();
        break;
    case 'peminjaman_bayar':
        $peminjamanController->bayar();
        break;

    case 'profile':
        include 'views/profile/index.php';
        break;

    // default fallback
    default:
        $authController->login();
        break;
}
