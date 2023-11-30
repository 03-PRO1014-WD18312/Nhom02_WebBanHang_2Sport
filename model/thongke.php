<?php 
    function thongke_doanh_thu(){
        $sql="SELECT category.id,category.name, order_info.status,SUM(order_detail.quantity)AS soluongdh,SUM(order_detail.price * order_detail.quantity) AS tongtien FROM category INNER JOIN product ON category.id=product.idCategory INNER JOIN order_detail ON order_detail.idProduct=product.id INNER JOIN order_info ON order_detail.idOrder=order_info.id WHERE order_info.status=3 GROUP BY category.id";
        $thongke_dt=pdo_query($sql);
        return $thongke_dt;
    }
?>