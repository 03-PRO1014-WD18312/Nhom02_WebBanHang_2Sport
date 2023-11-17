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
                <tr>
                    <td><input type="checkbox"></td>
                    <td>Lã Văn Sáng</td>
                    <td>Giày Nike 2023</td>
                    <td>Giày rất đẹp !!!</td>
                    <td>17/11/2023</td>
                    <td>
                        <a href="<?= $hard_delete ?>"><input type="button" value="Gỡ" onclick="return confirm('Bạn có chắc muốn xóa?')"></a>
                    </td>
                </tr>
            </table>
            <div class="action">
                <a href="">CHỌN TẤT CẢ</a>
                <a href="">BỎ CHỌN</a>
                <a href="">XÓA CÁC MỤC ĐÃ CHỌN</a>
            </div>
        </div>
    </article>
</main>