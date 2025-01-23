<style> 
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
    margin-top: 20px;
}

table {
    width: 90%;
    margin: 30px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #333;
    color: #fff;
    text-transform: uppercase;
}

td {
    color: #555;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

p {
    text-align: center;
    font-size: 18px;
    color: #666;
}

.back-btn {
    display: block;
    width: 200px;
    margin: 20px auto;
    padding: 10px 20px;
    text-align: center;
    background-color: #333;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.back-btn:hover {
    background-color: #555;
}
</style>
<?php
require_once "Database_connection.php";
session_start();

$db = new Database_connection();
$conn = $db->connect();

if (!isset($_SESSION['UID'])) {
    header("Location: loginto.php");
    exit();
}
$uid = $_SESSION['UID'];
$user_role = $_SESSION['usertype']; 

echo "<h1>Your Orders</h1>";

if ($user_role == 'Customer') {

    $query = "SELECT OID, order_name, order_price, order_date FROM orders WHERE UID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $uid);
} elseif ($user_role == 'Seller') {
    $query = "SELECT OID, UID, order_name, order_price, order_date FROM orders WHERE sid = ?";
    $stmt = $conn->prepare($query);

    $sellerQuery = "SELECT sid FROM sellers WHERE UID = ?";
    $sellerStmt = $conn->prepare($sellerQuery);
    $sellerStmt->bind_param("i", $uid);
    $sellerStmt->execute();
    $sellerResult = $sellerStmt->get_result();
    
    if ($sellerRow = $sellerResult->fetch_assoc()) {
        $sid = $sellerRow['sid'];
    } else {
        echo "You are not registered as a seller.";
        exit();
    }

    $stmt->bind_param("i", $sid);
} else {
    echo "You have not made a purchase.";
    exit();
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Order ID</th>
                <th>Order Name</th>
                <th>Price</th>
                <th>Date</th>";
    if ($user_role == 'seller') {
        echo "<th>Customer ID</th>";
    }
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['OID']}</td>
                <td>{$row['order_name']}</td>
                <td>{$row['order_price']} ETB</td>
                <td>{$row['order_date']}</td>";
        if ($user_role == 'seller') {
            echo "<td>{$row['UID']}</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No orders found.</p>";
}

$stmt->close();
$conn->close();
?>
