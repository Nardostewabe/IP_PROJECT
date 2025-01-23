<?php
session_start();
include("db_connection.php"); // Include your database connection

if (!$_SESSION) {
    header("Location: loginto.php"); // Redirect to login if not logged in
    exit();
}

$userId = ($_SESSION['usertype'] == "Seller") ? $_SESSION['SID'] : $_SESSION['UID'];
$userType = $_SESSION['usertype'];

// Query to delete the user based on their usertype
if ($userType == "Seller") {
    $deleteQuery = "DELETE FROM sellers WHERE SID = ?";
} else {
    $deleteQuery = "DELETE FROM users WHERE UID = ?";
}

$stmt = $conn->prepare($deleteQuery);
$stmt->bind_param("s", $userId);

if ($stmt->execute()) {
    // Clear session and logout the user
    session_unset();
    session_destroy();
    echo "<script>alert('Account deleted successfully!'); window.location.href = 'loginto.php';</script>";
} else {
    echo "<script>alert('Failed to delete account. Please try again.'); window.history.back();</script>";
}
?>

<h4><a href="update.php">Update Your Profile</a></h4>
<h4><a href="delete_account.php" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');" style="color: red;">Delete Account</a></h4><?php
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "crochet"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
