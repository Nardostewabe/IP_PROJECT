<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'your_database_name');

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Delete user logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $userType = $_POST['user_type'];

    // Determine the table based on user type
    $table = ($userType === 'user') ? 'users' : (($userType === 'seller') ? 'sellers' : null);

    if ($table) {
        $query = "DELETE FROM $table WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $userId);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $message = "Account deleted successfully.";
        } else {
            $message = "No account found with the given ID.";
        }
    } else {
        $message = "Invalid user type.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete User Account</title>
</head>
<body>
    <h2>Delete User Account</h2>
    
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    
    <form method="POST">
        <label>User ID:</label>
        <input type="number" name="user_id" required><br><br>

        <label>User Type:</label>
        <select name="user_type" required>
            <option value="user">User</option>
            <option value="seller">Seller</option>
        </select><br><br>

        <button type="submit">Delete Account</button>
    </form>
</body>
</html>
