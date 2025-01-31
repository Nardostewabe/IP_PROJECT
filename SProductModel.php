
<?php
class ProductsModel extends Database_connection {
    public function getProductsByCategory($category_id) {
        $conn = $this->connect();
        $query = "SELECT * FROM products WHERE cat_id = $category_id";
        return $conn->query($query);
    }
}