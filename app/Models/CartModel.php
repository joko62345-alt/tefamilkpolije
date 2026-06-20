<?php

class CartModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getOrCreateCart($userId) {
        $this->db->query("SELECT id FROM carts WHERE user_id = :user_id LIMIT 1");
        $this->db->bind(':user_id', $userId);
        $cart = $this->db->single();
        if ($cart) {
            return $cart['id'];
        }
        $this->db->query("INSERT INTO carts (user_id) VALUES (:user_id)");
        $this->db->bind(':user_id', $userId);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function getCartItems($userId) {
        $this->db->query("SELECT ci.*, p.name, p.price, p.image, p.stock
                          FROM cart_items ci
                          JOIN carts c ON ci.cart_id = c.id
                          JOIN products p ON ci.product_id = p.id
                          WHERE c.user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function addItem($cartId, $productId, $quantity) {
        // Check if already in cart
        $this->db->query("SELECT id, quantity FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id");
        $this->db->bind(':cart_id', $cartId);
        $this->db->bind(':product_id', $productId);
        $existing = $this->db->single();
        if ($existing) {
            $newQty = $existing['quantity'] + $quantity;
            $this->db->query("UPDATE cart_items SET quantity = :qty WHERE id = :id");
            $this->db->bind(':qty', $newQty);
            $this->db->bind(':id', $existing['id']);
            return $this->db->execute();
        }
        $this->db->query("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)");
        $this->db->bind(':cart_id', $cartId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':quantity', $quantity);
        return $this->db->execute();
    }

    public function updateItem($itemId, $quantity) {
        $this->db->query("UPDATE cart_items SET quantity = :qty WHERE id = :id");
        $this->db->bind(':qty', $quantity);
        $this->db->bind(':id', $itemId);
        return $this->db->execute();
    }

    public function removeItem($itemId) {
        $this->db->query("DELETE FROM cart_items WHERE id = :id");
        $this->db->bind(':id', $itemId);
        return $this->db->execute();
    }

    public function clearCart($userId) {
        $this->db->query("DELETE ci FROM cart_items ci
                          JOIN carts c ON ci.cart_id = c.id
                          WHERE c.user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }

    public function getCartTotal($userId) {
        $this->db->query("SELECT SUM(ci.quantity * p.price) as total
                          FROM cart_items ci
                          JOIN carts c ON ci.cart_id = c.id
                          JOIN products p ON ci.product_id = p.id
                          WHERE c.user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        $res = $this->db->single();
        return $res['total'] ?? 0;
    }
}
