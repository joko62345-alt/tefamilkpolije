<?php

class HomeController extends Controller {
    private $productModel;
    private $galleryModel;
    private $partnerModel;
    private $contactModel;

    public function __construct() {
        $this->productModel = $this->model('ProductModel');
        $this->galleryModel = $this->model('GalleryModel');
        $this->partnerModel = $this->model('PartnerModel');
        $this->contactModel = $this->model('ContactModel');
    }

    public function index() {
        $data['title'] = 'TEFA MILK – Beranda';
        $data['extra_css'] = ['homepage.css'];
        $data['products'] = $this->productModel->getRecommendedProducts();
        $this->view('home/index', $data);
    }

    public function profil_perusahaan() {
        $data['title'] = 'TEFA MILK – Profil Perusahaan';
        $data['extra_css'] = ['profil_perusahaan.css'];
        $data['extra_js'] = ['profil_perusahaan.js'];
        $this->view('home/profil_perusahaan', $data);
    }

    public function profil_tim() {
        $data['title'] = 'TEFA MILK – Profil Tim';
        $data['extra_css'] = ['profil_tim.css'];
        $this->view('home/profil_tim', $data);
    }

    public function tentang() {
        $data['title'] = 'TEFA MILK – Kegiatan Kami';
        $data['extra_css'] = ['tentang.css'];
        $data['galleries'] = $this->galleryModel->getGalleriesByType('kegiatan');
        $this->view('home/tentang', $data);
    }

    public function galery() {
        $data['title'] = 'TEFA MILK – Galeri Milk';
        $data['extra_css'] = ['galerysty.css'];
        $data['extra_js'] = ['galerycs.js'];
        $data['kegiatan'] = $this->galleryModel->getGalleriesByType('kegiatan');
        $data['artikel'] = $this->galleryModel->getGalleriesByType('artikel');
        
        // Combine reviews from contacts dan customer reviews
        $contactReviews = $this->contactModel->getAllReviews();
        $reviewModel = $this->model('ReviewModel');
        $customerReviews = $reviewModel->getApprovedReviews(100);
        
        // Merge reviews (customer reviews first, then contact reviews)
        $data['reviews'] = array_merge($customerReviews, $contactReviews);
        
        $this->view('home/galery', $data);
    }

    public function mitra_kerjasama() {
        $data['title'] = 'TEFA MILK – Mitra Kerjasama';
        $data['extra_css'] = ['mitra.css'];
        $data['partners'] = $this->partnerModel->getAllPartners();

        // Handle question form post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = [
                'name' => Helper::sanitize($_POST['nama']),
                'email' => Helper::sanitize($_POST['email']),
                'rating' => 0, // 0 means it's an inquiry
                'message' => Helper::sanitize($_POST['pertanyaan'])
            ];

            if (!empty($postData['name']) && !empty($postData['email']) && !empty($postData['message'])) {
                if ($this->contactModel->saveContact($postData)) {
                    Helper::setFlash('success', 'Pertanyaan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
                } else {
                    Helper::setFlash('danger', 'Gagal mengirim pertanyaan. Silakan coba lagi.');
                }
            } else {
                Helper::setFlash('danger', 'Semua kolom wajib diisi.');
            }
            Helper::redirect('home/mitra_kerjasama');
        }

        $this->view('home/mitra_kerjasama', $data);
    }

    public function kontak() {
        $data['title'] = 'Kontak - TEFA MILK';
        $data['extra_css'] = ['kontak.css'];

        // Handle review form post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = [
                'name' => Helper::sanitize($_POST['nama']),
                'email' => Helper::sanitize($_POST['email']),
                'rating' => isset($_POST['rating']) ? (int)$_POST['rating'] : 0,
                'message' => Helper::sanitize($_POST['ulasan'])
            ];

            if (!empty($postData['name']) && !empty($postData['email']) && !empty($postData['message'])) {
                if ($this->contactModel->saveContact($postData)) {
                    Helper::setFlash('success', 'Ulasan/Pesan Anda berhasil dikirim. Terima kasih!');
                } else {
                    Helper::setFlash('danger', 'Gagal mengirim pesan. Silakan coba lagi.');
                }
            } else {
                Helper::setFlash('danger', 'Semua kolom wajib diisi.');
            }
            Helper::redirect('home/kontak');
        }

        $this->view('home/kontak', $data);
    }

    public function ulasan() {
        $data['title'] = 'TEFA MILK – Semua Ulasan';
        $data['extra_css'] = ['galerysty.css'];
        $data['reviews'] = $this->contactModel->getAllReviews();
        $this->view('home/ulasan', $data);
    }

    public function artikel() {
        $data['title'] = 'TEFA MILK – Artikel';
        $data['extra_css'] = ['artikel.css'];
        $data['galleries'] = $this->galleryModel->getGalleriesByType('artikel');
        $this->view('home/artikel', $data);
    }

    public function artikeldetail($id = null) {
        if (!$id) Helper::redirect('home/artikel');
        $data['title'] = 'TEFA MILK – Detail Artikel';
        $data['extra_css'] = ['artikeldetail.css'];
        $data['gallery'] = $this->galleryModel->getGalleryById($id);
        if (!$data['gallery']) Helper::redirect('home/artikel');
        $this->view('home/artikeldetail', $data);
    }

    public function artikeldetail2($id = null) {
        if (!$id) Helper::redirect('home/artikel');
        $data['title'] = 'TEFA MILK – Detail Artikel';
        $data['extra_css'] = ['artikeldetail.css'];
        $data['gallery'] = $this->galleryModel->getGalleryById($id);
        if (!$data['gallery']) Helper::redirect('home/artikel');
        $this->view('home/artikeldetail2', $data);
    }
}
