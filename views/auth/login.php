<?php require_once '../views/templates/header.php'; ?>


<style>
    body {
        background: #f9f9f9;
    }
    .login-container {
        margin-top: 130px;
        margin-bottom: 80px;
    }
    .login-card {
        background: #FAF3D6;
        border: 1.5px solid #e2d9b8;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        padding: 35px;
    }
    .login-title {
        font-weight: 700;
        color: #2d2a26;
        text-align: center;
        margin-bottom: 25px;
        position: relative;
    }
    .login-title::after {
        content: "";
        width: 60px;
        height: 3px;
        background: #E4947D;
        display: block;
        margin: 8px auto 0;
        border-radius: 5px;
    }
    .form-label {
        font-weight: 600;
        color: #4f4b46;
    }
    .custom-input {
        border-radius: 8px;
        border: 1.5px solid #dedede;
        padding: 10px 15px;
        transition: 0.3s ease;
    }
    .custom-input:focus {
        border-color: #E4947D;
        box-shadow: 0 0 0 0.2rem rgba(228, 148, 125, 0.25);
    }
    .btn-login {
        background: #E4947D;
        color: #ffffff;
        padding: 10px;
        border-radius: 8px;
        border: none;
        font-size: 1.1rem;
        font-weight: 600;
        transition: 0.3s ease;
        width: 100%;
        margin-top: 15px;
    }
    .btn-login:hover {
        background: #d6836c;
        color: #fff;
    }
    .register-link {
        text-align: center;
        margin-top: 20px;
        font-size: 0.95rem;
    }
    .register-link a {
        color: #E4947D;
        text-decoration: none;
        font-weight: 600;
    }
    .register-link a:hover {
        text-decoration: underline;
    }
    .btn-back-home {
        background: #ffffff;
        color: #E4947D;
        padding: 10px 20px;
        border-radius: 8px;
        border: 2px solid #E4947D;
        font-size: 1rem;
        font-weight: 600;
        transition: 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-top: 15px;
    }
    .btn-back-home:hover {
        background: #E4947D;
        color: #fff;
    }
</style>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="login-card">
                <h3 class="login-title">LOGIN USER</h3>
                
                <?php Helper::flash(); ?>

                <form action="<?= BASEURL; ?>/auth/login" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control custom-input" placeholder="Masukkan username" required autofocus>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control custom-input" placeholder="Masukkan password" required>
                    </div>

                    <button type="submit" class="btn btn-login">Login</button>
                </form>

                <div class="register-link">
                    Belum punya akun? <a href="<?= BASEURL; ?>/auth/register">Daftar Sekarang</a>
                </div>
                
                <a href="<?= BASEURL; ?>/home" class="btn-back-home">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>


