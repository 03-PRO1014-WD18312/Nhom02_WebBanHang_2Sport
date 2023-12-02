<?php 
    //model tìm kiếm tài khoản
    function search_wp($table,$column1,$column2,$keyword, $id){
    $sql="SELECT * FROM $table WHERE ($column1 LIKE '%$keyword%' OR $column2 LIKE '%$keyword%') AND id <> $id";
    $search_wp=pdo_query($sql);
    return $search_wp;
    }
    // tìm kiếm sản phẩm
    function search_product($keyw){
        $sql = "SELECT product.id, product.name, product.img, variants.price, variants.discount
        FROM product 
        JOIN (
            SELECT idProduct, price, discount, id as idVariant
            FROM variants
            GROUP BY idProduct
        ) AS variants ON product.id = variants.idProduct 
        JOIN category ON product.idCategory = category.id where product.name like '%$keyw%'";
        
        $search_wp=pdo_query($sql);
        return $search_wp;
    }

?>