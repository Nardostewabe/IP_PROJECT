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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="stylesheets/style.css">
</head>
<body>

<h1>Your Orders</h1>

<?php
require_once "ViewOrderController.php";
if (empty($orders)): ?>
    <p>No orders found.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Order Name</th>
            <th>Price</th>
            <th>Date</th>
            <?php if ($user_role == 'Seller'): ?>
                <th>Customer ID</th>
            <?php else: ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>

        <?php foreach ($orders as $order){ ?>
            <tr>
                <td><?php echo $order['OID']; ?></td>
                <td><?php echo $order['order_name']; ?></td>
                <td><?php echo $order['order_price']; ?> ETB</td>
                <td><?php echo $order['order_date']; ?></td>

                <?php if ($user_role == 'Seller'): ?>
                    <td><?php echo $order['UID']; ?></td>
                <?php else: ?>
                    <td><a href="OrderController.php?order_id=<?php echo $order['OID']; ?>">Cancel</a></td>
                <?php endif; ?>
            </tr>
        <?php } ?>
    </table>
<?php endif; ?>

</body>
</html>


