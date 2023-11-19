<?php
if (is_array($sanpham)) {
    extract($sanpham);
}
?>
<main class="container">
    <?php include "boxleft.php" ?>
    <article>
        <div class="add-product">
            <h1>SỬA SẢN PHẨM</h1>
            <form action="index.php?act=updatesp" method="POST" enctype="multipart/form-data">
                <div class="form-add">
                    <div class="left">
                        <input type="text" name="id" value="<?= $id ?>" hidden>
                        <label for="">TÊN SẢN PHẨM</label><br>
                        <input type="text" name="namesp" value="<?= $name ?>"><br>
                        <div class="price">
                            <div class="origin-price">
                                <label for="">GIÁ GỐC</label><br>
                                <input type="text" name="price" value="<?= $price ?>">
                            </div>
                            <div class="discount">
                                <label for="">GIÁ GIẢM</label><br>
                                <input type="text" name="discount" value="<?= $discount ?>">
                            </div>
                        </div>
                        <label for="">SỐ LƯỢNG</label><br>
                        <input type="number" name="quantity" min="0" value="<?= $quantity ?>"><br>
                        <label for="">DANH MỤC</label><br>
                        <select name="iddm" id="category">
                            <?php 
                                foreach ($listdanhmuc as $danhmuc) {
                                    extract($danhmuc);
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                }
                            ?>
                        </select><br>
                        <label for="">TRẠNG THÁI</label><br>
                        <select name="status" id="status">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select><br>
                    </div>
                    <div class="right">
                        <div class="upload-image">
                            <div class="pose-image">
                                <input type="file" name="image1" id="fileInput1" style="margin-bottom: 10px;"/>
                                <input type="file" name="image2" id="fileInput2" style="margin-bottom: 10px;"/>
                                <input type="file" name="image3" id="fileInput3" style="margin-bottom: 10px;"/>
                                <input type="file" name="image4" id="fileInput4" style="margin-bottom: 10px;"/>
                            </div>
                            <div class="main-image">
                                <input type="file" name="image" id="fileInput5">
                                <img src="../assets/img/<?= $img ?>" alt="" width="70px" height="60px">
                            </div>
                        </div>
                        <label for="">MÀU</label>
                        <div class="choose-color">
                            <select name="color1">
                                <option value="">Chọn màu</option>
                                <option value="fff">White</option>
                                <option value="000">Black</option>
                                <option value="ff0000">Red</option>
                                <option value="0000ff">Blue</option>
                            </select>
                            <select name="color2">
                                <option value="">Chọn màu</option>
                                <option value="fff">White</option>
                                <option value="000">Black</option>
                                <option value="ff0000">Red</option>
                                <option value="0000ff">Blue</option>
                            </select>
                            <select name="color3">
                                <option value="">Chọn màu</option>
                                <option value="fff">White</option>
                                <option value="000">Black</option>
                                <option value="ff0000">Red</option>
                                <option value="0000ff">Blue</option>
                            </select>
                            <select name="color4">
                                <option value="">Chọn màu</option>
                                <option value="fff">White</option>
                                <option value="000">Black</option>
                                <option value="ff0000">Red</option>
                                <option value="0000ff">Blue</option>
                            </select>
                            <select name="color5">
                                <option value="">Chọn màu</option>
                                <option value="fff">White</option>
                                <option value="000">Black</option>
                                <option value="ff0000">Red</option>
                                <option value="0000ff">Blue</option>
                            </select>
                        </div>
                        <label for="">SIZE</label>
                        <div class="choose-size">
                            <input type="number" min="0" name="size1" value="<?= $size1 ?>">
                            <input type="number" min="0" name="size2">
                            <input type="number" min="0" name="size3">
                            <input type="number" min="0" name="size4">
                            <input type="number" min="0" name="size5">
                        </div>
                    </div>
                </div>
                <label for="">MÔ TẢ</label><br>
                <textarea name="des" id="des" cols="50" rows="10"><?= $des ?></textarea>
                <input type="submit" value="SỬA SẢN PHẨM" name="updateProduct">
                <input type="reset" value="NHẬP LẠI"><br>
                <?php
                    if (isset($messSuccess) && $messSuccess!='') {
                        echo $messSuccess;
                    }
                ?>
            </form>
        </div>
    </article>
</main>