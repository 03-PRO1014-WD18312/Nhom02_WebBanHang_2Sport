<?php 
    if ($_SESSION['login']['role']=='2') {
?>
<main class="container">
            <?php include "boxleft.php" ?>
            <article>
                <div class="tilte-ds">
                    <h2>CHI TIẾT ĐƠN HÀNG</h2>
                </div>
                <div class="table-product-wp">
                    <div class="table-product-ins">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sum=0;
                                    foreach ($show_order as $show) {
                                        extract($show);
                                        // echo "<pre>";
                                        // var_dump($show);
                                        $price_formatted = number_format($price, 0, '.', ',');
                                        $thanhtien = $price * $quantity;
                                        $thanhtien_formatted = number_format($thanhtien, 0, '.', ',');
                                        echo'
                                            <tr>
                                                <td>
                                                    <img src="../assets/img/'.$img.'" width="150%" alt="">
                                                    <div>
                                                        <a href="../index.php?act=detail&id='.$idProduct.'"><span style="font-weight:600; color:#DB0000">'.$productName.'</span></a></br>
                                                        <span>Size: '.$size.'</span><br>
                                                        <div style="background-color:'.$color.'; border-radius:50%; width:15px; height:15px; border:1px solid #d9d9d9;"></div>
                                                    </div>
                                                </td>
                                                <td>'.$quantity.'</td>
                                                <td>'.$price_formatted.'đ</td>
                                                <td>'.$thanhtien_formatted.'đ</td>
                                            </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                        <form action="" class="status-update" method="post">
                            <?php 
                            foreach ($list_order as $list) {
                                extract($list);
                            ?>
                            <h4>Trạng thái đơn hàng: 
                                <span>
                                <?php 
                                    if ($status == 0 ) {
                                        echo '<span style="color:#fff; padding:2px 15px; background-color: #DB0000; border-radius:20px;"">Chưa xử lý</span>';
                                    }elseif ($status == 1) {
                                        echo '<span style="color:#fff; padding:2px 15px; background-color: #069A8E; border-radius:20px;">Đã xử lý</span>';
                                    }elseif ($status == 2) {
                                        echo '<span style="color:#fff; padding:2px 15px; background-color: #F2921D; border-radius:20px;">Đang giao hàng</span>';
                                    }else {
                                        echo '<span style="color:#fff; padding:2px 15px; background-color: #153462; border-radius:20px;">Đã giao hàng <i class="fa-solid fa-check" style="font-size:15px;"></i></span>';
                                    }
                                ?>

                            </span></h4>
                            <div class="status-wp">
                                <select name="statusUpdate" id="">
                                    <option value="0"<?php if($status == "0") echo "selected";?>>Đang xử lý</option>
                                    <option value="1"<?php if($status == "1") echo "selected";?>>Đã xử lý</option>
                                    <option value="2"<?php if($status == "2") echo "selected";?>>Đang giao hàng</option>
                                    <option value="3"<?php if($status == "3") echo "selected";?>>Đã giao hàng</option>
                                </select>
                            <?php  } ?>
                                <input type="submit" value="CẬP NHẬT ĐƠN HÀNG" name="update_order"></div>
                        </form>
                        <div class="btn-back">
                            <a href="index.php?act=qldh"><i class="fa-regular fa-circle-left"></i> Trở lại</a>
                        </div>
                    </div>
                    <div class="table-product-right">
                        <h5>THÔNG TIN NGƯỜI MUA</h5>
                        <?php 
                            $sum=0;
                            foreach ($show_order as $show) {
                                extract($show);
                                $price_formatted = number_format($price, 0, '.', ',');
                                $thanhtien = $price * $quantity;
                                $thanhtien_formatted = number_format($thanhtien, 0, '.', ',');
                                $sum += $thanhtien;
                            }
                            echo'
                            <div class="info-user-order">
                                <p>Họ và tên: <span>'.$name.'</span></p>
                                <p>Số điện thoại: <span>'.$phoneNumber.'</span>  </p>
                                <p>Địa chỉ: <span>'.$address.'</span></p>
                            </div>
                            <div class="total-receipt">
                                <h4><i class="fa-solid fa-receipt"></i> Tổng tiền thanh toán: <span>'. number_format($sum, 0, '.', ',').' VND</span></h4>
                            </div>';
                        ?>
                        <div class="payment-cash">
                            <i class="fa-solid fa-credit-card"></i> <span>Phương thức thanh toán</span>
                            <select name="" id="" disabled>
                                <option value="0" <?php if($_SESSION['login']['payment'] == "0") echo "selected";?>>💵 Thanh toán bằng tiền mặt</option>
                                <option value="1" <?php if($_SESSION['login']['payment'] == "1") echo "selected";?>>🏧 Thanh toán bằng ATM MOMO</option>
                            </select>
                        </div>
                    </div>
                </div>
            </article>
</main>
<?php }else {
        header('Location: index.php');
    }
?>