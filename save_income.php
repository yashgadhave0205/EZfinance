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
$income_source = $_POST['income_source'];
$income_amount = $_POST['income_amount'];
$income_date = $_POST['income_date'];

// Insert income data into database
$sql = $conn->prepare("INSERT INTO incomes (income_source, income_amount, income_date, user_id) 
                       VALUES (?, ?, ?, ?)");
$sql->bind_param("sdsi", $income_source, $income_amount, $income_date, $user_id);

if ($sql->execute()) {
    echo "<script>
            alert('Income Added Successfully!');
            window.location.href='expense_tracker.php';
          </script>";
} else {
    echo "Error: " . $sql->error;
}

$sql->close();
$conn->close();
?>
