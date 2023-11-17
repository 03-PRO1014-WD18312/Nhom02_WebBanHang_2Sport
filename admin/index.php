<?php
    include "header.php";
    if (isset($_GET['act']) && ($_GET['act']) != ""){
    $act = $_GET['act'];
    switch ($act) {
            case 'khachhang':
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