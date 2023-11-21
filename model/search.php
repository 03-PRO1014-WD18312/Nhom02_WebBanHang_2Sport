<?php 
    //model tìm kiếm 
    function search_wp($table,$column1,$column2,$keyword, $id){
    $sql="SELECT * FROM $table WHERE ($column1 LIKE '%$keyword%' OR $column2 LIKE '%$keyword%') AND id <> $id";
    $search_wp=pdo_query($sql);
    return $search_wp;
    }
?>