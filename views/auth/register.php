<?php require_once '../views/templates/header.php'; ?>


<style>
    body {
        background: #f9f9f9;
    }
    .register-container {
        margin-top: 130px;
        margin-bottom: 80px;
    }
    .register-card {
        background: #FAF3D6;
        border: 1.5px solid #e2d9b8;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        padding: 35px;
    }
    .register-title {
        font-weight: 700;
        color: #2d2a26;
        text-align: center;
        margin-bottom: 25px;
        position: relative;
    }
    .register-title::after {
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
        padding: 8px 12px;
        transition: 0.3s ease;
    }
    .custom-input:focus {
        border-color: #E4947D;
        box-shadow: 0 0 0 0.2rem rgba(228, 148, 125, 0.25);
    }
    .btn-register {
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
    .btn-register:hover {
        background: #d6836c;
        color: #fff;
    }
    .login-link {
        text-align: center;
        margin-top: 20px;
        font-size: 0.95rem;
    }
    .login-link a {
        color: #E4947D;
        text-decoration: none;
        font-weight: 600;
    }
    .login-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="container register-container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="register-card">
                <h3 class="register-title">DAFTAR AKUN BARU</h3>
                
                <?php Helper::flash(); ?>

                <form action="<?= BASEURL; ?>/auth/register" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control custom-input" placeholder="Nama Lengkap" value="<?= isset($name) ? $name : ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control custom-input" placeholder="contoh@gmail.com" value="<?= isset($email) ? $email : ''; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control custom-input" placeholder="Username untuk login" value="<?= isset($username) ? $username : ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control custom-input" placeholder="Minimal 6 karakter" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">No. Telepon / WhatsApp</label>
                        <input type="text" name="phone" id="phone" class="form-control custom-input" placeholder="Contoh: 08123456789" value="<?= isset($phone) ? $phone : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Pengiriman</label>
                        <textarea name="address" id="address" class="form-control custom-input" rows="3" placeholder="Alamat lengkap rumah Anda untuk pengiriman susu"><?= isset($address) ? $address : ''; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-register">Daftar Akun</button>
                </form>

                <div class="login-link">
                    Sudah punya akun? <a href="<?= BASEURL; ?>/auth/login">Login di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>


