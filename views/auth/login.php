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
    .login-container {
        width: 100%;
        max-width: 1000px;
        background: linear-gradient(135deg, #FFFFFF 0%, #F0F9FF 50%, #EFF6FF 100%);
        border-radius: 24px;
        box-shadow: 0 25px 60px rgba(37, 99, 235, 0.15),
                    0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        display: flex;
        border: 1px solid rgba(147, 197, 253, 0.3);
        position: relative;
    }

    /* Dekorasi sudut atas kanan */
    .login-container::before {
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
    .login-container::after {
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
       LEFT SIDE - GAMBAR
       ============================================ */
    .login-left {
        width: 50%;
        position: relative;
        overflow: hidden;
        border-radius: 24px 0 0 24px;
    }

    .login-left-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Overlay gradient di atas gambar */
    .login-left::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, rgba(59, 130, 246, 0.3) 100%);
        z-index: 1;
    }

    /* Milk splash di bawah gambar */
    .milk-splash {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.6" d="M0,256L48,240C96,224,192,192,288,186.7C384,181,480,203,576,213.3C672,224,768,224,864,208C960,192,1056,160,1152,160C1248,160,1344,192,1392,208L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
        z-index: 2;
        pointer-events: none;
    }

    /* ============================================
       RIGHT SIDE - FORM
       ============================================ */
    .login-right {
        width: 50%;
        padding: 50px 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 2;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
    }

    .login-welcome {
        font-size: 1.7rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .login-subtitle {
        font-size: 0.88rem;
        color: #64748b;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-label {
        display: block;
        font-size: 0.88rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
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

    .forgot-password {
        text-align: right;
        margin-bottom: 22px;
    }

    .forgot-password a {
        color: #3B82F6;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .forgot-password a:hover {
        color: #1e40af;
        text-decoration: underline;
    }

    .btn-login-primary {
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
    }

    .btn-login-primary:hover {
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
    }

    .register-link {
        text-align: center;
        margin-top: 25px;
        font-size: 0.9rem;
        color: #64748b;
    }

    .register-link a {
        color: #3B82F6;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .register-link a:hover {
        color: #1e40af;
        text-decoration: underline;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 900px) {
        .login-left {
            display: none;
        }

        .login-right {
            width: 100%;
            padding: 40px 30px;
        }

        .login-container {
            border-radius: 20px;
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 20px 15px;
        }

        .login-right {
            padding: 35px 25px;
        }

        .login-welcome {
            font-size: 1.5rem;
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
    /* Versi Simpel - Hanya Teks */
.back-home-wrapper {
    margin-top: 20px;
    text-align: center;
}

.btn-back-home {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #64748b;
    font-size: 0.88rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 8px 16px;
    border-radius: 8px;
}

.btn-back-home:hover {
    color: #3B82F6;
    background: #EFF6FF;
}

.btn-back-home i {
    font-size: 0.9rem;
    transition: transform 0.3s ease;
}

.btn-back-home:hover i {
    transform: translateX(-3px);
}
</style>

<!-- ============================================
     MAIN CONTAINER - KOTAK PUTIH KEBIRUAN
     ============================================ -->
<div class="login-container">
    
    <!-- LEFT SIDE - GAMBAR -->
    <div class="login-left">
        <!-- GANTI DENGAN GAMBAR ANDA -->
        <img src="<?= BASEURL; ?>/image/1.png" 
             alt="Background" 
             class="login-left-image">
        
        <!-- Milk splash decoration -->
        <div class="milk-splash"></div>
    </div>

    <!-- RIGHT SIDE - FORM LOGIN -->
    <div class="login-right">
        <div class="login-card">
            <h2 class="login-welcome">Selamat Datang </h2>
            <p class="login-subtitle">Masuk untuk melanjutkan ke akun Tefa Milk Polije Anda</p>

            <?php Helper::flash(); ?>

            <form action="<?= BASEURL; ?>/auth/login" method="POST">
                <div class="form-group">
                    <label class="form-label">Username / Email</label>
                    <div class="input-wrapper">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control-custom" 
                               placeholder="Masukkan username atau email" 
                               required 
                               autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control-custom" 
                               placeholder="Masukkan password Anda" 
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="#">Lupa password?</a>
                </div>

                <button type="submit" class="btn-login-primary">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk
                </button>
            </form>

            <p class="register-link">
    Belum punya akun? <a href="<?= BASEURL; ?>/auth/register">Daftar sekarang</a>
</p>

<!-- Tombol Kembali ke Beranda -->
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

