
<main class="container history-order">
    <h2>LỊCH SỬ MUA HÀNG</h2>
    <div>
        <!-- <div>
            hello
        </div> -->
        <table>
            <thead>
                <tr>
                    <th>#Mã đơn hàng</th>
                    <th>Ngày mua</th>
                    <th>Tổng tiền</th>
                    <th>Tình trạng</th>
                    <th>Nhận xét</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($history_order as $order) {
                        extract($order);
                        foreach ($total as $sum) {
                            extract($sum);
                        }
                        echo'
                            <tr>
                                <td>'.$id.'</td>
                                <td>'.$date.'</td>
                                <td>'.number_format($total_price, 0, '.', ',').' VNĐ</td>
                                <td>
                                '. ($role == 0 ? 'Đang xử lý' : 'Đã xử lý') .'
                                </td>
                                <td>'.$rate.'</td>
                                <td><a href="index.php?act=show_order_hs&id='.$id.'">Chi tiết</a></td>
                            </tr>
                        ';
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>