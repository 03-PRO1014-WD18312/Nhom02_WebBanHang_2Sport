<main class="form-cart container">
    <h1><i class="fa-solid fa-cart-shopping"></i>THANH TOÁN ĐƠN HÀNG</h1>
    <div class="order-wp">
        <table>
            <tr>
                <th>#STT</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th colspan="2">Color / Size</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            <?php 
                $i=0;
                $stt=1;
                $sum = 0;
                foreach ($showcart as $cart) {
                    // var_dump($cart);
                    extract($cart);
                    $price_formatted = number_format($variant_discount, 0, '.', ',');
                    $thanhtien = $variant_discount * $quantity;
                    $thanhtien_formatted = number_format($thanhtien, 0, '.', ',');
                    $sum += $thanhtien;
                    echo '
                        <tr>
                            <td>'.$stt++.'</td>
                            <td><img src="assets/img/'.$product_img.'" width="50px" alt=""></td>
                            <td>'.$product_name.'</td>
                            <td><span style="background-color: '.$color.'; padding: 5px 15px; border:1px solid #d9d9d9; border-radius:50%;"></span></td>
                            <td>'.$size1.'</td>
                            <td>'.$price_formatted.'đ</td>
                            <td>'.$quantity.'</td>
                            <td>'.$thanhtien_formatted.'đ</td>
                        </tr>
                    ';
                    $i++;
                }
                    echo'<caption style="caption-side:bottom;text-align:left; color: #A6A6A4; font-style:italic; padding:15px 0px;">Có '.$i.' sản phẩm cần thanh toán</caption>';
                //     echo'<caption class="total" style="caption-side:bottom;text-align:right; padding:30px 30px 50px 0px;"><i class="fa-solid fa-file-invoice-dollar"></i>Tổng: '. number_format($sum, 0, '.', ',').' VND</caption>
                // ';
            ?>
        </table>
        
    </div>
    <!-- <form action="" class="form-receive" method="post">
            <h4>Thông tin nhận hàng</h4>
            <label for="">Họ và tên</label><br>
            <input type="text" placeholder="Nhập họ và tên: Lê Đình An" ><br>
            <label for="">Số điện thoại</label><br>
            <input type="tel" placeholder="Nhập SĐT:"><br>
            <label for="">Email</label><br>
            <input type="email" placeholder="Nhập email: "><br>
            <label for="">Địa chỉ</label><br>
            <textarea placeholder="Nhập địa chỉ nhận hàng" name="" id="" cols="30" rows="8"></textarea>
        </form> -->

    <!-- <div class="submit-cart">
        <a href="index.php" class="shopping">Tiếp tục mua hàng</a>
        <a href="index.php?act=payout" class="order">Đặt hàng</a>
    </div> -->
    <div class="profile-payment">
        <?php 
            if (isset($_SESSION['infor_order']) && !empty($_SESSION['infor_order'])) {
                foreach ($_SESSION['infor_order'] as $check) {
                    extract($check);
                    echo '
                    <form action="" class="form-receive" method="post">                            
                        <h4>Thông tin nhận hàng</h4>
                        <div class="receive-infor">                        
                            <div class="show_infor_order">                       
                                <label for="">Họ và tên: <span>'.$name.'</span></label><br>
                                <label for="">Số điện thoại: <span>'.$phoneNumber.'</span></label><br>
                                <label for="">Địa chỉ: <span>'.$address.'</span></label><br>
                            </div>
                            <div class="btn-edit-infor-order">    
                                <i class="fa-solid fa-square-pen"></i>                   
                            </div>
                        </div>

                    </form>
                    ';
                }
            } else {
                echo '
                <form action="" class="form-receive" method="post">
                    <h4>Thông tin nhận hàng</h4>
                    <label for="">Họ và tên</label><br>
                    <input type="text" name="name_tt" placeholder="Nhập họ và tên: Lê Đình An" ><br>
                    <label for="">Số điện thoại</label><br>
                    <input type="tel" name="phone_tt" placeholder="Nhập SĐT:"><br>
                    <label for="">Địa chỉ</label><br>
                    <textarea placeholder="Nhập địa chỉ nhận hàng" name="address_tt" id="" cols="30" rows="8"></textarea>
                    <label for="">💳 Cài đặt phương thức thanh toán</label><br>
                    <select class="select-payment" name="payment_method" id="">
                        <option value="TIỀN MẶT" selected>💵 Thanh toán bằng tiền mặt </option>
                        <option value="ATM">🏧 Thanh toán bằng ATM MOMO </option>
                    </select>
                    <input type="submit" name="tt_nhanhang" value="CẬP NHẬT">
                </form>
                ';
            }
        ?>
        <?php 
            $sum = 0;
            if (isset($_SESSION['infor_order']) && !empty($_SESSION['infor_order'])) {
                foreach ($showcart as $cart ) {
                    extract($cart);
                    $thanhtien = $variant_discount * $quantity;
                    $thanhtien_formatted = number_format($thanhtien, 0, '.', ',');
                    $sum += $thanhtien;
                }
                echo'
                    <div class="right_order">
                        <h4><i class="fa-solid fa-money-bill"></i> TỔNG TIỀN: '.number_format($sum, 0, '.', ',').' VNĐ</h4>
                        <form class="payment-in" method="POST" target="_top" enctype="application/x-www-form-urlencoded" action="">
                            <input type="hidden" name="tongtien_order" value="'. $sum .'">
                            <h5>HÌNH THỨC THANH TOÁN</h5>
                            <div class="payout-in">
                                <select class="select-payment" name="payment_method" id="">
                                    <option value="0" selected>💵 Thanh toán bằng tiền mặt </option>
                                    <option value="1">🏧 Thanh toán bằng ATM MOMO </option>
                                </select>
                                <input type="submit" name="payment" value="ĐẶT HÀNG">
                            </div>
                        </form>
                    </div>
                ';
            }else {
                echo'
                    <div class="right_order">
                        <img src="assets/img/img-payment.svg" alt="">
                    </div>
                    
                ';
            }
        ?>
    </div>
</main>