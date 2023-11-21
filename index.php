<?php
    session_start();
    include 'model/pdo.php';
    include 'model/danhmuc.php';
    include 'model/sanpham.php';
    include 'model/taikhoan.php';
    include 'view/header.php';
    if (isset($_GET['act']) && ($_GET['act'] != '')){
        $act = $_GET['act'];
        switch ($act) {
            case "dangky" :
                if (isset($_POST['register'])) {
                    $user=$_POST['user'];
                    $email=$_POST['mail'];
                    $pass=md5($_POST['pass']);
                    $passCheck=md5($_POST['passcheck']);
                    $userError=$emailError=$passError=$passCheckError="";
                    if (empty($user)) {
                        $userError="(* Vui lòng nhập username *)";
                    }elseif ( strlen($user)<6) {
                        $userError="(* Tên username không được nhỏ hơn 6 kí tự *)";
                    }
                    //
                    if (empty($email)) {
                        $emailError="(* Vui lòng nhập email *)";
                    }
                    //
                    if (empty($pass)) {
                        $passError="(* Vui lòng nhập mật khẩu *)";
                    }elseif( strlen($pass)<6){
                        $passError="(* Password không được nhỏ hơn 6 kí tự *)";
                    }
                    else {
                        if ($pass !== $passCheck) {
                            $passCheckError="(* Mật khẩu không trùng khớp *)";
                        }
                    }

                    if (empty($userError) & empty($emailError) & empty($passError) & empty($passCheckError)) {
                        register_kh($user,$pass,$email);
                        echo 'đăng kí thành công';
                    }

                }
                if (isset($_SESSION['login'])) {
                    include 'view/home.php';
                } 
                include 'view/dangky.php';
                break;
            case "dangnhap" :
                if (isset($_POST['login'])) {
                    $enterUsername=$_POST['username'];
                    $enterPass=$_POST['password'];
                    $errorEnterUsername=$errorEnterPassword="";
                    if (empty($enterUsername)) {
                        $errorEnterUsername="(* Vui lòng nhập username *)";
                    }elseif ( strlen($enterUsername)<6) {
                        $errorEnterUsername="(* Tên username không được nhỏ hơn 6 kí tự *)";
                    }
                    //
                    if (empty($enterPass)) {
                        $errorEnterPassword="(* Vui lòng nhập mật khẩu *)";
                    }elseif( strlen($enterPass)<6){
                        $errorEnterPassword="(* Password không được nhỏ hơn 6 kí tự *)";
                    }
                    //
                    if (empty($errorEnterUsername) && empty($errorEnterPassword)) {
                        $enterPassword=md5($_POST['password']);
                        $checkLogin=check_login($enterUsername,$enterPassword);
                        if (is_array($checkLogin)) {
                            $_SESSION['login'] = $checkLogin;
                            echo "<script>alert('🎉 Đăng nhập thành công 👏');</script>";
                            echo '
                                <script>
                                    if (performance.navigation.type === 0) {
                                        window.location.href = window.location.href;
                                        window.location.href = "index.php";
                                    }
                                </script>
                            ';
                        } else {
                            echo "<script>alert('Sai user hoặc Pass');</script>";
                        }
                    } 
                }
                include 'view/dangnhap.php';
                break;
            case 'logout':
                if (isset($_POST['logout'])) {
                    if (isset($_SESSION['login'])) {
                        unset($_SESSION['login']);
                        echo '
                            <script>
                                if (performance.navigation.type === 0) {
                                    window.location.href = window.location.href;
                                    window.location.href = "index.php";
                                }
                            </script>
                        ';
                    }
                }
                include 'view/home.php';
                break;
            case "cart" :
                include 'view/cart.php';
            break;
            case 'checkdh':
                include 'view/checkdh.php';
                break;
            case "detail" :
                if(isset($_GET['id']) && $_GET['id'] > 0){
                    $detail = detail_product($_GET['id']);
                    $infor = loadone_product_infor($_GET['id']);
                    tang_luot_xem($_GET['id']);
                }
                include 'view/chitietsanpham.php';
            break;
            case "quenmatkhau" :
                include 'view/quenmatkhau.php';
            break;
        default:
            include 'view/home.php';
            break;
        }
    } else{
        include 'view/home.php';
    }
        include 'view/footer.php';
?>