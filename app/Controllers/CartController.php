<?php

class CartController extends Controller {
    private $cartModel;
    private $orderModel;
    private $productModel;

    public function __construct() {
        Helper::requireCustomer();
        $this->cartModel  = $this->model('CartModel');
        $this->orderModel = $this->model('OrderModel');
        $this->productModel = $this->model('ProductModel');
    }

    // Show cart
    public function index() {
        $userId = Helper::getUserId();
        $data['title'] = 'Keranjang Belanja – TEFA MILK';
        $data['items'] = $this->cartModel->getCartItems($userId);
        $data['total'] = $this->cartModel->getCartTotal($userId);
        $data['extra_css'] = ['../public/css/cart.css'];
        $this->view('cart/index', $data);
          
    }

    // Add item to cart
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helper::redirect('catalog');
        }

        $userId    = Helper::getUserId();
        $productId = (int)($_POST['product_id'] ?? 0);
        $quantity  = max(1, (int)$_POST['quantity']);

        $product = $this->productModel->getProductById($productId);
        if (!$product) {
            Helper::setFlash('danger', 'Produk tidak ditemukan.');
            Helper::redirect('catalog');
        }

        if ($product['stock'] < $quantity) {
            Helper::setFlash('danger', 'Stok tidak mencukupi.');
            Helper::redirect('catalog/detail/' . $productId);
        }

        $cartId = $this->cartModel->getOrCreateCart($userId);
        $this->cartModel->addItem($cartId, $productId, $quantity);
        Helper::setFlash('success', $product['name'] . ' berhasil ditambahkan ke keranjang!');
        Helper::redirect('catalog/detail/' . $productId);
    }

    // Update quantity
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helper::redirect('cart');
        }
        $itemId  = (int)$_POST['item_id'];
        $qty     = (int)$_POST['quantity'];
        if ($qty < 1) {
            $this->cartModel->removeItem($itemId);
        } else {
            $this->cartModel->updateItem($itemId, $qty);
        }
        Helper::redirect('cart');
    }

    // Remove single item
    public function remove() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helper::redirect('cart');
        }
        $itemId = (int)$_POST['item_id'];
        $this->cartModel->removeItem($itemId);
        Helper::setFlash('success', 'Item berhasil dihapus dari keranjang.');
        Helper::redirect('cart');
    }

    // Show checkout page
    public function checkout() {
        $userId = Helper::getUserId();
        $items  = $this->cartModel->getCartItems($userId);
        if (empty($items)) {
            Helper::setFlash('danger', 'Keranjang Anda masih kosong.');
            Helper::redirect('cart');
        }
        $userModel = $this->model('UserModel');
        $user = $userModel->getUserById($userId);

        $data['title']   = 'Checkout – TEFA MILK';
        $data['items']   = $items;
        $data['total']   = $this->cartModel->getCartTotal($userId);
        $data['user']    = $user;
        $data['extra_css'] = ['../public/css/checkout.css'];
        $this->view('cart/checkout', $data);
    }

    // Process checkout
    public function placeorder() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helper::redirect('cart');
        }

        $userId  = Helper::getUserId();
        $items   = $this->cartModel->getCartItems($userId);
        if (empty($items)) {
            Helper::setFlash('danger', 'Keranjang Anda kosong.');
            Helper::redirect('cart');
        }

        $total   = $this->cartModel->getCartTotal($userId);
        $address = Helper::sanitize($_POST['shipping_address']);
        $payment = Helper::sanitize($_POST['payment_method']);

        if (empty($address) || empty($payment)) {
            Helper::setFlash('danger', 'Harap lengkapi alamat dan metode pembayaran.');
            Helper::redirect('cart/checkout');
        }

        $orderData = [
            'user_id'          => $userId,
            'total_price'      => $total,
            'shipping_address' => $address,
            'payment_method'   => $payment,
            'payment_proof'    => null
        ];

        // Upload bukti pembayaran jika transfer atau qris
        if (($payment === 'Transfer Bank' || $payment === 'QRIS') && !empty($_FILES['payment_proof']['name'])) {
            $uploadDir = '../public/proofs/payment/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $ext = strtolower(pathinfo($_FILES['payment_proof']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
            
            if (in_array($ext, $allowed)) {
                $paymentProof = 'payment_' . $userId . '_' . time() . '.' . $ext;
                if (move_uploaded_file($_FILES['payment_proof']['tmp_name'], $uploadDir . $paymentProof)) {
                    $orderData['payment_proof'] = $paymentProof;
                } else {
                    Helper::setFlash('danger', 'Gagal mengupload bukti pembayaran.');
                    Helper::redirect('cart/checkout');
                }
            } else {
                Helper::setFlash('danger', 'Format bukti pembayaran tidak didukung (jpg/png/pdf saja).');
                Helper::redirect('cart/checkout');
            }
        } elseif ($payment === 'Transfer Bank' || $payment === 'QRIS') {
            Helper::setFlash('danger', 'Harap upload bukti pembayaran untuk metode ' . $payment);
            Helper::redirect('cart/checkout');
        }

        $orderId = $this->orderModel->createOrder($orderData);

        foreach ($items as $item) {
            $this->orderModel->addOrderDetail($orderId, $item['product_id'], $item['quantity'], $item['price']);
        }

        // Clear cart setelah order dibuat, stok akan dikurangi saat pesanan selesai
        $this->cartModel->clearCart($userId);

        Helper::setFlash('success', 'Pesanan berhasil dibuat! Nomor pesanan: #' . $orderId . '. Status saat ini: Menunggu verifikasi pembayaran.');
        Helper::redirect('cart/history');
    }

    // Show order history
    public function history() {
        $userId = Helper::getUserId();
        $orders = $this->orderModel->getOrdersByUser($userId);

        foreach ($orders as &$order) {
            $order['details'] = $this->orderModel->getOrderDetailsByOrder($order['id']);
        }

        $data['title'] = 'Riwayat Pesanan – TEFA MILK';
        $data['orders'] = $orders;
        $data['extra_css'] = ['../public/css/history.css'];
        $this->view('cart/history', $data);
    }

    // Upload delivery proof
    public function upload_delivery_proof() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helper::redirect('cart/history');
        }

        $orderId = (int)$_POST['order_id'];
        $userId = Helper::getUserId();

        $order = $this->orderModel->getOrderById($orderId);
        if (!$order || $order['user_id'] !== $userId) {
            Helper::setFlash('danger', 'Pesanan tidak ditemukan.');
            Helper::redirect('cart/history');
        }

        if ($order['status'] !== 'Diproses') {
            Helper::setFlash('danger', 'Bukti penerimaan hanya bisa diupload untuk pesanan yang sedang diproses.');
            Helper::redirect('cart/history');
        }

        if (!empty($order['delivery_proof'])) {
            Helper::setFlash('warning', 'Bukti penerimaan sudah diupload. Tunggu verifikasi admin.');
            Helper::redirect('cart/history');
        }

        if (empty($_FILES['delivery_proof']['name'])) {
            Helper::setFlash('danger', 'Harap pilih file bukti penerimaan.');
            Helper::redirect('cart/history');
        }

        $uploadDir = '../public/proofs/delivery/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $ext = strtolower(pathinfo($_FILES['delivery_proof']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed)) {
            Helper::setFlash('danger', 'Format bukti tidak didukung (jpg/png saja).');
            Helper::redirect('cart/history');
        }

        $deliveryProof = 'delivery_' . $orderId . '_' . time() . '.' . $ext;
        if (move_uploaded_file($_FILES['delivery_proof']['tmp_name'], $uploadDir . $deliveryProof)) {
            if ($this->orderModel->updateDeliveryProof($orderId, $deliveryProof)) {
                Helper::setFlash('success', 'Bukti penerimaan berhasil diupload! Admin akan segera memverifikasi.');
            } else {
                Helper::setFlash('danger', 'Gagal menyimpan bukti penerimaan.');
            }
        } else {
            Helper::setFlash('danger', 'Gagal mengupload file.');
        }

        Helper::redirect('cart/history');
    }

    // Add review untuk pesanan selesai
    public function add_review() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helper::redirect('cart/history');
        }

        $orderId = (int)$_POST['order_id'];
        $userId = Helper::getUserId();

        $order = $this->orderModel->getOrderById($orderId);
        if (!$order || $order['user_id'] !== $userId) {
            Helper::setFlash('danger', 'Pesanan tidak ditemukan.');
            Helper::redirect('cart/history');
        }

        // Allow review if order is marked 'Selesai' OR if customer has uploaded delivery proof
        if ($order['status'] !== 'Selesai' && empty($order['delivery_proof'])) {
            Helper::setFlash('danger', 'Hanya pesanan yang selesai atau yang memiliki bukti penerimaan yang bisa diberi ulasan.');
            Helper::redirect('cart/history');
        }

        $reviewModel = $this->model('ReviewModel');
        if ($reviewModel->getReviewByOrder($orderId)) {
            Helper::setFlash('danger', 'Anda sudah memberikan ulasan untuk pesanan ini.');
            Helper::redirect('cart/history');
        }

        $rating = (int)$_POST['rating'] ?? 5;
        $title = Helper::sanitize($_POST['title'] ?? 'Produk Bagus');
        $message = Helper::sanitize($_POST['message']);

        if (empty($message)) {
            Helper::setFlash('danger', 'Ulasan tidak boleh kosong.');
            Helper::redirect('cart/history');
        }

        $image = null;
        if (!empty($_FILES['review_image']['name'])) {
            $uploadDir = '../public/image/reviews/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $ext = strtolower(pathinfo($_FILES['review_image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png'];
            if (in_array($ext, $allowed)) {
                $image = 'review_' . $userId . '_' . time() . '.' . $ext;
                if (move_uploaded_file($_FILES['review_image']['tmp_name'], $uploadDir . $image)) {
                    $image = 'reviews/' . $image;
                } else {
                    $image = null;
                }
            }
        }

        $reviewData = [
            'order_id' => $orderId,
            'user_id' => $userId,
            'rating' => $rating,
            'title' => $title,
            'message' => $message,
            'image' => $image
        ];

        if ($reviewModel->createReview($reviewData)) {
            Helper::setFlash('success', 'Ulasan Anda berhasil dikirim! Admin akan segera memverifikasinya.');
        } else {
            Helper::setFlash('danger', 'Gagal mengirim ulasan.');
        }

        Helper::redirect('cart/history');
    }
}

