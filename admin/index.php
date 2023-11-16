<?php
include "header.php";
if (isset($_GET['act']) && ($_GET['act']) != ""){
  $act = $_GET['act'];
  switch ($act) {
    case 'listsp' :
        include "sanpham/list.php";
        break;
    case 'addsp' :
        include "sanpham/add.php";
        break;
    case 'listdm' :
        include "danhmuc/list.php";
        break;
    case 'adddm' :
        include "danhmuc/add.php";
        break;
  }
} else {
  include "home.php";
}
include "footer.php";
?>