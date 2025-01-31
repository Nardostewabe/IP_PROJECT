<?php
require_once('CategoriesModel.php');

$categoryModel = new CategoryModel();
$categories = $categoryModel->getCategories();
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
    <?php while ($row = $categories->fetch_assoc()) : ?>
        <li><a href="products.php?category_id=<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></a></li>
    <?php endwhile; ?>
</ul>

</body>
</html>
