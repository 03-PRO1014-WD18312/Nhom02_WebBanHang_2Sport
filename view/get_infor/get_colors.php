<?php
include '../../model/pdo.php';

// Fetch colors from the database
$sql = "SELECT 
variants.id, 
variants.price, 
variants.discount, 
variants.quantity, 
product_color.id, product_color.color 
from variants 
join product_color on variants.idColor = product_color.id
where variants.idProduct=54";
$colors = pdo_query($sql);

// Build the HTML options
$options = '<option value="">Select a color</option>';
foreach ($colors as $color) {
    $options .= '<option value="' . $color['id'] . '">' . $color['color'] . '</option>';
}

echo $options;
?>
