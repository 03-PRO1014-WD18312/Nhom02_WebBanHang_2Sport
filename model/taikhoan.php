<?php 
    // Kiểm tra mật user / pass để login
    function check_login($enterUsername,$enterPassword){
        $sql="SELECT * FROM account WHERE username='".$enterUsername."' AND password='".$enterPassword."'";
        $check_login=pdo_query_one($sql);
        return $check_login;
    }
    //đăng kí khách hàng
    function register_kh($user,$pass,$email){
        $sql="INSERT INTO `account`(`username`, `password`, `email`) VALUES ('$user','$pass','$email')";
        pdo_execute($sql);
    }
    //Hiển thị danh sách khách hàng
    function list_kh(){
        $sql ="SELECT * FROM account where role = 1 or role = 0";
        $dskh=pdo_query($sql);
        return $dskh;
    }

    // check tên đăng kí đã có trên database chưa
    function check_register($user,$email){
        $sql ="SELECT * FROM account WHERE username='".$user."' OR email='".$email."'";
        $check_register=pdo_query_one($sql);
        return $check_register;
    }
    //phanquyen
    function phanquyen($id){
        $sql = "UPDATE account set role = 1 where id = '$id'";
        pdo_execute($sql);
      }
    //goquyen
      function goquyen($id){
        $sql = "UPDATE account set role = 0 where id = '$id'";
        pdo_execute($sql);
      }
    //update-info-user

    function update_info_user($email_user,$name_order,$img_user,$phone_order,$address_order,$payment_order,$idkh){
      $sql="UPDATE `account` SET `email`='$email_user',`img`='$img_user',`name`='$name_order',`phone`='$phone_order',`address`='$address_order', `payment`='$payment_order' WHERE id=$idkh";
      pdo_execute($sql);
    }

    function update_info_user_order($name_order,$phone_order,$address_order,$idkh){
      $sql="UPDATE `account` SET `name`='$name_order',`phone`='$phone_order',`address`='$address_order' WHERE id=$idkh";
      pdo_execute($sql);
    }
    // Đếm số lượng khách hàng 
    function countUser(){
        $sql="SELECT COUNT(account.id) AS countKH FROM `account` WHERE account.role = '0'";
        $countUser=pdo_query($sql);
        return $countUser; 
    }


?>