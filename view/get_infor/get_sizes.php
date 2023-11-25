<?php
include '../../model/pdo.php';

if (isset($_GET['colorId'])) {
    $colorId = $_GET['colorId'];

    // Fetch sizes based on selected color
    $sql = "SELECT s.size1, s.size2
            FROM variants v
            JOIN size s ON v.idSize = s.id
            WHERE v.idColor = ?";
    $sizes = pdo_query($sql, $colorId);

    // Build the HTML options
    $options = '<p>Sizes:</p>';
    foreach ($sizes as $size) {
        $options .= '<p>' . $size['size1'] . ', ' . $size['size2'] . '</p>';
    }

    echo $options;
} else {
    echo 'Invalid request';
}
?>
