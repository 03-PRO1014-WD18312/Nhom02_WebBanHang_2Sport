<?php
include '../../model/pdo.php';

if (isset($_GET['colorId'])) {
    $colorId = $_GET['colorId'];

    // Fetch price based on selected color
    $sqlPrice = "SELECT price, discount FROM variants WHERE idColor = ?";
    $price = pdo_query_one($sqlPrice, $colorId);

    // Fetch sizes based on selected color
    $sizes = '';
    $sizesUrl = 'get_sizes.php?colorId=' . $colorId;
    $sizes .= '<div id="sizesDisplay"></div>';

    if ($price) {
        echo 'Price: ' . $price['price'] . '<br>';
        echo $sizes;
    } else {
        echo 'Price not available';
    }
} else {
    echo 'Invalid request';
}
?>
