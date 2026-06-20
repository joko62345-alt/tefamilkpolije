<?php

class ContactModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllReviews() {
        $this->db->query("SELECT * FROM contacts WHERE rating > 0 ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    public function saveContact($data) {
        $this->db->query("INSERT INTO contacts (name, email, rating, message) VALUES (:name, :email, :rating, :message)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':message', $data['message']);
        return $this->db->execute();
    }
}
