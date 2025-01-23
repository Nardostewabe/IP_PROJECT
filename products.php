<?php
require_once('Database_connection.php');
$db = new Database_connection();
$conn = $db->connect();

// Get category ID from URL
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

if ($category_id > 0) {
    // Fetch category name
    $cat_query = "SELECT category_name FROM categories WHERE id = $category_id";
    $cat_result = $conn->query($cat_query);
    $category = $cat_result->fetch_assoc();

    echo "<h2>Products in " . $category['category_name'] . "</h2>";

    // Fetch products based on selected category
    $query = "SELECT * FROM products WHERE cat_id = $category_id";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            echo "<div class='product'>";
            echo "<img src='images/" . $row['image_url'] . "' alt='" . $row['product_name'] . "' style='width:150px; height:150px;'>";
            echo "<h3>" . $row['product_name'] . "</h3>";
            echo "<p>Price: " . $row['price'] . " ETB</p>";
            echo "<a href='purchase.php?name=" . urlencode($row['product_name']) . "&price=" . urlencode($row['price']) . "'>Purchase</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No products found in this category.</p>";
    }
} else {
    echo "<p>Invalid category selected.</p>";
}


?>
<link rel="stylesheet" href="stylesheets/prod_categ.css">
