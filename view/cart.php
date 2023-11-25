<main class="form-cart container">
    <h1><i class="fa-solid fa-bag-shopping"></i>GIỎ HÀNG</h1>
    <div class="cart-detail">
        <table>
            <tr>
                <th>#STT</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th colspan="2">Color / Size</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
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
                            <td><span style="background-color: '.$color.'; padding: 10px 20px; border:1px solid #d9d9d9; border-radius:50%;"></span></td>
                            <td>'.$size1.'</td>
                            <td>'.$price_formatted.'đ</td>
                            <td><input type="number" min="1" name="" value="'.$quantity.'" id=""></td>
                            <td>'.$thanhtien_formatted.'đ</td>
                            <td><a href="index.php?act=deletecart&id='.$cart_id.'" onclick="return xoacart()"><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>
                    ';
                    $i++;
                }
                    echo'<caption style="caption-side:bottom;text-align:left; color: #A6A6A4; font-style:italic; padding:15px 0px;">Có '.$i.' sản phẩm trong giỏ hàng</caption>';
                    echo'<caption class="total" style="caption-side:bottom;text-align:right; padding:0px 30px 50px 0px;"><i class="fa-solid fa-file-invoice-dollar"></i>Tổng: '. number_format($sum, 0, '.', ',').' VND</caption>
                ';
            ?>
            <script>
                function xoacart() {
                    return confirm("Bạn có muốn xoá khỏi giỏ hàng không?");
                }
            </script>
        </table>
        <div class="submit-cart">
            <a href="index.php" class="shopping">Tiếp tục mua hàng</a>
            <a href="index.php?act=order" class="order">Mua hàng</a>
            <!-- <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
            action="view/payment_atm.php">
            <input type="submit" name="momo" value="Thanh toán momo">
            </form> -->
        </div>
    </div>
</main>