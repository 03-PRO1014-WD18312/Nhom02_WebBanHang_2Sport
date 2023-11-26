<?php
function insert_product($name, $iddm, $status, $des, $prices, $discounts, $quantitys, $sizes, $colors, $hinh){
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
    foreach ($sizes as $size) {
        $sql_array[] = "INSERT INTO product_size (size) VALUES ('$size')";
        // Lấy ID màu được chèn cuối cùng
        $sql_array[] = "SET @lastSizeId$sizeCounter = LAST_INSERT_ID()";
        $sizeCounter++;
    }
    // Reset bộ đếm
    $colorCounter = 1;
    $sizeCounter = 1;
    $count = count($colors);
    for ($i = 0; $i < $count; $i++) {
        $quantity = $quantitys[$i];
        $price = $prices[$i];
        $discount = $discounts[$i];
        $sql_array[] = "INSERT INTO variants (price, quantity, discount, idProduct, idSize, idColor) VALUES ('$price', '$quantity', '$discount', @lastProductId, @lastSizeId$sizeCounter, @lastColorId$colorCounter)";
        // Tăng bộ đếm
        $colorCounter++;
        $sizeCounter++;
    }
    pdo_execute_multi($sql_array);
}
function update_product($id, $iddm, $name, $status, $des, $hinh, $prices, $discounts, $quantitys, $colors, $sizes){
    $sql_array = array();
    
    // Update bảng product
    if($hinh != ""){
        $sql_array[] = "UPDATE product SET name = '$name', idCategory = '$iddm', status = '$status', des = '$des', img = '$hinh' WHERE id = '$id'";
    }else{
        $sql_array[] = "UPDATE product SET name = '$name', idCategory = '$iddm', status = '$status', des = '$des' WHERE id = '$id'";
    }

    // Update variants, product_size, and product_color 
    $count = count($colors);
    for ($i = 0; $i < $count; $i++) {
        $quantity = $quantitys[$i];
        $price = $prices[$i];
        $size = $sizes[$i];
        $color = $colors[$i];
        $discount = $discounts[$i];

        // Update product_color tại dòng hiện tại
        $sql_array[] = "UPDATE product_color 
                        SET color = '$color' 
                        WHERE id = (SELECT idColor FROM variants WHERE idProduct = '$id' LIMIT 1 OFFSET $i);";

        // Update product_size tại dòng hiện tại
        $sql_array[] = "UPDATE product_size 
                        SET size = '$size'
                        WHERE id = (SELECT idSize FROM variants WHERE idProduct = '$id' LIMIT 1 OFFSET $i);";

        // Update variants tại dòng hiện tại
        $sql_array[] = "UPDATE variants 
                SET price = '$price', quantity = '$quantity', discount = '$discount'
                WHERE idProduct = '$id' AND id = (SELECT id FROM variants WHERE idProduct = '$id' LIMIT 1 OFFSET $i);";
    }

    pdo_execute_multi($sql_array);
}
function select_update_product($id){
    $sql = "SELECT product.id as idProduct, product.name, product.status, product.img, product.des, product.idCategory, 
    variants.id, variants.price, variants.discount, variants.quantity, product_color.color, product_size.size
    FROM variants 
    JOIN product ON variants.idProduct = product.id 
    JOIN product_size ON variants.idSize = product_size.id 
    JOIN product_color ON variants.idColor = product_color.id 
    WHERE product.id = $id";
    $result = pdo_query($sql);
    return $result;
}
function count_update($id){
    $sql = "SELECT quantity FROM variants JOIN product on variants.idProduct = product.id WHERE product.id = $id;";
    $result = pdo_query($sql);
    return $result;
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
    $sql = "SELECT category.id as idCategory, product.id, product.name, product.img, product.des, product.view, product.status, category.name as cateName
    from product join category on product.idCategory = category.id where product.id = '$id'";
    $result = pdo_query_one($sql);
    return $result;
}
function loadone_product_infor($id){
    $sql = "SELECT 
    variants.id as idVariant, 
    variants.price, 
    variants.discount, 
    variants.quantity, 
    product_size.id, product_size.size,
    product_color.id as idColor, product_color.color 
    from variants 
    join product_size on variants.idSize = product_size.id
    join product_color on variants.idColor = product_color.id
    where variants.idProduct='$id'";
    $result = pdo_query($sql);
    return $result;
}
function load_product_same_type($idCategory,$id){
    $sql = "SELECT category.id as idCategory, product.id as idProduct, product.name, product.img, variants.price, variants.discount, variants.id, variants.idSize, variants.idColor, product_color.color, product_size.size 
    FROM product 
    JOIN (
        SELECT idProduct, price, discount, id , idSize, idColor
        FROM variants
        GROUP BY idProduct
    ) AS variants ON product.id = variants.idProduct 
    JOIN category ON product.idCategory = category.id 
    JOIN product_size ON variants.idSize=product_size.id
    JOIN product_color ON variants.idColor=product_color.id
    WHERE product.idCategory = $idCategory and product.id <> $id limit 10";
    $result = pdo_query($sql);
    return $result;
}
function load_detail($id){
    $sql = "SELECT variants.id, product.name, product.img, variants.price, variants.discount, product_color.color, 
    product_size.size
    FROM product 
    JOIN variants on variants.idProduct = product.id 
    JOIN product_size on product_size.id = variants.idSize 
    JOIN product_color on product_color.id = variants.idColor 
    WHERE variants.id = $id;";
    $result = pdo_query($sql);
    return $result;
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
function list_sanpham_danhmuc($id){
    $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount, category_main.name 
    AS category_name FROM product JOIN category AS category_main ON product.idCategory = category_main.id 
    JOIN ( SELECT idProduct, price, discount, id as idVariant FROM variants GROUP BY idProduct ) AS variants 
    ON product.id = variants.idProduct JOIN category AS category_variants 
    ON product.idCategory = category_variants.id WHERE product.idCategory = $id";
    $result = pdo_query($sql);
    return $result;
}
// function list_danhmuc_sanpham($id){
//     $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount
//     FROM product 
//     JOIN (
//         SELECT idProduct, price, discount, id as idVariant
//         FROM variants
//         GROUP BY idProduct
//     ) AS variants ON product.id = variants.idProduct 
//     JOIN category ON product.idCategory = category.id 
//     WHERE product.idCategory = $id";
// }
function list_giay(){
    $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount, variants.id, variants.idSize, variants.idColor, product_color.color, product_size.size 
    FROM product 
    JOIN (
        SELECT idProduct, price, discount, id , idSize, idColor
        FROM variants
        GROUP BY idProduct
    ) AS variants ON product.id = variants.idProduct 
    JOIN category ON product.idCategory = category.id 
    JOIN product_size ON variants.idSize=product_size.id
    JOIN product_color ON variants.idColor=product_color.id
    WHERE product.idCategory = 4";
    $result = pdo_query($sql);
    return $result;
}
function list_gang(){
    $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount, variants.id, variants.idSize, variants.idColor, product_color.color, product_size.size 
    FROM product 
    JOIN (
        SELECT idProduct, price, discount, id , idSize, idColor
        FROM variants
        GROUP BY idProduct
    ) AS variants ON product.id = variants.idProduct 
    JOIN category ON product.idCategory = category.id 
    JOIN product_size ON variants.idSize=product_size.id
    JOIN product_color ON variants.idColor=product_color.id
    WHERE product.idCategory = 5 LIMIT 5";
    $result = pdo_query($sql);
    return $result;
}
function list_quanao(){
    $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount, variants.id, variants.idSize, variants.idColor, product_color.color, product_size.size 
    FROM product 
    JOIN (
        SELECT idProduct, price, discount, id , idSize, idColor
        FROM variants
        GROUP BY idProduct
    ) AS variants ON product.id = variants.idProduct 
    JOIN category ON product.idCategory = category.id 
    JOIN product_size ON variants.idSize=product_size.id
    JOIN product_color ON variants.idColor=product_color.id
    WHERE product.idCategory = 6 LIMIT 5";
    $result = pdo_query($sql);
    return $result;
}
function list_ball(){
    $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount, variants.id, variants.idSize, variants.idColor, product_color.color, product_size.size 
    FROM product 
    JOIN (
        SELECT idProduct, price, discount, id , idSize, idColor
        FROM variants
        GROUP BY idProduct
    ) AS variants ON product.id = variants.idProduct 
    JOIN category ON product.idCategory = category.id 
    JOIN product_size ON variants.idSize=product_size.id
    JOIN product_color ON variants.idColor=product_color.id
    WHERE product.idCategory = 7 LIMIT 5";
    $result = pdo_query($sql);
    return $result;
}
function tang_luot_xem($id){
    $sql = "UPDATE product set view = view + 1 where id = $id";
    pdo_execute($sql);
}
?>