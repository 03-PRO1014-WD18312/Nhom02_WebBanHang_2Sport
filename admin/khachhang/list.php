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
                        <th>#STT</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Vai trò</th>
                        <th>Thao tác</th>
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
                                <td>'.$role.'</td>
                                <td><a class="btn btn-info" href="index.php?act=suakh&id='.$id.'"><i class="fa-regular fa-pen-to-square"></i></a></td>
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