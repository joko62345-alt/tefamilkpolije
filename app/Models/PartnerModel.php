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
}
