<main class="container">
    <?php include "boxleft.php" ?>
    <article>
        <div class="add-product">
            <h1>THÊM MỚI SẢN PHẨM</h1>
            <form action="">
                <div class="form-add">
                    <div class="left">
                        <label for="">MÃ SẢN PHẨM</label><br>
                        <input type="text"><br>
                        <label for="">TÊN SẢN PHẨM</label><br>
                        <input type="text"><br>
                        <div class="price">
                            <div class="origin-price">
                                <label for="">GIÁ GỐC</label><br>
                                <input type="text">
                            </div>
                            <div class="discount">
                                <label for="">GIÁ GIẢM</label><br>
                                <input type="text">
                            </div>
                        </div>
                        <label for="">SỐ LƯỢNG</label><br>
                        <input type="number"><br>
                        <label for="">DANH MỤC</label><br>
                        <select name="" id="category">
                            <option value="">Danh mục 1</option>
                            <option value="">Danh mục 2</option>
                        </select><br>
                        <label for="">TRẠNG THÁI</label><br>
                        <select name="" id="status">
                            <option value="">Trạng thái 1</option>
                            <option value="">Trạng thái 2</option>
                        </select><br>
                    </div>
                    <div class="right">
                        <div class="upload-image">
                            <div class="pose-image">
                                <label for="fileInput1" class="custom-file-input">Ảnh phụ 1</label>
                                <input type="file" id="fileInput1" style="display: none;" />
                                <label for="fileInput2" class="custom-file-input">Ảnh phụ 2</label>
                                <input type="file" id="fileInput2" style="display: none;" />
                                <label for="fileInput3" class="custom-file-input">Ảnh phụ 3</label>
                                <input type="file" id="fileInput3" style="display: none;" />
                                <label for="fileInput4" class="custom-file-input">Ảnh phụ 4</label>
                                <input type="file" id="fileInput4" style="display: none;" />
                            </div>
                            <div class="main-img">
                                <input type="file">
                            </div>
                        </div>
                        <label for="">MÀU</label>
                        <div class="choose-color">
                            <input type="checkbox">
                            <label for="">Màu trắng</label>
                            <input type="checkbox">
                            <label for="">Màu đen</label>
                            <input type="checkbox">
                            <label for="">Màu đỏ</label>
                            <input type="checkbox">
                            <label for="">Màu vàng</label>
                        </div>
                        <label for="">SIZE</label>
                        <div class="choose-size">
                            <input type="number" min="0">
                            <input type="number" min="0">
                            <input type="number" min="0">
                            <input type="number" min="0">
                        </div>
                    </div>
                </div>
                <label for="">MÔ TẢ</label><br>
                <textarea name="" id="des" cols="50" rows="10"></textarea>
                <input type="submit" value="THÊM SẢN PHẨM">
                <input type="reset" value="NHẬP LẠI">
            </form>
        </div>
    </article>
</main>