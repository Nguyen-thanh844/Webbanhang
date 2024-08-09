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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết sản phẩm : <?= $sanPham['ten_san_pham'] ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">E-commerce</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img style="width: 500px; height:500px" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" class="product-image" alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            <!-- <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div> -->
                            <?php foreach ($listAnhSanPham as $key => $anhSP) : ?>
                                <div class="product-image-thumb <?= $anhSP[$key] == 0 ? 'active' : '' ?>"><img src="<?= BASE_URL . $anhSP['link_hinh_anh']; ?>" alt="Product Image"></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">Tên sản phẩm : <?= $sanPham['ten_san_pham'] ?></h3>
                        <hr>
                        <h5 class="mt-3">Giá tiền : <small><?= $sanPham['gia_san_pham'] ?></small></h5>
                        <hr>
                        <h5 class="mt-3">Giá khuyến mãi : <small><?= $sanPham['gia_khuyen_mai'] ?></small></h5>
                        <hr>
                        <h5 class="mt-3">Số lượng : <small><?= $sanPham['so_luong'] ?></small></h5>
                        <hr>
                        <h5 class="mt-3">Lượt xem : <small><?= $sanPham['luot_xem'] ?></small></h5>
                        <hr>
                        <h5 class="mt-3">Ngày nhập : <small><?= $sanPham['ngay_nhap'] ?></small></h5>
                        <hr>
                        <h5 class="mt-3">Danh mục : <small><?= $sanPham['ten_danh_muc'] ?></small></h5>
                        <hr>
                        <h5 class="mt-3">Trạng thái : <small><?= $sanPham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán' ?></small></h5>
                        <hr>
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                    <h2 class="m-4">Bình luận của sản phẩm</h2>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Người bình luận</th>
                                <th>Nội dungdung</th>
                                <th>Ngày bình luận</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listBinhLuan as $key => $binhLuan) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <a target="_blank" href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $binhLuan['tai_khoan_id']; ?>">
                                            <?= $binhLuan['ho_ten'] ?>
                                        </a>
                                    </td>
                                    <td><?= $binhLuan['noi_dung'] ?></td>
                                    <td><?= $binhLuan['ngay_dang'] ?></td>
                                    <td><?= $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Bị ẩn'; ?></td>
                                    <td>
                                        <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="post">
                                            <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">

                                            <input type="hidden" name="name_view" value="detail_san_pham">

                                            
                                            <button onclick="return confirm('Bạn có muốn ẩn bình luận này không?')" class="btn btn-warning">
                                                <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'Bỏ ẩn'; ?>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#binh-luan" role="tab" aria-controls="product-desc" aria-selected="true">Bình luận của sản phẩm</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên người bình luận</th>
                                        <th>Nội dung</th>
                                        <th>Ngày đăng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Trần Đình Cảnh</td>
                                        <td>Sản phẩm hơi đáng yêu nhưng lười ăn</td>
                                        <td>27/07/2024</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#"><button class="btn btn-warning">Ẩn</button></a>
                                                <a href="#"><button class="btn btn-danger">Xóa</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
            </div>

        </div>

    </section>
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
<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>
<!-- Code injected by live-server -->
</body>

</html>