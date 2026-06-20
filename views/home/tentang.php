<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- ============================================
     HERO BANNER - Tentang Kami
     ============================================ -->
<section class="about-hero-banner">
    <div class="banner-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <span class="banner-label">
                    <i class="bi bi-info-circle-fill me-2"></i>TENTANG KAMI
                </span>
                <h1 class="banner-title">Mengenal TEFA Milk Lebih Dekat</h1>
                <p class="banner-description mx-auto">
                    Unit produksi susu milik Politeknik Negeri Jember yang berbasis Teaching Factory
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION SIAPA KAMI
     ============================================ -->
<section class="about-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="section-subtitle">Siapa Kami</span>
                <h2 class="section-title text-start">TEFA Milk Polije</h2>
                <p class="about-text">
                    TEFA Milk Polije adalah unit produksi susu milik Politeknik Negeri Jember yang berbasis Teaching Factory, sehingga pendidikan dikombinasikan dengan praktik industri nyata.
                </p>
                <p class="about-text">
                    Mahasiswa terlibat langsung dalam proses produksi, pengemasan, hingga pemasaran produk susu siap konsumsi. Kami berkomitmen menghasilkan produk susu berkualitas tinggi dengan standar higienis dan modern.
                </p>
                
                <div class="about-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="feature-text">
                            <h5>Produk Berkualitas</h5>
                            <p>Terjamin mutunya dan aman dikonsumsi</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="feature-text">
                            <h5>Standar Higienis</h5>
                            <p>Diproses dengan teknologi modern</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="feature-text">
                            <h5>Berbasis Pendidikan</h5>
                            <p>Fasilitas pembelajaran mahasiswa</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="about-image-wrapper">
                    <img src="<?= BASEURL; ?>/image/1.png" alt="Tentang TEFA Milk" class="about-image">
                    <div class="image-decoration"></div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ============================================
     SECTION MENGAPA MEMILIH KAMI
     ============================================ -->
<section class="why-choose-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Keunggulan Kami</span>
            <h2 class="section-title">Mengapa Memilih TEFA Milk?</h2>
            <p class="section-description">
                Kami berkomitmen memberikan yang terbaik untuk Anda
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <h4 class="why-title">100% Susu Segar</h4>
                    <p class="why-text">
                        Diproduksi langsung dari peternakan Polije dengan susu segar berkualitas tinggi
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="why-title">Terjamin Keamanannya</h4>
                    <p class="why-text">
                        Melalui proses produksi yang higienis dan terstandar untuk keamanan konsumen
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h4 class="why-title">Kualitas Terjamin</h4>
                    <p class="why-text">
                        Diolah dengan teknologi modern dan dukungan mesin produksi berkualitas
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h4 class="why-title">Sehat & Bergizi</h4>
                    <p class="why-text">
                        Kaya akan kalsium, protein, dan nutrisi penting untuk tubuh sehat
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h4 class="why-title">Berbasis Pendidikan</h4>
                    <p class="why-text">
                        Menggabungkan pendidikan dengan praktik industri nyata
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h4 class="why-title">Produk Lokal</h4>
                    <p class="why-text">
                        Mendukung produk lokal dan perekonomian daerah Jember
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>