<?php
require_once "Database_connection.php";

class SearchHandler {
    private $conn;
    private $searchQuery;

    public function __construct($conn, $searchQuery) {
        $this->conn = $conn;
        $this->searchQuery = $searchQuery;
    }

    public function searchProducts() {
        
        $query = "SELECT * FROM products WHERE product_name LIKE ?";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%" . $this->searchQuery . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function searchPatterns() {
        
        $query = "SELECT * FROM patterns WHERE pat_name LIKE ?";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%" . $this->searchQuery . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function displayResults($results, $type) {
       
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                if ($type == 'product') {
                    echo "<li><a href='products.php?category_id=" . $row['cat_id']. "'>" . $row['product_name'] . "</a></li>";
                } elseif ($type == 'pattern') {
                    echo "<li><a href='patterns.php'>" . $row['pat_name'] . "</a></li>";
                }
            }
        } else {
            echo "No $type found for '" . $this->searchQuery . "'.";
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $db = new Database_connection();
    $conn = $db->connect();
    

    $searchQuery = $_POST['searchQuery'];

    $searchHandler = new SearchHandler($conn, $searchQuery);


    $productResults = $searchHandler->searchProducts();

    $patternResults = $searchHandler->searchPatterns();


    if ($productResults->num_rows > 0) {
        echo "<h2>Product Results for '$searchQuery'</h2><ul>";
        $searchHandler->displayResults($productResults, 'product');
        echo "</ul>";
    }

    if ($patternResults->num_rows > 0) {
        echo "<h2>Pattern Results for '$searchQuery'</h2><ul>";
        $searchHandler->displayResults($patternResults, 'pattern');
        echo "</ul>";
    }


    if ($productResults->num_rows == 0 && $patternResults->num_rows == 0) {
        echo "No products or patterns found for '$searchQuery'.";
    }
}
?>
