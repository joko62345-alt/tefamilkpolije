<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<!-- ============================================
     HERO SECTION - Mitra Kerjasama
     ============================================ -->
<section class="mitra-hero-section">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="hero-label">MITRA KERJA SAMA</span>
                <h1 class="hero-title">
                    Bersinergi Membangun Kualitas,<br>
                    <span class="text-gradient">Menebar Manfaat</span>
                </h1>
                <p class="hero-description">
                    Tefa Milk Polije percaya bahwa kolaborasi adalah kunci untuk menghasilkan produk berkualitas dan membawa manfaat lebih luas bagi masyarakat.
                </p>
                <a href="#form-section" class="btn-hero-primary">
                    <i class="bi bi-handshake me-2"></i>Jadi Mitra Kami
                </a>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-wrapper">
                    <img src="<?= BASEURL; ?>/image/3.png" alt="Partnership" class="hero-image">
                    <div class="milk-splash-decoration"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     VALUE PROPOSITIONS
     ============================================ -->
<section class="value-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h5 class="value-title">Kualitas Terjamin</h5>
                    <p class="value-text">Produk berkualitas tinggi dengan standar terbaik</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-handshake"></i>
                    </div>
                    <h5 class="value-title">Saling Menguntungkan</h5>
                    <p class="value-text">Kolaborasi yang memberikan manfaat bagi kedua belah pihak</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h5 class="value-title">Berkelanjutan</h5>
                    <p class="value-text">Membangun kemitraan jangka panjang yang berkelanjutan</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="value-title">Untuk Masyarakat</h5>
                    <p class="value-text">Bersama menghasilkan produk bermanfaat bagi masyarakat</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     PARTNER SHOWCASE
     ============================================ -->
<section class="partner-showcase-section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">Mitra Kami</span>
            <h2 class="section-title">Partner TEFA MILK</h2>
        </div>

        <!-- Partner Grid -->
        <div class="partner-grid">
            <?php if (!empty($partners)): ?>
                <?php foreach ($partners as $index => $partner): ?>
                    <?php 
                    // Tentukan kategori berdasarkan nama atau data dari database
                    $category = 'all';
                    if (stripos($partner['name'], 'mart') !== false || stripos($partner['name'], 'retail') !== false) {
                        $category = 'retail';
                    } elseif (stripos($partner['name'], 'polije') !== false || stripos($partner['name'], 'sekolah') !== false) {
                        $category = 'education';
                    }
                    $isHidden = $index >= 5;
                    ?>
                    <div class="partner-card <?= $isHidden ? 'partner-hidden' : ''; ?>" data-category="<?= $category; ?>" data-index="<?= $index; ?>">
                        <div class="partner-logo-wrapper">
                            <img src="<?= BASEURL; ?>/image/<?= $partner['image']; ?>" 
                                 alt="<?= htmlspecialchars($partner['name']); ?>" 
                                 class="partner-logo">
                        </div>
                        <h5 class="partner-name"><?= htmlspecialchars($partner['name']); ?></h5>
                        <p class="partner-category"><?= $partner['category'] ?? 'Mitra Strategis'; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Placeholder partners untuk demo -->
                <div class="partner-card" data-category="retail">
                    <div class="partner-logo-wrapper">
                        <div class="partner-placeholder">Alfamart</div>
                    </div>
                    <h5 class="partner-name">Alfamart</h5>
                    <p class="partner-category">Retail Modern</p>
                </div>
                <div class="partner-card" data-category="retail">
                    <div class="partner-logo-wrapper">
                        <div class="partner-placeholder">Indomaret</div>
                    </div>
                    <h5 class="partner-name">Indomaret</h5>
                    <p class="partner-category">Retail Modern</p>
                </div>
                <div class="partner-card" data-category="retail">
                    <div class="partner-logo-wrapper">
                        <div class="partner-placeholder">TRANSmart</div>
                    </div>
                    <h5 class="partner-name">TRANSmart</h5>
                    <p class="partner-category">Retail Modern</p>
                </div>
                <div class="partner-card" data-category="education">
                    <div class="partner-logo-wrapper">
                        <div class="partner-placeholder">Politeknik Negeri Jember</div>
                    </div>
                    <h5 class="partner-name">Politeknik Negeri Jember</h5>
                    <p class="partner-category">Institusi Pendidikan</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <button class="btn-view-all" id="togglePartnersBtn">
                Lihat Lainnya <i class="bi bi-arrow-down ms-2"></i>
            </button>
        </div>
    </div>
</section>

<!-- ============================================
     COLLABORATION SECTION
     ============================================ -->
<section class="collaboration-section">
    <div class="container">
        <div class="collab-wrapper">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="collab-images">
                        <div class="collab-img-wrapper">
                            <img src="<?= BASEURL; ?>/image/header-bg.png" alt="Collaboration 1" class="collab-img">
                        </div>
                        <div class="collab-img-wrapper">
                            <img src="<?= BASEURL; ?>/image/header-bg.png" alt="Collaboration 2" class="collab-img">
                        </div>
                        <div class="collab-img-wrapper">
                            <img src="<?= BASEURL; ?>/image/header-bg.png" alt="Collaboration 3" class="collab-img">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <span class="section-label">Mari Berkolaborasi</span>
                    <h2 class="section-title text-start">Mari Berkolaborasi Bersama Kami</h2>
                    <p class="section-desc text-start">
                        Jadilah bagian dari jaringan mitra Tefa Milk Polije dan bersama-sama menciptakan nilai untuk masyarakat yang lebih baik.
                    </p>
                    <div class="collab-features">
                        <div class="collab-feature">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Dipercaya oleh berbagai mitra untuk tumbuh bersama</span>
                        </div>
                        <div class="collab-feature">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Menyediakan kebutuhan dalam setiap tatanan susu</span>
                        </div>
                    </div>
                    <a href="#form-section" class="btn-contact-us">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     FAQ SECTION
     ============================================ -->
<section class="faq-section-modern">
    <div class="container">
        <div class="section-header">
            <span class="section-label">FAQ</span>
            <h2 class="section-title">Pertanyaan Umum Kerja Sama</h2>
        </div>

        <div class="faq-wrapper">
            <div class="accordion" id="faqAccordion">
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Bagaimana cara mengajukan kerja sama dengan TEFA MILK?</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Anda dapat menghubungi kami melalui email atau formulir kontak yang tersedia. Tim kami akan meninjau pengajuan dan menghubungi Anda untuk diskusi lebih lanjut.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Jenis kerja sama apa saja yang dapat dilakukan?</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Kami membuka peluang kemitraan untuk pengembangan produk susu, distribusi, penelitian, branding bersama, dan kerja sama industri.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Dokumen apa yang diperlukan untuk memulai kerja sama?</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Biasanya kami meminta profil perusahaan, proposal atau bentuk kerja sama yang diinginkan, dan kontak penanggung jawab. Persyaratan tambahan akan diinformasikan sesuai jenis kemitraan.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Berapa lama proses verifikasi atau persetujuan kerja sama?</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Waktu proses bervariasi, namun rata-rata berkisar antara 7-14 hari kerja sejak dokumen diterima dan konsep kerja disepakati.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     CONTACT FORM SECTION
     ============================================ -->
<section id="form-section" class="contact-form-section">
    <div class="container">
        <div class="form-wrapper">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7">
                    <span class="section-label">Hubungi Kami</span>
                    <h2 class="section-title text-start">Masih mempunyai pertanyaan?</h2>
                    <p class="section-desc text-start mb-4">
                        Kirimkan kepada kami! Tim kami siap membantu Anda.
                    </p>

                    <?php Helper::flash(); ?>

                    <form action="<?= BASEURL; ?>/home/mitra_kerjasama" method="POST" class="contact-form">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label-custom">Nama</label>
                                <input type="text" class="form-control-custom" name="nama" id="nama" placeholder="Masukkan Nama" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label-custom">Email</label>
                                <input type="email" class="form-control-custom" name="email" id="email" placeholder="Masukkan Email" required>
                            </div>
                            <div class="col-12">
                                <label for="pertanyaan" class="form-label-custom">Pertanyaan</label>
                                <textarea class="form-control-custom" name="pertanyaan" id="pertanyaan" rows="4" placeholder="Masukkan pertanyaan" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-submit-form">
                                    <i class="bi bi-send-fill me-2"></i>Kirim Pertanyaan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-5">
                    <div class="form-info-box">
                        <h5 class="info-title">Kenali juga struktur dan manajemen TEFA MILK</h5>
                        <p class="info-text">Pelajari lebih lanjut tentang profil perusahaan kami untuk memahami visi, misi, dan struktur organisasi kami.</p>
                        <a href="<?= BASEURL; ?>/home/profil_perusahaan" class="btn-profile-link">
                            <i class="bi bi-building me-2"></i>PROFIL PERUSAHAAN
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     FOOTER CTA
     ============================================ -->
<section class="footer-cta-section">
    <div class="container">
        <div class="cta-box">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="cta-title">BERGABUNG BERMITRA BERSAMA TEFA MILK POLIJE!</h3>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="mailto:tefamilkduapolije@gmail.com" class="btn-email-cta">
                        <i class="bi bi-envelope-fill me-2"></i>tefamilkduapolije@gmail.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Toggle FAQ
function toggleFaq(button) {
    const answer = button.nextElementSibling;
    const icon = button.querySelector('i');
    
    button.classList.toggle('active');
    
    if (button.classList.contains('active')) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
    } else {
        answer.style.maxHeight = '0';
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    }
}

// Filter Partners
const tabBtns = document.querySelectorAll('.tab-btn');
const partnerCards = document.querySelectorAll('.partner-card');

tabBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove active from all tabs
        tabBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const category = this.getAttribute('data-category');
        let visibleCount = 0;
        
        partnerCards.forEach(card => {
            const isInCategory = category === 'all' || card.getAttribute('data-category') === category;
            
            if (isInCategory) {
                card.style.display = 'block';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, 50);
                
                // Show only first 5 when filtering
                if (visibleCount < 5) {
                    card.classList.remove('partner-hidden');
                } else {
                    card.classList.add('partner-hidden');
                }
                visibleCount++;
            } else {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });
        
        // Update button visibility
        updateToggleButton();
    });
});

// Toggle Partners Button
const toggleBtn = document.getElementById('togglePartnersBtn');
const partnerGrid = document.querySelector('.partner-grid');

function updateToggleButton() {
    const hiddenPartners = document.querySelectorAll('.partner-card.partner-hidden:not([style*="display: none"])');
    const visiblePartners = document.querySelectorAll('.partner-card:not([style*="display: none"])');
    
    if (hiddenPartners.length > 0) {
        toggleBtn.style.display = 'block';
    } else {
        toggleBtn.style.display = 'none';
    }
}

if (toggleBtn) {
    toggleBtn.addEventListener('click', function() {
        const hiddenPartners = document.querySelectorAll('.partner-card.partner-hidden:not([style*="display: none"])');
        const icon = toggleBtn.querySelector('i');
        
        if (toggleBtn.getAttribute('data-expanded') === 'true') {
            // Hide extra partners
            hiddenPartners.forEach(card => {
                card.classList.add('partner-hidden');
            });
            toggleBtn.setAttribute('data-expanded', 'false');
            toggleBtn.innerHTML = 'Lihat Lainnya <i class="bi bi-arrow-down ms-2"></i>';
        } else {
            // Show all partners
            document.querySelectorAll('.partner-card:not([style*="display: none"])').forEach(card => {
                card.classList.remove('partner-hidden');
            });
            toggleBtn.setAttribute('data-expanded', 'true');
            toggleBtn.innerHTML = 'Sembunyikan <i class="bi bi-arrow-up ms-2"></i>';
        }
    });
    
    updateToggleButton();
}
</script>

<?php require_once '../views/templates/footer.php'; ?>