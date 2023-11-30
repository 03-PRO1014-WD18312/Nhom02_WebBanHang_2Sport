<?php
    if (is_array($_SESSION['infor_order'])) {
        extract($_SESSION['infor_order']);
    }
//
    if (is_array($showcart)) {
        extract($showcart);
    }
    if (is_array($_SESSION['login'])) {
        extract($_SESSION['login']);
    }
?>
<?php 
    if (!empty($showcart)) {
    ?>
        <main class="form-order container">
        <h2><i class="fa-solid fa-cart-shopping"></i>THANH TOÁN ĐƠN HÀNG</h2>
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
                                    <td>'.$size.'</td>
                                    <td>'.$price_formatted.'đ</td>
                                    <td>'.$quantity.'</td>
                                    <td>'.$thanhtien_formatted.'đ</td>
                                </tr>
                            ';
                            $i++;
                        }echo'<caption style="caption-side:bottom;text-align:left; color: #A6A6A4; font-style:italic; padding:15px 0px;">Có '.$i.' sản phẩm cần thanh toán</caption>'; 
                ?>
            </table> 
        </div>
        <div>
            <form action="" method="post" class="profile-payment">
            <?php 
                echo'
                <div class="form-receive">                            
                    <h4>Thông tin nhận hàng</h4>
                    <div class="receive-infor">                        
                        <div class="show_infor_order">                       
                        <label for="">Họ và tên</label> <span style="color:#DB0000;">'.$error_name.'</span>
                            <input type="text" name="name_order" placeholder="Nhập họ và tên : " value="'.$name.'"><br>
                            <label for="">Số điện thoại</label> <span style="color:#DB0000;">'.$error_name.'</span>
                            <input type="text" name="phone_order" placeholder="Nhập số điện thoại : " value="'.$phone.'"><br>
                            <label for="">Địa chỉ</label> <span style="color:#DB0000;">'.$error_name.'</span>
                            <textarea name="address_order" id="" cols="30" rows="6" placeholder="Nhập địa chỉ nhận hàng : ">'.$address.'</textarea><br>
                        </div>
                    </div>
                </div>
                ';
                    $sum=0;
                    foreach ($showcart as $cart ) {
                        extract($cart);
                        $thanhtien = $variant_discount * $quantity;
                        $thanhtien_formatted = number_format($thanhtien, 0, '.', ',');
                        $sum += $thanhtien;
                    }
                    echo '
                        <div class="right_order">
                            <h4><i class="fa-solid fa-money-bill"></i> TỔNG TIỀN: '.number_format($sum, 0, '.', ',').' VNĐ</h4>
                            <div class="payment-in">
                                <input type="hidden" name="tongtien_order" value="'. $sum .'">
                                <h5><i class="fa-solid fa-credit-card"></i> HÌNH THỨC THANH TOÁN <a href="index.php?act=setInfoUser"><i class="fa-solid fa-square-pen" style="font-size:15px; color:#BD0000;"></i></a></h5> 
                                <div class="payout-in">
                                    <select class="select-payment" name="payment_method" disabled id="">
                                        <option value="0" '.($payment == "0" ? "selected" : "").'>💵 Thanh toán bằng tiền mặt</option>
                                        <option value="1" '.($payment == "1" ? "selected" : "").'>🏧 Thanh toán bằng ATM MOMO</option>
                                    </select>
                                    <input type="submit" name="payment" value="ĐẶT HÀNG">
                                </div>
                            </div>
                        </div>
                    ';
            ?>
            </form>
        </div>
    </main>
<?php }else{
        echo'<div style="width:100%; text-align:center; padding-top:75px">
            <img src="./assets/img/404.svg" width="50%" alt="">
        </div>
        ';
    }
?>
