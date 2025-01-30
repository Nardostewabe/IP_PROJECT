<?php

require_once('Database_connection.php');
$db = new Database_connection();
$conn = $db->connect();

$query = "SELECT * FROM categories";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="stylesheets/prod_categ.css">
</head>
<body>

<h2>Product Categories</h2>
<ul>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='products.php?category_id=" . $row['id'] . "'>" . $row['category_name'] . "</a></li>";
    }
    ?>
</ul>

</body>
</html>
<?php
$conn->close();
?>
