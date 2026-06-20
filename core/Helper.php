<?php

class Helper {
    public static function initSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function redirect($path) {
        header('Location: ' . BASEURL . '/' . $path);
        exit;
    }

    public static function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    public static function formatRupiah($angka) {
        return "Rp. " . number_format($angka, 0, ',', '.');
    }

    // Flash Messages
    public static function setFlash($tipe, $pesan) {
        $_SESSION['flash'] = [
            'tipe' => $tipe, // success, danger, warning, info
            'pesan' => $pesan
        ];
    }

    public static function flash() {
        if (isset($_SESSION['flash'])) {
            $tipe = $_SESSION['flash']['tipe'];
            $pesan = $_SESSION['flash']['pesan'];
            echo '<div class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert">
                    ' . $pesan . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION['flash']);
        }
    }

    // Authentication Checks
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function getUserRole() {
        return isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
    }

    public static function getUserId() {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    public static function getUserName() {
        return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
    }

    public static function requireLogin() {
        self::initSession();
        if (!self::isLoggedIn()) {
            self::setFlash('danger', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
            self::redirect('auth/login');
        }
    }

    public static function requireRole($role) {
        self::requireLogin();
        if (self::getUserRole() !== $role) {
            self::setFlash('danger', 'Anda tidak memiliki hak akses untuk halaman tersebut.');
            if (self::getUserRole() === 'admin') {
                self::redirect('admin');
            } else {
                self::redirect('home');
            }
        }
    }

    public static function requireAdmin() {
        self::requireRole('admin');
    }

    public static function requireCustomer() {
        self::requireRole('customer');
    }
}
