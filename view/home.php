<main class="container">
    <div class="slide-banner">
        <a href=""><img id="banner" src="assets/img/banner1.png" alt=""></a>
        <button class="pre" onclick="prev()">&#10094;</button>
        <button class="next" onclick="next()">&#10095;</button>
    </div>
    <div class="catalog">
        <div class="text">
            <a href="">DANH MỤC</a>
            <P>SALE KHỦNG GIẢM LÊN TỚI 50% KHI ĐẶT HÀNG TRÊN 2 TRIỆU ĐỒNG</P>
        </div>
        <div class="list-catalog">
            <?php 
                $listCate=list_category();
                foreach ($listCate as $dm) {
                    extract($dm);
                    echo '
                        <div class="product-symbolic">
                            <a href="index.php?act=sanpham&id='.$id.'"><img src="assets/img/'.$img.'" alt=""></a>
                            <a class="name-catalog" href="">'.$name.'</a>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
    <div class="product-wp">
        <h3>GIÀY BÓNG ĐÁ <span>( 100 SẢN PHẨM )</span></h3>
        <div class="product-ins">
        <?php 
        $listGiay = list_giay();
        foreach ($listGiay as $sp){
            // echo '<pre>';
            // var_dump($sp);
        ?>
            <div class="product-item">
                <div class="detail">
                    <a href="" class="detail-img">
                        <img src="assets/img/<?= $sp['img']?>" alt="">
                    </a>
                    <a href="index.php?act=detail&id=<?= $sp[0]?>" class="detail-show">CHI TIẾT</a>
                </div>
                <div class="product-describe">
                    <a href=""><p><?= $sp['name'] ?></p></a>
                    <span class="price-new"><?= number_format($sp['discount'])  ?></span>
                    <span class="price-origin">
                        <del><?=number_format($sp['price'])?></del>
                    </span>
                </div>
                <div class="buy-cart">
                    <form action="index.php?act=addcart" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_variant" value="<?= $sp['id'] ?>">
                        <input type="hidden" name="ten_sp" value="<?= $sp['name'] ?>">
                        <input type="hidden" name="price" value="<?= $sp['discount'] ?>">
                        <input type="hidden" name="imgsp" value="<?= $sp['img'] ?>">
                        <button type="submit" class="addcart-product"><i class="fa-solid fa-cart-plus fa-shake"></i></button>
                    </form>
                    <a href="" class="buy-product"><button>MUA HÀNG</button></a>
                </div>
            </div>
        <?php } ?>
        </div>
        <div class="view-now"><a href="index.php?act=sanpham&id=4">XEM THÊM</a></div>
    </div>
    <div class="product-wp">
        <h3>GĂNG TAY THỦ MÔN <span>( 100 SẢN PHẨM )</span></h3>
        <div class="product-ins">
        <?php 
        $listGang = list_gang();
        foreach ($listGang as $sp){
            extract($sp);
        ?>
                        <div class="product-item">
                <div class="detail">
                    <a href="" class="detail-img">
                        <img src="assets/img/<?= $sp['img']?>" alt="">
                    </a>
                    <a href="index.php?act=detail&id=<?= $sp[0]?>" class="detail-show">CHI TIẾT</a>
                </div>
                <div class="product-describe">
                    <a href=""><p><?= $sp['name'] ?></p></a>
                    <span class="price-new"><?= number_format($sp['discount'])  ?></span>
                    <span class="price-origin">
                        <del><?=number_format($sp['price'])?></del>
                    </span>
                </div>
                <div class="buy-cart">
                    <form action="index.php?act=addcart" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_variant" value="<?= $sp['id'] ?>">
                        <input type="hidden" name="ten_sp" value="<?= $sp['name'] ?>">
                        <input type="hidden" name="price" value="<?= $sp['discount'] ?>">
                        <input type="hidden" name="imgsp" value="<?= $sp['img'] ?>">
                        <button type="submit" class="addcart-product"><i class="fa-solid fa-cart-plus fa-shake"></i></button>
                    </form>
                    <a href="index.php?" class="buy-product"><button>MUA HÀNG</button></a>
                </div>
            </div>
        <?php } ?>
        </div>
        <div class="view-now"><a href="index.php?act=sanpham&id=5">XEM THÊM</a></div>
    </div>
    <div class="product-wp">
        <h3>QUẢ BÓNG ĐÁ <span>( 100 SẢN PHẨM )</span></h3>
        <div class="product-ins">
        <?php 
        $listBall = list_ball();
        foreach ($listBall as $sp){
            extract($sp);
        ?>
            <div class="product-item">
                <div class="detail">
                    <a href="" class="detail-img">
                        <img src="assets/img/<?= $sp['img']?>" alt="">
                    </a>
                    <a href="index.php?act=detail&id=<?= $sp[0]?>" class="detail-show">CHI TIẾT</a>
                </div>
                <div class="product-describe">
                    <a href=""><p><?= $sp['name'] ?></p></a>
                    <span class="price-new"><?= number_format($sp['discount'])  ?></span>
                    <span class="price-origin">
                        <del><?=number_format($sp['price'])?></del>
                    </span>
                </div>
                <div class="buy-cart">
                    <form action="index.php?act=addcart" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_variant" value="<?= $sp['id'] ?>">
                        <input type="hidden" name="ten_sp" value="<?= $sp['name'] ?>">
                        <input type="hidden" name="price" value="<?= $sp['discount'] ?>">
                        <input type="hidden" name="imgsp" value="<?= $sp['img'] ?>">
                        <button type="submit" class="addcart-product"><i class="fa-solid fa-cart-plus fa-shake"></i></button>
                    </form>
                    <a href="" class="buy-product"><button>MUA HÀNG</button></a>
                </div>
            </div>
        <?php } ?>
        </div>
        <div class="view-now"><a href="index.php?act=sanpham&id=7">XEM THÊM</a></div>
    </div>
    <div class="product-wp">
        <h3>ÁO BÓNG ĐÁ <span>( 100 SẢN PHẨM )</span></h3>
        <div class="product-ins">
        <?php 
        $listQuanao = list_quanao();
        foreach ($listQuanao as $sp){
            extract($sp);
        ?>
            <div class="product-item">
                <div class="detail">
                    <a href="" class="detail-img">
                        <img src="assets/img/<?= $sp['img']?>" alt="">
                    </a>
                    <a href="index.php?act=detail&id=<?= $sp[0]?>" class="detail-show">CHI TIẾT</a>
                </div>
                <div class="product-describe">
                    <a href=""><p><?= $sp['name'] ?></p></a>
                    <span class="price-new"><?= number_format($sp['discount'])  ?></span>
                    <span class="price-origin">
                        <del><?=number_format($sp['price'])?></del>
                    </span>
                </div>
                <div class="buy-cart">
                    <form action="index.php?act=addcart" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_variant" value="<?= $sp['id'] ?>">
                        <input type="hidden" name="ten_sp" value="<?= $sp['name'] ?>">
                        <input type="hidden" name="price" value="<?= $sp['discount'] ?>">
                        <input type="hidden" name="imgsp" value="<?= $sp['img'] ?>">
                        <button type="submit" class="addcart-product"><i class="fa-solid fa-cart-plus fa-shake"></i></button>
                    </form>
                    <a href="" class="buy-product"><button>MUA HÀNG</button></a>
                </div>
            </div>
        <?php } ?>
        </div>
        <div class="view-now"><a href="index.php?act=sanpham&id=6">XEM THÊM</a></div>
    </div>
    <div class="policy-wp">
        <div class="policy-item">
            <i class="fa-solid fa-circle-check"></i>
            <div class="policy-des">
                <h4>HÀNG CHÍNH HÃNG 100%</h4>
                <p>2 SPORT cam kết bán hàng chính hãng 100%</p>
            </div>
        </div>
        <div class="policy-item">
            <i class="fa-solid fa-truck-fast"></i>
            <div class="policy-des">
                <h4>GIAO HÀNG SIÊU NHANH</h4>
                <p>Giao hàng nội thành TP.HCM & HN chỉ trong 2h</p>
            </div>
        </div>
        <div class="policy-item">
            <i class="fa-solid fa-rotate"></i>
            <div class="policy-des">
                <h4>ĐỔI TRẢ TRONG 90 NGÀY</h4>
                <p>Đổi trả trong 90 ngày chưa qua sử dụng</p>
            </div>
        </div>
        <div class="policy-item">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <div class="policy-des">
                <h4>BẢO HÀNH TRỌN ĐỜI</h4>
                <p>2 SPORT bảo hành miễn phí keo trọn đời</p>
            </div>
        </div>
    </div>
</main>
    
