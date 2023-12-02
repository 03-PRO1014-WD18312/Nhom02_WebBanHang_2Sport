<main class="container">
    <h2 class="name-cate">Danh mục:</h2>
    <div class="extra">
        <div class="list-cate">
            <?php foreach($listCategory as $row){
                extract($row);
            ?>
                <a href="index.php?act=sanpham&id=<?= $id ?>"><?= $name ?></a>
            <?php } ?>
        </div>
        <div class="filter" id="filterContainer">
            <i class="fa-solid fa-filter" id="filterIcon"></i>
            <div class="filter-options" id="filterOptions">
                <a href="" class="filter-link">Được xem nhiều nhất</a>
                <a href="#" class="filter-link">Từ giá thấp đến cao</a>
                <a href="#" class="filter-link">Từ giá cao đến thấp</a>
            </div>
        </div>
    </div>
    <div class="product-wp">
        <h3>Kết quả tìm kiếm từ khóa " <?= $keyw ?> "</h3>
        <div class="product-ins">
        <?php 
        foreach ($listSearch as $sp){
            extract($sp);
        ?>
            <div class="product-item">
                <div class="detail">
                    <a href="" class="detail-img">
                        <img src="assets/img/<?= $img ?>" alt="">
                    </a>
                    <a href="index.php?act=detail&id=<?= $id ?>" class="detail-show">CHI TIẾT</a>
                </div>
                <div class="product-describe">
                    <a href=""><p><?= $name ?></p></a>
                    <span class="price-new"><?= number_format($discount) ?>đ</span>
                    <span class="price-origin">
                        <del><?= number_format($price) ?>đ</del>
                    </span>
                </div>
                <div class="buy-cart">
                    <form action="index.php?act=addcart" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_variant" value="<?= $idVariant ?>">
                        <input type="hidden" name="ten_sp" value="<?= $name ?>">
                        <input type="hidden" name="price" value="<?= $discount ?>">
                        <input type="hidden" name="imgsp" value="<?= $img ?>">
                        <!-- <input type="hidden" name="colorsp" value="<?= $color ?>">
                        <input type="hidden" name="sizesp" value="<?= $size ?>"> -->
                        <button type="submit" class="addcart-product"><i class="fa-solid fa-cart-plus fa-shake"></i></button>
                    </form>
                    <a href="" class="buy-product"><button>MUA HÀNG</button></a>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</main>
<script>
    var filterContainer = document.getElementById('filterContainer');
    var filterOptions = document.getElementById('filterOptions');

    // Hiển thị dropdown khi di chuột vào biểu tượng
    filterContainer.addEventListener('mouseenter', function() {
        filterOptions.style.display = 'block';
    });

    // Ẩn dropdown khi di chuột ra khỏi biểu tượng
    filterContainer.addEventListener('mouseleave', function() {
        filterOptions.style.display = 'none';
    });

    // Ẩn dropdown nếu di chuột ra khỏi cả khu vực chứa biểu tượng và dropdown
    filterOptions.addEventListener('mouseleave', function() {
        filterOptions.style.display = 'none';
    });
</script>



    
