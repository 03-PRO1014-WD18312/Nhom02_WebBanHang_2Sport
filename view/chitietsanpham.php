<?php 
    extract($detail);
?>

<div class="form-detail container">
    <h1>CHI TIẾT SẢN PHẨM</h1>
    <div class="infor-product">
        <form action="" class="form">
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
                        <div 
                            onclick="loadForms(<?= $idVariant ?>); return false;" 
                            class="color-id" 
                            style="background-color:<?= $color; ?>"
                            data-id="<?= $idVariant; ?>"
                            data-price="<?= $price; ?>"
                            data-size="<?= $size; ?>"
                            data-discount="<?= $discount; ?>"
                        ></div>
                    <?php } ?>
                </div>
            </div>
            <div class="right">
                <h3 class="name-product"><?= $name ?></h3>
                <div class="price">
                    <?php foreach($infor as $row){
                        extract($row);    
                    ?>
                        <p id="display-discount" class="discount">Giảm giá: <?= $discount ?> đ</p>
                        <p id="display-price" class="origin-price">Giá: <?= $price ?> đ</p>
                    <?php break; }?>
                    <!-- <p id="display-percent" class="percent"><?= round(($discount - $price) / 10000) ?>%</p> -->
                </div>
                <div class="choose-color">
                    <p>Chọn màu:</p>
                    <?php foreach($infor as $row){
                        extract($row);    
                    ?>
                        <div 
                            onclick="loadForms(<?= $idVariant ?>); return false;" 
                            class="color-id" 
                            style="background-color:<?= $color; ?>"
                            data-id="<?= $idVariant; ?>"
                            data-price="<?= $price; ?>"
                            data-size="<?= $size; ?>"
                            data-discount="<?= $discount; ?>"
                            data-percent="<?= round(($discount - $price) / 10000); ?>"
                        ></div>
                    <?php } ?>
                </div>
                <div class="choose-size">
                    <p>Size:</p>
                    <?php foreach($infor as $row){
                        extract($row);    
                    ?>
                        <div class="size" id="display-size"><?= $size ?></div>
                    <?php break; }?>
                </div>

                <input type="submit" class="addToCart" value="THÊM VÀO GIỎ">

            </div>
        </form>
    </div>
    <div class="detail-product">
        <h2>Chi tiết sản phẩm</h2>
        <div class="infor">
            <div class="name"><b>Tên: </b><?= $name ?></div>
            <div class="des"><b>Mô tả: </b><?= $des?></div>
        </div>
    </div>
    <div class="comment" width="1360px">
        <h2>Bình luận</h2>
        <iframe src="view/binhluan-form.php?id=<?= $_GET['id'] ?>" frameborder="0" width="100%" height="250px" style="margin-bottom: 50px;"></iframe>
    </div>
    <div class="similar-product">
        <h2>Sản phẩm cùng loại</h2>
        <div class="product-wp">
            <div class="product-ins">
            <?php 
            $product_same_type = load_product_same_type($detail['idCategory'],$_GET['id']);
            foreach ($product_same_type as $sp){
                extract($sp);
            ?>
                <div class="product-item">
                    <div class="detail">
                        <a href="" class="detail-img">
                            <img src="assets/img/<?= $sp['img']?>" alt="">
                        </a>
                        <a href="index.php?act=detail&id=<?= $sp['idProduct']?>" class="detail-show">CHI TIẾT</a>
                    </div>
                    <div class="product-describe">
                        <a href=""><p><?= $sp['name'] ?></p></a>
                        <span class="price-new"><?= number_format($sp['discount'])  ?></span>
                        <span class="price-origin">
                            <del><?=number_format($sp['price'])?></del>
                        </span>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    function loadForms(idVariant) {
        // Lấy thông tin từ data-attributes của màu được chọn
        var selectedColor = document.querySelector(`[data-id="${idVariant}"]`);
        var discount = selectedColor.getAttribute("data-discount");
        var price = selectedColor.getAttribute("data-price");
        var size = selectedColor.getAttribute("data-size");
        var percent = selectedColor.getAttribute("data-percent");

        // Hiển thị giá, discount và size tương ứng
        document.getElementById("display-discount").innerText = "Giảm giá: " + discount + " đ";
        document.getElementById("display-price").innerText = "Giá: " + price + " đ";
        document.getElementById("display-size").innerText = size;
        document.getElementById("display-percent").innerText = percent + "%";
    }
</script>
