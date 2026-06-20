    <!-- Footer -->
    <footer class="footer">
        <div class="container py-3">
        <div class="row">
            <!-- About Section -->
            <div class="col-lg-3 col-md-3 mb-4">
                <img src="<?= BASEURL; ?>/image/polije.png" alt="Logo Footer" class="footer-logo mb-3" style="max-height: 50px;">
                <p class="footer-text">Tefa Milk Polije adalah unit produksi susu milik Politeknik Negeri Jember yang berbasis Teaching Factory, sehingga pendidikan dikombinasikan dengan praktik industri nyata.<br><br>Mahasiswa terlibat langsung dalam proses produksi, pengemasan, hingga pemasaran produk susu siap konsumsi.</p>
            </div>

            <!-- TEFA MILK Info -->
            <div class="col-lg-3 col-md-4 mb-4">
                <h5 class="footer-heading mb-4">TEFA MILK</h5>
                <div class="footer-info">
                    <h6 class="info-title">Kantor Pusat</h6>
                    <p class="info-text">Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121</p>
                    <h6 class="info-title mt-3">Jam Operasional</h6>
                    <p class="info-text mb-1">Senin - Jumat : 07.30 - 17.00</p>
                    <p class="info-text">Sabtu - Minggu : Tutup</p>
                </div>
            </div>

            <!-- Menu -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="footer-heading mb-4">MENU UTAMA</h5>
                <ul class="footer-menu list-unstyled">
                    <li><a href="<?= BASEURL; ?>/home">Beranda</a></li>
                    <li><a href="<?= BASEURL; ?>/home/profil_perusahaan">Profil</a></li>
                    <li><a href="<?= BASEURL; ?>/catalog">Katalog Produk</a></li>
                    <li><a href="<?= BASEURL; ?>/home/galery">Galeri Milk</a></li>
                    <li><a href="<?= BASEURL; ?>/home/mitra_kerjasama">Mitra Kerjasama</a></li>
                    <li><a href="<?= BASEURL; ?>/home/kontak">Kontak</a></li>
                </ul>
            </div>

            <!-- Social Media -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="footer-heading mb-4">SOSIAL MEDIA</h5>
                <ul class="footer-social list-unstyled">
                    <li>
                        <a href="https://www.instagram.com/_jokoest?igsh=MWp5anBzaXV0MnJsMQ==" target="_blank" class="d-flex align-items-center text-decoration-none text-muted mb-2">
                            <i class="fa-brands fa-instagram me-2"></i><span>Instagram</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/share/17yNHUZbAp/" target="_blank" class="d-flex align-items-center text-decoration-none text-muted mb-2">
                            <i class="fab fa-facebook me-2"></i><span>Facebook</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://youtube.com/@polijesip?si=0WnHTrgRa2TBOmU2" target="_blank" class="d-flex align-items-center text-decoration-none text-muted mb-2">
                            <i class="fab fa-youtube me-2"></i><span>Youtube</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/6287729664976" target="_blank" class="d-flex align-items-center text-decoration-none text-muted">
                            <i class="fa-brands fa-whatsapp me-2"></i><span>WhatsApp</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        </div>
        
        <!-- Copyright -->
        <div class="footer-bottom">
            <div class="container">
                <p class="text-center mb-0 py-3">2026 TEFA MILK. All rights reserved</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Custom Navbar scroll effect
        window.addEventListener("scroll", function () {
            const navbar = document.querySelector(".custom-navbar");
            if (navbar) {
                if (window.scrollY > 10) {
                    navbar.classList.add("scrolled");
                } else {
                    navbar.classList.remove("scrolled");
                }
            }
        });
    </script>
    
    <!-- Page Specific JS -->
    <?php if (isset($extra_js)): ?>
        <?php foreach ($extra_js as $js): ?>
            <script src="<?= BASEURL; ?>/js/<?= $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
