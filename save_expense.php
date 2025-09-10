<?php
session_start(); 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in. Please login first.");
}

// Get user_id from session
$user_id = $_SESSION['user_id'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'ezfinance');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from form
$expense_name = $_POST['expense_name'];
$expense_amount = $_POST['expense_amount'];
$expense_date = $_POST['expense_date'];
$expense_category = $_POST['expense_category'];
$expense_note = $_POST['expense_note'];

// Insert expense along with user_id
$sql = $conn->prepare("INSERT INTO expenses (expense_name, expense_amount, expense_date, expense_category, expense_note, user_id) 
                       VALUES (?, ?, ?, ?, ?, ?)");
$sql->bind_param("sdsssi", $expense_name, $expense_amount, $expense_date, $expense_category, $expense_note, $user_id);

if ($sql->execute()) {
    echo "<script>
            alert('Expense Added Successfully!');
            window.location.href='expense_tracker.php';
          </script>";
} else {
    echo "Error: " . $sql->error;
}

$sql->close();
$conn->close();
?>
