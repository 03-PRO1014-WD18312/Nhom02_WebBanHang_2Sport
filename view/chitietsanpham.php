<?php 
    extract($detail);
?>
<div class="form-detail">
    <h1>CHI TIẾT SẢN PHẨM</h1>
    <div class="infor-product">
        <div class="left">
            <div class="image-product">
                <div class="main-image">
                    <img src="assets/img/<?= $img ?>" alt="" width="400px" height="360px">
                </div>
            </div>
            <div class="color-product">
                <?php foreach($infor as $row){
                    extract($row);    
                ?>
                <div style="background-color:<?= $color ?>;"></div>
                <?php } ?>
            </div>
        </div>
        <div class="right">
            <h3 class="name-product"><?= $name ?></h3>
            <div class="price">
                <?php foreach($infor as $row){
                    extract($row);    
                ?>
                <p class="discount"><?= $discount ?></p>
                <p class="origin-price"><?= $price ?></p>
                <p class="percent"><?= ($discount-$price)/10000 ?>%</p>
                <?php } ?>
            </div>
            <div class="choose-color">
                <p>Chọn màu:</p>
                <?php foreach($infor as $row){
                    extract($row);    
                ?>
                <div style="background-color:<?= $color ?>;"></div>
                <?php } ?>
            </div>
            <div class="choose-size">
                <p>Chọn size:</p>
                <?php foreach($infor as $row){
                    extract($row);    
                ?>
                <div class="size1"><?= $size ?></div>
                <?php } ?>
            </div>
            <form action="">
                <input type="button" class="addToCart" value="THÊM VÀO GIỎ">
                <input type="button" class="buy" value="MUA NGAY">
            </form>
        </div>
    </div>
    <div class="detail-product">
        <h2>Chi tiết sản phẩm</h2>
        <div class="infor">
            <div class="name"><b>Tên: </b><?= $name ?></div>
            <div class="des"><b>Mô tả: </b><?= $des?></div>
            
        </div>
    </div>
    <div class="comment">
        <h2>Bình luận</h2>
    </div>
    <div class="similar-product">

    </div>
</div>