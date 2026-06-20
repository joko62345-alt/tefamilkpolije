<?php

class ReviewModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Get all reviews
    public function getAllReviews() {
        $this->db->query("SELECT r.*, u.name, u.id as user_id, o.id as order_id
                          FROM reviews r
                          JOIN users u ON r.user_id = u.id
                          JOIN orders o ON r.order_id = o.id
                          WHERE r.status = 'approved'
                          ORDER BY r.created_at DESC");
        return $this->db->resultSet();
    }

    // Get approved reviews with pagination
    public function getApprovedReviews($limit = 10, $offset = 0) {
        $this->db->query("SELECT r.*, u.name, u.id as user_id
                          FROM reviews r
                          JOIN users u ON r.user_id = u.id
                          WHERE r.status = 'approved'
                          ORDER BY r.created_at DESC
                          LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    // Get review for specific order
    public function getReviewByOrder($orderId) {
        $this->db->query("SELECT * FROM reviews WHERE order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        return $this->db->single();
    }

    // Get pending reviews (untuk admin)
    public function getPendingReviews() {
        $this->db->query("SELECT r.*, u.name, u.email, o.id as order_id
                          FROM reviews r
                          JOIN users u ON r.user_id = u.id
                          JOIN orders o ON r.order_id = o.id
                          WHERE r.status = 'pending'
                          ORDER BY r.created_at ASC");
        return $this->db->resultSet();
    }

    // Create review
    public function createReview($data) {
        $this->db->query("INSERT INTO reviews (order_id, user_id, rating, title, message, image, status)
                          VALUES (:order_id, :user_id, :rating, :title, :message, :image, :status)");
        $this->db->bind(':order_id', $data['order_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':rating', $data['rating'] ?? 5);
        $this->db->bind(':title', $data['title'] ?? null);
        $this->db->bind(':message', $data['message']);
        $this->db->bind(':image', $data['image'] ?? null);
        $this->db->bind(':status', 'pending');
        return $this->db->execute();
    }

    // Approve review (admin)
    public function approveReview($reviewId) {
        $this->db->query("UPDATE reviews SET status = 'approved' WHERE id = :id");
        $this->db->bind(':id', $reviewId);
        return $this->db->execute();
    }

    // Reject review (admin)
    public function rejectReview($reviewId) {
        $this->db->query("DELETE FROM reviews WHERE id = :id");
        $this->db->bind(':id', $reviewId);
        return $this->db->execute();
    }

    // Get review by id
    public function getReviewById($reviewId) {
        $this->db->query("SELECT r.*, u.name FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.id = :id");
        $this->db->bind(':id', $reviewId);
        return $this->db->single();
    }

    // Count approved reviews
    public function countApprovedReviews() {
        $this->db->query("SELECT COUNT(*) as count FROM reviews WHERE status = 'approved'");
        $res = $this->db->single();
        return $res['count'];
    }

    // Count pending reviews
    public function countPendingReviews() {
        $this->db->query("SELECT COUNT(*) as count FROM reviews WHERE status = 'pending'");
        $res = $this->db->single();
        return $res['count'];
    }

    // Get average rating
    public function getAverageRating() {
        $this->db->query("SELECT AVG(rating) as avg_rating FROM reviews WHERE status = 'approved'");
        $res = $this->db->single();
        return $res['avg_rating'] ? round($res['avg_rating'], 1) : 0;
    }
}
