<?php

class ProfileController extends Controller {
    private $userModel;

    public function __construct() {
        Helper::requireCustomer();
        $this->userModel = $this->model('UserModel');
    }

    public function index() {
        $userId = Helper::getUserId();
        $user   = $this->userModel->getUserById($userId);
        $data['title'] = 'Edit Profil – TEFA MILK';
        $data['user']  = $user;
                $data['extra_css'] = ['../public/css/profile.css'];
        $this->view('profile/index', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helper::redirect('profile');
        }
        $userId = Helper::getUserId();
        $data = [
            'id'      => $userId,
            'name'    => Helper::sanitize($_POST['name']),
            'phone'   => Helper::sanitize($_POST['phone']),
            'address' => Helper::sanitize($_POST['address'])
        ];
        if (empty($data['name'])) {
            Helper::setFlash('danger', 'Nama tidak boleh kosong.');
            Helper::redirect('profile');
        }
        if ($this->userModel->updateProfile($data)) {
            $_SESSION['user_name'] = $data['name'];
            Helper::setFlash('success', 'Profil berhasil diperbarui!');
        } else {
            Helper::setFlash('danger', 'Gagal memperbarui profil.');
        }
        Helper::redirect('profile');
    }

    public function changepassword() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helper::redirect('profile');
        }
        $userId      = Helper::getUserId();
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirm     = $_POST['confirm_password'];

        $user = $this->userModel->getUserById($userId);
        if (!password_verify($oldPassword, $user['password'])) {
            Helper::setFlash('danger', 'Password lama tidak sesuai.');
            Helper::redirect('profile');
        }
        if ($newPassword !== $confirm) {
            Helper::setFlash('danger', 'Konfirmasi password tidak cocok.');
            Helper::redirect('profile');
        }
        if (strlen($newPassword) < 6) {
            Helper::setFlash('danger', 'Password baru minimal 6 karakter.');
            Helper::redirect('profile');
        }
        $this->userModel->updatePassword($userId, $newPassword);
        Helper::setFlash('success', 'Password berhasil diubah!');
        Helper::redirect('profile');
    }
}
