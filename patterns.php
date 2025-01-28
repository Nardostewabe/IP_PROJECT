<?php
require_once('Database_connection.php');
    
    $db = new Database_connection();
    $conn = $db->connect();

    $query = "SELECT * FROM patterns";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<a href = Patterns/".$row['pat_pdf_url'].">Preview</a>";
            echo "<h3>" . $row['pat_name'] . "</h3>";
            echo "<p>Price: " . $row['pat_price'] . " ETB</p>";
            echo "<a href='purchase.php?name=" . urlencode($row['pat_name']) . "&price=" . urlencode($row['pat_price']) . "'>Purchase</a>";
            echo "</div>";
        }
    }
    else {
        echo "<p>No patterns found.</p>";
    }

?>
<link rel="stylesheet" href="stylesheets/prod_categ.css">