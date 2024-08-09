<?php


class ProductDetail
{
    public $modelSanPhamDetail;

    public function __construct()
    {
        $this->modelSanPhamDetail = new Detail();
       
    }

    public function productDetail($id)
    {
        $view = 'details';
        $product = $this->modelSanPhamDetail->getbyIDProductDetails($id);
        $productall = $this->modelSanPhamDetail->getAllProduct();
        require_once PATH_VIEW . 'layouts/master.php';
    }
}
