<?php 
    function rating_rate($idkh, $id_product, $content_rate, $rating){
        $sql="INSERT INTO `rate`(`id_account`, `id_product`, `rating`, `content_rate`, `date_rate`) VALUES ('$idkh','$id_product','$rating','$content_rate',CURRENT_DATE())";
        pdo_execute($sql);
    }
    
?>