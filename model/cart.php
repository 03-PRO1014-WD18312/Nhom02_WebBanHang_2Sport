<?php 
    //thêm giỏ hàng
    function addcart($nameSp,$priceSp,$imgSp,$idkh){
        $sql="INSERT INTO `cart`(`name`, `price`, `img`,`idAccount`) VALUES ('$nameSp','$priceSp','$imgSp','$idkh')";
        pdo_execute($sql);
    }
    //show giỏ hàng 
    function showcart($idkh){
        $sql="SELECT * FROM cart WHERE idAccount = $idkh";
        $showcart=pdo_query($sql);
        return $showcart;
    }
?>