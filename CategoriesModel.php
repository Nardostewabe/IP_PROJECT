<?php
require_once('Database_connection.php');

class CategoryModel extends Database_connection {

    
    public function getCategories() {
        $conn = $this->connect();
        $query = "SELECT * FROM categories";
        $result = $conn->query($query);
        return $result;
    }

    
    public function getCategoryById($category_id) {
        $conn = $this->connect();
        $query = "SELECT category_name FROM categories WHERE id = $category_id";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
}
}
?>
