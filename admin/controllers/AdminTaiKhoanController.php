<?php

class AdminTaiKhoanController
{
    public $modelTaiKhoan;
    public $modelDonHang;
    public $modelSanPham;



    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelDonHang = new AdminDonHang();
        $this->modelSanPham = new AdminSanPham();
    }
    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1); //
        require_once './views/taikhoan/quantri/listQuanTri.php';
        // var_dump($listQuanTri);die;
    }
    public function formAddQuanTri()
    {
        require_once './views/taikhoan/quantri/AddQuanTri.php';

        deleteSessionError();
    }
    public function postAddQuanTri()
    {
        // hàm này dùng để hiển thị form nhập

        // kiểm tra xem dữ liệu có được submit lên ko
        // var_dump('abc');die;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // laays ra du lieu

            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];

            // tạo mảng chứa dữ liệu

            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            $_SESSION['error'] = $errors;
            // nếu không có lỗi tiến hành thêm tài khoản
            if (empty($errors)) {
                // nếu không có lỗi tiến hành thêm tài khoản
                // đặt password mặc định

                $password = password_hash('123@123', PASSWORD_BCRYPT); // password_hash dểd mã hóa
                // var_dump($password);die;
                // khai báo chưcs vụ

                $chuc_vu_id = 1;
                // var_dump($chuc_vu_id);die;
                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);
                // $this->modelTaiKhoan->inserTaiKoan($ten_danh_muc, $mo_ta);
                // var_dump($abc);die;
                header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                // trả về form và lỗi 
                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=form-them-quan-tri');
                exit();
            }
        }
    }
    public function formEditQuanTri()
    {
        $id_quan_tri = $_GET['id_quan_tri'];
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        // var_dump($quanTri);die;
        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
    }
    public function postEditQuanTri()
    {
        // hàm này dùng để hiển thị form nhập

        // kiểm tra xem dữ liệu có được submit lên ko

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // laays ra du lieu
            // lấy ra dữ liệu cũ của sản phẩm

            $quan_tri_id = $_POST['quan_tri_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            // tạo mảng chứa dữ liệu

            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái vui lòng phải chọn';
            }

            $_SESSION['error'] = $errors;
            //  var_dump($errors);die;
            // nếu không có lỗi tiến hành sửa
            if (empty($errors)) {

                // nếu không có lỗi tiến hành thêm sản phẩm
                // var_dump('OKE');
                $this->modelTaiKhoan->updateTaiKhoan(
                    $quan_tri_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $trang_thai,
                );

                // var_dump($abc);die;
                header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                // trả về form và lỗi 
                // require_once './views/sanpham/addSanPham.php';

                // đặt chỉ thị xóa session sau khi xóa form

                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
    }
    public function resetPassword()
    {
        $tai_khoan_id = $_GET['id_quan_tri'];


        $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
        $password = password_hash('123@123', PASSWORD_BCRYPT); // password_hash dểd mã hóa

        $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);
        // var_dump($status);die;
        if ($status && $tai_khoan['chuc_vu_id'] == 1) {
            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        } elseif ($status && $tai_khoan['chuc_vu_id'] == 2) {
            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();
        } else {
            var_dump('Lỗi khi reset tài khoản');
            die;
        }
    }
    public function danhSachKhachHang()
    {
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);

        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }

    // form sửa khách hàng
    public function formEditKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        // var_dump($quanTri);die;
        require_once './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();
    }
    // sửa khách hàng
    public function postEditKhachHang()
    {
        // hàm này dùng để hiển thị form nhập

        // kiểm tra xem dữ liệu có được submit lên ko

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // laays ra du lieu
            // lấy ra dữ liệu cũ của sản phẩm

            $khach_hang_id = $_POST['khach_hang_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            // tạo mảng chứa dữ liệu

            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
            }
            if (empty($gioi_tinh)) {
                $errors['email'] = 'Giới tính không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái vui lòng phải chọn';
            }

            $_SESSION['error'] = $errors;
            //  var_dump($errors);die;
            // nếu không có lỗi tiến hành sửa
            if (empty($errors)) {

                // nếu không có lỗi tiến hành thêm sản phẩm
                // var_dump('OKE');
                $this->modelTaiKhoan->updateKhachHang(
                    $khach_hang_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $ngay_sinh,
                    $gioi_tinh,
                    $dia_chi,
                    $trang_thai,
                );

                // var_dump($abc);die;
                header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                exit();
            } else {
                // trả về form và lỗi 
                // require_once './views/sanpham/addSanPham.php';

                // đặt chỉ thị xóa session sau khi xóa form

                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }
    public function detailtKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        $listDonHang = $this->modelDonHang->getDonHangFormKhachHang($id_khach_hang);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFormKhachHang($id_khach_hang);
        require_once './views/taikhoan/khachhang/detailKhachHang.php';
    }
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay email vaf password gui len tu form
            $email = $_POST['email'];
            $password = $_POST['password'];
            // var_dump($password);die;


            // xu ly kiem tra dang nhap

            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if ($user == $email) { // truongwf hợp đăng nhập thành công
                // Lưu thông tin vào session

                $_SESSION['user_admin'] = $user;
                header("Location: " . BASE_URL_ADMIN);
                exit();
            } else {
                // lỗi thì lưu vao session

                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);
                // die;
                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
                exit();
            }
        }
    }
    public function logout(){
        if(isset($_SESSION['user_admin'])){
            unset($_SESSION['user_admin']);
            header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
        }
    }
    // public function formEditCaNhanQuanTri(){
    //     require_once('./views/taikhoan/canhan/editCaNhan.php');
    //     deleteSessionError();
    // }
}
