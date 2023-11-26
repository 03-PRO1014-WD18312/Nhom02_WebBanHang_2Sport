<?php 
    extract($detail);
?>
<div class="form-detail container">
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
                    <div onclick="loadForms(<?= $idVariant ?>); return false;" class="color-id" style="background-color:<?= $color ?>;"></div>
                <?php } ?>
            </div>
        </div>
        <div class="right">
            <h3 class="name-product"><?= $name ?></h3>
            <div class="price">
                
                <iframe id="priceIframe" src="view/price-form.php" frameborder="0" width="100%" height="70px"></iframe>
                
            </div>
            <div class="choose-color">
                <p>Chọn màu:</p>
                <?php foreach($infor as $row){
                    extract($row);    
                ?>
                    <div onclick="loadForms(<?= $idVariant ?>); return false;" class="color-id" style="background-color:<?= $color ?>;"></div>
                <?php } ?>
            </div>
            <div class="choose-size">
                <p>Chọn size:</p>
                <iframe id="sizeIframe" src="view/size-form.php" frameborder="0" width="400px" height="70px"></iframe>
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
        loadPriceForm(idVariant);
        loadSizeForm(idVariant);
        // Thêm các hàm khác nếu bạn muốn thực hiện thêm chức năng
    }

    function loadPriceForm(idVariant) {
        fetch('view/price-form.php?id=' + idVariant, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('priceIframe').contentDocument.body.innerHTML = data;
        })
        .catch(error => {
            console.error('Lỗi khi tải dữ liệu:', error);
        });
    }

    function loadSizeForm(idVariant) {
        fetch('view/size-form.php?id=' + idVariant, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('sizeIframe').contentDocument.body.innerHTML = data;
        })
        .catch(error => {
            console.error('Lỗi khi tải dữ liệu:', error);
        });
    }

    function loadColorForm() {
        // Thực hiện các bước tương tự để tải form màu
    }
</script>

