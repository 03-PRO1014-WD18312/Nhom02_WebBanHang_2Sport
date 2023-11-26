<?php
  session_start();
  include "../model/pdo.php";
  include '../model/sanpham.php';
    $id = '';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $load_size = load_detail($id);
    }else{
        $id = 10;
        $load_size = load_detail($id);
    }

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form-size{
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }
        .size{
            padding: 3px 10px;
            border: 1px solid #000;
        }
        .size:hover{
            background-color: #FF0000;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="form-size"> 
        <select name="" id="">
            <option value="<?= $id ?>"><?= $load_size[0]['size1'] ?></option>
            <?php if(!empty($load_size[0]['size2'])){ ?>
            <option value="<?= $id ?>"><?= $load_size[0]['size2'] ?></option>
            <?php }else{} ?>
            <?php if(!empty($load_size[0]['size3'])){ ?>
            <option value="<?= $id ?>"><?= $load_size[0]['size3'] ?></option>
            <?php }else{} ?>
            <?php if(!empty($load_size[0]['size4'])){ ?>
            <option value="<?= $id ?>"><?= $load_size[0]['size4'] ?></option>
            <?php }else{} ?>
        </select>
    </div>
</body>
</html>