<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<div class="container mt-5 pt-4 mb-5" style="max-width:800px;">
    <h2 class="fw-bold mb-1">Edit Profil</h2>
    <p class="text-muted small mb-4">Perbarui informasi akun dan alamat pengiriman Anda</p>

    <?php Helper::flash(); ?>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="profileTabs">
        <li class="nav-item">
            <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#tab-profile" style="color:#E4947D;">Data Diri</a>
        </li>
        <li class="nav-item">
            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#tab-password" style="color:#666;">Ubah Password</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Profile Tab -->
        <div class="tab-pane fade show active" id="tab-profile">
            <div class="card border-0 shadow-sm p-4" style="background:#FAF3D6; border-radius:12px;">
                <form action="<?= BASEURL; ?>/profile/update" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Username</label>
                        <input type="text" class="form-control" value="<?= $user['username']; ?>" readonly style="background:#fff8ee;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Email</label>
                        <input type="email" class="form-control" value="<?= $user['email']; ?>" readonly style="background:#fff8ee;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?= $user['name']; ?>" required style="border-color:#E4947D;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">No. Telepon</label>
                        <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?? ''; ?>" placeholder="08xxx" style="border-color:#E4947D;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Alamat Pengiriman</label>
                        <textarea name="address" rows="3" class="form-control" placeholder="Alamat lengkap" style="border-color:#E4947D;"><?= $user['address'] ?? ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn text-white fw-bold px-4" style="background:#E4947D; border:none; border-radius:8px;">
                        <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <!-- Password Tab -->
        <div class="tab-pane fade" id="tab-password">
            <div class="card border-0 shadow-sm p-4" style="background:#FAF3D6; border-radius:12px;">
                <form action="<?= BASEURL; ?>/profile/changepassword" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Password Lama <span class="text-danger">*</span></label>
                        <input type="password" name="old_password" class="form-control" placeholder="Masukkan password lama" required style="border-color:#E4947D;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="new_password" class="form-control" placeholder="Minimal 6 karakter" required style="border-color:#E4947D;">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Ulangi password baru" required style="border-color:#E4947D;">
                    </div>
                    <button type="submit" class="btn text-white fw-bold px-4" style="background:#E4947D; border:none; border-radius:8px;">
                        <i class="bi bi-lock me-1"></i> Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/templates/footer.php'; ?>
