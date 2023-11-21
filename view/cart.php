<div class="form-cart">
    <h1><i class="fa-solid fa-bag-shopping"></i>GIỎ HÀNG</h1>
    <div class="cart-detail">
        <table>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Xóa</th>
            </tr>
            <?php 
                $showcart=showcart($idkh);
                foreach ($showcart as $cart) {
                    extract($cart);
                    echo '
                    <tr>
                        <td><img src="assets/img/'.$img.'" alt=""></td>
                        <td>'.$name.'</td>
                        <td>'.$price.'</td>
                        <td><button>-</button>1<button>+</button></td>
                        <td>650,000 VND</td>
                        <td><i class="fa-solid fa-trash-can"></i></td>
                    </tr>
                    ';
                }
            ?>
        </table>
        <div class="total"><i class="fa-solid fa-file-invoice-dollar"></i>Tổng: 1,300,000 VND</div>
        <div class="navigation">
            <a href="" class="shopping">Tiếp tục mua hàng</a>
            <a href="" class="order">Đặt hàng</a>
        </div>
    </div>
    
</div>