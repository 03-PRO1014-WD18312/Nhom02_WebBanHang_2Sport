<?php 
    if ($_SESSION['login']['role']=='2') {
?>
<main class="container">
            <?php include "boxleft.php" ?>
            <article>
                <div class="tilte-ds">
                    <h2>THỐNG KÊ ĐƠN HÀNG THEO DOANH THU</h2>
                </div>
                <table class="table-tk">
                    <thead>
                        <tr>
                            <th>Tên danh mục</th>
                            <th>Số lượng đặt hàng hoàn thành</th>
                            <th>Doanh thu</th>
                            <th>Lãi 20% / SP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            foreach ($thongke_dt as $dthu) {
                                extract($dthu);
                                // var_dump($dthu);
                                $lai=$tongtien * 20/100;
                                $sum += $lai;
                                ?>
                                    <tr>
                                        <td style="text-align:left; padding-left:15px;"><?=$name;?></td>
                                        <td><?=$soluongdh;?></td>
                                        <td style="text-align:right; padding-right:15px;"><?=number_format($tongtien, 0, '.', ',');?> đ</td>
                                        <td style="text-align:right; padding-right:15px;"><?=number_format($lai, 0, '.', ',');?> đ</td>
                                    </tr>
                                        <?php  }
                
                                ?><tr style="font-weight:600">
                                        <td colspan="4" style="text-align:right;padding:15px 10px;">TỔNG DOANH THU: <span style="color:#DB0000;"><?=number_format($sum, 0, '.', ',');?> VND</span></td>
                                    </tr>
                    </tbody>
                </table>  
                <a target="chart" href="index.php?act=tkdt"><button class="btn-bieudo">XEM BIỂU ĐỒ</button> </a>
                <iframe src="" name="chart" frameborder="0" width="100%" height="520px"></iframe>
            </article>
    </main>
<?php }else {
    header('Location: index.php');
}
?>