<!-- Header -->
<?php require './views/layout/header.php'; ?>
<!-- end Header -->
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/slidebar.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Chi tiết đơn hàng - Đơn hàng : <?= $donHang['ma_don_hang'] ?></h1>
                </div>
                <div class="col-sm-2">
                    <form action="" method="post" class="form-group">
                        <select name="" id="">
                            <?php foreach ($listTrangThaiDonHang as $key => $trangThai) :  ?>
                                <option 
                                    <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                                    <?= $trangThai['id'] < $donHang['trang_thai_id'] ? 'disabled' : '' ?>
                                     value="<?= $trangThai['id']; ?>">
                                    <?= $trangThai['ten_trang_thai']; ?>
                                </option>
                            <?php endforeach;  ?>
                        </select>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Nội dung của bảng -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php
                    if ($donHang['trang_thai_id'] == 1) {
                        $colorAlerts = 'primary';
                    } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                        $colorAlerts = 'warning';
                    } elseif ($donHang['trang_thai_id'] == 10) {
                        $colorAlerts = 'success';
                    } else {
                        $colorAlerts = 'danger';
                    }
                    ?>
                    <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                        Đơn hàng : <?= $donHang['ten_trang_thai'] ?>
                    </div>

                    <div class="invoice p-3 mb-3">

                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Shop Balo CanhTD.
                                    <small class="float-right">Ngày đặt : <?= formatDate($donHang['ngay_dat']) ?></small>
                                </h4>
                            </div>

                        </div>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Thông tin người đặt
                                <address>
                                    <strong><?= $donHang['ho_ten'] ?></strong><br>
                                    Email : <?= $donHang['email'] ?><br>
                                    Số điện thoại : <?= $donHang['so_dien_thoai'] ?><br>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                Thông tin người nhận
                                <address>
                                    <strong><?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                                    Email : <?= $donHang['email_nguoi_nhan'] ?><br>
                                    Số điện thoại : <?= $donHang['sdt_nguoi_nhan'] ?><br>
                                    Địa chỉ : <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>Mã đơn hàng : </strong><?= $donHang['ma_don_hang'] ?><br>
                                    <strong>Tổng tiền : </strong><?= $donHang['tong_tien'] ?><br>
                                    <strong>Ghi chú : </strong><?= $donHang['ghi_chu'] ?><br>
                                    <strong>Thanh toán : </strong><?= $donHang['ten_phuong_thuc'] ?><br>
                                </address>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tong_tien = 0; ?>
                                        <?php foreach ($sanPhamDonHang as $key => $sanPham) : ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $sanPham['ten_san_pham'] ?></td>
                                                <td><?= $sanPham['don_gia'] ?></td>
                                                <td><?= $sanPham['so_luong'] ?></td>
                                                <td><?= $sanPham['thanh_tien'] ?></td>
                                            </tr>
                                            <?php $tong_tien += $sanPham['thanh_tien'] ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Ngày đặt hàng: <?= formatDate($donHang['ngay_dat']) ?></p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Thành tiền :</th>
                                            <td><?= $tong_tien ?></td>
                                        </tr>
                                        <tr>
                                            <th>Vận chuyển:</th>
                                            <td>100000</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền :</th>
                                            <td><?= $tong_tien + 100000 ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Footer -->
<?php include './views/layout/footer.php'; ?>
<!-- End Footer -->
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<!-- Code injected by live-server -->
</body>

</html>