<main class="container">
            <?php include "boxleft.php" ?>
            <article>
                <div class="tilte-ds">
                    <h2>DANH SÁCH ĐƠN HÀNG</h2>
                </div>
                <form class="form-search" action="" method="post">
                    <div class="search-wp">
                        <input class="input-search" type="search" placeholder="Bạn cần tìm gì...">
                        <button class="btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>#Mã ĐH</th>
                            <th>NGÀY TẠO</th>
                            <th>KHÁCH HÀNG</th>
                            <th>TÌNH TRẠNG</th>
                            <th>TỔNG TIỀN </th>
                            <th>CHI TIẾT </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($list_order as $order) {
                                $id_order=$order[0];
                                $total=total_money_order($id_order);
                                foreach ($total as $sum) {
                                    extract($sum);
                                }
                                echo'
                                    <tr>
                                        <td>'.$order[0].'</td>
                                        <td>'.$order['date'].'</td>
                                        <td>'.$order['username'].'</td>
                                        <td>
                                        '. ($status == 0 ? 'Đang xử lý' : 'Đã xử lý') .'
                                        </td>
                                        <td>'.number_format($total_price, 0, '.', ',').' VNĐ</td>
                                        <td><a href="index.php?act=show_order_hs&id='.$id.'">Chi tiết</a></td>
                                    </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
            </article>
    </main>