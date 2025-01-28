<?php
require_once('Database_connection.php');
    
// Connect to the database
$db = new Database_connection();
$conn = $db->connect();

// Get the search term from the query string
$searchTerm = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '';

// Prepare the SQL queries
$patternQuery = "SELECT * FROM patterns WHERE pat_name LIKE ?";
$productQuery = "SELECT * FROM products WHERE product_name LIKE ?";

// Prepare statements for both tables
$stmtPattern = $conn->prepare($patternQuery);
$stmtPattern->bind_param("s", $searchTerm);

$stmtProduct = $conn->prepare($productQuery);
$stmtProduct->bind_param("s", $searchTerm);

// Execute the queries
$stmtPattern->execute();
$stmtProduct->execute();

// Get the results
$resultPattern = $stmtPattern->get_result();
$resultProduct = $stmtProduct->get_result();

// Redirect if a pattern or product is found
if ($resultPattern->num_rows > 0) {
    // If pattern is found, redirect to patterns.php
    header('Location: patterns.php');
    exit();
} elseif ($resultProduct->num_rows > 0) {
    // If product is found, redirect to the appropriate product category page
    while ($row = $resultProduct->fetch_assoc()) {
        // You can define the categories dynamically or just map them from the product table
        // Assuming you have a 'category' field in the products table
        $category = strtolower($row['category']); // category could be 'clothing', 'accessories', etc.
        header('Location: ' . $category . '.php');
        exit();
    }
} else {
    // If no results found
    echo "<p>No products or patterns found matching your search.</p>";
}

?>
