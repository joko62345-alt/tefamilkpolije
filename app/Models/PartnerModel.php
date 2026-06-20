<?php

class PartnerModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllPartners() {
        $this->db->query("SELECT * FROM partners ORDER BY created_at ASC");
        return $this->db->resultSet();
    }

    public function getPartnerById($id) {
        $this->db->query("SELECT * FROM partners WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function createPartner($data) {
        $this->db->query("INSERT INTO partners (name, image, description) VALUES (:name, :image, :description)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':description', $data['description']);
        return $this->db->execute();
    }

    public function updatePartner($id, $data) {
        $this->db->query("UPDATE partners SET name = :name, description = :description WHERE id = :id");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function updatePartnerImage($id, $image) {
        $this->db->query("UPDATE partners SET image = :image WHERE id = :id");
        $this->db->bind(':image', $image);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function deletePartner($id) {
        $this->db->query("DELETE FROM partners WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
