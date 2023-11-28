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
        <div class="profile-payment">
            <?php 
                    if (!empty($_SESSION['login']['email']) && !empty($_SESSION['login']['name']) && !empty($_SESSION['login']['phone']) && !empty($_SESSION['login']['address'])) {
                        echo'
                        <form action="" class="form-receive" method="post">                            
                            <h4>Thông tin nhận hàng</h4>
                            <div class="receive-infor">                        
                                <div class="show_infor_order">                       
                                    <label for="">Họ và tên: <span>'.$name.'</span></label><br>
                                    <label for="">Số điện thoại: <span>'.$phone.'</span></label><br>
                                    <label for="">Địa chỉ: <span>'.$address.'</span></label><br>
                                </div>
                                <div class="btn-edit-infor-order">    
                                    <a href="index.php?act=setInfoUser"><i class="fa-solid fa-square-pen"></i></a>
                                </div>
                            </div>
                        </form>
                        ';
                        $sum=0;
                        foreach ($showcart as $cart ) {
                            extract($cart);
                            $thanhtien = $variant_discount * $quantity;
                            $thanhtien_formatted = number_format($thanhtien, 0, '.', ',');
                            $sum += $thanhtien;
                        }
                        if ($payment == "0") {
                            echo '
                                <div class="right_order">
                                    <h4><i class="fa-solid fa-money-bill"></i> TỔNG TIỀN: '.number_format($sum, 0, '.', ',').' VNĐ</h4>
                                    <form class="payment-in" method="POST" target="_top" action="">
                                        <input type="hidden" name="tongtien_order" value="'. $sum .'">
                                        <h5><i class="fa-solid fa-credit-card"></i> HÌNH THỨC THANH TOÁN <a href="index.php?act=setInfoUser"><i class="fa-solid fa-square-pen" style="font-size:15px; color:#BD0000;"></i></a></h5> 
                                        <div class="payout-in">
                                            <select class="select-payment" name="payment_method" disabled id="">
                                                <option value="0" '.($payment == "0" ? "selected" : "").'>💵 Thanh toán bằng tiền mặt</option>
                                                <option value="1" '.($payment == "1" ? "selected" : "").'>🏧 Thanh toán bằng ATM MOMO</option>
                                            </select>
                                            <input type="submit" name="payment" value="ĐẶT HÀNG">
                                        </div>
                                    </form>
                                </div>
                            ';
                        }else {
                            echo'
                                <div class="right_order">
                                    <h4><i class="fa-solid fa-money-bill"></i> TỔNG TIỀN: '.number_format($sum, 0, '.', ',').' VNĐ</h4>
                                    <form class="payment-in" method="POST" target="_top" enctype="application/x-www-form-urlencoded" action="view/payment_atm.php">
                                        <input type="hidden" name="tongtien_order" value="'. $sum .'">
                                        <h5><i class="fa-solid fa-credit-card"></i> HÌNH THỨC THANH TOÁN <a href="index.php?act=setInfoUser"><i class="fa-solid fa-square-pen" style="font-size:15px; color:#BD0000;"></i></a></h5>
                                        <div class="payout-in">
                                            <select class="select-payment" name="payment_method" disabled id="">
                                                <option value="0" '.($payment == "0" ? "selected" : "").'>💵 Thanh toán bằng tiền mặt</option>
                                                <option value="1" '.($payment == "1" ? "selected" : "").'>🏧 Thanh toán bằng ATM MOMO</option>
                                            </select>
                                            <input type="submit" name="payment" value="ĐẶT HÀNG">
                                        </div>
                                    </form>
                                </div>
                            ';                    
                        }
                    }else{
                        echo "<script>
                            alert('Vui lòng thiết lập đầy đủ thông tin !!!');
                            window.location.href = 'index.php?act=setInfoUser';
                        </script>";
                    }
            ?>
        </div>
    </main>
<?php }else{
        echo'<div style="width:100%; text-align:center; padding-top:75px">
            <img src="./assets/img/404.svg" width="50%" alt="">
        </div>
        ';
    }
?>
