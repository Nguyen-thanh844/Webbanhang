<?php

class AdminDonHangController
{
    public $modelDonHang;

    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }
    public function danhSachDonHang()
    {

        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once './views/donhang/listDonHang.php';
    }
    public function detailDonHang()
    {

        $don_hang_id = $_GET['id_don_hang'];

        // lấy thông tin đơn hàng ở bảng don_hangs

        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        // lấy danh sách sản phẩm đã đặt của giỏ hàng ở bảng chi_tiet_don_hangs

        $sanPhamDonHang = $this->modelDonHang->getListSPDonHang($don_hang_id);

        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        require_once './views/donhang/detailDonHang.php';
    }
    public function formEditDonHang()
    {
        
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
        // require_once './views/danhmuc/editDanhMuc.php';
    }
    public function postEditDonHang()
    {
        // hàm này dùng để hiển thị form nhập

        // kiểm tra xem dữ liệu có được submit lên ko

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // laays ra du lieu
            // lấy ra dữ liệu cũ của sản phẩm

            $don_hang_id = $_POST['don_hang_id'] ?? '';

            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';

            // tạo mảng chứa dữ liệu

            $errors = [];
            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
            }
            if (empty($sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = 'Số điện thoại không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Email người nhận không được để trống';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $errors['so_luong'] = 'Địa chỉ người nhận không được để trống';
            }
            if (empty($trang_thai_id)) {
                $errors['trang_thai_id'] = 'Trạng thái phải chọn';
            }

            $_SESSION['error'] = $errors;
            //  var_dump($errors);die;
            // nếu không có lỗi tiến hành sửa
            if (empty($errors)) {

                // nếu không có lỗi tiến hành thêm sản phẩm
                // var_dump('OKE');
                $this->modelDonHang->updateDonHang(
                    $don_hang_id,
                    $ten_nguoi_nhan,
                    $sdt_nguoi_nhan,
                    $email_nguoi_nhan,
                    $dia_chi_nguoi_nhan,
                    $ghi_chu,
                    $trang_thai_id
                );
                // var_dump($acb);die;
                header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
                exit();
            } else {
                // trả về form và lỗi 
                // require_once './views/sanpham/addSanPham.php';

                // đặt chỉ thị xóa session sau khi xóa form

                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }
    // Sửa album ảnh
    // - sửa ảnh cũ
    // -- + thêm ảnh mới
    // -- + không thêm ảnh mới
    // - không sửa ảnh cũ
    // -- + thêm ảnh mới
    // -- + không thêm ảnh mới
    // - xóa ảnh cũ
    // -- + thêm ảnh mới
    // -- + không thêm ảnh mới

    // public function postEditAnhSanPham()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $san_pham_id = $_POST['san_pham_id'] ?? '';
    //         // lấy danh sách ảnh hiện tại của sản phẩm

    //         $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);

    //         // xử lý các ảnh được gửi từ form

    //         $img_array = $_FILES['img_array'];
    //         $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];

    //         $current_img_ids = $_POST['current_img_ids' ?? []];

    //         // khai báo mảng để lưu ảnh mới thêm hoặc thay thế ảnh cũ

    //         $upload_file = [];

    //         // upload ảnh mới hoặc thay thế ảnh cữ 

    //         foreach ($img_array['name'] as $key => $value) {
    //             if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
    //                 $new_file = uploadFileAlbum($img_array, './uploads/', $key);
    //                 if ($new_file) {
    //                     $upload_file[] = [
    //                         'id' => $current_img_ids[$key] ?? null,
    //                         'file' => $new_file
    //                     ];
    //                 }
    //             }
    //         }

    //         // lưu ảnh mới vào db và xóa ảnh cũ

    //         foreach ($upload_file as $file_info) {
    //             if ($file_info['id']) {
    //                 $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];


    //                 // cập nhật ảnh cũ 

    //                 $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

    //                 // xóa ảnh cũ 

    //                 deleteFile($old_file);
    //             } else {
    //                 // thêm ảnh mới

    //                 $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
    //             }
    //         }

    //         // xử lý xóa ảnh

    //         foreach ($listAnhSanPhamCurrent as $anhSP) {
    //             $anh_id = $anhSP['id'];
    //             if (in_array($anh_id, $img_delete)) {
    //                 // xóa ảnh trong db

    //                 $this->modelSanPham->destroyAnhSanPham($anh_id);

    //                 // xóa fiel

    //                 deleteFile($anhSP['link_hinh_anh']);
    //             }
    //         }
    //         header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_phan=' . $san_pham_id);
    //         exit();
    //     }
    // }
    // public function deleteSanPham()
    // {
    //     $id = $_GET['id_san_pham'];
    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);

    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

    //     if ($sanPham) {
    //         deleteFile($sanPham['hinh_anh']);
    //         $this->modelSanPham->destroySanPham($id);
    //     }
    //     if ($listAnhSanPham) {
    //         foreach ($listAnhSanPham as $key => $anhSP) {
    //             deleteFile($anhSP['link_hinh_anh']);
    //             $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
    //         }
    //     }
    //     header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
    //     exit();
    // }

    // public function detailSanPham()
    // {

    //     $id = $_GET['id_san_pham'];

    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);
    //     // var_dump($sanPham);die;
    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    //     // var_dump($listAnhSanPham);die;
    //     if ($sanPham) {
    //         require_once './views/sanpham/showSanPham.php';
    //     } else {
    //         header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
    //         exit();
    //     }
    // }
}
