<?php 
    function rating_rate($idkh, $id_product, $content_rate, $rating){
        $sql="INSERT INTO `rate`(`id_account`, `id_product`, `rating`, `content_rate`, `date_rate`) VALUES ('$idkh','$id_product','$rating','$content_rate',CURRENT_DATE())";
        pdo_execute($sql);
    }

    //hiển thị đánh giá sản phẩm
    function showRating($id_product){
        $sql="SELECT account.name,account.img, rate.rating, rate.content_rate, rate.date_rate FROM `rate` INNER JOIN account ON account.id=rate.id_account INNER JOIN product ON rate.id_product=product.id WHERE rate.id_product=$id_product";
        $showRating=pdo_query($sql);
        return $showRating;
    }
    
?>