<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EZfinance";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit_income'])) {
    $income_source = $_POST['income_source'];
    $income_amount = $_POST['income_amount'];
    $income_month = $_POST['income_month'];
    $user_id = 1; // Replace this with the logged-in user's ID.

    // Insert query
    $query = "INSERT INTO incomes (user_id, income_source, income_amount, income_month) 
              VALUES ('$user_id', '$income_source', '$income_amount', '$income_month')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Income added successfully!'); window.location.href='expense_tracker.php';</script>";
    } else {
        echo "<script>alert('Error adding income: " . mysqli_error($conn) . "');</script>";
    }
}

// Close connection
mysqli_close($conn);
?>
