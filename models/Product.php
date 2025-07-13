<?php
require_once 'config/database.php';

class Product
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nama, $deskripsi, $harga, $image, $type)
    {
        $stmt = $this->conn->prepare("INSERT INTO products (nama, deskripsi, harga, image, type) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nama, $deskripsi, $harga, $image, $type]);
    }


    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nama, $deskripsi, $harga, $image, $type)
    {
        $stmt = $this->conn->prepare("UPDATE products SET nama = ?, deskripsi = ?, harga = ?, image = ?, type = ? WHERE id = ?");
        return $stmt->execute([$nama, $deskripsi, $harga, $image, $type, $id]);
    }


    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByType(array $types)
    {
        $placeholders = implode(',', array_fill(0, count($types), '?'));
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE type IN ($placeholders)");
        $stmt->execute($types);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getForPeminjaman()
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE type IN ('dodos', 'egrek')");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
