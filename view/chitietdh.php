
<main class="container history-order">
    <h2>LỊCH SỬ MUA HÀNG</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th>#STT</th>
                    <th>Tên sản phẩm</th>
                    <th colspan="2">Color / Size</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Đánh giá</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stt=1;
                    foreach ($info_order as $order_status) {
                        extract($order_status);
                        // echo '<pre>';
                        // var_dump($order_status);
                    }
                    $sum=0;
                    foreach ($show_order as $show) {
                        extract($show);
                        $price_formatted = number_format($price, 0, '.', ',');
                        $thanhtien = $price * $quantity;
                        $thanhtien_formatted = number_format($thanhtien, 0, '.', ',');
                        $sum+=$thanhtien;
                        ?>
                            <tr>
                                <td><?=$stt++ ?></td>
                                <td><?=$productName?></td>
                                <td><span style="background-color: <?=$color?>; padding: 5px 15px; border:1px solid #d9d9d9; border-radius:50%;"></span></td>
                                <td><?=$size?></td>
                                <td><?=$price_formatted?>đ</td>
                                <td><?=$quantity?></td>
                                <td><?=$thanhtien_formatted?>đ</td>
                                <td><?php 
                                    if ($status=='3') {
                                        echo'<a style="background-color: #DB0000; padding:7px 15px;text-decoration: none; color:#fff; border-radius:5px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" href="index.php?act=rate&id='.$id.'&idproduct='.$idProduct.'" target="rate">ĐÁNH GIÁ 🌟</a>';
                                    }
                                ?></td>
                            </tr>
                    <?php  }
                    ?><tr style="font-weight:600">
                        <td colspan="7" style="text-align:right;padding:15px 10px;">TỔNG TIỀN: <span style="color:#DB0000;"><?=number_format($sum, 0, '.', ',');?> VND</span></td>
                    </tr>
            </tbody>
        </table>
        <iframe src="" name="rate" frameborder="0" height="500px"></iframe>
    </div>
</main>