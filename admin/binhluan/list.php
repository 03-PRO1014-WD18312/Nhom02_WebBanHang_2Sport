<main class="container">
    <?php include "boxleft.php" ?>
    <article>
        <div class="list-product">
            <h1>DANH SÁCH BÌNH LUẬN</h1>
            <table>
                <tr>
                    <th></th>
                    <th>Người bình luận</th>
                    <th>Sản phẩm</th>
                    <th>Nội dung</th>
                    <th>Ngày bình luận</th>
                    <th>Hành động</th>
                </tr>
                <?php foreach($binhluan as $row){
                    extract($row);
                    $delete = "index.php?act=deletebl&id=$id";
                ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><?= $username ?></td>
                    <td><?= $name ?></td>
                    <td><?= $text ?></td>
                    <td><?= $date ?></td>
                    <td>
                        <a onclick="return confirm('Bạn có chắc muốn xóa bình luận này');" href="<?=$delete?>"><input type="button" value="Xóa"></a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <div class="action">
                <a href="">CHỌN TẤT CẢ</a>
                <a href="">BỎ CHỌN</a>
                <a href="">XÓA CÁC MỤC ĐÃ CHỌN</a>
            </div>
        </div>
    </article>
</main>