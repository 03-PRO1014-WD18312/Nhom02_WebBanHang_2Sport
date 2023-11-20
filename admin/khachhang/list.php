<main class="container">
        <?php include "boxleft.php" ?>
        <article>
            <div class="tilte-ds">
                <h2>DANH SÁCH KHÁCH HÀNG</h2>
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
                        <th>ID</th>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Vai trò</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listAccount as $row){
                        extract($row);
                        $sualoai = "index.php?act=suadm&id=$id";
                        $xoaloai = "index.php?act=deletedm&id=$id";
                    ?>  
                    <tr>
                        <td><?= $id ?></td>
                        <td><img src="../assets/img/<?= $img ?>" alt="ảnh khách hàng"></td>
                        <td><?= $username ?></td>
                        <td><?= $email ?></td>
                        <td><?= $address ?></td>
                        <td><?=$role == 1 ? 'Admin' : 'User'?></td>
                        <td>
                            <a href=""><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>  
        </article>
</main>
