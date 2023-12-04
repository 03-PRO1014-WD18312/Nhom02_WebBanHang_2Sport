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
    
    if (isset($_POST['buyProduct'])) {
        $nameSp=$_POST['productName'];
        $priceSp=$_POST['selectedDiscount'];
        $imgSp=$_POST['productImage'];
        $quantity = $_POST['quantity'];
        $id_variant=$_POST['variantId'];

        $idkh=$_SESSION['login']['id'];
        $on_size_color_variant=on_size_color_variant($id_variant);
        $colorSp=$on_size_color_variant[0]['color'];
        $sizeSp=$on_size_color_variant[0]['size'];
        $order=[$nameSp,$priceSp,$imgSp,$quantity,$id_variant,$idkh,$colorSp,$sizeSp];
        $_SESSION['order']=$order;
        echo "<script>
                window.location.href = 'index.php?act=order';
            </script>";
        exit();
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
                <?php
                $uniqueColors = array(); // Mảng để lưu trữ các màu duy nhất
                foreach ($infor as $row) {
                    extract($row);
                    // Kiểm tra xem màu đã xuất hiện chưa
                    if (!in_array($color, $uniqueColors)) {
                        array_push($uniqueColors, $color); // Thêm màu vào danh sách duy nhất
                        ?>
                        <div
                            onclick="loadForms('<?= $color ?>'); return false;"
                            class="color-id"
                            style="background-color:<?= $color; ?>"
                            data-color="<?= $color; ?>"
                        ></div>
                    <?php } ?>
                <?php } ?>
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
                    <?php
                    $uniqueColors = array(); // Mảng để lưu trữ các màu duy nhất
                    foreach ($infor as $row) {
                        extract($row);
                        // Kiểm tra xem màu đã xuất hiện chưa
                        if (!in_array($color, $uniqueColors)) {
                            array_push($uniqueColors, $color); // Thêm màu vào danh sách duy nhất
                            ?>
                            <div
                                onclick="loadForms('<?= $color ?>'); return false;"
                                class="color-id"
                                style="background-color:<?= $color; ?>"
                                data-color="<?= $color; ?>"
                            ></div>
                        <?php } ?>
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
                <input type="text" name="productName" value="<?= $name ?>">
                <input type="text" name="productImage" value="<?= $img ?>">
                <input type="text" name="variantId" id="variantId">
                <input type="text" id="selectedColor" name="selectedColor">
                <input type="text" id="selectedPrice" name="selectedPrice">
                <input type="text" id="selectedDiscount" name="selectedDiscount">
                <input type="text" id="selectedSize" name="selectedSize">
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
    document.addEventListener("DOMContentLoaded", function () {
        // Gọi hàm loadForms với màu đầu tiên trong danh sách
        loadForms('<?= $infor[0]['color']; ?>');
    });

    function loadForms(selectedColor) {
        var variants = <?= json_encode($infor); ?>;
        var selectedVariants = variants.filter(function (variant) {
            return variant.color === selectedColor;
        });

        var sizeContainer = document.querySelector('.choose-size');
        sizeContainer.innerHTML = '<p>Size:</p>';

        selectedVariants.forEach(function (variant) {
            var sizeDiv = document.createElement('div');
            sizeDiv.className = 'size';
            sizeDiv.innerText = variant.size;
            sizeDiv.onclick = function () {
                // Gọi hàm để hiển thị giá và thông tin liên quan khi size được chọn
                displayVariantInfo(variant);
            };
            sizeContainer.appendChild(sizeDiv);
        });

        // Hiển thị thông tin đầu tiên trong danh sách size
        if (selectedVariants.length > 0) {
            displayVariantInfo(selectedVariants[0]);
        } else {
            // Nếu không có size nào, ẩn thông tin
            clearVariantInfo();
        }
    }

    function displayVariantInfo(variant) {
        document.getElementById("selectedColor").value = variant.color;
        document.getElementById("selectedPrice").value = variant.price;
        document.getElementById("selectedDiscount").value = variant.discount;
        document.getElementById("selectedSize").value = variant.size;
        document.getElementById("variantId").value = variant.id; // Chỉnh sửa đây

        // Hiển thị giá, discount và size tương ứng
        document.getElementById("display-discount").innerText = "Giảm giá: " + variant.discount + " đ";
        document.getElementById("display-price").innerText = "Giá: " + variant.price + " đ";
        document.getElementById("display-size").innerText = variant.size;
        document.getElementById("display-percent").innerText = (variant.discount - variant.price) / 10000 + "%";
    }

    function clearVariantInfo() {
        // Ẩn thông tin khi không có size nào được chọn
        document.getElementById("selectedColor").value = "";
        document.getElementById("selectedPrice").value = "";
        document.getElementById("selectedDiscount").value = "";
        document.getElementById("selectedSize").value = "";
        document.getElementById("variantId").value = "";

        document.getElementById("display-discount").innerText = "";
        document.getElementById("display-price").innerText = "";
        document.getElementById("display-size").innerText = "";
        document.getElementById("display-percent").innerText = "";
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
