<?php 
    //thêm thông tin nhận hàng
    function insert_infor_order($name_tt,$phone_tt,$address_tt,$idkh,$payment_method){
        $sql="INSERT INTO `order_wp`(`name`, `address`, `phoneNumber`,`payment`,`idAccount`) VALUES ('$name_tt','$address_tt','$phone_tt','$payment_method','$idkh')";
        pdo_execute($sql);
    }
    //
    function check_infor_order($idkh){
        $sql="SELECT * FROM `order_wp` WHERE idAccount=$idkh";
        $check_infor_order=pdo_query($sql);
        return $check_infor_order;
    }

    function insert_add_payment_method($payment_method){
        $sql="INSERT INTO `order_wp`(`payment`) VALUES ('$payment_method')";
        pdo_execute($sql);
    }
?>