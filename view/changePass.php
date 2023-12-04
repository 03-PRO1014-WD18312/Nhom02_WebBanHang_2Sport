<?php 
    if (is_array($_SESSION['login'])) {
        extract ($_SESSION['login']);
    }
?>
<?php 
    if (isset($_SESSION['login'])) {
        ?>
<main class="container update-user">
    <h2>ĐỔI MẬT KHẨU</h2>
    <div class="update-user-wp">
        <?php include 'box-left-setInfo.php' ?>
        <div class="update-user-right">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-grid-user-info">
                    
                </div>
                <br><br>
                <input type="submit" name="update-info-user" value="UPDATE">
            </form>
        </div>        
    </div>

</main>

<?php
}else {
    echo'<div style="width:100%; text-align:center; padding-top:75px">
        <img src="./assets/img/404.svg" width="50%" alt="">
    </div>
    ';
}
?>