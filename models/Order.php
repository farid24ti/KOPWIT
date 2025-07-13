<?php
require_once 'config/database.php';

class Order
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Membuat order baru
    public function create($product_id, $user_id, $quantity, $total_harga)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO orders (product_id, user_id, quantity, total_harga) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$product_id, $user_id, $quantity, $total_harga]);
    }

    // Ambil semua order berdasarkan user login
    public function getAllByUser($user_id)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                o.*, 
                p.nama AS nama_produk 
            FROM orders o
            JOIN products p ON o.product_id = p.id 
            WHERE o.user_id = ? 
            ORDER BY o.created_at DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil semua order untuk admin
    public function getAll()
    {
        $stmt = $this->conn->query("
            SELECT 
                o.*, 
                p.nama AS nama_produk, 
                u.name AS nama_user 
            FROM orders o
            JOIN products p ON o.product_id = p.id 
            JOIN users u ON o.user_id = u.id 
            ORDER BY o.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil detail satu order berdasarkan ID
    public function getById($id)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                o.*, 
                p.nama AS nama_produk, 
                u.name AS nama_user 
            FROM orders o
            JOIN products p ON o.product_id = p.id 
            JOIN users u ON o.user_id = u.id 
            WHERE o.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update status order
    public function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare("
            UPDATE orders 
            SET status = ? 
            WHERE id = ?
        ");
        return $stmt->execute([$status, $id]);
    }

    public function update($id, $product_id, $quantity, $total_harga)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET product_id = ?, quantity = ?, total_harga = ? WHERE id = ?");
        return $stmt->execute([$product_id, $quantity, $total_harga, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM orders WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByIdWithUserProduct($id)
    {
        $stmt = $this->conn->prepare("
        SELECT orders.*, products.nama AS nama_produk, users.name AS nama_user, users.email 
        FROM orders
        JOIN products ON orders.product_id = products.id
        JOIN users ON orders.user_id = users.id
        WHERE orders.id = ?
    ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createWithStatus($product_id, $user_id, $quantity, $total_harga, $status)
    {
        $stmt = $this->conn->prepare("INSERT INTO orders (product_id, user_id, quantity, total_harga, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$product_id, $user_id, $quantity, $total_harga, $status]);
    }

    public function getLastInsertId()
    {
        return $this->conn->lastInsertId();
    }

    public function updateBuktiAndStatus($id, $bukti_bayar, $status)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET bukti_bayar = ?, status = ? WHERE id = ?");
        return $stmt->execute([$bukti_bayar, $status, $id]);
    }

    public function createWithBukti($product_id, $user_id, $quantity, $total_harga, $bukti_bayar, $status)
    {
        $stmt = $this->conn->prepare("INSERT INTO orders (product_id, user_id, quantity, total_harga, bukti_bayar, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$product_id, $user_id, $quantity, $total_harga, $bukti_bayar, $status]);
    }
}
