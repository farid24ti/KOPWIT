<?php
// File: models/Peminjaman.php
require_once 'config/database.php';

class Peminjaman
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAllByUser($user_id)
    {
        $stmt = $this->conn->prepare("SELECT peminjaman.*, products.nama FROM peminjaman JOIN products ON peminjaman.product_id = products.id WHERE peminjaman.user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($product_id, $user_id, $quantity, $total_harga, $status = 'belum_dibayar')
    {
        $stmt = $this->conn->prepare("INSERT INTO peminjaman (product_id, user_id, quantity, total_harga, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$product_id, $user_id, $quantity, $total_harga, $status]);
    }

    public function uploadBukti($id, $filename)
    {
        $stmt = $this->conn->prepare("UPDATE peminjaman SET bukti_bayar = ?, status = 'menunggu' WHERE id = ?");
        $stmt->execute([$filename, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM peminjaman WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getLastInsertId()
    {
        return $this->conn->lastInsertId();
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("
            SELECT peminjaman.*, products.nama AS nama_produk, products.type
            FROM peminjaman
            JOIN products ON peminjaman.product_id = products.id
            WHERE peminjaman.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("
        SELECT p.*, u.name AS nama_user, u.email, pr.nama AS nama_produk
        FROM peminjaman p
        JOIN users u ON p.user_id = u.id
        JOIN products pr ON p.product_id = pr.id
        ORDER BY p.created_at DESC
    ");
        $stmt->execute(); // Penting!
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE peminjaman SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }

    public function update($id, $product_id, $quantity, $total_harga)
    {
        $stmt = $this->conn->prepare("UPDATE peminjaman SET product_id = ?, quantity = ?, total_harga = ? WHERE id = ?");
        $stmt->execute([$product_id, $quantity, $total_harga, $id]);
    }
}
