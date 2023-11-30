<?php 
    //thêm thông tin nhận hàng
    function insert_infor_order($name_order,$phone_order,$address_order,$idkh,$payment){
        $sql="INSERT INTO `order_info`(`name`, `address`, `phoneNumber`,`payment`, `date`, `idAccount`) VALUES ('$name_order','$address_order','$phone_order','$payment',CURRENT_DATE(),'$idkh')";
        pdo_execute($sql);
    }
    //
    function check_infor_order($idkh){
        $sql="SELECT * FROM `order_info` WHERE idAccount=$idkh ORDER BY id DESC";
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
    //list toàn bộ danh sách đơn hàng
    function list_order(){
        $sql="SELECT * FROM order_info JOIN account ON order_info.idAccount = account.id ORDER BY order_info.id DESC";
        $list_order=pdo_query($sql);
        return $list_order;
    }
    
    //tong tien
    function total_money_order($id_order){
       $sql="SELECT SUM(price * quantity) AS total_price FROM order_detail WHERE idOrder=$id_order GROUP BY idOrder";
       $total_order=pdo_query($sql);
       return $total_order;
    }
    //show_order_product
    function show_order($id_order){
        $sql="SELECT * FROM `order_detail` INNER JOIN product ON order_detail.idProduct=product.id INNER JOIN order_info ON order_detail.idOrder=order_info.id WHERE idOrder = $id_order";
        $show_order=pdo_query($sql);
        return $show_order;
    }
    //
    // update trạng thái đơn hàng
    function update_status_order($id_order,$status){
        $sql="UPDATE `order_info` SET `status`='$status' WHERE id=$id_order";
        pdo_execute($sql);
    }

    //hiển thị trạng thái đơn hàng
    function list_staus_order($id_order){
        $sql="SELECT * FROM `order_info` WHERE id=$id_order";
        $list_staus_order=pdo_query($sql);
        return $list_staus_order;
    }
?>