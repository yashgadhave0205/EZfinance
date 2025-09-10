<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'ezfinance');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get expense ID from URL
if (isset($_GET['id'])) {
    $expense_id = $_GET['id'];
    $user_id = $_SESSION['user_id']; // Get logged-in user ID

    // Ensure the user can only delete their own expenses
    $sql = "DELETE FROM expenses WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $expense_id, $user_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Expense Deleted Successfully!'); window.location.href='expense_tracker.php';</script>";
    } else {
        echo "<script>alert('Error Deleting Expense'); window.location.href='expense_tracker.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
