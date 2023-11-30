<?php
    session_start();
    include 'model/pdo.php';
    include 'model/danhmuc.php';
    include 'model/sanpham.php';
    include 'model/search.php';
    include 'model/taikhoan.php';
    include 'model/cart.php';
    include 'model/rating.php';
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
                        if ($check_register=check_register($user,$email)==true) {
                            echo "<script>alert('User hoặc Email đã tồn tại');</script>";
                        }else{
                            $pass=md5($_POST['pass']);
                            register_kh($user,$pass,$email);
                            echo "<script>
                                    alert('Đăng ký thành công!');
                                    window.location.href = 'index.php?act=dangnhap';
                                </script>";
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
            case 'updatecart':
                if (isset($_SESSION['login'])){
                    $idkh=$_SESSION['login']['id']; 
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        foreach ($_POST['quantity'] as $cart_id => $quantity) {
                            // Thực hiện cập nhật số lượng cho từng sản phẩm trong giỏ hàng
                            $sql = "UPDATE `cart` SET `quantity` = ? WHERE `id` = ?";
                            pdo_execute($sql, $quantity, $cart_id);
                        }
                        echo "<script>alert('Cập nhật giỏ hàng thành công');
                            window.location.href = 'index.php?act=showcart';
                        </script>";
                    }
                    else {
                        echo "<script>alert('Cập nhật giỏ hàng không thành công');
                            window.location.href = 'index.php?act=showcart';
                        </script>";
                    }
                }
                break;                
            case 'showcart':
                if (isset($_SESSION['login'])){
                    $idkh=$_SESSION['login']['id']; 
                }else{
                    echo "<script>alert('Vui lòng đăng nhập để xem giỏ hàng 🧐');
                        window.location.href = 'index.php?act=dangnhap';
                    </script>";
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
                error_reporting(0);
                    // extract($_SESSION['login']);
                    $idkh=$_SESSION['login']['id'];
                    $showcart = showcart($idkh);
                    $_SESSION['history_cart'] = $showcart;
                    $error_name=$error_phone=$error_address="";
                    $name_order=$_POST['name_order'];
                    $phone_order=$_POST['phone_order'];
                    $address_order=$_POST['address_order'];
                    if (isset($_POST['payment'])) {
                        if (empty($name_order)) {
                            $error_name="(*)";
                        }
                        if (empty($phone_order) ) {
                            $error_phone="(*)";
                        }
                        if (empty($address_order)) {
                            $error_address="(*)";
                        }
                        if (empty($error_name) && empty($error_phone) && empty($error_address)) {

                            update_info_user_order($name_order,$phone_order,$address_order,$idkh);
                            $_SESSION['login']['name'] = $name_order;
                            $_SESSION['login']['phone'] = $phone_order;
                            $_SESSION['login']['address'] = $address_order;
                            update_info_user_order($name_order,$phone_order,$address_order,$idkh);
                            insert_infor_order($name_order,$phone_order,$address_order,$idkh,$payment);
                            $info_order=check_infor_order($idkh);
                            $idOrder = $info_order[0]['id'];
                            echo $idOrder;
                            foreach ($_SESSION['history_cart'] as $cartItem) {
                                $productName = $cartItem['product_name'];
                                $price = $cartItem['variant_discount'];
                                $color = $cartItem['color'];
                                $size = $cartItem['size'];
                                $quantity = $cartItem['quantity'];
                                $idProduct = $cartItem['product_id'];
                                $idOrder = $info_order[0]['id'];
                                insert_history_cart($productName, $price, $color, $size, $quantity, $idProduct, $idOrder);
                            }
                            clean_cart($idkh);
                            echo "
                                <script>
                                    alert('Đặt hàng thành công 👏');
                                    window.location.href = 'index.php?act=history-order';
                                </script>
                            ";
                        }

                    }
                $showcart=showcart($idkh);
                include 'view/order.php';
                break;
            case 'history-order':
                $idkh = $_SESSION['login']['id'];
                $info_order=check_infor_order($idkh);
                $history_order=history_order($idkh);
                include 'view/history_order.php';
                break;
            case 'show_order_hs':
                $id_order=$_GET['id'];
                $show_order=show_order($id_order);
                $idkh = $_SESSION['login']['id'];
                $info_order=check_infor_order($idkh);
                include 'view/chitietdh.php';
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
            case 'setInfoUser':
                // var_dump($_SESSION['login']['id']);
                if (isset($_POST['update-info-user'])) {
                    $email_user=$_POST['email-user'];
                    $name_order=$_POST['name_order'];
                    $phone_order=$_POST['phone_order'];
                    $address_order=$_POST['address_order'];
                    $payment_order=$_POST['payment_method'];
                    $idkh=$_SESSION['login']['id'];
                    if ($_FILES['fileimg']['name']=='') {
                        $img_user = $_SESSION['login']['img'];
                    }else {
                        $img_user=$_FILES['fileimg']['name'];
                        move_uploaded_file($_FILES['fileimg']['tmp_name'] , 'assets/img/'.$img_user);
                    }
                    update_info_user($email_user,$name_order,$img_user,$phone_order,$address_order,$payment_order,$idkh);

                    $_SESSION['login']['email'] = $email_user;
                    $_SESSION['login']['name'] = $name_order;
                    $_SESSION['login']['img'] = $img_user;
                    $_SESSION['login']['phone'] = $phone_order;
                    $_SESSION['login']['address'] = $address_order;
                    $_SESSION['login']['payment'] = $payment_order;
                    update_info_user($email_user,$name_order,$img_user,$phone_order,$address_order,$payment_order,$idkh);

                    header("Location: index.php?act=setInfoUser");
                    echo "<script>alert('Cập nhập thông tin thành công 👏');
                        if (performance.navigation.type == 0) {
                            window.location.href = window.location.href;
                            window.location.href = 'index.php?act=setInfoUser';
                        }
                    </script>";

                }
                include 'view/setting_info_user.php';
                break;
            case 'rate':
                // var_dump($id_product,$rating,$content_rate,$idkh);
                if (isset($_POST['rateSubmit'])) {
                    $rating=$_POST['rating'];
                    $content_rate=$_POST['contentRate'];
                    $id_product=$_GET['idproduct'];
                    $idkh = $_SESSION['login']['id'];
                    rating_rate($idkh, $id_product, $content_rate,$rating);
                    echo 'Đánh giá thành công 👋';
                }
                include'view/rate.php';
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