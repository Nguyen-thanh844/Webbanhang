<?php

class HomeController
{
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelDanhMuc = new SanPham();
    }
    function homeIndex()
    {
        $view = 'home';
        $product = $this->modelSanPham->getAllProduct();
        // var_dump($product);die();
        $product3 = $this->modelSanPham->get3Product();
        $product3view = $this->modelSanPham->get3ViewProduct();
        $product3commnet = $this->modelSanPham->get3CommentProduct();
        // var_dump($product3);die();
        $category = $this->modelDanhMuc->getAllCategory();
        // var_dump($category);die();
        require_once PATH_VIEW . 'layouts/master.php';
    }

    public function danhSachSanPham()
    {
        // echo "day la trang danh sach san pham";
        $listProduct = $this->modelSanPham->getAllProduct(); //
        // var_dump($listProduct);die();
        require_once './views/listProduct.php';
    }
}
