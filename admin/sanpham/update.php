<?php
// var_dump($sanpham);
// extract($sanpham);
$i = 0;
?>
<main class="container">
    <?php include "boxleft.php" ?>
    <article>
        <div class="add-product">
            <h1>SỬA SẢN PHẨM</h1>
            <form action="index.php?act=updatesp" method="POST" enctype="multipart/form-data">
                <div class="form-add">
                    <div class="left">
                        <input type="hidden" name="id" value="<?= $sanpham[0]['id'] ?>">
                        <label for="">TÊN SẢN PHẨM</label><br>
                        <input type="text" name="namesp" placeholder="Nhập tên sản phẩm" value="<?= $sanpham[0]['name'] ?>"><br>
                        <br>
                        <label for="">DANH MỤC</label><br>
                        <select name="iddm" id="category">
                        <?php 
                            foreach ($selectdm as $danhmuc) {?>
                            <option value="<?= $danhmuc['idCategory'] ?>"<?= ($danhmuc['idCategory']) ?'selected':""?> ><?= $danhmuc['name'] ?></option>
                            <?php }
                        ?>
                        </select><br><br>
                        <label for="">TRẠNG THÁI</label><br>
                        <select name="status" id="status">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select><br><br>
                    </div>
                    <div class="right">
                            <div class="main-image">
                                <label for="fileInput5" class="main-file-input"><i class="fa-solid fa-upload"></i>Ảnh chính</label>
                                <input type="file" name="image" id="fileInput5" style="display: none;">
                            </div>
                            <div class="textarea-sp">
                                <label for="">MÔ TẢ</label><br>
                                <textarea name="des" id="des" cols="50" rows="7" placeholder="Nhập mô tả"><?= $sanpham[0]['des']?></textarea>
                            </div>
                    </div>
                </div>
                <div class="variant-wp">
                    <label for="">SẢN PHẨM BIẾN THỂ</label><br>
                    <hr>
                    <div id="container">
                        <?php foreach ($count as $row){
                            
                        ?>
                        <div class="variant">
                            <div class="variant-in">
                                <label for="">Kích cỡ</label></br>
                                <input type="text" list="size" name="size[]" placeholder="Nhập size" value="<?= $sanpham[$i]['size'] ?>">
                            </div>
                            <div class="variant-in">
                                <label for="">Màu</label></br>
                                <input type="text" list="color" name="color[]" placeholder="Nhập màu" value="<?= $sanpham[$i]['color'] ?>">
                            </div>
                            <div class="variant-in">
                                <label for="">Giá gốc</label></br>
                                <input type="number" name="price[]" placeholder="Nhập giá gốc" value="<?= $sanpham[$i]['price'] ?>">
                            </div>
                            <div class="variant-in">
                                <label for="">Giá khuyến mãi</label></br>
                                <input type="number" name="priceSale[]" placeholder="Nhập giá sale" value="<?= $sanpham[$i]['discount'] ?>">
                            </div>
                            <div class="variant-in">
                                <label for="">Số lượng</label></br>
                                <input type="number" name="quantity[]" min="1" value="<?= $sanpham[$i]['quantity'] ?>" placeholder="Nhập số lượng" >
                            </div>
                        </div>
                        <?php $i++; } ?>
                    </div>
                    <datalist id="size">
                        <option value="39">
                        <option value="40">
                        <option value="41">
                        <option value="42">
                        <option value="43">
                        <option value="M">
                        <option value="S">
                        <option value="L">
                        <option value="XL">
                        <option value="XXL">
                    </datalist>
                    <datalist id="color">
                        <option value="blue">
                        <option value="green">
                        <option value="red">
                        <option value="white">
                        <option value="yellow">
                        <option value="black">
                    </datalist>
                </div>
                <input type="submit" class="submit" value="SỬA SẢN PHẨM" name="updateProduct">
                <input type="reset" class="reset" value="NHẬP LẠI">
            </form>
        </div>
    </article>
</main>
        