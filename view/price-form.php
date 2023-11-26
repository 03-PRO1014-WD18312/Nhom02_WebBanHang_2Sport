<?php
  session_start();
  include "../model/pdo.php";
  include '../model/sanpham.php';
    
    if(isset($_GET['id'])){
        $load_price = load_detail($_GET['id']);
    }else{
        $load_price = load_detail(10);
    }
    
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form-price{
            display: flex;
            gap: 15px;
        }
        .discount{
            color: #FF0000;
            font-size: 22px;
            font-weight: bold;
        }
        .price{
            color: #575757;
            font-size: 15px;
            font-weight: bold;
            text-decoration-line: line-through;
        }
        .percent{
            color: #fff;
            background-color: #000;
            font-size: 15px;
            font-weight: bold;
            padding: 5px 7px;
            margin-left: 10px;
            position: absolute;
            top: -5px;
            left: 200px;
        }
    </style>
</head>
<body>
    <div class="form-price"> 
        
        <div class="discount"><?= number_format($load_price[0]['discount']) ?> đ</div>
        <div class="price"><?= number_format($load_price[0]['price']) ?> đ</div>
        <p class="percent"><?= ($load_price[0]['discount']-$load_price[0]['price'])/10000 ?>%</p>
    </div>
</body>
</html>