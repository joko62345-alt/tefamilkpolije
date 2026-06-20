<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-background">
        <img src="<?= BASEURL; ?>/image/header-bg.png" alt="hero-bg-img" class="hero-bg-img">
    </div>
    <div class="hero-content">
        <h1>Tentang Tim TEFA Milk</h1>
        <a class="hero-btn-primary" href="<?= BASEURL; ?>/home/profil_perusahaan">Lihat Profil Perusahaan</a>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <!-- Team Introduction -->
    <div class="team-intro">
        <div class="team-image">
            <img src="<?= BASEURL; ?>/image/profil tim.jpg" alt="Tim TEFA MILK">
        </div>
        <div class="team-description">
            <p>
                Di balik setiap langkah besar, ada tim yang solid dan penuh semangat. Tim kami hadir dari individu
                dengan berbagai latar belakang, keahlian, dan minat yang sama untuk berinovasi dan menciptakan nilai
                lebih untuk Indonesia. Perpaduan pengalaman dan kreativitas inilah yang memiliki kami mampu
                menghadapi tantangan serta menciptakan peluang bagi tumbuh kembangnya bisnis kami.
            </p>
            <br>
            <p>
                Kami percaya bahwa kerja sama, komunikasi yang baik, serta komitmen untuk terus berkembang adalah
                kunci keberhasilan. Dengan semangat kekeluargaan, kami menjadikan setiap tantangan sebagai peluang
                untuk lebih maju bersama demi kebutuhan Anda.
            </p>
        </div>
    </div>

    <!-- Team Members Grid -->
    <div class="team-grid">
        <h2>Tim Kami</h2>
        <div class="members-container">
            <!-- Member Card 1 -->
            <div class="member-card">
                <div class="member-image">
                    <img src="<?= BASEURL; ?>/image/tim 3.jpg" alt="Tim Member 1">
                </div>
                <div class="member-info">
                    <div class="member-name">Marshanda</div>
                    <div class="member-role">Penanggung Jawab</div>
                </div>
            </div>

            <!-- Member Card 2 -->
            <div class="member-card">
                <div class="member-image">
                    <img src="<?= BASEURL; ?>/image/tim 5.jpg" alt="Tim Member 2">
                </div>
                <div class="member-info">
                    <div class="member-name">Joko</div>
                    <div class="member-role">Manajer</div>
                </div>
            </div>

            <!-- Member Card 3 -->
            <div class="member-card">
                <div class="member-image">
                    <img src="<?= BASEURL; ?>/image/penanggung jawab tim.jpg" alt="Tim Member 3">
                </div>
                <div class="member-info">
                    <div class="member-name">Farel</div>
                    <div class="member-role">Staf</div>
                </div>
            </div>

            <!-- Member Card 4 -->
            <div class="member-card">
                <div class="member-image">
                    <img src="<?= BASEURL; ?>/image/tim 4.jpg" alt="Tim Member 4">
                </div>
                <div class="member-info">
                    <div class="member-name">Kevin</div>
                    <div class="member-role">Staf</div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>
