<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<section class="hero-section">
    <div class="hero-background">
        <img src="<?= BASEURL; ?>/image/header-bg.png" alt="hero-bg-img" class="hero-bg-img">
    </div>
    <div class="hero-content">
        <h1>Tentang TEFA Milk</h1>
        <a class="hero-btn-primary" href="<?= BASEURL; ?>/home/profil_tim">Lihat Tim TEFA Milk</a>
    </div>
</section>

<section class="content-section">
    <h2 class="section-title">SEJARAH</h2>
    <p class="section-content">
        TEFA Milk lahir dari kompetensi, keterampilan, dan bidang keahlian sumber daya manusia di Politeknik
        Negeri Jember (Polije). Di Polije terdapat dua jurusan yang beririsan erat dengan olahan pangan, yaitu
        Teknologi dan Teknologi Pertanian.
    </p>
    <div id="sejarahFull" style="display: none; margin-top: 20px;">
        <p class="section-content">
            Jurusan Peternakan memfokus pada olahan pangan hewani, serta susu. Jurusan Teknologi Pertanian berat
            dengan produk olahan susu. Kepaduan TEFA Milk juga menapatkan respons terhadap kebutuhan industri
            pengolahan susu khususnya produk susu pereh yang kerap menghadapi kendala terkait standarnya untuk
            masuk ke industri. Polije memberikan dukungan penuh untuk membuat TEFA Milk mampu menghasilkan
            produk berkualitas tinggi dengan dukungan mesin produksi. Meskipun TEFA Milk juga memproduksi susu
            untuk memenuhi kebutuhan pasar, fokus utama tetap sebagai fasilitas pembelajaran dan praktikum
            mahasiswa.
        </p>
    </div>
    <button class="read-more-btn" onclick="toggleContent('sejarahFull')">Baca Lebih Banyak</button>
</section>

<div class="vm-container">
    <div class="vm-box1">
        <h3>VISI</h3>
        <p class="section-content">
            TEFA Milk memiliki tujuan untuk memproduksi bahan pangan olahan susu yang berkualitas dan
            terstandar. "Berkualitas" berarti produk yang dihasilkan terjamin mutunya, tidak terkontaminasi,
            serta aman dikonsumsi. "Terstandar" berarti melalui berbagai tahapan sertifikasi, seperti halal,
            SNI, dan BPOM.
        </p>
    </div>
    <div class="vm-box">
        <h3>MISI</h3>
        <div class="vm-placeholder">
            MISI MASIH BELUM ADA
        </div>
    </div>
</div>

<section class="org-section">
    <h2 class="section-title">Struktur Organisasi</h2>
    <p class="section-subtitle">Company Structure Diagram</p>
    <div class="org-content">
        <!-- DIAGRAM -->
        <div class="diagram-container">
            <img src="<?= BASEURL; ?>/image/struktur tefa.jpg" alt="Company Structure Diagram">
        </div>

        <!-- CAROUSEL -->
        <div class="leaders-carousel-container">
            <div id="leadersCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- SLIDE 1: CEO -->
                    <div class="carousel-item active">
                        <div class="leader-card">
                            <img src="<?= BASEURL; ?>/image/penanggung jawab.jpg" alt="CEO" class="leader-img">
                            <h3 class="leader-title">CEO</h3>
                            <p class="leader-role">Penanggung Jawab</p>
                        </div>
                    </div>

                    <!-- SLIDE 2: Leader 1 -->
                    <div class="carousel-item">
                        <div class="leader-card">
                            <img src="<?= BASEURL; ?>/image/perusahaan 1.jpg" alt="Leader 1" class="leader-img">
                            <h3 class="leader-title">Leader 1</h3>
                            <p class="leader-role">Perusahaan 1</p>
                        </div>
                    </div>

                    <!-- SLIDE 3: Leader 2 -->
                    <div class="carousel-item">
                        <div class="leader-card">
                            <img src="<?= BASEURL; ?>/image/perusahaan 2.jpg" alt="Leader 2" class="leader-img">
                            <h3 class="leader-title">Leader 2</h3>
                            <p class="leader-role">Perusahaan 2</p>
                        </div>
                    </div>

                    <!-- SLIDE 4: Leader 3 -->
                    <div class="carousel-item">
                        <div class="leader-card">
                            <img src="<?= BASEURL; ?>/image/perusahaan 3.jpg" alt="Leader 3" class="leader-img">
                            <h3 class="leader-title">Leader 3</h3>
                            <p class="leader-role">Perusahaan 3</p>
                        </div>
                    </div>
                </div>

                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#leadersCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#leadersCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#leadersCarousel" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#leadersCarousel" data-bs-slide-to="3"></button>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#leadersCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#leadersCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>
