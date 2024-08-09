<?php

class AdminDanhMucController
{
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachDanhMuc()
    {

        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }
    public function formAddDanhMuc()
    {
        // hàm này dùng để hiển thị form nhập
        require_once './views/danhmuc/addDanhMuc.php';
        // var_dump('form thêm');
    }
    public function postAddDanhMuc()
    {
        // hàm này dùng để hiển thị form nhập
        // var_dump($_POST);

        // kiểm tra xem dữ liệu có được submit lên ko
        // var_dump('abc');die;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // laays ra du lieu

            $ten_danh_muc = $_POST['ten_danh_muc'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            // tạo mảng chứa dữ liệu

            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            $_SESSION['error'] = $errors;
            // nếu không có lỗi tiến hành thêm danh mục
            if (empty($errors)) {
                // nếu không có lỗi tiến hành thêm danh mục
                // var_dump('OKE');
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                // trả về form và lỗi 
                require_once './views/danhmuc/addDanhMuc.php';
            }
        }
    }
    public function formEditDanhMuc()
    {
        // hàm này dùng để hiển thị form nhập

        // lấy ra thông tin danh mục cần sửa
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            require_once './views/danhmuc/editDanhMuc.php';
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
        // require_once './views/danhmuc/editDanhMuc.php';
    }
    public function postEditDanhMuc()
    {
        // hàm này dùng để hiển thị form nhập

        // kiểm tra xem dữ liệu có được submit lên ko

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // laays ra du lieu

            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // tạo mảng chứa dữ liệu

            
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            // nếu không có lỗi tiến hành thêm danh mục
            if (empty($errors)) {
                // nếu không có lỗi tiến hành thêm danh mục
                $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                // trả về form và lỗi 
                $danhMuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once './views/danhmuc/editDanhMuc.php';
            }
        }
    }
    public function deleteDanhMuc()
    {
        // lấy ra id danh mục cần xóa
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            $this->modelDanhMuc->destroyDanhMuc($id);
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
}
