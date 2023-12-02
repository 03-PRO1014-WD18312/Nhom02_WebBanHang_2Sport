<?php 
    //thêm giỏ hàng
    function addcart_quantity($nameSp, $priceSp, $imgSp, $quantity, $idkh, $id_variant) {
        // Kiểm tra xem sản phẩm với ID biến thể đã cho đã tồn tại trong giỏ hàng chưa
        $existingCartItem = pdo_query_one("SELECT * FROM `cart` WHERE `idVariant` = ?", $id_variant);

        if ($existingCartItem) {
            // Nếu tồn tại thì update số lương
            $newQuantity = $existingCartItem['quantity'] + $quantity;
            pdo_execute("UPDATE `cart` SET `quantity` = ? WHERE `idVariant` = ?", $newQuantity, $id_variant);
        } else {
            // Nếu không thì thêm sản phẩm 
            $sql = "INSERT INTO `cart`(`name`,`price`, `img`, `quantity`, `idAccount`, `idVariant`) 
                    VALUES ('$nameSp','$priceSp','$imgSp', '$quantity', '$idkh','$id_variant')";
            pdo_execute($sql);
        }
    }

    //show giỏ hàng 
    function showcart($idkh){
        $sql="SELECT
        cart.id AS cart_id,
        cart.quantity,
        product.id AS product_id,
        product.name AS product_name,
        product.img AS product_img,
        variants.price AS variant_price,
        variants.discount AS variant_discount,
        product_size.size,
        product_color.color
    FROM
        cart
    JOIN
        variants ON cart.idVariant = variants.id
    JOIN
        product ON variants.idProduct = product.id
    JOIN
        product_size ON variants.idSize = product_size.id
    JOIN
        product_color ON variants.idColor = product_color.id
    WHERE
        cart.idAccount = $idkh;";
        $showcart=pdo_query($sql);
        return $showcart;

    }
    
    //xoá giỏ hàng
    function deletecart($id){
        $sql="DELETE FROM `cart` WHERE `cart`.`id`=$id";
        pdo_execute($sql);
    }

   

?>