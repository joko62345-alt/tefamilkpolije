<?php

class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllCategories() {
        $this->db->query("SELECT * FROM categories ORDER BY id ASC");
        return $this->db->resultSet();
    }

    public function getCategoryById($id) {
        $this->db->query("SELECT * FROM categories WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function createCategory($name) {
        $this->db->query("INSERT INTO categories (name) VALUES (:name)");
        $this->db->bind(':name', $name);
        return $this->db->execute();
    }

    public function updateCategory($id, $name) {
        $this->db->query("UPDATE categories SET name = :name WHERE id = :id");
        $this->db->bind(':name', $name);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function deleteCategory($id) {
        $this->db->query("DELETE FROM categories WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
