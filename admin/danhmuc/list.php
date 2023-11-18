<main class="container">
    <?php include "boxleft.php" ?>
    <article>
        <div class="list-product">
            <h1>DANH SÁCH DANH MỤC</h1>
            <form action="">
                <input type="text" placeholder="Tìm tên sản phẩm">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <table>
                <tr>
                    <th></th>
                    <th>Mã danh mục</th>
                    <th>Tên danh mục</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>1</td>
                    <td>Ball 2023</td>
                    <td><img src="../assets/images/logo-web.svg" alt=""></td>
                    <td>
                        <a href="<?= $suasp ?>"><input type="button" value="Sửa"></a>   
                        <a href="<?= $hard_delete ?>"><input type="button" value="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')"></a>
                    </td>
                </tr>
            </table>
            <div class="action">
                <a href="">THÊM DANH MỤC</a>
                <a href="">CHỌN TẤT CẢ</a>
                <a href="">BỎ CHỌN</a>
                <a href="">XÓA CÁC MỤC ĐÃ CHỌN</a>
            </div>
        </div>
    </article>
</main>