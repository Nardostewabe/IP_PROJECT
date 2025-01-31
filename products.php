<?php

require_once('Database_connection.php');
require_once('CategoriesModel.php');
require_once('SProductModel.php');



$categoryModel = new CategoryModel();
$productModel = new ProductsModel();

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

if ($category_id > 0) {

    $category = $categoryModel->getCategoryById($category_id);

 
    if (!$category) {
        echo "<p>Invalid category selected.</p>";
        exit();
    }
    $products = $productModel->getProductsByCategory($category_id);


    if ($products->num_rows == 0) {
        echo "<p>No products found in this category.</p>";
        exit();
    }

    echo "<h2>Products in " . htmlspecialchars($category['category_name']) . "</h2>";

    while ($row = $products->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<img src='images/" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['product_name']) . "' style='width:150px; height:150px;'>";
        echo "<h3>" . htmlspecialchars($row['product_name']) . "</h3>";
        echo "<p>Price: " . number_format($row['price'], 2) . " ETB</p>";
        echo "<a href='purchase.php?name=" . urlencode($row['product_name']) . "&price=" . urlencode($row['price']) . "'>Purchase</a>";
        echo "</div>";
    }
} else {
    echo "<p>Invalid category selected.</p>";
}

echo '<link rel="stylesheet" href="stylesheets/prod_categ.css">';
?>
