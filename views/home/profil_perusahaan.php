<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- ============================================
     HERO BANNER - Profil Perusahaan
     ============================================ -->
<section class="profile-banner">
    <div class="banner-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center py-5">
            <div class="col-lg-6">
                <span class="banner-label">PROFIL PERUSAHAAN</span>
                <h1 class="banner-title">Tentang TEFA Milk</h1>
                <p class="banner-description">
                    Tefa Milk Polije adalah unit produksi susu milik Politeknik Negeri Jember yang berbasis Teaching Factory, sehingga pendidikan dikombinasikan dengan praktik industri nyata.
                </p>
                <a class="btn btn-primary btn-lg" href="<?= BASEURL; ?>/home/profil_tim">
                    <i class="bi bi-people-fill me-2"></i>Lihat Tim TEFA Milk
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION SEJARAH, VISI, MISI (3 Kolom)
     ============================================ -->
<section class="section-info">
    <div class="container">
        <div class="row g-4">
            <!-- SEJARAH -->
            <div class="col-lg-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-book-fill"></i>
                    </div>
                    <h3 class="info-title">SEJARAH</h3>
                    <p class="info-text">
                        TEFA Milk lahir dari kompetensi, keterampilan, dan bidang keahlian sumber daya manusia di Politeknik Negeri Jember (Polije). Di Polije terdapat dua jurusan yang beririsan erat dengan olahan pangan, yaitu Teknologi dan Teknologi Pertanian.
                    </p>
                    <div id="sejarahFull" style="display: none;">
                        <p class="info-text">
                            Jurusan Peternakan memfokus pada olahan pangan hewani, serta susu. Jurusan Teknologi Pertanian berat dengan produk olahan susu. Kepaduan TEFA Milk juga menapatkan respons terhadap kebutuhan industri pengolahan susu khususnya produk susu pereh yang kerap menghadapi kendala terkait standarnya untuk masuk ke industri. Polije memberikan dukungan penuh untuk membuat TEFA Milk mampu menghasilkan produk berkualitas tinggi dengan dukungan mesin produksi. Meskipun TEFA Milk juga memproduksi susu untuk memenuhi kebutuhan pasar, fokus utama tetap sebagai fasilitas pembelajaran dan praktikum mahasiswa.
                        </p>
                    </div>
                    <button class="btn-read-more" onclick="toggleContent('sejarahFull')">
                        <i class="bi bi-arrow-down-circle me-1"></i>Baca Lebih Banyak
                    </button>
                </div>
            </div>

            <!-- VISI -->
            <div class="col-lg-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <h3 class="info-title">VISI</h3>
                    <p class="info-text">
                        TEFA Milk memiliki tujuan untuk memproduksi bahan pangan olahan susu yang berkualitas dan terstandar. "Berkualitas" berarti produk yang dihasilkan terjamin mutunya, tidak terkontaminasi, serta aman dikonsumsi. "Terstandar" berarti melalui berbagai tahapan sertifikasi, seperti halal, SNI, dan BPOM.
                    </p>
                </div>
            </div>

            <!-- MISI -->
            <div class="col-lg-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3 class="info-title">MISI</h3>
                    <div class="mission-empty">
                        <i class="bi bi-clock-history"></i>
                        <p>MISI MASIH BELUM ADA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION STRUKTUR ORGANISASI
     ============================================ -->
<section class="section-org">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Company Structure</span>
            <h2 class="section-heading-title">Struktur Organisasi</h2>
        </div>

        <div class="row g-4 align-items-start">
            <!-- Diagram -->
            <div class="col-lg-7">
                <div class="diagram-box">
                    <img src="<?= BASEURL; ?>/image/struktur tefa.jpg" alt="Struktur Organisasi" class="diagram-img">
                </div>
            </div>

            <!-- Carousel Leader -->
            <div class="col-lg-5">
                <div class="leader-box">
                    <div id="leadersCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="leader-item">
                                    <div class="leader-avatar">
                                        <img src="<?= BASEURL; ?>/image/penanggung jawab.jpg" alt="CEO">
                                    </div>
                                    <h4 class="leader-name">CEO</h4>
                                    <p class="leader-position">Penanggung Jawab</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="leader-item">
                                    <div class="leader-avatar">
                                        <img src="<?= BASEURL; ?>/image/perusahaan 1.jpg" alt="Leader 1">
                                    </div>
                                    <h4 class="leader-name">Leader 1</h4>
                                    <p class="leader-position">Perusahaan 1</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="leader-item">
                                    <div class="leader-avatar">
                                        <img src="<?= BASEURL; ?>/image/perusahaan 2.jpg" alt="Leader 2">
                                    </div>
                                    <h4 class="leader-name">Leader 2</h4>
                                    <p class="leader-position">Perusahaan 2</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="leader-item">
                                    <div class="leader-avatar">
                                        <img src="<?= BASEURL; ?>/image/perusahaan 3.jpg" alt="Leader 3">
                                    </div>
                                    <h4 class="leader-name">Leader 3</h4>
                                    <p class="leader-position">Perusahaan 3</p>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#leadersCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#leadersCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#leadersCarousel" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#leadersCarousel" data-bs-slide-to="3"></button>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#leadersCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#leadersCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>