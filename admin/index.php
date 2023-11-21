<?php
    session_start();
    if (isset($_SESSION['login']) && !$_SESSION['login']['role']=='1' || !$_SESSION['login']['role']=='2') {
        header('location: ../index.php');
    }
    include "../model/pdo.php";
    include "../model/danhmuc.php";
    include "../model/taikhoan.php";
    include "../model/sanpham.php";
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
                    $price = $_POST['price'];
                    $discount = $_POST['discount'];
                    $quantity = $_POST['quantity'];
                    $iddm = $_POST['iddm'];
                    $status = $_POST['status'];
                    $des = $_POST['des'];

                    $color1 = $_POST['color1'];
                    $color2 = $_POST['color2'];
                    $color3 = $_POST['color3'];
                    $color4 = $_POST['color4'];
                    $color5 = $_POST['color5'];

                    $size1 = $_POST['size1'];
                    $size2 = $_POST['size2'];
                    $size3 = $_POST['size3'];
                    $size4 = $_POST['size4'];
                    $size5 = $_POST['size5'];

                    $hinh = $_FILES['image']['name'];
                    $hinh1 = $_FILES['image1']['name'];
                    $hinh2 = $_FILES['image2']['name'];
                    $hinh3 = $_FILES['image3']['name'];
                    $hinh4 = $_FILES['image4']['name'];

                    $target_direct = "../assets/img/";

                    $target_file = $target_direct.basename($hinh);
                    $target_file1 = $target_direct.basename($hinh1);
                    $target_file2 = $target_direct.basename($hinh2);
                    $target_file3 = $target_direct.basename($hinh3);
                    $target_file4 = $target_direct.basename($hinh4);

                    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                    move_uploaded_file($_FILES['image1']['tmp_name'], $target_file1);
                    move_uploaded_file($_FILES['image2']['tmp_name'], $target_file2);
                    move_uploaded_file($_FILES['image3']['tmp_name'], $target_file3);
                    move_uploaded_file($_FILES['image4']['tmp_name'], $target_file4);
                    insert_product($name, $price, $discount, $quantity, $iddm, $status, $des, $size1, $size2, $size3, $size4, $size5, $hinh, $hinh1, $hinh2, $hinh3, $hinh4, $color1, $color2, $color3, $color4, $color5);
                    header('location: index.php?act=listsp');

                }
                $listdanhmuc = list_category();
                include "sanpham/add.php";
                break;
            case 'suasp' :
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    $sanpham = loadone_product($id);  
                    $infor = loadone_product_infor($id);  
                    $listdanhmuc = list_category();
                }
                include "sanpham/update.php";
                break;
            case 'updatesp' :
                if (isset($_POST['updateProduct']) && $_POST['updateProduct']) {
                    $id = $_POST['id'];
                    $name = $_POST['namesp'];
                    $price = $_POST['price'];
                    $discount = $_POST['discount'];
                    $quantity = $_POST['quantity'];
                    $iddm = $_POST['iddm'];
                    $status = $_POST['status'];
                    $des = $_POST['des'];

                    $color1 = $_POST['color1'];
                    $color2 = $_POST['color2'];
                    $color3 = $_POST['color3'];
                    $color4 = $_POST['color4'];
                    $color5 = $_POST['color5'];

                    $size1 = $_POST['size1'];
                    $size2 = $_POST['size2'];
                    $size3 = $_POST['size3'];
                    $size4 = $_POST['size4'];
                    $size5 = $_POST['size5'];

                    $hinh = $_FILES['image']['name'];
                    $hinh1 = $_FILES['image1']['name'];
                    $hinh2 = $_FILES['image2']['name'];
                    $hinh3 = $_FILES['image3']['name'];
                    $hinh4 = $_FILES['image4']['name'];

                    $target_direct = "../assets/img/";

                    $target_file = $target_direct.basename($hinh);
                    $target_file1 = $target_direct.basename($hinh1);
                    $target_file2 = $target_direct.basename($hinh2);
                    $target_file3 = $target_direct.basename($hinh3);
                    $target_file4 = $target_direct.basename($hinh4);

                    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                    move_uploaded_file($_FILES['image1']['tmp_name'], $target_file1);
                    move_uploaded_file($_FILES['image2']['tmp_name'], $target_file2);
                    move_uploaded_file($_FILES['image3']['tmp_name'], $target_file3);
                    move_uploaded_file($_FILES['image4']['tmp_name'], $target_file4);
                    update_product($id, $name, $price, $discount, $quantity, $iddm, $status, $des, $size1, $size2, $size3, $size4, $size5, $hinh, $hinh1, $hinh2, $hinh3, $hinh4, $color1, $color2, $color3, $color4, $color5);
                    $messSuccess = "Cập nhật thành công!";
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
                include "binhluan/list.php";
                break;
            case 'khachhang':
                $keyword=$_REQUEST['keyword'];
                $table='account';
                $column1='username';
                $column2='email';
                if (isset($_POST['searchkh'])) {
                    if ($search_wp=search_wp($table,$column1,$column2,$keyword)==true) {
                        $dskh=search_wp($table,$column1,$column2,$keyword);
                        include 'khachhang/list.php';
                        exit();
                    }else {
                        echo"<script>
                            alert('Không có user hay email tồn tại !');
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