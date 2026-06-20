<?php

class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createOrder($data) {
        $this->db->query("INSERT INTO orders (user_id, order_date, total_price, status, shipping_address, payment_method, payment_proof)
                          VALUES (:user_id, NOW(), :total_price, 'Menunggu', :shipping_address, :payment_method, :payment_proof)");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':total_price', $data['total_price']);
        $this->db->bind(':shipping_address', $data['shipping_address']);
        $this->db->bind(':payment_method', $data['payment_method']);
        $this->db->bind(':payment_proof', $data['payment_proof'] ?? null);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function addOrderDetail($orderId, $productId, $quantity, $price) {
        $this->db->query("INSERT INTO order_details (order_id, product_id, quantity, price)
                          VALUES (:order_id, :product_id, :quantity, :price)");
        $this->db->bind(':order_id', $orderId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':price', $price);
        return $this->db->execute();
    }

    public function getOrdersByUser($userId) {
        $this->db->query("SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getOrderDetailsByOrder($orderId) {
        $this->db->query("SELECT od.*, p.name, p.image
                          FROM order_details od
                          JOIN products p ON od.product_id = p.id
                          WHERE od.order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        return $this->db->resultSet();
    }

    public function getOrderById($orderId) {
        $this->db->query("SELECT o.*, u.name as customer_name, u.email, u.phone
                          FROM orders o JOIN users u ON o.user_id = u.id
                          WHERE o.id = :id");
        $this->db->bind(':id', $orderId);
        return $this->db->single();
    }

    public function getAllOrders() {
        $this->db->query("SELECT o.*, u.name as customer_name, u.email
                          FROM orders o JOIN users u ON o.user_id = u.id
                          ORDER BY o.created_at DESC");
        return $this->db->resultSet();
    }

    public function updateOrderStatus($orderId, $status) {
        $order = $this->getOrderById($orderId);
        if (!$order || $order['status'] === $status) {
            return false;
        }

        $this->db->beginTransaction();

        $this->db->query("UPDATE orders SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $orderId);
        $updated = $this->db->execute();

        if (!$updated) {
            $this->db->rollback();
            return false;
        }

        $needsStockUpdate = false;
        $direction = 0;
        if ($order['status'] !== 'Selesai' && $status === 'Selesai') {
            $needsStockUpdate = true;
            $direction = -1;
        }
        if ($order['status'] === 'Selesai' && $status !== 'Selesai') {
            $needsStockUpdate = true;
            $direction = 1;
        }

        if ($needsStockUpdate) {
            if (!$this->adjustStockForOrder($orderId, $direction)) {
                $this->db->rollback();
                return false;
            }
        }

        $this->db->commit();
        return true;
    }

    private function adjustStockForOrder($orderId, $direction) {
        $this->db->query("SELECT od.product_id, od.quantity, p.stock FROM order_details od JOIN products p ON od.product_id = p.id WHERE od.order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        $details = $this->db->resultSet();

        foreach ($details as $item) {
            $newStock = $item['stock'] + ($item['quantity'] * $direction);
            if ($direction === -1 && $item['stock'] < $item['quantity']) {
                return false;
            }
            $this->db->query("UPDATE products SET stock = :stock WHERE id = :id");
            $this->db->bind(':stock', max(0, $newStock));
            $this->db->bind(':id', $item['product_id']);
            if (!$this->db->execute()) {
                return false;
            }
        }

        return true;
    }

    public function updateDeliveryProof($orderId, $proofFile) {
        $this->db->query("UPDATE orders SET delivery_proof = :proof WHERE id = :id");
        $this->db->bind(':proof', $proofFile);
        $this->db->bind(':id', $orderId);
        return $this->db->execute();
    }

    public function getOrderCount() {
        $this->db->query("SELECT COUNT(*) as count FROM orders");
        $res = $this->db->single();
        return $res['count'];
    }

    public function getTotalRevenue() {
        $this->db->query("SELECT SUM(total_price) as total FROM orders WHERE status = 'Selesai'");
        $res = $this->db->single();
        return $res['total'] ?? 0;
    }

    public function getOrdersByDateRange($from, $to) {
        $this->db->query("SELECT o.*, u.name as customer_name
                          FROM orders o JOIN users u ON o.user_id = u.id
                          WHERE DATE(o.order_date) BETWEEN :from AND :to
                          ORDER BY o.order_date DESC");
        $this->db->bind(':from', $from);
        $this->db->bind(':to', $to);
        return $this->db->resultSet();
    }

    public function getRevenueByDateRange($from, $to) {
        $this->db->query("SELECT SUM(total_price) as total
                          FROM orders
                          WHERE status = 'Selesai' AND DATE(order_date) BETWEEN :from AND :to");
        $this->db->bind(':from', $from);
        $this->db->bind(':to', $to);
        $res = $this->db->single();
        return $res['total'] ?? 0;
    }
}
