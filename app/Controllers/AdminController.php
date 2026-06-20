<?php

class AdminController extends Controller {
    private $productModel;
    private $categoryModel;
    private $userModel;
    private $orderModel;

    public function __construct() {
        Helper::requireAdmin();
        $this->productModel  = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->userModel     = $this->model('UserModel');
        $this->orderModel    = $this->model('OrderModel');
    }

    // ===================== DASHBOARD =====================
    public function index() {
        $data['title']     = 'Admin – TEFA MILK';
        $data['pageTitle'] = 'Dashboard';
        $data['totalProducts']  = $this->productModel->getProductCount();
        $data['totalCustomers'] = $this->userModel->getCustomerCount();
        $data['totalOrders']    = $this->orderModel->getOrderCount();
        $data['totalRevenue']   = $this->orderModel->getTotalRevenue();
        $data['recentOrders']   = array_slice($this->orderModel->getAllOrders(), 0, 5);
        $this->view('admin/dashboard', $data);
    }

    // ===================== CATEGORIES =====================
    public function categories() {
        $data['title']      = 'Admin – Kategori';
        $data['pageTitle']  = 'Kelola Kategori';
        $data['categories'] = $this->categoryModel->getAllCategories();
        $this->view('admin/categories', $data);
    }

    public function store_category() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') Helper::redirect('admin/categories');
        $name = Helper::sanitize($_POST['name']);
        if (empty($name)) {
            Helper::setFlash('danger', 'Nama kategori tidak boleh kosong.');
        } else {
            $this->categoryModel->createCategory($name);
            Helper::setFlash('success', 'Kategori berhasil ditambahkan.');
        }
        Helper::redirect('admin/categories');
    }

    public function edit_category($id = null) {
        if (!$id) Helper::redirect('admin/categories');
        $data['title']     = 'Admin – Edit Kategori';
        $data['pageTitle'] = 'Edit Kategori';
        $data['category']  = $this->categoryModel->getCategoryById($id);
        $this->view('admin/edit_category', $data);
    }

    public function update_category() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') Helper::redirect('admin/categories');
        $id   = (int)$_POST['id'];
        $name = Helper::sanitize($_POST['name']);
        if (empty($name)) {
            Helper::setFlash('danger', 'Nama kategori tidak boleh kosong.');
        } else {
            $this->categoryModel->updateCategory($id, $name);
            Helper::setFlash('success', 'Kategori berhasil diperbarui.');
        }
        Helper::redirect('admin/categories');
    }

    public function delete_category($id = null) {
        if (!$id) Helper::redirect('admin/categories');
        $this->categoryModel->deleteCategory($id);
        Helper::setFlash('success', 'Kategori berhasil dihapus.');
        Helper::redirect('admin/categories');
    }

    // ===================== PRODUCTS =====================
    public function products() {
        $data['title']      = 'Admin – Produk';
        $data['pageTitle']  = 'Kelola Produk';
        $data['products']   = $this->productModel->getAllProducts();
        $data['categories'] = $this->categoryModel->getAllCategories();
        $this->view('admin/products', $data);
    }

    public function store_product() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') Helper::redirect('admin/products');

        $image = 'default.png';
        if (!empty($_FILES['image']['name'])) {
            $uploadDir  = '../public/image/';
            $ext        = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed    = ['jpg','jpeg','png','webp'];
            if (!in_array($ext, $allowed)) {
                Helper::setFlash('danger', 'Format gambar tidak didukung (jpg/png/webp saja).');
                Helper::redirect('admin/products');
            }
            $image = 'prod_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
        }

        $productData = [
            'category_id' => (int)$_POST['category_id'],
            'name'        => Helper::sanitize($_POST['name']),
            'description' => Helper::sanitize($_POST['description']),
            'price'       => (float)$_POST['price'],
            'stock'       => (int)$_POST['stock'],
            'image'       => $image
        ];
        $this->productModel->createProduct($productData);
        Helper::setFlash('success', 'Produk berhasil ditambahkan.');
        Helper::redirect('admin/products');
    }

    public function edit_product($id = null) {
        if (!$id) Helper::redirect('admin/products');
        $data['title']      = 'Admin – Edit Produk';
        $data['pageTitle']  = 'Edit Produk';
        $data['product']    = $this->productModel->getProductById($id);
        $data['categories'] = $this->categoryModel->getAllCategories();
        $this->view('admin/edit_product', $data);
    }

    public function update_product() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') Helper::redirect('admin/products');

        $id    = (int)$_POST['id'];
        $image = '';
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../public/image/';
            $ext       = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed   = ['jpg','jpeg','png','webp'];
            if (in_array($ext, $allowed)) {
                $image = 'prod_' . time() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
            }
        }

        $productData = [
            'id'          => $id,
            'category_id' => (int)$_POST['category_id'],
            'name'        => Helper::sanitize($_POST['name']),
            'description' => Helper::sanitize($_POST['description']),
            'price'       => (float)$_POST['price'],
            'stock'       => (int)$_POST['stock'],
            'image'       => $image
        ];
        $this->productModel->updateProduct($productData);
        Helper::setFlash('success', 'Produk berhasil diperbarui.');
        Helper::redirect('admin/products');
    }

    public function delete_product($id = null) {
        if (!$id) Helper::redirect('admin/products');
        $this->productModel->deleteProduct($id);
        Helper::setFlash('success', 'Produk berhasil dihapus.');
        Helper::redirect('admin/products');
    }

    // ===================== CUSTOMERS =====================
    public function customers() {
        $data['title']     = 'Admin – Pelanggan';
        $data['pageTitle'] = 'Daftar Pelanggan';
        $data['customers'] = $this->userModel->getAllCustomers();
        $this->view('admin/customers', $data);
    }

    // ===================== ORDERS =====================
    public function orders() {
        $data['title']     = 'Admin – Pesanan';
        $data['pageTitle'] = 'Kelola Pesanan';
        $data['orders']    = $this->orderModel->getAllOrders();
        $this->view('admin/orders', $data);
    }

    public function order_detail($id = null) {
        if (!$id) Helper::redirect('admin/orders');
        $order   = $this->orderModel->getOrderById($id);
        $details = $this->orderModel->getOrderDetailsByOrder($id);
        $data['title']     = 'Admin – Detail Pesanan';
        $data['pageTitle'] = 'Detail Pesanan #' . $id;
        $data['order']     = $order;
        $data['details']   = $details;
        $this->view('admin/order_detail', $data);
    }

    public function update_status() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') Helper::redirect('admin/orders');
        $orderId = (int)$_POST['order_id'];
        $status  = $_POST['status'];
        $allowed = ['Menunggu', 'Diproses', 'Selesai'];
        
        if (!in_array($status, $allowed)) {
            Helper::setFlash('danger', 'Status tidak valid.');
            Helper::redirect('admin/orders');
        }

        // Get order to check requirements
        $order = $this->orderModel->getOrderById($orderId);
        if (!$order) {
            Helper::setFlash('danger', 'Pesanan tidak ditemukan.');
            Helper::redirect('admin/orders');
        }

        // Validasi bukti pembayaran untuk metode transfer/QRIS
        if (($order['payment_method'] === 'Transfer Bank' || $order['payment_method'] === 'QRIS') && empty($order['payment_proof'])) {
            Helper::setFlash('danger', 'Bukti pembayaran belum diupload. Harap tunda hingga pelanggan upload bukti.');
            Helper::redirect('admin/orders');
        }

        // Validasi bukti penerimaan sebelum mark Selesai
        if ($status === 'Selesai' && empty($order['delivery_proof'])) {
            Helper::setFlash('danger', 'Bukti penerimaan belum diupload. Pesanan tidak bisa ditandai selesai.');
            Helper::redirect('admin/orders');
        }

        // Update status
        if ($this->orderModel->updateOrderStatus($orderId, $status)) {
            Helper::setFlash('success', 'Status pesanan berhasil diperbarui.');
        } else {
            Helper::setFlash('danger', 'Status pesanan gagal diperbarui. Stok produk mungkin tidak mencukupi atau status tidak berubah.');
        }
        Helper::redirect('admin/orders');
    }

    // ===================== REPORT =====================
    public function report() {
        $from = $_GET['from'] ?? date('Y-m-01');
        $to   = $_GET['to']   ?? date('Y-m-d');

        $data['title']     = 'Admin – Laporan';
        $data['pageTitle'] = 'Laporan Penjualan';
        $data['from']      = $from;
        $data['to']        = $to;
        $data['orders']    = $this->orderModel->getOrdersByDateRange($from, $to);
        $data['revenue']   = $this->orderModel->getRevenueByDateRange($from, $to);
        $this->view('admin/report', $data);
    }

    // Preview laporan untuk print/save PDF
    public function report_preview() {
        $from = $_GET['from'] ?? date('Y-m-01');
        $to   = $_GET['to']   ?? date('Y-m-d');

        $data['from']    = $from;
        $data['to']      = $to;
        $data['orders']  = $this->orderModel->getOrdersByDateRange($from, $to);
        $data['revenue'] = $this->orderModel->getRevenueByDateRange($from, $to);
        $this->view('admin/report_preview', $data);
    }

    // ===================== GALLERY =====================
    public function gallery() {
        $galleryModel = $this->model('GalleryModel');
        $data['title']      = 'Admin – Galeri';
        $data['pageTitle']  = 'Kelola Galeri';
        $data['galleries']  = $galleryModel->getAllGalleries();
        $this->view('admin/gallery', $data);
    }

    public function store_gallery() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') Helper::redirect('admin/gallery');

        $image = 'default.png';
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../public/image/gallery/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            if (!in_array($ext, $allowed)) {
                Helper::setFlash('danger', 'Format gambar tidak didukung (jpg/png/webp saja).');
                Helper::redirect('admin/gallery');
            }
            $image = 'gallery_' . time() . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image)) {
                $image = 'gallery/' . $image;
            }
        }

        $galleryData = [
            'title'       => Helper::sanitize($_POST['title']),
            'description' => Helper::sanitize($_POST['description'] ?? ''),
            'image'       => $image,
            'type'        => $_POST['type'] ?? 'kegiatan'
        ];
        $galleryModel = $this->model('GalleryModel');
        $galleryModel->createGallery($galleryData);
        Helper::setFlash('success', 'Gambar galeri berhasil ditambahkan.');
        Helper::redirect('admin/gallery');
    }

    public function edit_gallery($id = null) {
        if (!$id) Helper::redirect('admin/gallery');
        $galleryModel = $this->model('GalleryModel');
        $data['title']     = 'Admin – Edit Galeri';
        $data['pageTitle'] = 'Edit Galeri';
        $data['gallery']   = $galleryModel->getGalleryById($id);
        $this->view('admin/edit_gallery', $data);
    }

    public function update_gallery() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') Helper::redirect('admin/gallery');

        $id    = (int)$_POST['id'];
        $image = '';
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../public/image/gallery/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            if (in_array($ext, $allowed)) {
                $image = 'gallery_' . time() . '.' . $ext;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image)) {
                    $image = 'gallery/' . $image;
                }
            }
        }

        $galleryModel = $this->model('GalleryModel');
        $galleryData = [
            'title'       => Helper::sanitize($_POST['title']),
            'description' => Helper::sanitize($_POST['description'] ?? ''),
            'type'        => $_POST['type']
        ];
        $galleryModel->updateGallery($id, $galleryData);
        if (!empty($image)) {
            $galleryModel->updateGalleryImage($id, $image);
        }
        Helper::setFlash('success', 'Galeri berhasil diperbarui.');
        Helper::redirect('admin/gallery');
    }

    public function delete_gallery($id = null) {
        if (!$id) Helper::redirect('admin/gallery');
        $galleryModel = $this->model('GalleryModel');
        $galleryModel->deleteGallery($id);
        Helper::setFlash('success', 'Gambar galeri berhasil dihapus.');
        Helper::redirect('admin/gallery');
    }

    // ===================== REVIEWS =====================
    public function reviews() {
        $reviewModel = $this->model('ReviewModel');
        $data['title']          = 'Admin – Ulasan';
        $data['pageTitle']      = 'Kelola Ulasan Pelanggan';
        $data['reviews']        = $reviewModel->getPendingReviews();
        $data['approvedReviews']= $reviewModel->getAllReviews();
        $data['avgRating']      = $reviewModel->getAverageRating();
        $data['totalReviews']   = $reviewModel->countApprovedReviews();
        $this->view('admin/reviews', $data);
    }

    public function approve_review($id = null) {
        if (!$id) Helper::redirect('admin/reviews');
        $reviewModel = $this->model('ReviewModel');
        $reviewModel->approveReview($id);
        Helper::setFlash('success', 'Ulasan berhasil disetujui.');
        Helper::redirect('admin/reviews');
    }

    public function delete_review($id = null) {
        if (!$id) Helper::redirect('admin/reviews');
        $reviewModel = $this->model('ReviewModel');
        $reviewModel->rejectReview($id);
        Helper::setFlash('success', 'Testimoni berhasil dihapus.');
        Helper::redirect('admin/reviews');
    }

    public function reject_review($id = null) {
        if (!$id) Helper::redirect('admin/reviews');
        $reviewModel = $this->model('ReviewModel');
        $reviewModel->rejectReview($id);
        Helper::setFlash('success', 'Ulasan berhasil ditolak.');
        Helper::redirect('admin/reviews');
    }
}

