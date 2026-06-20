<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserByUsername($username) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function getUserByEmail($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function getUserById($id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function register($data) {
        $this->db->query("INSERT INTO users (username, email, password, name, phone, address, role) 
                          VALUES (:username, :email, :password, :name, :phone, :address, 'customer')");
        
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);

        return $this->db->execute();
    }

    public function updateProfile($data) {
        $this->db->query("UPDATE users SET name = :name, phone = :phone, address = :address WHERE id = :id");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function updatePassword($id, $password) {
        $this->db->query("UPDATE users SET password = :password WHERE id = :id");
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getAllCustomers() {
        $this->db->query("SELECT * FROM users WHERE role = 'customer' ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    public function getCustomerCount() {
        $this->db->query("SELECT COUNT(*) as count FROM users WHERE role = 'customer'");
        $res = $this->db->single();
        return $res['count'];
    }
}
