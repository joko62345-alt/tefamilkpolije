<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- ============================================
     HERO BANNER - Kontak
     ============================================ -->
<section class="contact-hero-banner">
    <div class="banner-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center py-4">
            <div class="col-12">
                <div class="banner-content">
                    <span class="banner-label">
                        <i class="bi bi-telephone-fill me-2"></i>HUBUNGI KAMI
                    </span>
                    <p class="banner-description">
                        Tim TEFA Milk siap melayani Anda dengan cepat dan informatif. Hubungi kami untuk pertanyaan dan pemesanan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION INFO KONTAK
     ============================================ -->
<section class="contact-info-section">
    <div class="container">
        <?php Helper::flash(); ?>

        <div class="section-header">
            <span class="section-label">Informasi Kontak</span>
            <h2 class="section-title">Terhubung dengan Kami</h2>
            <p class="section-description">
                Temukan dan hubungi kami melalui kontak berikut untuk informasi lebih lanjut
            </p>
        </div>

        <div class="contact-grid">
            <!-- Telepon -->
            <div class="contact-card">
                <div class="contact-card-icon">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <h4 class="contact-card-title">Nomor Telepon</h4>
                <div class="contact-card-content">
                    <a href="tel:+6281216756412" class="contact-link">
                        <i class="bi bi-telephone me-2"></i>+6281 2167 56412
                    </a>
                    <a href="tel:+6281346509876" class="contact-link">
                        <i class="bi bi-telephone me-2"></i>+6281 3465 09876
                    </a>
                </div>
            </div>

            <!-- Email -->
            <div class="contact-card">
                <div class="contact-card-icon">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <h4 class="contact-card-title">Email</h4>
                <div class="contact-card-content">
                    <a href="mailto:tefamilkduapolije@gmail.com" class="contact-link">
                        <i class="bi bi-envelope me-2"></i>tefamilkduapolije@gmail.com
                    </a>
                </div>
            </div>

            <!-- WhatsApp -->
            <div class="contact-card">
                <div class="contact-card-icon" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                    <i class="bi bi-whatsapp"></i>
                </div>
                <h4 class="contact-card-title">WhatsApp</h4>
                <div class="contact-card-content">
                    <a href="https://wa.me/6287729664976" target="_blank" class="contact-link">
                        <i class="bi bi-whatsapp me-2"></i>+62877 2966 4976
                    </a>
                    <a href="https://wa.me/6287765711240" target="_blank" class="contact-link">
                        <i class="bi bi-whatsapp me-2"></i>+62877 6571 1240
                    </a>
                </div>
            </div>

            <!-- Alamat -->
            <div class="contact-card">
                <div class="contact-card-icon" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h4 class="contact-card-title">Alamat</h4>
                <div class="contact-card-content">
                    <a href="https://maps.app.goo.gl/BgYy2WTXGwJ8wfBS7" target="_blank" class="contact-link">
                        <i class="bi bi-geo-alt me-2"></i>Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION SOCIAL MEDIA
     ============================================ -->
<section class="social-media-section">
    <div class="container">
        <div class="social-wrapper">
            <div class="social-header">
                <span class="section-label">Media Sosial</span>
                <h2 class="section-title">Ikuti Kami</h2>
                <p class="section-description">
                    Tetap terhubung dan dapatkan update terbaru dari TEFA Milk
                </p>
            </div>

            <div class="social-grid">
                <a href="https://www.instagram.com/_jokoest?igsh=MWp5anBzaXV0MnJsMQ==" target="_blank" class="social-card instagram">
                    <div class="social-icon-wrapper">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="social-info">
                        <h5>Instagram</h5>
                        <span>@tefamilkpolije</span>
                    </div>
                    <i class="bi bi-arrow-right social-arrow"></i>
                </a>

                <a href="https://youtube.com/@polijesip?si=0WnHTrgRa2TBOmU2" target="_blank" class="social-card youtube">
                    <div class="social-icon-wrapper">
                        <i class="fab fa-youtube"></i>
                    </div>
                    <div class="social-info">
                        <h5>YouTube</h5>
                        <span>TEFA Milk Polije</span>
                    </div>
                    <i class="bi bi-arrow-right social-arrow"></i>
                </a>

                <a href="https://www.facebook.com/share/17yNHUZbAp/" target="_blank" class="social-card facebook">
                    <div class="social-icon-wrapper">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-info">
                        <h5>Facebook</h5>
                        <span>TEFA Milk</span>
                    </div>
                    <i class="bi bi-arrow-right social-arrow"></i>
                </a>

                <a href="https://x.com/Polije_SIP?t=lusvWOWoRzBjZzL3RTrXVQ&s=09" target="_blank" class="social-card twitter">
                    <div class="social-icon-wrapper">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="social-info">
                        <h5>Twitter / X</h5>
                        <span>@Polije_SIP</span>
                    </div>
                    <i class="bi bi-arrow-right social-arrow"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     SECTION MAP
     ============================================ -->
<section class="map-section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">Lokasi Kami</span>
            <h2 class="section-title">Temukan Kami di Peta</h2>
            <p class="section-description">
                Kunjungi kantor kami di Politeknik Negeri Jember
            </p>
        </div>

        <div class="map-wrapper">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3949.4465446342715!2d113.71764612443924!3d-8.157684131725677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1spoliteknik%20negeri%20jember!5e0!3m2!1sid!2sid!4v1763972873584!5m2!1sid!2sid"
                    width="100%" 
                    height="500" 
                    style="border:0; border-radius: 20px;" 
                    allowfullscreen="" 
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        
        </div>
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>