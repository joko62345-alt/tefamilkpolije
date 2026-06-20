<?php require_once '../views/templates/header.php'; ?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        /* Background halaman dengan gradient biru muda */
        background: linear-gradient(135deg, #E0F2FE 0%, #DBEAFE 50%, #EFF6FF 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    /* ============================================
       MAIN CONTAINER - KOTAK PUTIH KEBIRUAN
       ============================================ */
    .register-container {
        width: 100%;
        max-width: 800px;
        background: linear-gradient(135deg, #FFFFFF 0%, #F0F9FF 50%, #EFF6FF 100%);
        border-radius: 24px;
        box-shadow: 0 25px 60px rgba(37, 99, 235, 0.15),
                    0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid rgba(147, 197, 253, 0.3);
        position: relative;
        padding: 50px;
    }

    /* Dekorasi sudut atas kanan */
    .register-container::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 1;
    }

    /* Dekorasi sudut bawah kiri */
    .register-container::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(147, 197, 253, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 1;
    }

    /* ============================================
       FORM CONTENT
       ============================================ */
    .register-content {
        position: relative;
        z-index: 2;
        max-width: 650px;
        margin: 0 auto;
    }

    .register-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .register-welcome {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .register-subtitle {
        font-size: 0.9rem;
        color: #64748b;
        line-height: 1.6;
    }

    /* ============================================
       FORM FIELDS
       ============================================ */
    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
        margin-bottom: 18px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        font-size: 0.88rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-label .required {
        color: #EF4444;
        margin-left: 2px;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1rem;
        z-index: 2;
        pointer-events: none;
    }

    .form-control-custom {
        width: 100%;
        padding: 13px 16px 13px 48px;
        border: 2px solid #E2E8F0;
        border-radius: 12px;
        font-size: 0.93rem;
        color: #1e293b;
        background: white;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        background: #FAFBFF;
    }

    .form-control-custom::placeholder {
        color: #94a3b8;
    }

    textarea.form-control-custom {
        resize: vertical;
        min-height: 90px;
        padding: 13px 16px 13px 48px;
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        font-size: 1rem;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #3B82F6;
    }

    .form-hint {
        display: block;
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 5px;
    }

    /* ============================================
       BUTTONS
       ============================================ */
    .btn-register-primary {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .btn-register-primary:hover {
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
    }

    /* ============================================
       LINKS
       ============================================ */
    .login-link {
        text-align: center;
        margin-top: 22px;
        font-size: 0.9rem;
        color: #64748b;
    }

    .login-link a {
        color: #3B82F6;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .login-link a:hover {
        color: #1e40af;
        text-decoration: underline;
    }

    .back-home-wrapper {
        margin-top: 18px;
        text-align: center;
    }

    .btn-back-home {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 12px 28px;
        background: white;
        color: #3B82F6;
        border: 2px solid #DBEAFE;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.08);
    }

    .btn-back-home:hover {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: white;
        border-color: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
    }

    .btn-back-home i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }

    .btn-back-home:hover i {
        transform: translateX(-3px);
    }

    /* ============================================
       DIVIDER
       ============================================ */
    .form-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #E2E8F0, transparent);
        margin: 25px 0;
    }

    .section-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #3B82F6;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-label i {
        font-size: 1rem;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 768px) {
        body {
            padding: 20px 15px;
            align-items: flex-start;
        }

        .register-container {
            padding: 35px 25px;
            border-radius: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .register-welcome {
            font-size: 1.5rem;
        }

        .btn-back-home {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .register-container {
            padding: 30px 20px;
        }
    }

    /* Flash Message */
    .alert {
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-danger {
        background: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FECACA;
    }

    .alert-success {
        background: #F0FDF4;
        color: #16A34A;
        border: 1px solid #BBF7D0;
    }

    .alert-warning {
        background: #FFFBEB;
        color: #D97706;
        border: 1px solid #FDE68A;
    }
</style>

<!-- ============================================
     MAIN CONTAINER - KOTAK PUTIH KEBIRUAN
     ============================================ -->
<div class="register-container">
    <div class="register-content">
        
        <!-- Header -->
        <div class="register-header">
            <h2 class="register-welcome">Daftar Akun Baru </h2>
            <p class="register-subtitle">Buat akun untuk mulai berbelanja produk susu segar TEFA MILK</p>
        </div>

        <?php Helper::flash(); ?>

        <form action="<?= BASEURL; ?>/auth/register" method="POST">
            
            <!-- SECTION 1: Informasi Akun -->
            <div class="section-label">
                <i class="bi bi-person-badge"></i>
                <span>Informasi Akun</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="name" class="form-label">
                        Nama Lengkap <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="form-control-custom" 
                               placeholder="Masukkan nama lengkap" 
                               value="<?= isset($name) ? $name : ''; ?>" 
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="form-label">
                        Username <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-at input-icon"></i>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control-custom" 
                               placeholder="Username untuk login" 
                               value="<?= isset($username) ? $username : ''; ?>" 
                               required>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email" class="form-label">
                        Email <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control-custom" 
                               placeholder="contoh@gmail.com" 
                               value="<?= isset($email) ? $email : ''; ?>" 
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">
                        Password <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control-custom" 
                               placeholder="Minimal 6 karakter" 
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    <small class="form-hint">Gunakan minimal 6 karakter dengan kombinasi huruf dan angka</small>
                </div>
            </div>

            <!-- Divider -->
            <div class="form-divider"></div>

            <!-- SECTION 2: Informasi Kontak -->
            <div class="section-label">
                <i class="bi bi-telephone"></i>
                <span>Informasi Kontak</span>
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">
                    No. Telepon / WhatsApp
                </label>
                <div class="input-wrapper">
                    <i class="bi bi-whatsapp input-icon"></i>
                    <input type="text" 
                           name="phone" 
                           id="phone" 
                           class="form-control-custom" 
                           placeholder="Contoh: 08123456789" 
                           value="<?= isset($phone) ? $phone : ''; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">
                    Alamat Pengiriman
                </label>
                <div class="input-wrapper">
                    <i class="bi bi-geo-alt input-icon" style="top: 20px; transform: none;"></i>
                    <textarea name="address" 
                              id="address" 
                              class="form-control-custom" 
                              rows="3" 
                              placeholder="Alamat lengkap rumah Anda untuk pengiriman susu"><?= isset($address) ? $address : ''; ?></textarea>
                </div>
                <small class="form-hint">Alamat ini akan digunakan sebagai alamat default saat checkout</small>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-register-primary">
                Daftar Akun
            </button>
        </form>

        <!-- Links -->
        <p class="login-link">
            Sudah punya akun? <a href="<?= BASEURL; ?>/auth/login">Login di sini</a>
        </p>

        <div class="back-home-wrapper">
            <a href="<?= BASEURL; ?>/home" class="btn-back-home">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
</script>
