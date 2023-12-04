<?php
    session_start();
    if (isset($_SESSION['login']) && !$_SESSION['login']['role']=='1' || !$_SESSION['login']['role']=='2') {
        header('location: ../index.php');
    }
    include "../model/pdo.php";
    include "../model/danhmuc.php";
    include "../model/taikhoan.php";
    include "../model/sanpham.php";
    include "../model/bienthe.php";
    include "../model/binhluan.php";
    include "../model/search.php";
    include "../model/order_payment.php";
    include "../model/thongke.php";
    include "header.php";
    if (isset($_GET['act']) && ($_GET['act']) != ""){
    $act = $_GET['act'];
    switch ($act) {
            case 'logout':
                if (isset($_SESSION['login'])) {
                    unset($_SESSION['login']);
                    echo '
                        <script>
                            if (performance.navigation.type === 0) {
                                window.location.href = window.location.href;
                                window.location.href = "../index.php";
                            }
                        </script>
                    ';
                }
                include 'view/home.php';
                break;
            case 'listsp' :
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $perPage = 10; // Số lượng mục hiển thị trên mỗi trang
                $listProduct = list_product($page, $perPage);
                include "sanpham/list.php";
                break;
            case 'addsp' :
                if (isset($_POST['addProduct']) && $_POST['addProduct']) {
                    $name = $_POST['namesp'];
                    $iddm = $_POST['iddm'];
                    $status = $_POST['status'];
                    $des = $_POST['des'];

                    $price = $_POST['price'];
                    $discount = $_POST['priceSale'];
                    $quantity = $_POST['quantity'];
                    $size = $_POST['size'];
                    $color = $_POST['color'];

                    $hinh = $_FILES['image']['name'];
                    $target_direct = "../assets/img/";
                    $target_file = $target_direct.basename($hinh);
                    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                    insert_product($name, $iddm, $status, $des, $price, $discount, $quantity, $size, $color, $hinh);
                    header('location: index.php?act=listsp');
                } 
                $listdanhmuc = list_category();
                include "sanpham/add.php";
                break;
            case 'suasp' :
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    $sanpham = select_update_product($id);
                    $listdanhmuc=list_category();
                    $selectdm = join_sp_dm($id); 
                    $count = count_update($id);
                }
                include "sanpham/update.php";
                break;
            case 'updatesp' :
                if (isset($_POST['sua']) && $_POST['sua']) {
                    $id = $_POST['id'];
                    $name = $_POST['namesp'];
                    $iddm = $_POST['iddm'];
                    $status = $_POST['status'];
                    $des = $_POST['des'];

                    $price1 = $_POST['price1'];
                    $discount1 = $_POST['priceSale1'];
                    $quantity1 = $_POST['quantity1'];
                    $size1 = $_POST['size1'];
                    $color1 = $_POST['color1'];

                    if(isset($_POST['color'])){
                            
                        $price = $_POST['price'];
                        $discount = $_POST['priceSale'];
                        $quantity = $_POST['quantity'];
                        $size = $_POST['size'];
                        $color = $_POST['color'];
                        insert_product_details($id, $color, $size, $price, $discount, $quantity);
                    }

                    $hinh = $_FILES['image']['name'];
                    $target_direct = "../assets/img/";
                    $target_file = $target_direct.basename($hinh);
                    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

                    update_product($id, $iddm, $name, $status, $des, $hinh, $price1, $discount1, $quantity1, $color1, $size1);
                    header('location: index.php?act=listsp');
                }
                $listdanhmuc = list_category();
                include "sanpham/update.php";
                break;
            case 'deletesp' :
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    delete_product($_GET['id']);
                    header('location: index.php?act=listsp');
                }
                break;
            case 'deleteselected-sp':
                if(isset($_POST['selectedProducts']) && !empty($_POST['selectedProducts'])) {
                    foreach($_POST['selectedProducts'] as $selectedProductId) {
                        delete_product($selectedProductId);
                    }
                    header('location: index.php?act=listsp');
                }
                break;
            case 'deleteVariant' :
                if(isset($_GET['id'])){
                    delete_variant($_GET['id']);
                    header('Location: index.php?act=listsp');
                }
                break;
            case 'listdm' :
                $listCate = list_category();
                $check = check_category($id);
                include "danhmuc/list.php";
                break;
            case 'adddm' :
                if (isset($_POST['addCate']) && $_POST['addCate']) {
                    $name = $_POST['namedm'];
                    $hinh = $_FILES['img']['name'];
                    $target_direct = "../assets/img/";
                    $target_file = $target_direct.basename($hinh);
                    move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
                    insert_category($name, $hinh);
                    header('location: index.php?act=listdm');
                  }
                include "danhmuc/add.php";
                break;
            case "suadm" :
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    $danhmuc = loadone_category($id); 
                }
                include "danhmuc/update.php";
                break;
            case 'updatedm' :
                if(isset($_POST['updateCate']) && $_POST['updateCate']) {
                    $id = $_POST['id'];
                    $name = $_POST['namedm'];
                    $hinh = $_FILES['img']['name'];
                    $target_direct = "../assets/img/";
                    $target_file = $target_direct.basename($hinh);
                    move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
                    update_category($id,$name,$hinh);
                    $danhmuc = loadone_category($id); 
                    header('location: index.php?act=listdm');
                }
                $listCate = list_category();
                include "danhmuc/update.php";
                break;
            case 'deletedm' :
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    delete_category($_GET['id']);
                    header('location: index.php?act=listdm');
                }
                break;
            case 'listcolor' :
                $listColor = list_variant();
                include "bienthe/listcolor.php";
                break;
            case 'suacolor' :
                if(isset($_GET['id']) && $_GET['id'] > 0){
                    $list = list_color($_GET['id']);
                }
                include "bienthe/updatecolor.php";
                break;
            case 'updatecolor' :
                if(isset($_POST['updateColor']) && $_POST['updateColor']) {
                    $id = $_POST['id'];
                    $color = $_POST['color'];
                    $update = update_color($id,$color);
                    header('location: index.php?act=listcolor');
                }
                include "bienthe/updatecolor.php";
                break;
            case 'listsize' :
                $listSize = list_variant();
                include "bienthe/listsize.php";
                break;
            case 'suasize' :
                if(isset($_GET['id']) && $_GET['id'] > 0){
                    $list = list_size($_GET['id']);
                }
                include "bienthe/updatesize.php";
                break;
            case 'updatesize' :
                if(isset($_POST['updateSize']) && $_POST['updateSize']) {
                    $id = $_POST['id'];
                    $size = $_POST['size'];
                    $update = update_size($id,$size);
                    header('location: index.php?act=listsize');
                }
                include "bienthe/updatesize.php";
                break;
            case 'listbl' :
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $perPage = 10; // Số lượng mục hiển thị trên mỗi trang
                $binhluan = load_all_comment($page, $perPage);
                include "binhluan/list.php";
                break;
            case 'deletebl' :
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    delete_comment($_GET['id']);
                    header('Location: index.php?act=listbl');
                }
                break;
            case 'deleteselected-bl':
                if (isset($_POST['selectedComments']) && !empty($_POST['selectedComments'])) {
                    foreach ($_POST['selectedComments'] as $selectedCommentId) {
                        delete_comment($selectedCommentId);
                    }
                    header('location: index.php?act=listbl');
                }
                break;
            case 'khachhang':
                if (isset($_POST['searchkh'])) {
                    $keyword=$_POST['keyword'];
                    $table='account';
                    $column1='username';
                    $column2='email';
                    $id=$_SESSION['login']['id'];
                    if ($search_wp=search_wp($table,$column1,$column2,$keyword, $id)==true) {
                        $dskh=search_wp($table,$column1,$column2,$keyword,$id);
                        include 'khachhang/list.php';
                        exit();
                    }else {
                        echo"<script>
                            alert('Không có user hoặc email tồn tại ! hoặc đã đăng nhập');
                        </script>";
                    }
                }
                $dskh=list_kh();
                include 'khachhang/list.php';
                break;
            case 'phanquyen':
                if (isset($_GET['id'])) {
                    $id=$_GET['id'];
                    phanquyen($id);
                }
                $dskh=list_kh();
                include 'khachhang/list.php';
            break;
            case 'goquyen':
                if (isset($_GET['id'])) {
                    $id=$_GET['id'];
                    goquyen($id);
                }
                $dskh=list_kh();
                include 'khachhang/list.php';
            break;
            case 'qldh':
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $perPage = 10; // Số lượng mục hiển thị trên mỗi trang
                $list_order=list_order($page, $perPage);
                include 'donhang/list.php';
                break;
            case 'chitietdh':
                $id_order=$_GET['id'];
                $show_order=show_order($id_order);
                $status=$_POST['statusUpdate'];
                $list_order=list_staus_order($id_order);
                if (isset($_POST['update_order'])) {
                    update_status_order($id_order,$status);
                    echo"<script>
                        alert('Cập nhật trạng thái đơn hàng thành công 👋');
                        if (performance.navigation.type === 0) {
                            window.location.href = window.location.href;
                        }
                    </script>";
                }
                include 'donhang/chitietdh.php';
                break;
            case 'spdm':
                $thongkesp = load_thongke_sanpham_danhmuc();
                include 'thongke/sp-dm.php';
                break;
            case 'bieudo-sp' :
                $thongkesp = load_thongke_sanpham_danhmuc();
                include 'thongke/bieudo-sp.php';
                break;
            case 'dhdt':
                $thongke_dt=thongke_doanh_thu();
                include 'thongke/dh-dt.php';
                break;
            case 'tkdt':
                $thongke_dt=thongke_doanh_thu();
                include 'thongke/bieudo-dh.php';
                break;
        default:
            include 'home.php';
        break;
    }
    } else {
        include "home.php";
    }
include "footer.php";
?>