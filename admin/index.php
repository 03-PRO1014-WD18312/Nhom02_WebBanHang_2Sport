<?php
include "header.php";
if (isset($_GET['act']) && ($_GET['act']) != ""){
  $act = $_GET['act'];
  switch ($act) {
    
  }
} else {
  include "home.php";
}
include "footer.php";
?>