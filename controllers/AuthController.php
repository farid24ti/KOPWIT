<?php
require_once 'models/User.php';

class AuthController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();

            // Role default = employee
            $role = 'employee';

            $user->register($_POST['name'], $_POST['email'], $_POST['password'], $role);
            header('Location: index.php?page=login');
        } else {
            include 'views/auth/register.php';
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $result = $user->login($_POST['email'], $_POST['password']);

            if ($result) {
                $_SESSION['user'] = $result;

                if ($result['role'] == 'admin') {
                    header('Location: index.php?page=produk');
                } else {
                    header('Location: index.php?page=list_produk');
                }
            } else {
                echo "Login gagal!";
            }
        } else {
            include 'views/auth/login.php';
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php?page=login');
    }

    public function dashboardAdmin()
    {
        if ($_SESSION['user']['role'] == 'admin') {
            include 'views/admin/admindashboard.php';
        } else {
            echo "Akses ditolak!";
        }
    }

    public function dataUser()
    {
        // Cek apakah user admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            echo "Akses ditolak!";
            return;
        }
        $user = new User();
        $employees = $user->getAllEmployees();

        include 'views/admin/datauser/index.php';
    }


    public function tambahUser()
    {
        // Pastikan hanya admin yang bisa akses
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            echo "Akses ditolak!";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = 'employee'; // paksa jadi employee

            $user->register($name, $email, $password, $role);
            header('Location: index.php?page=datauser');
        } else {
            include 'views/admin/datauser/tambah.php';
        }
    }

    public function editUser()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            echo "Akses ditolak!";
            return;
        }

        $user = new User();
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $user->updateUser($id, $name, $email);
            header('Location: index.php?page=datauser');
        } else {
            $data = $user->getUserById($id);
            include 'views/admin/datauser/edit.php';
        }
    }

    public function hapusUser()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            echo "Akses ditolak!";
            return;
        }

        $user = new User();
        $id = $_GET['id'];
        $user->deleteUser($id);

        header('Location: index.php?page=datauser');
    }

    //employee
    public function dashboardEmployee()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
            echo "Akses ditolak!";
            exit;
        }

        $product = new Product();
        $produk = $product->getAll(); // Ambil semua produk dari tabel
        include 'views/employee/employeedashboard.php';
    }

    public function list_produk()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
            echo "Akses ditolak!";
            exit;
        }

        $product = new Product();
        $produk = $product->getAll();
        include 'views/employee/produk/index.php'; // file ini akan kita buat
    }
}
