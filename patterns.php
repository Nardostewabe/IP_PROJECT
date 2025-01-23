<?php
require_once('Database_connection.php');
    
    $db = new Database_connection();
    $conn = $db->connect();

    $query = "SELECT * FROM patterns";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='Patterns/" . $row['pat_pdf_url'] . "' alt='" . $row['pat_name'] . "' style='width:150px; height:150px;'>";
            echo "<h3>" . $row['product_name'] . "</h3>";
            echo "<p>Price: " . $row['price'] . " ETB</p>";
            echo "<a href='purchase.php?name=" . urlencode($row['pat_name']) . "&price=" . urlencode($row['pat_price']) . "'>Purchase</a>";
            echo "</div>";
        }
    }
    else {
        echo "<p>No patterns found.</p>";
    }

?>
<link rel="stylesheet" href="stylesheets/prod_categ.css">