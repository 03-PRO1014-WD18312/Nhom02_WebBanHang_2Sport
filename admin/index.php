<?php
    session_start();
    if (isset($_SESSION['login']) && !$_SESSION['login']['role']=='1' || !$_SESSION['login']['role']=='2') {
        header('location: ../index.php');
    }
    include "../model/pdo.php";
    include "../model/danhmuc.php";
    include "../model/taikhoan.php";
    include "../model/sanpham.php";
    include "../model/binhluan.php";
    include "../model/search.php";
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
                $listProduct = list_product();
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
                    $size1 = $_POST['size1'];
                    $size2 = $_POST['size2'];
                    $size3 = $_POST['size3'];
                    $size4 = $_POST['size4'];
                    $color = $_POST['color'];
                    $color = $_POST['color'];

                    $hinh = $_FILES['image']['name'];
                    $target_direct = "../assets/img/";
                    $target_file = $target_direct.basename($hinh);
                    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                    insert_product($name, $iddm, $status, $des, $price, $discount, $quantity, $size1, $size2, $size3, $size4, $color, $hinh);
                    header('location: index.php?act=listsp');
                } 
                $listdanhmuc = list_category();
                include "sanpham/add.php";
                break;
            case 'suasp' :
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    $sanpham = select_update_product($id);
                    $listdanhmuc = list_category(); 
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

                    $price = $_POST['price'];
                    $discount = $_POST['priceSale'];
                    $quantity = $_POST['quantity'];
                    $size1 = $_POST['size1'];
                    $size2 = $_POST['size2'];
                    $size3 = $_POST['size3'];
                    $size4 = $_POST['size4'];
                    $color = $_POST['color'];

                    $hinh = $_FILES['image']['name'];
                    $target_direct = "../assets/img/";
                    $target_file = $target_direct.basename($hinh);
                    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

                    update_product($id, $iddm, $name, $status, $des, $hinh, $price, $discount, $quantity, $color, $size1, $size2, $size3, $size4);
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
            case 'listdm' :
                $listCate = list_category();
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
                    // $messSuccess = "Cập nhật thành công!";
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
            case 'listbl' :
                $binhluan = load_all_comment();
                include "binhluan/list.php";
                break;
            case 'deletebl' :
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    delete_comment($_GET['id']);
                }
                $binhluan = load_all_comment();
                include "binhluan/list.php";
                break;
            case 'khachhang':
                $keyword=$_POST['keyword'];
                $table='account';
                $column1='username';
                $column2='email';
                if (isset($_POST['searchkh'])) {
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
            case 'spdm':
                include 'thongke/sp-dm.php';
                break;
            case 'dhdt':
                include 'thongke/dh-dt.php';
                break;
            case 'qldh':
                include 'donhang/list.php';
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