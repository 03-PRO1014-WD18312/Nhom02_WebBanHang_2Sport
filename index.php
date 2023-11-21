<?php
    session_start();
    include 'model/pdo.php';
    include 'model/danhmuc.php';
    include 'model/sanpham.php';
    include 'model/taikhoan.php';
    include 'model/cart.php';
    include 'view/header.php';
    if (isset($_GET['act']) && ($_GET['act'] != '')){
        $act = $_GET['act'];
        switch ($act) {
            case "dangky" :
                if (isset($_POST['register'])) {
                    $user=$_POST['user'];
                    $email=$_POST['mail'];
                    $passW=$_POST['pass'];
                    $passCheckW=$_POST['passcheck'];
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
                    if (empty($passW)) {
                        $passError="(* Vui lòng nhập mật khẩu *)";
                    }elseif( strlen($passW)<6){
                        $passError="(* Password không được nhỏ hơn 6 kí tự *)";
                    }
                    else {
                        if ($passW !== $passCheckW) {
                            $passCheckError="(* Mật khẩu không trùng khớp *)";
                        }
                    }
                    if (empty($userError) & empty($emailError) & empty($passError) & empty($passCheckError)) {
                        var_dump(check_register($user,$email));
                        if ($check_register=check_register($user,$email)==true) {
                            echo "<script>alert('User hoặc Email đã tồn tại');</script>";
                        }else{
                            $pass=md5($_POST['pass']);
                            register_kh($user,$pass,$email);
                            echo 'đăng kí thành công';
                        }
                        
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
                include 'view/home.php';
                break;
            case "addcart" :
                $nameSp=$_POST['ten_sp'];
                $priceSp=$_POST['price'];
                $imgSp=$_POST['imgsp'];
                $colorSp=$_POST['colorsp'];
                $sizeSp=$_POST['sizesp'];
                $id_variant=$_POST['id_variant'];
                $idkh=$_SESSION['login']['id'];
                if (isset($_SESSION['login'])) {
                    addcart($nameSp,$priceSp,$imgSp,$idkh);
                    echo "<script>alert('Thêm giỏ hàng thành công 🛒');
                        window.location.href = 'index.php';
                    </script>";
                }else {
                    echo'<script>
                        alert("Vui lòng đăng nhập");
                    </script>';
                    include 'view/home.php';
                }
            break;
            case 'showcart':
                if (isset($_SESSION['login'])){
                   $idkh=$_SESSION['login']['id'];
                    $showcart=showcart($idkh);
                    include 'view/cart.php'; 
                }
                
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