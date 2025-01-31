<?php

class ProductController {
    
    public function showProductsByCategory($category_id) {
        
        $categoryModel = new CategoryModel();
        $productModel = new ProductsModel();

        
        $category = $categoryModel->getCategoryById($category_id);
        $products = $productModel->getProductsByCategory($category_id);

        
        if (!$category) {
            echo "<p>Invalid category selected.</p>";
            return;
        }

       
        if ($products->num_rows == 0) {
            echo "<p>No products found in this category.</p>";
            return;
        }

       
        require_once('products.php');
    }

    public function addProduct($name, $price, $category_id, $file) {
        $productModel = new ProductModel($name, $price, $category_id, $file);
        $productModel->addProduct();
    }
}
require_once('ProductModel.php');

if (isset($_POST['add'])) {

    $name = $_POST['pdname'];
    $price = $_POST['pdprice'];
    $picture = $_FILES['picture'];  
    $category_id = $_POST['category_id'];    
    
    $adder = new ProductController();
    $adder->addProduct($name,$price,$category_id,$picture);

    
    header("Location: sellerhome.php");
    exit();
} else {
    echo "Form submission failed!";
}

?>
