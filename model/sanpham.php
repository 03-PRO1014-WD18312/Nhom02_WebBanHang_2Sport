<?php
function insert_product($name, $price, $discount, $quantity, $iddm, $status, $des, $size1, $size2, $size3, $size4, $size5, $hinh, $hinh1, $hinh2, $hinh3, $hinh4, $color1, $color2, $color3, $color4, $color5){
    $sql = "INSERT INTO product (name, price, discount, img, quantity, des, status, idCategory)
    VALUES ('$name', '$price', '$discount', '$hinh', '$quantity', '$des', '$status', '$iddm');";
    
    $sql .= "INSERT INTO product_infor (image1, image2, image3, image4, size1, size2, size3, size4, size5, color1, color2, color3, color4, color5, idProduct)
    VALUES ('$hinh1', '$hinh2', '$hinh3', '$hinh4', '$size1', '$size2', '$size3', '$size4', '$size5', '$color1', '$color2', '$color3', '$color4', '$color5', LAST_INSERT_ID());";

    pdo_execute($sql);
}
function list_product(){
    $sql = "SELECT * from product order by id";
    $listProduct = pdo_query($sql);
    return $listProduct;
}
function loadone_product($id){
    $sql = "SELECT * from product where id='$id'";
    $result = pdo_query_one($sql);
    return $result;
}
function update_product($id, $name, $price, $discount, $quantity, $iddm, $status, $des, $size1, $size2, $size3, $size4, $size5, $hinh, $hinh1, $hinh2, $hinh3, $hinh4, $color1, $color2, $color3, $color4, $color5){
    $sql = "UPDATE product
    JOIN product_infor ON product.id = product_infor.idProduct
    SET product.name = '$name',
        product.price = '$price',
        product.discount = '$discount',
        product.quantity = '$quantity',
        product.idCategory = '$iddm',
        product.status = '$status',
        product.des = '$des',
        product.img = '$hinh',
        product_infor.size1 = '$size1',
        product_infor.size2 = '$size2',
        product_infor.size3 = '$size3',
        product_infor.size4 = '$size4',
        product_infor.size5 = '$size5',
        product_infor.image1 = '$hinh1',
        product_infor.image2 = '$hinh2',
        product_infor.image3 = '$hinh3',
        product_infor.image4 = '$hinh4',
        product_infor.color1 = '$color1',
        product_infor.color2 = '$color2',
        product_infor.color3 = '$color3',
        product_infor.color4 = '$color4',
        product_infor.color5 = '$color5'
    WHERE product.id = '$id'";
    pdo_execute($sql);
}
function delete_product($id){
    // Tắt ràng buộc khóa ngoại trước khi xóa sau đó bật lại
    $sql = "SET foreign_key_checks = 0;
    DELETE product, product_infor
    FROM product
    LEFT JOIN product_infor ON product.id = product_infor.idproduct
    WHERE product.id = '$id';
    SET foreign_key_checks = 1";
    pdo_execute($sql);
}
function loadone_product_infor($id){
    $sql = "SELECT * from product_infor where idProduct='$id'";
    $result = pdo_query_one($sql);
    return $result;
}
?>