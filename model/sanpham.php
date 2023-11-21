<?php
function insert_product($name, $iddm, $status, $des, $prices, $discounts, $quantitys,  $sizes, $colors, $hinh){
    // Insert into product
    $sql_array = array("INSERT INTO product (name, idCategory, status, img, des) VALUES ('$name', '$iddm', '$status', '$hinh', '$des')");
    // Nhận ID sản phẩm được chèn cuối cùng
    $sql_array[] = "SET @lastProductId = LAST_INSERT_ID()";
    // Khởi tạo bộ đếm
    $colorCounter = 1;
    $sizeCounter = 1;
    // Lặp qua từng màu và chèn vào product_color
    foreach ($colors as $color) {
        $sql_array[] = "INSERT INTO product_color (color) VALUES ('$color')";
        // Lấy ID màu được chèn cuối cùng
        $sql_array[] = "SET @lastColorId$colorCounter = LAST_INSERT_ID()";
        $colorCounter++;
    }
    // Lặp qua từng kích thước và chèn vào product_size
    foreach ($sizes as $size) {
        $sql_array[] = "INSERT INTO product_size (size) VALUES ('$size')";
        // Lấy ID size được chèn cuối cùng
        $sql_array[] = "SET @lastSizeId$sizeCounter = LAST_INSERT_ID()";
        $sizeCounter++;
    }
    // Reset counters
    $colorCounter = 1;
    $sizeCounter = 1;
    // Lặp qua các kích thước và số lượng để chèn vào các biến thể bằng cách sử dụng vòng lặp for
    $count = count($sizes);
    for ($i = 0; $i < $count; $i++) {
        $quantity = $quantitys[$i];
        $price = $prices[$i];
        $discount = $discounts[$i];
        // Insert into variants
        $sql_array[] = "INSERT INTO variants (price, quantity, discount, idProduct, idSize, idColor) VALUES ('$price', '$quantity', '$discount', @lastProductId, @lastSizeId$sizeCounter, @lastColorId$colorCounter)";
        // Tăng bộ đếm
        $colorCounter++;
        $sizeCounter++;
    }
    pdo_execute_multi($sql_array);
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
function detail_product($id){
    $sql = "SELECT product.id, product.name, product.img, product.des, product.status, category.name as cateName
    from product join category on product.idCategory = category.id where product.id = '$id'";
    $result = pdo_query_one($sql);
    return $result;
}
function loadone_product_infor($id){
    $sql = "SELECT 
    variants.id, 
    variants.price, 
    variants.discount, 
    variants.quantity, 
    product_size.id, product_size.size,
    product_color.id, product_color.color 
    from variants 
    join product_size on variants.idSize = product_size.id
    join product_color on variants.idColor = product_color.id
    where variants.idProduct='$id'";
    $result = pdo_query($sql);
    return $result;
}
function update_product($id, $name, $price, $discount, $quantity, $iddm, $status, $des, $size1, $size2, $size3, $size4, $size5, $hinh, $hinh1, $hinh2, $hinh3, $hinh4, $color1, $color2, $color3, $color4, $color5){
    
}
function delete_product($id){
    // Tắt ràng buộc khóa ngoại trước khi xóa sau đó bật lại
    $sql = "SET foreign_key_checks = 0;

    DELETE variants, product_color, product_size
    FROM variants
    LEFT JOIN product_color ON variants.idColor = product_color.id
    LEFT JOIN product_size ON variants.idSize = product_size.id
    WHERE variants.idProduct = '$id';
    
    DELETE FROM product
    WHERE id = '$id';
    
    SET foreign_key_checks = 1;";

    pdo_execute($sql);
}
function lista(){
    $sql = "select * from product where idCategory = 4";
    $result = pdo_query($sql);
    return $result;
}
function list_giay(){
    $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount 
    FROM product 
    JOIN (
        SELECT idProduct, price, discount
        FROM variants
        GROUP BY idProduct
    ) AS variants ON product.id = variants.idProduct 
    JOIN category ON product.idCategory = category.id 
    WHERE product.idCategory = 4";
    $result = pdo_query($sql);
    return $result;
}
function list_gang(){
    $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount 
    FROM product 
    JOIN (
        SELECT idProduct, price, discount
        FROM variants
        GROUP BY idProduct
    ) AS variants ON product.id = variants.idProduct 
    JOIN category ON product.idCategory = category.id 
    WHERE product.idCategory = 5";
    $result = pdo_query($sql);
    return $result;
}
function list_quanao(){
    $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount 
    FROM product 
    JOIN (
        SELECT idProduct, price, discount
        FROM variants
        GROUP BY idProduct
    ) AS variants ON product.id = variants.idProduct 
    JOIN category ON product.idCategory = category.id 
    WHERE product.idCategory = 6";
    $result = pdo_query($sql);
    return $result;
}
function list_ball(){
    $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount 
    FROM product 
    JOIN (
        SELECT idProduct, price, discount
        FROM variants
        GROUP BY idProduct
    ) AS variants ON product.id = variants.idProduct 
    JOIN category ON product.idCategory = category.id 
    WHERE product.idCategory = 7";
    $result = pdo_query($sql);
    return $result;
}
?>