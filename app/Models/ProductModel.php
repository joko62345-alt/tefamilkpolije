<?php

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllProducts() {
        $this->db->query("SELECT p.*, c.name as category_name FROM products p 
                          JOIN categories c ON p.category_id = c.id 
                          ORDER BY p.created_at DESC");
        return $this->db->resultSet();
    }

    public function getProductById($id) {
        $this->db->query("SELECT p.*, c.name as category_name FROM products p 
                          JOIN categories c ON p.category_id = c.id 
                          WHERE p.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getRecommendedProducts() {
        $this->db->query("SELECT * FROM products ORDER BY price DESC LIMIT 3");
        return $this->db->resultSet();
    }

    public function getProductsByCategory($categoryId) {
        $this->db->query("SELECT p.*, c.name as category_name FROM products p 
                          JOIN categories c ON p.category_id = c.id 
                          WHERE p.category_id = :category_id 
                          ORDER BY p.name ASC");
        $this->db->bind(':category_id', $categoryId);
        return $this->db->resultSet();
    }

    public function createProduct($data) {
        $this->db->query("INSERT INTO products (category_id, name, description, price, stock, image) 
                          VALUES (:category_id, :name, :description, :price, :stock, :image)");
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':image', $data['image']);
        return $this->db->execute();
    }

    public function updateProduct($data) {
        if (!empty($data['image'])) {
            $this->db->query("UPDATE products SET category_id = :category_id, name = :name, 
                              description = :description, price = :price, stock = :stock, image = :image 
                              WHERE id = :id");
            $this->db->bind(':image', $data['image']);
        } else {
            $this->db->query("UPDATE products SET category_id = :category_id, name = :name, 
                              description = :description, price = :price, stock = :stock 
                              WHERE id = :id");
        }
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function updateStock($id, $newStock) {
        $this->db->query("UPDATE products SET stock = :stock WHERE id = :id");
        $this->db->bind(':stock', $newStock);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function deleteProduct($id) {
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getProductCount() {
        $this->db->query("SELECT COUNT(*) as count FROM products");
        $res = $this->db->single();
        return $res['count'];
    }
}
