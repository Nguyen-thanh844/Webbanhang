<?php 

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_file(PATH_CONTROLLER);
require_file(PATH_MODEL);

// Route Client
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->homeIndex(), //trường hợp đặc biệt
    'danh-sach-san-pham'=>(new HomeController())->danhSachSanPham(),
    'product-detail' => (new ProductDetail())->productDetail($_GET['id']),
    
};