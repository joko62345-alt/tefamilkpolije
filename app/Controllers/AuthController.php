<?php

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function login() {
        if (Helper::isLoggedIn()) {
            if (Helper::getUserRole() === 'admin') {
                Helper::redirect('admin');
            } else {
                Helper::redirect('home');
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = Helper::sanitize($_POST['username']);
            $password = $_POST['password'];

            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_username'] = $user['username'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];

                Helper::setFlash('success', 'Selamat datang kembali, ' . $user['name'] . '!');
                if ($user['role'] === 'admin') {
                    Helper::redirect('admin');
                } else {
                    Helper::redirect('home');
                }
            } else {
                Helper::setFlash('danger', 'Username atau Password salah.');
                $this->view('auth/login');
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function register() {
        if (Helper::isLoggedIn()) {
            Helper::redirect('home');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => Helper::sanitize($_POST['username']),
                'email' => Helper::sanitize($_POST['email']),
                'password' => $_POST['password'],
                'name' => Helper::sanitize($_POST['name']),
                'phone' => Helper::sanitize($_POST['phone']),
                'address' => Helper::sanitize($_POST['address']),
            ];

            if (empty($data['username']) || empty($data['email']) || empty($data['password']) || empty($data['name'])) {
                Helper::setFlash('danger', 'Harap isi semua kolom wajib.');
                $this->view('auth/register', $data);
                return;
            }

            if ($this->userModel->getUserByUsername($data['username'])) {
                Helper::setFlash('danger', 'Username sudah digunakan.');
                $this->view('auth/register', $data);
                return;
            }

            if ($this->userModel->getUserByEmail($data['email'])) {
                Helper::setFlash('danger', 'Email sudah terdaftar.');
                $this->view('auth/register', $data);
                return;
            }

            if ($this->userModel->register($data)) {
                Helper::setFlash('success', 'Registrasi berhasil! Silakan login.');
                Helper::redirect('auth/login');
            } else {
                Helper::setFlash('danger', 'Terjadi kesalahan saat registrasi.');
                $this->view('auth/register', $data);
            }
        } else {
            $this->view('auth/register');
        }
    }

    public function logout() {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        
        Helper::initSession();
        Helper::setFlash('success', 'Anda telah berhasil logout.');
        Helper::redirect('auth/login');
    }
}
