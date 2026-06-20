<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-background">
        <img src="<?= BASEURL; ?>/image/header-bg.png" alt="hero-bg-img" class="hero-bg-img">
    </div>
    <div class="hero-content">
        <h1>KONTAK KAMI</h1>
        <p>Tim TEFA Milk siap melayani Anda dengan cepat dan informatif. Hubungi kami untuk pertanyaan dan pemesanan.</p>
    </div>
</section>

<!-- Main Content -->
<section class="contact-section py-5">
    <div class="container">
        
        <?php Helper::flash(); ?>
        
        <div class="row">
            <!-- KIRI (Info Kontak) -->
            <div class="col-lg-6 mb-4">
                <h3 class="contact-heading mb-3 fw-bold">Terhubung dengan Kami</h3>
                <p class="contact-description mb-5 text-muted">Temukan dan hubungi kami melalui kontak berikut untuk informasi lebih lanjut.</p>

                <div class="contact-info-wrapper">
                    <hr class="contact-divider">

                    <div class="contact-item d-flex align-items-center mb-4">
                        <a href="tel:+6281216756412" class="contact-icon text-decoration-none text-white d-flex justify-content-center align-items-center rounded-circle me-3" style="background: #E4947D; width: 45px; height: 45px;">
                            <i class="bi bi-telephone-plus"></i>
                        </a>
                        <div class="contact-details">
                            <h5 class="contact-label fw-bold mb-1" style="font-size: 1rem;">Nomor Telepon</h5>
                            <p class="contact-value mb-0">
                                <a href="tel:+6281216756412" class="text-decoration-none text-dark">
                                    +6281 2167 56412
                                </a>
                            </p>
                            <p class="contact-value mb-0">
                                <a href="tel:+6281346509876" class="text-decoration-none text-dark">
                                    +6281 3465 09876
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="contact-item d-flex align-items-center mb-4">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=tefamilkduapolije@gmail.com" target="_blank" class="contact-icon text-decoration-none text-white d-flex justify-content-center align-items-center rounded-circle me-3" style="background: #E4947D; width: 45px; height: 45px;">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <div class="contact-details">
                        <h5 class="contact-label fw-bold mb-1" style="font-size: 1rem;">Email</h5>
                        <p class="contact-value mb-0">
                            <a href="mailto:tefamilkduapolije@gmail.com" class="text-decoration-none text-dark">
                                tefamilkduapolije@gmail.com
                            </a>
                        </p>
                    </div>
                </div>

                <div class="contact-item d-flex align-items-center mb-4">
                    <a href="https://wa.me/6287729664976" target="_blank" class="contact-icon text-decoration-none text-white d-flex justify-content-center align-items-center rounded-circle me-3" style="background: #E4947D; width: 45px; height: 45px;">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <div class="contact-details">
                        <h5 class="contact-label fw-bold mb-1" style="font-size: 1rem;">WhatsApp</h5>
                        <p class="contact-value mb-0">
                            <a href="https://wa.me/6287729664976" target="_blank" class="text-dark text-decoration-none">
                                +6287729664976
                            </a>
                        </p>
                        <p class="contact-value mb-0">
                            <a href="https://wa.me/6287765711240" target="_blank" class="text-dark text-decoration-none">
                                +6287765711240
                            </a>
                        </p>
                    </div>
                </div>

                <div class="contact-item d-flex align-items-center mb-4">
                    <a href="https://maps.app.goo.gl/BgYy2WTXGwJ8wfBS7" target="_blank" class="contact-icon text-decoration-none text-white d-flex justify-content-center align-items-center rounded-circle me-3" style="background: #E4947D; width: 45px; height: 45px;">
                        <i class="fas fa-map-marker-alt"></i>
                    </a>
                    <div class="contact-details">
                        <h5 class="contact-label fw-bold mb-1" style="font-size: 1rem;">Alamat</h5>
                        <p class="contact-value mb-0">
                            <a href="https://maps.app.goo.gl/BgYy2WTXGwJ8wfBS7" target="_blank" class="text-dark text-decoration-none small">
                                Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121
                            </a>
                        </p>
                    </div>
                </div>

                <hr class="contact-divider contact-divider-bottom">

                <div class="social-media-section">
                    <h4 class="social-heading fw-bold mb-3" style="font-size: 1.1rem;">Ikuti Media Sosial Kami</h4>
                    <div class="social-icons d-flex">
                        <a href="https://www.instagram.com/_jokoest?igsh=MWp5anBzaXV0MnJsMQ==" target="_blank" class="social-icon me-3 text-dark fs-4">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://youtube.com/@polijesip?si=0WnHTrgRa2TBOmU2" target="_blank" class="social-icon me-3 text-dark fs-4">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://www.facebook.com/share/17yNHUZbAp/" target="_blank" class="social-icon me-3 text-dark fs-4">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://x.com/Polije_SIP?t=lusvWOWoRzBjZzL3RTrXVQ&s=09" target="_blank" class="social-icon text-dark fs-4">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- KANAN (Formulir Ulasan) -->
            <div class="col-lg-6">
                <div class="form-wrapper p-4 rounded shadow-sm" style="background: #FAF3D6; border: 1.5px solid #e2d9b8;">
                    <form action="<?= BASEURL; ?>/home/kontak" method="POST" id="contactForm">
                        <label class="contact-heading mb-1 fw-bold fs-4 d-block text-dark">Kirim Pesan / Ulasan</label>
                        <p class="contact-description mb-3 text-muted small">Sampaikan ulasan atau masukan Anda melalui form berikut.</p>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold text-dark small">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control custom-input" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-dark small">Email</label>
                            <input type="email" name="email" id="email" class="form-control custom-input" placeholder="Masukkan Email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark d-block small">Rating</label>
                            <div class="rating-stars fs-3 text-muted" style="cursor: pointer;">
                                <i class="fas fa-star star" data-rating="1"></i>
                                <i class="fas fa-star star" data-rating="2"></i>
                                <i class="fas fa-star star" data-rating="3"></i>
                                <i class="fas fa-star star" data-rating="4"></i>
                                <i class="fas fa-star star" data-rating="5"></i>
                            </div>
                            <input type="hidden" name="rating" id="ratingValue" value="0">
                        </div>
                        <div class="mb-4">
                            <label for="ulasan" class="form-label fw-semibold text-dark small">Ulasan Anda</label>
                            <textarea name="ulasan" id="ulasan" class="form-control custom-textarea" rows="5" placeholder="Masukkan Ulasan Anda" required></textarea>
                        </div>
                        <button type="submit" class="btn w-100 py-2 text-white fw-bold" style="background: #E4947D; border: none; border-radius: 8px;">Kirim Pesan</button>
                    </form>
                </div>
            </div> 
        </div>    
    </div>    
</section>

<!-- Map Section -->
<section class="map-section py-5">
    <div class="container">
        <div class="map-wrapper shadow-sm rounded overflow-hidden">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3949.4465446342715!2d113.71764612443924!3d-8.157684131725677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1spoliteknik%20negeri%20jember!5e0!3m2!1sid!2sid!4v1763972873584!5m2!1sid!2sid"
                width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<script>
    // Rating star handler in-page (copied from original js/kontak.js logic)
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.rating-stars .star');
        const ratingValue = document.getElementById('ratingValue');
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingValue.value = rating;
                
                stars.forEach(s => {
                    const starRating = s.getAttribute('data-rating');
                    if (starRating <= rating) {
                        s.classList.add('active', 'text-warning');
                        s.classList.remove('text-muted');
                    } else {
                        s.classList.remove('active', 'text-warning');
                        s.classList.add('text-muted');
                    }
                });
            });
            
            star.addEventListener('mouseenter', function() {
                const rating = this.getAttribute('data-rating');
                stars.forEach(s => {
                    const starRating = s.getAttribute('data-rating');
                    if (starRating <= rating) {
                        s.style.color = '#FFD700';
                    } else {
                        s.style.color = '';
                    }
                });
            });
        });
        
        document.querySelector('.rating-stars').addEventListener('mouseleave', function() {
            const currentRating = ratingValue.value;
            stars.forEach(s => {
                const starRating = s.getAttribute('data-rating');
                if (starRating <= currentRating) {
                    s.style.color = '#FFD700';
                } else {
                    s.style.color = '#ccc';
                }
            });
        });
    });
</script>

<?php require_once '../views/templates/footer.php'; ?>
