<?php 
    //thêm giỏ hàng
    function addcart($nameSp,$priceSp,$imgSp,$idkh,$id_variant,$idSize,$idColor){
        $sql="INSERT INTO `cart`(`name`, `color`, `size`, `price`, `img`, `idAccount`, `idVariant`) VALUES ('$nameSp','$idColor','$idSize','$priceSp','$imgSp','$idkh','$id_variant')
        ";
        pdo_execute($sql);
    }
    //show giỏ hàng 
    function showcart($idkh){
        $sql="SELECT * FROM cart WHERE idAccount = $idkh";
        $showcart=pdo_query($sql);
        return $showcart;
    }
    //xoá giỏ hàng
    function deletecart($id){
        $sql="DELETE FROM `cart` WHERE `cart`.`id`=$id";
        pdo_execute($sql);
    }

    


?>