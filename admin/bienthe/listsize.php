<main class="container">
    <?php include "boxleft.php" ?>
    <article>
        <div class="list-product">
            <h1>DANH SÁCH SIZE</h1>
            <form action="">
                <input type="text" placeholder="Tìm tên sản phẩm">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <table>
                <tr>
                    <th></th>
                    <th>Mã size</th>
                    <th>Size</th>
                    <th>Sản phẩm</th>
                    <th>Giá gốc</th>
                    <th>Giá giảm</th>
                    <th>Hành động</th>
                </tr>
                
                <?php foreach($listSize as $row){
                    extract($row);
                    $sualoai = "index.php?act=suadm&id=$id";
                    $xoaloai = "index.php?act=deletedm&id=$id";
                ?>  
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= $id ?></td>
                        <td><?= $size ?></td>
                        <td><?= $name ?></td>
                        <td><?= $price ?></td>
                        <td><?= $discount ?></td>
                        <td>
                            <a href="<?= $sualoai ?>"><input type="button" value="Sửa"></a>   
                            <a href="<?= $xoaloai ?>"><input type="button" value="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')"></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <div class="action">
                <a href="index.php?act=adddm">THÊM DANH MỤC</a>
                <a href="">CHỌN TẤT CẢ</a>
                <a href="">BỎ CHỌN</a>
                <a href="">XÓA CÁC MỤC ĐÃ CHỌN</a>
            </div>
        </div>
    </article>
</main>