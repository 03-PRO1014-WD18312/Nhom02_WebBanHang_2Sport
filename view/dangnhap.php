<?php 
    if (isset($_SESSION['login'])) {
        echo '
            <script>
                if (performance.navigation.type === 0) {
                    window.location.href = window.location.href;
                    window.location.href = "index.php";
                }
            </script>
        ';
    }
?>
<div class="container">
    <div class="form-signin">
        <h1>ĐĂNG NHẬP</h1>
        <form action="index.php?act=dangnhap" method="post">
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
