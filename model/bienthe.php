<?php 
function list_color(){
    $sql = "SELECT product_color.color, product_color.id, variants.price, variants.discount, product.name 
    FROM variants 
    JOIN product_color on variants.idColor = product_color.id 
    JOIN product on variants.idProduct = product.id;";
    $result = pdo_query($sql);
    return $result;
}
function list_size(){
    $sql = "SELECT product_size.size1, product_size.size2, product_size.size3, product_size.size4, product_size.id, variants.price, variants.discount, product.name 
    FROM variants 
    JOIN product_size on variants.idSize = product_size.id 
    JOIN product on variants.idProduct = product.id;";
    $result = pdo_query($sql);
    return $result;
}
?>