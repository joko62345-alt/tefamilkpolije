<?php

class GalleryModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getGalleriesByType($type) {
        $this->db->query("SELECT * FROM galleries WHERE type = :type ORDER BY created_at DESC");
        $this->db->bind(':type', $type);
        return $this->db->resultSet();
    }

    // Get all galleries
    public function getAllGalleries() {
        $this->db->query("SELECT * FROM galleries ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // Get gallery by id
    public function getGalleryById($id) {
        $this->db->query("SELECT * FROM galleries WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Create gallery
    public function createGallery($data) {
        $this->db->query("INSERT INTO galleries (title, image, type, description)
                          VALUES (:title, :image, :type, :description)");
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':type', $data['type'] ?? 'kegiatan');
        $this->db->bind(':description', $data['description'] ?? null);
        return $this->db->execute();
    }

    // Update gallery
    public function updateGallery($id, $data) {
        $this->db->query("UPDATE galleries SET title = :title, type = :type, description = :description WHERE id = :id");
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':description', $data['description'] ?? null);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Update gallery image
    public function updateGalleryImage($id, $image) {
        $this->db->query("UPDATE galleries SET image = :image WHERE id = :id");
        $this->db->bind(':image', $image);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Delete gallery
    public function deleteGallery($id) {
        $this->db->query("DELETE FROM galleries WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Get count by type
    public function countByType($type) {
        $this->db->query("SELECT COUNT(*) as count FROM galleries WHERE type = :type");
        $this->db->bind(':type', $type);
        $res = $this->db->single();
        return $res['count'];
    }

    // Get total gallery count
    public function getTotalCount() {
        $this->db->query("SELECT COUNT(*) as count FROM galleries");
        $res = $this->db->single();
        return $res['count'];
    }
}

