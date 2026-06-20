<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- ============================================
     HERO BANNER - Profil Tim
     ============================================ -->
<section class="team-hero-banner">
    <div class="banner-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center py-5">
            <div class="col-lg-6">
                <span class="banner-label">
                    <i class="bi bi-people-fill me-2"></i>PROFIL TIM
                </span>
                <h1 class="banner-title">Tentang Tim TEFA Milk</h1>
                <p class="banner-description">
                    Tim solid dan penuh semangat yang berinovasi untuk menciptakan nilai lebih
                </p>
                <a class="btn btn-primary btn-lg" href="<?= BASEURL; ?>/home/profil_perusahaan">
                    <i class="bi bi-building me-2"></i>Lihat Profil Perusahaan
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION INTRO TIM
     ============================================ -->
<section class="team-intro-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Gambar Tim -->
            <div class="col-lg-5">
                <div class="team-intro-image-wrapper">
                    <img src="<?= BASEURL; ?>/image/profil tim.jpg" alt="Tim TEFA MILK" class="team-intro-image">
                    <div class="image-decoration"></div>
                </div>
            </div>

            <!-- Deskripsi Tim -->
            <div class="col-lg-7">
               
                <h2 class="section-title text-start">Tim yang Solid & Penuh Semangat</h2>
                <p class="team-description">
                    Di balik setiap langkah besar, ada tim yang solid dan penuh semangat. Tim kami hadir dari individu dengan berbagai latar belakang, keahlian, dan minat yang sama untuk berinovasi dan menciptakan nilai lebih untuk Indonesia. Perpaduan pengalaman dan kreativitas inilah yang memiliki kami mampu menghadapi tantangan serta menciptakan peluang bagi tumbuh kembangnya bisnis kami.
                </p>
                <p class="team-description">
                    Kami percaya bahwa kerja sama, komunikasi yang baik, serta komitmen untuk terus berkembang adalah kunci keberhasilan. Dengan semangat kekeluargaan, kami menjadikan setiap tantangan sebagai peluang untuk lebih maju bersama demi kebutuhan Anda.
                </p>

                
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION ANGGOTA TIM
     ============================================ -->
<section class="team-members-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Anggota Kami</span>
            <h2 class="section-title">Tim Kami</h2>
            <p class="section-description">
                Kenali lebih dekat orang-orang hebat di balik TEFA Milk
            </p>
        </div>

        <div class="members-grid">
            <!-- Member 1 -->
            <div class="member-card">
                <div class="member-image-wrapper">
                    <img src="<?= BASEURL; ?>/image/tim 3.jpg" alt="Marshanda" class="member-image">
                    <div class="member-overlay">
                        <div class="member-social">
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Marshanda</h3>
                    <p class="member-role">Penanggung Jawab</p>
                    <div class="member-divider"></div>
                    <p class="member-desc">Memimpin tim dengan visi dan dedikasi tinggi</p>
                </div>
            </div>

            <!-- Member 2 -->
            <div class="member-card">
                <div class="member-image-wrapper">
                    <img src="<?= BASEURL; ?>/image/tim 5.jpg" alt="Joko" class="member-image">
                    <div class="member-overlay">
                        <div class="member-social">
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Joko</h3>
                    <p class="member-role">Manajer</p>
                    <div class="member-divider"></div>
                    <p class="member-desc">Mengelola operasional dengan profesional</p>
                </div>
            </div>

            <!-- Member 3 -->
            <div class="member-card">
                <div class="member-image-wrapper">
                    <img src="<?= BASEURL; ?>/image/penanggung jawab tim.jpg" alt="Farel" class="member-image">
                    <div class="member-overlay">
                        <div class="member-social">
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Farel</h3>
                    <p class="member-role">Staf</p>
                    <div class="member-divider"></div>
                    <p class="member-desc">Mendukung operasional harian dengan baik</p>
                </div>
            </div>

            <!-- Member 4 -->
            <div class="member-card">
                <div class="member-image-wrapper">
                    <img src="<?= BASEURL; ?>/image/tim 4.jpg" alt="Kevin" class="member-image">
                    <div class="member-overlay">
                        <div class="member-social">
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Kevin</h3>
                    <p class="member-role">Staf</p>
                    <div class="member-divider"></div>
                    <p class="member-desc">Berkontribusi aktif dalam setiap proyek</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>