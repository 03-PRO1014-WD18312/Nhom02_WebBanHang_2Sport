<main class="form-cart container">
    <h1><i class="fa-solid fa-cart-shopping"></i>THANH TOÁN ĐƠN HÀNG</h1>
    <div class="order-wp">
        <div class="order-left">
            <?php 
                foreach ($showcart as $oder) {
                    extract($oder);                
                    $price_formatted = number_format($price, 0, '.', ',');
                    $thanhtien = $price * $quantity;
                    $thanhtien_formatted = number_format($thanhtien, 0, '.', ',');
                    $sum += $thanhtien;
                    echo '
                        <div class="product-show">
                            <img src="assets/img/'.$img.'" alt="">
                            <div class="profile-sp">
                                <h5>Tên sản phẩm: '.$name.'</h5>
                                <div class="variant-text">                                
                                    <span>Số lượng: '.$quantity.'</span>
                                    <p>Giá: '.$price_formatted.'đ</p>
                                    <span>Color: <span style="background-color: '.$color.'; padding: 5px 8px; border:1px solid #d9d9d9; border-radius:50%;"></span></span></br>
                                    <span>Size:'.$size.'</span>
                                </div>
                            </div>
                        </div>
                    ';
                }
                echo'
                <div class="order-right">
                    <h4>TỔNG TIỀN : '. number_format($sum, 0, '.', ',').' VND</h4>
                </div>
                ';
            ?>
        </div>
        <form action="" class="form-receive" method="post">
            <h4>Thông tin nhận hàng</h4>
            <label for="">Họ và tên</label><br>
            <input type="text" placeholder="Nhập họ và tên: Lê Đình An" ><br>
            <label for="">Số điện thoại</label><br>
            <input type="tel" placeholder="Nhập SĐT:"><br>
            <label for="">Email</label><br>
            <input type="email" placeholder="Nhập email: "><br>
            <label for="">Địa chỉ</label><br>
            <textarea placeholder="Nhập địa chỉ nhận hàng" name="" id="" cols="30" rows="8"></textarea>
        </form>
        
    </div>

    <div class="submit-cart">
        <a href="index.php" class="shopping">Tiếp tục mua hàng</a>
        <a href="index.php?act=payout" class="order">Đặt hàng</a>
    </div>
</main>