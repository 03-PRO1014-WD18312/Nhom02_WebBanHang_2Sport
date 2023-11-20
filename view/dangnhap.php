<?php 
    if (isset($_SESSION['login'])) {
        header('location: index.php');
    } 
?>
<div class="container">
    <div class="form-signin">
        <h1>ĐĂNG NHẬP</h1>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Vui lòng nhập username">
            <span style="color: orangered; font-size: small;"><?php echo $errorEnterUsername;?></span><br>
            <input type="password" name="password" placeholder="Vui lòng nhập mật khẩu">
            <span style="color: orangered; font-size: small;"><?php echo $errorEnterPassword;?></span><br>
            <a class="forget-pass" href="">Quên mật khẩu?</a>
            <input type="submit" name="login" value="Đăng nhập">
            <p>Bạn chưa có tài khoản? <a class="signup-now" href="index.php?act=dangky">Đăng ký ngay</a></p>
        </form>
    </div>    
</div>