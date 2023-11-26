<?php 
    //thêm thông tin nhận hàng
    function insert_infor_order($name_tt,$phone_tt,$address_tt,$idkh,$payment_method){
        $sql="INSERT INTO `order_info`(`name`, `address`, `phoneNumber`,`payment`, `date`, `idAccount`) VALUES ('$name_tt','$address_tt','$phone_tt','$payment_method',CURRENT_DATE(),'$idkh')";
        pdo_execute($sql);
    }
    //
    function check_infor_order($idkh){
        $sql="SELECT * FROM `order_info` WHERE idAccount=$idkh";
        $check_infor_order=pdo_query($sql);
        return $check_infor_order;
    }
    //
    function insert_add_payment_method($payment_method){
        $sql="INSERT INTO `order_info`(`payment`) VALUES ('$payment_method')";
        pdo_execute($sql);
    }
    //clean-cart khi thanh toán thành công
    function clean_cart($idkh){
        $sql="DELETE FROM `cart` WHERE idAccount=$idkh";
        pdo_execute($sql);
    }
    //lịch sử mua hàng
    function insert_history_cart($productName,$price,$color,$size,$quantity,$idProduct,$idOrder){
        $sql="INSERT INTO `order_detail`(`productName`, `price`, `color`, `size`, `quantity`, `idProduct`, `idOrder`) VALUES ('$productName','$price','$color','$size','$quantity','$idProduct','$idOrder')";
        pdo_execute($sql);
    }
    //
    function history_order($idkh){
        $sql="SELECT * FROM `order_info`WHERE idAccount=$idkh";
        $history_order=pdo_query($sql);
        return $history_order;
    }
    //tong tien
    function total_money_order($id_order){
       $sql="SELECT SUM(price) AS total_price FROM order_detail WHERE idOrder = $id_order";
       $total_order=pdo_query($sql);
       return $total_order;
    }
    //show_order_product
    function show_order($id_order){
        $sql="SELECT * FROM `order_detail` WHERE idOrder = $id_order";
        $show_order=pdo_query($sql);
        return $show_order;
    }
?>