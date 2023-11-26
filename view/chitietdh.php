
<main class="container history-order">
    <h2>LỊCH SỬ MUA HÀNG</h2>
    <div>
        <!-- <div>
            hello
        </div> -->
        <table>
            <thead>
                <tr>
                    <th>#STT</th>
                    <th>Tên sản phẩm</th>
                    <th colspan="2">Color / Size</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stt=1;
                    foreach ($show_order as $show) {
                        extract($show);
                        // var_dump($show);
                        $price_formatted = number_format($price, 0, '.', ',');
                        $thanhtien = $price * $quantity;
                        $thanhtien_formatted = number_format($thanhtien, 0, '.', ',');
                        echo '
                            <tr>
                                <td>'.$stt++.'</td>
                                <td>'.$productName.'</td>
                                <td><span style="background-color: '.$color.'; padding: 5px 15px; border:1px solid #d9d9d9; border-radius:50%;"></span></td>
                                <td>'.$size.'</td>
                                <td>'.$price_formatted.'đ</td>
                                <td>'.$quantity.'</td>
                                <td>'.$thanhtien_formatted.'đ</td>
                            </tr>
                        ';
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>