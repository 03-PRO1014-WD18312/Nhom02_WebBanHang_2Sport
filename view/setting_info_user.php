<?php 
    if (is_array($_SESSION['login'])) {
        extract ($_SESSION['login']);
    }
?>
<?php 
    if (isset($_SESSION['login'])) {
        ?>
<main class="container update-user">
    <h2>THIẾT LẬP TÀI KHOẢN</h2>
    <div class="update-user-wp">
        <?php include 'box-left-setInfo.php' ?>
        <div class="update-user-right">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-grid-user-info">
                    <div class="grid-user-info-left">
                        <h3>THÔNG TIN NGƯỜI DÙNG</h3>
                        <label for="">ID User</label>
                        <input type="number" disabled value="<?= $id;?>"><br><br>
                        <label for="">Tên Username</label>
                        <input type="text" disabled value="<?= $username;?>"><br><br>
                        <label for="">Gmail</label>
                        <input type="email" name="email-user" value="<?= $email;?>" ><br><br>
                        <label for="">Hình ảnh</label><br>
                        <div class="img-user">
                            <label for="imgUser"><i class="fa-solid fa-camera"></i><img  src="assets/img/<?= $img;?>" alt="img-user"> </label><br>
                            <div class="chonanh">
                                <input type="file" name="fileimg" value="" id="imgUser" style="display:none;"> 
                            </div>
                        </div>
                    </div>
                    <div class="grid-user-info-right">
                        <h3>THÔNG TIN THANH TOÁN</h3>
                        <label for="">Họ và tên</label>
                        <input type="text" name="name_order" placeholder="Nhập họ và tên : " value="<?= $name;?>"><br><br>
                        <label for="">Số điện thoại</label>
                        <input type="text" name="phone_order" placeholder="Nhập số điện thoại : " value="<?= $phone;?>"><br><br>
                        <label for="">Địa chỉ</label><br>
                        <textarea name="address_order" id="" cols="30" rows="6" placeholder="Nhập địa chỉ nhận hàng : "><?= $address;?></textarea><br><br>
                        <label for=""><i class="fa-solid fa-credit-card"></i> Cài đặt phương thức thanh toán</label>
                        <select class="select-payment" name="payment_method" id="">
                            <option value="0" <?php if($payment == "0") echo "selected";?>>💵 Thanh toán bằng tiền mặt</option>
                            <option value="1" <?php if($payment == "1") echo "selected";?>>🏧 Thanh toán bằng ATM MOMO</option>
                        </select>
                    </div>
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
