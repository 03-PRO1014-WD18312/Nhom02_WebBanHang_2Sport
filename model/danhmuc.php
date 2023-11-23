<?php
function insert_category($name, $hinh){
    $sql = "INSERT INTO category (name, img) values ('$name', '$hinh')";
    pdo_execute($sql);
}
function update_category($id, $name, $hinh){
    if($hinh != ""){
        $sql = "UPDATE category set name = '$name', img = '$hinh' where id = '$id'";
    }else{
        $sql = "UPDATE category set name = '$name' where id = '$id'";
    }
    pdo_execute($sql);
}
function list_category(){
    $sql = "SELECT * from category order by id";
    $listCate = pdo_query($sql);
    return $listCate;
}
function loadone_category($id){
    $sql = "SELECT * from category where id='$id'";
    $result = pdo_query_one($sql);
    return $result;
}
function delete_category($id){
    $sql = "DELETE from category where id = $id";
    pdo_execute($sql);
}
function join_sp_dm($id){
    $sql = "SELECT * FROM product JOIN category ON product.idCategory = category.id WHERE product.id = $id";
    $dssp=pdo_query($sql);
    return $dssp;
}
?>