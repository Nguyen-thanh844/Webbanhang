<?php require_once PATH_VIEW . "components/Hero-section.php"; ?>

<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php foreach ($category as $key => $danhMuc) : ?>
                    <tr>

                        <div class="col-lg-3">
                            <div class="categories__item set-bg">
                                <img src="<?= $danhMuc['hinh_anh'] ?>" alt="">
                                <h5><a href="#"><?= $danhMuc['ten_danh_muc'] ?></a></h5>
                            </div>
                        </div>
                    </tr>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php foreach ($product as $value) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg">
                            <a href="<?= BASE_URL ?>?act=product-detail&id=<?= $value['id'] ?>">
                                <img src="<?= $value['hinh_anh'] ?>" alt="">
                            </a>
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-eye"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="<?= BASE_URL ?>?act=product-detail&id=<?= $value['id'] ?>"><?= $value['ten_san_pham'] ?></a></h6>
                            <h5>$<?= $value['gia_san_pham'] ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Sản phẩm mới nhất</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($product3 as $value) : ?>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?= $value['hinh_anh'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?= $value['ten_san_pham'] ?></h6>
                                        <span><?= $value['gia_san_pham'] ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($product3 as $value) : ?>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?= $value['hinh_anh'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?= $value['ten_san_pham'] ?></h6>
                                        <span><?= $value['gia_san_pham'] ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Sản phẩm hàng đầu</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($product3view as $value) : ?>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?= $value['hinh_anh'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?= $value['ten_san_pham'] ?></h6>
                                        <span><?= $value['gia_san_pham'] ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($product3view as $value) : ?>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?= $value['hinh_anh'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?= $value['ten_san_pham'] ?></h6>
                                        <span><?= $value['gia_san_pham'] ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Đánh giá sản phẩm</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($product3commnet as $value) : ?>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?= $value['hinh_anh'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?= $value['ten_san_pham'] ?></h6>
                                        <span><?= $value['gia_san_pham'] ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                            <!-- <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="public/assets/client/img/balo/2.png" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="public/assets/client/img/balo/3.png" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a> -->
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($product3commnet as $value) : ?>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?= $value['hinh_anh'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?= $value['ten_san_pham'] ?></h6>
                                        <span><?= $value['gia_san_pham'] ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->
</ul>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Blog Section End -->