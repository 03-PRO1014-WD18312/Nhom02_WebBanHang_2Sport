<?php 
function load_thongke_sanpham_danhmuc(){
    $sql = "SELECT
                c.id AS category_id,
                c.name AS category_name,
                COUNT(v.id) AS variant_count,
                MIN(v.discount) AS min_price,
                MAX(v.discount) AS max_price,
                AVG(v.discount) AS avg_price
            FROM
                category c
            JOIN
                product p ON c.id = p.idCategory
            JOIN
                variants v ON p.id = v.idProduct
            GROUP BY
                c.id, c.name order by variant_count desc;";
    return pdo_query($sql);
}
?>