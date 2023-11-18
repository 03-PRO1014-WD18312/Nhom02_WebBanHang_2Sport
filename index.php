<?php
require 'view/header.php';
if (isset($_GET['act']) && ($_GET['act'] != '')){
    $act = $_GET['act'];
    switch ($act) {
        case "dangnhap" :
            require 'view/dangnhap.php';
            break;
        case "dangky" :
            require 'view/dangky.php';
            break;
        case "cart" :
            require 'view/cart.php';
        break;
        case 'checkdh':
            require 'view/checkdh.php';
            break;
    default:
        include 'view/home.php';
        break;
    }
} else{
    require 'view/home.php';
}
    require 'view/footer.php';
?>