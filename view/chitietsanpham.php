<?php 
    extract($detail);
    if(isset($_POST['addToCart'])){
        $nameSp=$_POST['productName'];
        $priceSp=$_POST['selectedDiscount'];
        $imgSp=$_POST['productImage'];
        $quantity = $_POST['quantity'];
        $id_variant=$_POST['variantId'];
        $idkh=$_SESSION['login']['id'];
        if (isset($_SESSION['login'])) {
            addcart_quantity($nameSp,$priceSp,$imgSp,$quantity,$idkh,$id_variant);
            echo "<script>alert('Thêm giỏ hàng thành công 🛒');
                if (performance.navigation.type == 0) {
                    window.location.href = window.location.href;
                    window.location.href = 'index.php?act=showcart';
                }
                window.location.href = 'index.php?act=showcart';
            </script>";
        }else {
            echo'<script>
                alert("Vui lòng đăng nhập");
            </script>';
        }
    }
?>

<div class="form-detail container">
    <h1>CHI TIẾT SẢN PHẨM</h1>
    <div class="infor-product">
        <form action="" method="POST" class="form">
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
                    <p id="display-percent" class="percent"><?= round(($discount - $price) / 10000) ?>%</p>
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
                <div class="quantity">
                    <p>Số lượng: </p>
                    <div class="number-input">
                        <button type="button" class="btn-minus" onclick="decrement()">-</button>
                        <input type="number" id="quantity" name="quantity" min="1" value="1"/>
                        <button type="button" class="btn-plus" onclick="increment()">+</button>
                    </div>
                </div>
                <input type="hidden" name="productName" value="<?= $name ?>">
                <input type="hidden" name="productImage" value="<?= $img ?>">
                <input type="hidden" name="variantId" id="variantId">
                <input type="hidden" id="selectedColor" name="selectedColor">
                <input type="hidden" id="selectedPrice" name="selectedPrice">
                <input type="hidden" id="selectedDiscount" name="selectedDiscount">
                <input type="hidden" id="selectedSize" name="selectedSize">
                <input type="submit" class="addToCart" name="addToCart" value="THÊM VÀO GIỎ">
                <input type="submit" class="buy" name="buyProduct" value="MUA HÀNG">

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
    document.addEventListener("DOMContentLoaded", function() {
    // Call loadForms with the ID of the first variant
    loadForms(<?php echo $infor[0]['idVariant']; ?>);
    });
    function loadForms(idVariant) {
        // Lấy thông tin từ data-attributes của màu được chọn
        var selectedColor = document.querySelector(`[data-id="${idVariant}"]`);
        var discount = selectedColor.getAttribute("data-discount");
        var price = selectedColor.getAttribute("data-price");
        var size = selectedColor.getAttribute("data-size");
        var percent = (discount - price)/10000;

        // Hiển thị giá, discount và size tương ứng
        document.getElementById("display-discount").innerText = "Giảm giá: " + discount + " đ";
        document.getElementById("display-price").innerText = "Giá: " + price + " đ";
        document.getElementById("display-size").innerText = size;
        document.getElementById("display-percent").innerText = percent + "%";

        document.getElementById("selectedColor").value = selectedColor.style.backgroundColor;
        document.getElementById("selectedPrice").value = price;
        document.getElementById("selectedDiscount").value = discount;
        document.getElementById("selectedSize").value = size;
        document.getElementById("variantId").value = idVariant;
    }
    function increment() {
        var input = document.getElementById('quantity');
        var value = parseInt(input.value, 10);
        input.value = value + 1;
    }

    function decrement() {
        var input = document.getElementById('quantity');
        var value = parseInt(input.value, 10);
        if (value > 0) {
            input.value = value - 1;
        }
    }
</script>
