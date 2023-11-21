<?php 
    if (isset($_SESSION['login'])) {
        if ($_SESSION['login']['role']=='2') {
?>
<main class="container">
        <?php include "boxleft.php" ?>
        <article>
            <div class="tilte-ds">
                <h2>DANH SÁCH KHÁCH HÀNG</h2>
            </div>
            <form class="form-search" action="" method="post">
                <div class="search-wp">
                    <input class="input-search" type="search" name="keyword" required placeholder="Nhập user or email ...">
                    <button type="submit" name="searchkh" class="btn-search"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>#STT</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Role</th>
                        <th>Access</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 0;
                    $stt=1;
                    foreach ($dskh as $kh) {
                        extract($kh);
                        echo'
                            <tr>
                                <td>'.$stt++.'</td>
                                <td>'.$username.'</td>
                                <td>'.$email.'</td>
                                <td><img src="../assets/img/'.$img.'" alt="anh-user"></td>
                                <td> 
                                    '. ($role == 1 ? 'Quản trị viên' : 'Khách hàng') .'
                                </td>
                                <td>'. ($role == 0 ? '<a href="index.php?act=phanquyen&id='.$id.'" style="padding:10px; display:block;"><i class="fa-solid fa-user-plus" style="color: #023588;"></i></a>' : '<a href="index.php?act=goquyen&id='.$id.'" style="padding:10px; display:block;"><i class="fa-solid fa-user-minus" style="color: #ac0000;"></i></a>') .'</td>
                            </tr>
                        ';
                        $i++;
                    }
                    echo'<caption style="caption-side:bottom;text-align:left; color: #A6A6A4; font-style:italic; padding:15px 0px;">Có '.$i.' khách hàng</caption>';
                ?>
                </tbody>
            </table>  
        </article>
</main>
<?php }
    else {
        header('Location: ../index.php');
    }
}
?>