<?php require_once '../views/templates/header.php'; ?>
<?php require_once '../views/templates/navbar.php'; ?>

<section class="hero-section">
    <div class="hero-background">
        <img src="<?= BASEURL; ?>/image/header-bg.png" alt="hero-bg-img" class="hero-bg-img">
    </div>
    <div class="hero-content">
        <h1>TEACHING FACTORY MILK</h1>
        <p>Mengedepankan standar mutu, kebersihan, dan keamanan pangan,<br>TEFA MILK membuka peluang kerjasama dengan berbagai mitra untuk produksi susu</p>
    </div>
</section>

<!-- PARTNER -->
<section class="section-partner container my-5">
    <h3 class="fw-bold mb-4 text-center">PARTNER TEFA MILK</h3>

    <div class="row justify-content-center g-4">
        <?php if (!empty($partners)): ?>
            <?php foreach ($partners as $partner): ?>
                <div class="col-md-5 col-lg-4">
                    <div class="partner-card h-100 shadow-sm" style="border-radius: 12px; overflow: hidden; background: #FAF3D6; border: 1.5px solid #eee;">
                        <img src="<?= BASEURL; ?>/image/<?= $partner['image']; ?>" alt="<?= $partner['name']; ?>" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="content p-3">
                            <h5 class="fw-bold"><?= $partner['name']; ?></h5>
                            <p class="text-muted small">
                                <?= $partner['description']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted text-center">Belum ada partner terdaftar.</p>
        <?php endif; ?>
    </div>
</section>

<!-- FAQ -->
<section class="container-fluid my-5">
    <div class="faq-section shadow p-4 rounded" style="background: #ffffff; max-width: 900px; margin: 0 auto;">
        <h4 class="fw-bold mb-4 text-center">FAQ KERJA SAMA TEFA MILK</h4>

        <div class="accordion" id="faqAccordion">
            <!-- FAQ 1 -->
            <div class="accordion-item border-0 border-bottom">
                <h4 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" style="background: none; color: #333;">
                        Bagaimana cara mengajukan kerja sama dengan TEFA MILK?
                    </button>
                </h4>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Anda dapat menghubungi kami melalui email atau formulir kontak yang tersedia. Tim kami akan meninjau pengajuan dan menghubungi Anda untuk diskusi lebih lanjut.
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="accordion-item border-0 border-bottom">
                <h4 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" style="background: none; color: #333;">
                        Jenis kerja sama apa saja yang dapat dilakukan?
                    </button>
                </h4>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Kami membuka peluang kemitraan untuk pengembangan produk susu, distribusi, penelitian, branding bersama, dan kerja sama industri.
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="accordion-item border-0 border-bottom">
                <h4 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" style="background: none; color: #333;">
                        Dokumen apa yang diperlukan untuk memulai kerja sama?
                    </button>
                </h4>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Biasanya kami meminta profil perusahaan, proposal atau bentuk kerja sama yang diinginkan, dan kontak penanggung jawab. Persyaratan tambahan akan diinformasikan sesuai jenis kemitraan.
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="accordion-item border-0 border-bottom">
                <h4 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" style="background: none; color: #333;">
                        Berapa lama proses verifikasi atau persetujuan kerja sama?
                    </button>
                </h4>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Waktu proses bervariasi, namun rata-rata berkisar antara 7-14 hari kerja sejak dokumen diterima dan konsep kerja disepakati.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FORM SECTION -->
<section id="form-section" class="py-4">
    <div class="container" style="max-width: 900px;">
        <?php Helper::flash(); ?>
        
        <div class="row g-4">
            <div class="col-md-7">
                <div class="form-box p-4" style="background: #FAF3D6; border-radius: 12px; border: 1.5px solid #e2d9b8;">
                    <h5 class="fw-bold mb-1">Masih mempunyai pertanyaan?</h5>
                    <p class="small text-muted mb-3">Kirimkan kepada kami!</p>

                    <form action="<?= BASEURL; ?>/home/mitra_kerjasama" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label fw-semibold text-dark small">Nama</label>
                                <input class="form-control" type="text" name="nama" id="nama" placeholder="Masukkan Nama" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold text-dark small">Email</label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Masukkan Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pertanyaan" class="form-label fw-semibold text-dark small">Pertanyaan</label>
                            <textarea class="form-control" name="pertanyaan" id="pertanyaan" rows="4" placeholder="Masukkan pertanyaan" required></textarea>
                        </div>
                        <button type="submit" class="btn submit-btn w-100 text-white fw-bold" style="background: #E4947D;">Kirim Pertanyaan</button>
                    </form>
                </div>
            </div>
            <div class="col-md-5 d-flex flex-column justify-content-center text-center">
                <p class="mb-3 fw-bold">Kenali juga struktur dan manajemen TEFA MILK pada halaman</p>
                <a class="btn profile-btn fw-bold py-2" href="<?= BASEURL; ?>/home/profil_perusahaan" style="background: transparent; border: 2px solid #E4947D; color: #d6836c; border-radius: 8px;">PROFIL PERUSAHAAN</a>
            </div>
        </div>
    </div>
</section>

<!-- SOP SECTION -->
<div class="container-fluid px-0 my-5" style="max-width: 900px; margin: 0 auto;">
    <div class="sop-wrapper p-4 shadow rounded" style="background: #fff;">
        <h4 class="text-center mb-5 fw-bold">STANDARD OPERATING <br> PROCEDURE (SOP)</h4>

        <div class="sop-item row align-items-center mb-3">
            <div class="col-1 d-flex justify-content-end">
                <div class="kotak" style="width: 15px; height: 15px; background: #E4947D; border-radius: 3px;"></div>
            </div>
            <div class="col-7 fw-semibold">SOP Produksi Susu</div>
            <div class="col-4 text-end">
                <button class="btn-sop px-3 py-1" data-bs-toggle="modal" data-bs-target="#modalSOP1" style="background: transparent; border: 1.5px solid #E4947D; color: #d6836c; border-radius: 5px; font-size: 0.90rem;">Lihat Selengkapnya</button>
            </div>
        </div>

        <div class="sop-item row align-items-center mb-3">
            <div class="col-1 d-flex justify-content-end">
                <div class="kotak" style="width: 15px; height: 15px; background: #E4947D; border-radius: 3px;"></div>
            </div>
            <div class="col-7 fw-semibold">SOP Kebersihan & Sanitasi</div>
            <div class="col-4 text-end">
                <button class="btn-sop px-3 py-1" data-bs-toggle="modal" data-bs-target="#modalSOP2" style="background: transparent; border: 1.5px solid #E4947D; color: #d6836c; border-radius: 5px; font-size: 0.90rem;">Lihat Selengkapnya</button>
            </div>
        </div>

        <div class="sop-item row align-items-center mb-3">
            <div class="col-1 d-flex justify-content-end">
                <div class="kotak" style="width: 15px; height: 15px; background: #E4947D; border-radius: 3px;"></div>
            </div>
            <div class="col-7 fw-semibold">SOP Kerjasama Supplier</div>
            <div class="col-4 text-end">
                <button class="btn-sop px-3 py-1" data-bs-toggle="modal" data-bs-target="#modalSOP3" style="background: transparent; border: 1.5px solid #E4947D; color: #d6836c; border-radius: 5px; font-size: 0.90rem;">Lihat Selengkapnya</button>
            </div>
        </div>

        <div class="sop-item row align-items-center">
            <div class="col-1 d-flex justify-content-end">
                <div class="kotak" style="width: 15px; height: 15px; background: #E4947D; border-radius: 3px;"></div>
            </div>
            <div class="col-7 fw-semibold">SOP Pengelolaan Wadah Susu</div>
            <div class="col-4 text-end">
                <button class="btn-sop px-3 py-1" data-bs-toggle="modal" data-bs-target="#modalSOP4" style="background: transparent; border: 1.5px solid #E4947D; color: #d6836c; border-radius: 5px; font-size: 0.90rem;">Lihat Selengkapnya</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SOP 1 -->
<div class="modal fade" id="modalSOP1" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4">
      <h5 class="fw-bold text-center">STANDARD OPERATING PROCEDURE (SOP)</h5>
      <h3 class="text-center fw-bold mb-4">PRODUKSI SUSU PASTEURISASI</h3>
      <p>Produksi susu pasteurisasi merupakan kegiatan utama TEFA MILK yang berfokus pada pembuatan produk susu olahan untuk menjaga kualitas, keamanan, serta memperpanjang masa simpan.</p>
      <h6 class="fw-bold mt-3">Tujuan</h6>
      <ul>
          <li>Menjaga proses produksi sesuai standar.</li>
          <li>Menjamin kualitas & keamanan produk.</li>
      </ul>
      <h6 class="fw-bold mt-3">Prosedur</h6>
      <ul>
          <li>Penerimaan susu dari peternak.</li>
          <li>Pembersihan & filtrasi.</li>
          <li>Pemanasan sesuai standar suhu pasteurisasi.</li>
          <li>Pengecekan kualitas & pengemasan.</li>
      </ul>
      <button class="btn btn-danger mt-3 align-self-end px-4" data-bs-dismiss="modal">Tutup</button>
    </div>
  </div>
</div>

<!-- MODAL SOP 2 -->
<div class="modal fade" id="modalSOP2" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4">
      <h5 class="fw-bold text-center">STANDARD OPERATING PROCEDURE (SOP)</h5>
      <h3 class="text-center fw-bold mb-4">TEFA MILK – KEBERSIHAN & SANITASI</h3>
      <p>Kebersihan dan sanitasi merupakan aspek penting untuk menjaga keamanan pangan dan kualitas produk.</p>
      <h6 class="fw-bold mt-3">Prosedur</h6>
      <ul>
          <li>Pembersihan area sebelum dan sesudah produksi.</li>
          <li>Disinfeksi peralatan & fasilitas.</li>
          <li>Pengelolaan limbah sesuai ketentuan.</li>
      </ul>
      <button class="btn btn-danger mt-3 align-self-end px-4" data-bs-dismiss="modal">Tutup</button>
    </div>
  </div>
</div>

<!-- MODAL SOP 3 -->
<div class="modal fade" id="modalSOP3" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4">
      <h5 class="fw-bold text-center">STANDARD OPERATING PROCEDURE (SOP)</h5>
      <h3 class="text-center fw-bold mb-4">TEFA MILK – KERJA SAMA SUPPLIER</h3>
      <p>Kerja sama dengan supplier bahan baku sangat penting untuk menjaga kelangsungan produksi.</p>
      <h6 class="fw-bold mt-3">Prosedur</h6>
      <ul>
          <li>Pemeriksaan bahan saat diterima.</li>
          <li>Sertifikasi kelayakan bahan baku.</li>
          <li>Evaluasi berkala kualitas supplier.</li>
      </ul>
      <button class="btn btn-danger mt-3 align-self-end px-4" data-bs-dismiss="modal">Tutup</button>
    </div>
  </div>
</div>

<!-- MODAL SOP 4 -->
<div class="modal fade" id="modalSOP4" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4">
      <h5 class="fw-bold text-center">STANDARD OPERATING PROCEDURE (SOP)</h5>
      <h3 class="text-center fw-bold mb-4">TEFA MILK – PENGELOLAAN WADAH SUSU</h3>
      <p>Wadah susu yang higienis sangat berpengaruh terhadap kualitas produk.</p>
      <button class="btn btn-danger mt-3 align-self-end px-4" data-bs-dismiss="modal">Tutup</button>
    </div>
  </div>
</div>

<!-- JOIN -->
<section class="mitra-section container my-5">
    <div class="row align-items-center justify-content-center text-center py-4 bg-light rounded" style="border: 1px solid #ddd;">
        <div class="col-lg-6">
            <h2 class="mitra-title fw-bold" style="color: #2d2a26;">
                BERGABUNG BERMITRA<br>
                BERSAMA TEFA MILK POLIJE!
            </h2>
        </div>
        <div class="col-lg-6 d-flex justify-content-center mt-3 mt-lg-0">
            <div class="email-box p-3 d-flex align-items-center rounded bg-white shadow-sm" style="cursor: pointer; border: 1.5px solid #E4947D; min-width: 300px;" onclick="window.location.href='mailto:tefamilkduapolije@gmail.com'">
                <div class="icon me-3 text-white d-flex align-items-center justify-content-center rounded-circle" style="background: #E4947D; width: 45px; height: 45px;">
                    <i class="bi bi-envelope-fill fs-5"></i>
                </div>
                <div class="text-start">
                    <h5 class="email-title mb-0 fw-bold" style="font-size: 1rem; color: #2d2a26;">Email</h5>
                    <p class="contact-value mb-0 text-muted small">tefamilkduapolije@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../views/templates/footer.php'; ?>
