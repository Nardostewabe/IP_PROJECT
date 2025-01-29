<?php
require_once "Database_connection.php";

class SearchHandler {
    private $conn;
    private $searchQuery;

    public function __construct($conn, $searchQuery) {
        $this->conn = $conn;
        $this->searchQuery = mysqli_real_escape_string($conn, $searchQuery); // Sanitize the input
    }

    public function searchProducts() {
        $query = "SELECT * FROM products WHERE product_name LIKE ? OR description LIKE ?";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%" . $this->searchQuery . "%";
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function searchPatterns() {
        $query = "SELECT * FROM patterns WHERE pattern_name LIKE ? OR description LIKE ?";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%" . $this->searchQuery . "%";
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function displayResults($results) {
        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                echo "<li><a href='" . $row['link'] . "'>" . $row['name'] . "</a> - " . $row['description'] . "</li>";
            }
        } else {
            echo "No products or patterns found for '" . $this->searchQuery . "'.";
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = $_POST['searchQuery'];

    $searchHandler = new SearchHandler($conn, $searchQuery);

    
    $productResults = $searchHandler->searchProducts();
    $patternResults = $searchHandler->searchPatterns();

    
    if (mysqli_num_rows($productResults) > 0) {
        echo "<h2>Product Results for '$searchQuery'</h2><ul>";
        $searchHandler->displayResults($productResults);
        echo "</ul>";
    }

    if (mysqli_num_rows($patternResults) > 0) {
        echo "<h2>Pattern Results for '$searchQuery'</h2><ul>";
        $searchHandler->displayResults($patternResults);
        echo "</ul>";
    }

    if (mysqli_num_rows($productResults) == 0 && mysqli_num_rows($patternResults) == 0) {
        echo "No products or patterns found for '$searchQuery'.";
    }
}

