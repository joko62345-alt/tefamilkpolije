<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- ============================================
     HERO BANNER - Edit Profil
     ============================================ -->
<section class="profile-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
        </nav>
        <div class="banner-content">
            <span class="banner-label">
                <i class="bi bi-person-gear me-2"></i>AKUN SAYA
            </span>
            <p class="banner-description">
                Perbarui informasi akun dan alamat pengiriman Anda
            </p>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION EDIT PROFIL
     ============================================ -->
<section class="profile-section">
    <div class="container">
        <?php Helper::flash(); ?>

        <div class="profile-wrapper">
            <!-- Tabs -->
            <div class="profile-tabs">
                <button class="tab-button active" data-tab="profile">
                    <i class="bi bi-person-fill me-2"></i>Data Diri
                </button>
                <button class="tab-button" data-tab="password">
                    <i class="bi bi-lock-fill me-2"></i>Ubah Password
                </button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content-wrapper">
                <!-- Profile Tab -->
                <div class="tab-pane active" id="tab-profile">
                    <div class="form-card">
                        <div class="form-header">
                            <div class="form-icon">
                                <i class="bi bi-person-badge"></i>
                            </div>
                            <div>
                                <h4>Informasi Data Diri</h4>
                                <p>Perbarui informasi pribadi dan alamat pengiriman Anda</p>
                            </div>
                        </div>

                        <form action="<?= BASEURL; ?>/profile/update" method="POST">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-at me-1"></i>Username
                                    </label>
                                    <input type="text" 
                                           class="form-control readonly" 
                                           value="<?= $user['username']; ?>" 
                                           readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-envelope me-1"></i>Email
                                    </label>
                                    <input type="email" 
                                           class="form-control readonly" 
                                           value="<?= $user['email']; ?>" 
                                           readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-person me-1"></i>Nama Lengkap <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       class="form-control" 
                                       value="<?= $user['name']; ?>" 
                                       placeholder="Masukkan nama lengkap"
                                       required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-telephone me-1"></i>No. Telepon
                                </label>
                                <input type="text" 
                                       name="phone" 
                                       class="form-control" 
                                       value="<?= $user['phone'] ?? ''; ?>" 
                                       placeholder="Contoh: 08123456789">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-geo-alt me-1"></i>Alamat Pengiriman
                                </label>
                                <textarea name="address" 
                                          rows="3" 
                                          class="form-control" 
                                          placeholder="Masukkan alamat lengkap untuk pengiriman"><?= $user['address'] ?? ''; ?></textarea>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-submit">
                                    <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Password Tab -->
                <div class="tab-pane" id="tab-password">
                    <div class="form-card">
                        <div class="form-header">
                            <div class="form-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div>
                                <h4>Ubah Password</h4>
                                <p>Amankan akun Anda dengan password yang kuat</p>
                            </div>
                        </div>

                        <form action="<?= BASEURL; ?>/profile/changepassword" method="POST">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-lock me-1"></i>Password Lama <span class="required">*</span>
                                </label>
                                <input type="password" 
                                       name="old_password" 
                                       class="form-control" 
                                       placeholder="Masukkan password lama" 
                                       required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-key me-1"></i>Password Baru <span class="required">*</span>
                                </label>
                                <input type="password" 
                                       name="new_password" 
                                       class="form-control" 
                                       placeholder="Minimal 6 karakter" 
                                       required>
                                <small class="form-hint">Gunakan kombinasi huruf, angka, dan simbol untuk keamanan maksimal</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-key-fill me-1"></i>Konfirmasi Password Baru <span class="required">*</span>
                                </label>
                                <input type="password" 
                                       name="confirm_password" 
                                       class="form-control" 
                                       placeholder="Ulangi password baru" 
                                       required>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-submit">
                                    <i class="bi bi-lock me-2"></i>Ubah Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Tab switching
const tabButtons = document.querySelectorAll('.tab-button');
const tabPanes = document.querySelectorAll('.tab-pane');

tabButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Remove active from all buttons
        tabButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        // Show corresponding tab pane
        const tabId = this.getAttribute('data-tab');
        tabPanes.forEach(pane => {
            pane.classList.remove('active');
            if (pane.id === `tab-${tabId}`) {
                pane.classList.add('active');
            }
        });
    });
});
</script>

<?php require_once '../views/templates/footer.php'; ?>