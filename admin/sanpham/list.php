<main class="container">
    <?php include "boxleft.php" ?>
    <article>
        <div class="list-product">
            <h1>DANH SÁCH SẢN PHẨM</h1>
            <form action="">
                <input type="text" placeholder="Tìm tên sản phẩm">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <table>
                <tr>
                    <th></th>
                    <th>Mã sản phẩm</th>
                    <th>Mã danh mục</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                <?php foreach($listProduct as $row){
                    extract($row);
                    $suasp = "index.php?act=suasp&id=$id";
                    $xoasp = "index.php?act=deletesp&id=$id";
                ?>  
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= $id ?></td>
                        <td><?= $idCategory ?></td>
                        <td><?= $name ?></td>
                        <td><img src="../assets/img/<?= $img ?>" alt=""></td>
                        <td><?=$status == 1 ? 'Hiển thị' : 'Ẩn'?></td>
                        <td>
                            <a href="<?= $suasp ?>"><input type="button" value="Sửa"></a>   
                            <a href="<?= $xoasp ?>"><input type="button" value="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')"></a>
                        </td>
                    </tr>
                <?php } ?>
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