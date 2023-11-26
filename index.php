<?php
    session_start();
    include 'model/pdo.php';
    include 'model/danhmuc.php';
    include 'model/sanpham.php';
    include 'model/search.php';
    include 'model/taikhoan.php';
    include 'model/cart.php';
    include 'model/order_payment.php';
    if (isset($_SESSION['login'])) {
        $idkh = $_SESSION['login']['id'];

        // Retrieve cart count
        $cartCount = count(showcart($idkh));

        include 'view/header.php';
    }
    else{
        include 'view/header.php';
    }
    if (isset($_GET['act']) && ($_GET['act'] != '')){
        $act = $_GET['act'];
        switch ($act) {
            case "sanpham" :
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $listsp = list_sanpham_danhmuc($id);
                }
                include "view/danhmucsampham.php";
                break;
            // case "danhmuc" :
            //     if(isset($_GET['id'])) {
            //         $id = $_GET['id'];
            //         $listspdm = list_danhmuc_sanpham($id);
            //     }
            //     include "view/danhmuc.php";
            //     break;
            case "timkiem" :
                if(isset($_POST['keyw'])) {
                    $keyw = $_POST['keyw'];
                    $listSearch = search_product($keyw);
                } else{

                }
                include "view/timkiem.php";
                break;
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
                $id_variant=$_POST['id_variant'];
                $idkh=$_SESSION['login']['id'];
                if (isset($_SESSION['login'])) {
                    addcart($nameSp,$priceSp,$imgSp,$idkh,$id_variant);
                    echo "<script>alert('Thêm giỏ hàng thành công 🛒');
                        if (performance.navigation.type == 0) {
                            window.location.href = window.location.href;
                            window.location.href = 'index.php?act=showcart';
                        }
                        window.location.href = 'index.php?act=showcart';
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
                }
                $showcart=showcart($idkh);
                include 'view/cart.php'; 
                break;
            case 'deletecart':
                $id=$_GET['id'];
                if (isset($id) && $id > 0) {
                    deletecart($id);
                    echo '
                        <script>
                            if (performance.navigation.type === 0) {
                                window.location.href = window.location.href;
                                window.location.href = "index.php?act=showcart";
                            }
                        </script>
                    ';
                }
                $idkh=$_SESSION['login']['id'];
                $showcart=showcart($idkh);
                include 'view/cart.php'; 
                break;
            case 'order':
                $idkh=$_SESSION['login']['id'];
                $_SESSION['infor_order']=check_infor_order($idkh);
                if (isset($_POST['tt_nhanhang'])) {
                $name_tt=$_POST['name_tt'];
                $phone_tt=$_POST['phone_tt'];
                $address_tt=$_POST['address_tt'];
                $payment_method=$_POST['payment_method'];
                    insert_infor_order($name_tt,$phone_tt,$address_tt,$idkh,$payment_method);
                    echo "<script>alert('Cập nhập thông tin thành công 👏');
                        if (performance.navigation.type == 0) {
                            window.location.href = window.location.href;
                            window.location.href = 'index.php?act=order';
                        }
                    </script>";
                }
                $showcart=showcart($idkh);
                include 'view/order.php';
                break;
            case 'checkdh':
                include 'view/checkdh.php';
                break;
            case "detail" :
                if(isset($_GET['id'])){
                    $detail = detail_product($_GET['id']);
                    $infor = loadone_product_infor($_GET['id']);
                    $product_same_type = load_product_same_type($detail['idCategory'],$_GET['id']);
                    tang_luot_xem($_GET['id']);
                }
                include 'view/chitietsanpham.php';
            break;

            case "quenmatkhau" :
                include 'view/quenmatkhau.php';
            break;
            case "price-form" :
                include 'view/price-form.php';
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