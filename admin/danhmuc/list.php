<main class="container">
    <?php include "boxleft.php" ?>
    <article>
        <div class="list-product">
            <h1>DANH SÁCH DANH MỤC</h1>
            <form action="" class="formSearch">
                <input type="text" placeholder="Tìm tên danh mục">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <table>
                <tr>
                    <th>Mã danh mục</th>
                    <th>Tên danh mục</th>
                    <th>Ảnh</th>
                    <?php if($_SESSION['login']['role'] == 2){ ?>
                    <th>Hành động</th>
                    <?php } ?>
                </tr>
                
                <?php foreach($listCate as $row){
                    extract($row);
                    $sualoai = "index.php?act=suadm&id=$id";
                    $xoaloai = "index.php?act=deletedm&id=$id";
                    $canDelete = !check_category($id);
                ?>  
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= $name ?></td>
                        <td><img src="../assets/img/<?= $img ?>" alt=""></td>
                        <?php if($_SESSION['login']['role'] == 2){ ?>
                            <td>
                                <a href="<?= $sualoai ?>"><input type="button" value="Sửa"></a>   
                                <?php if ($canDelete): ?>
                                    <a href="<?= $xoaloai ?>"><input type="button" value="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')"></a>
                                <?php endif; ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
            <div class="action">
                <a href="index.php?act=adddm">THÊM DANH MỤC</a>
            </div>
        </div>
    </article>
</main>