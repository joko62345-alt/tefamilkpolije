<?php

class CatalogController extends Controller {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    public function index() {
        $data['title'] = 'TEFA MILK – Katalog Produk';
        $data['extra_css'] = ['../public/css/catalog.css'];
        $data['extra_js'] = ['main_page_katalog.js'];
        $data['products'] = $this->productModel->getAllProducts();
        $data['categories'] = $this->categoryModel->getAllCategories();
        $this->view('catalog/index', $data);
    }

    public function detail($id = null) {
        if (is_null($id)) {
            Helper::redirect('catalog');
        }

        $product = $this->productModel->getProductById($id);
        if (!$product) {
            Helper::setFlash('danger', 'Produk tidak ditemukan.');
            Helper::redirect('catalog');
        }

        $data['title'] = 'TEFA MILK – Detail ' . $product['name'];
        $data['extra_css'] = ['../public/css/detailproduk.css'];
        $data['product'] = $product;
        $this->view('catalog/detail', $data);
    }
}
