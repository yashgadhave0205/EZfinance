<?php

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "EZfinance";

// Create connection
$conn = mysqli_connect($servername, $user, $password, $dbname);

// Check connection
if ($conn) {
   // echo "Connected to database";

    // Fetch username from the register table
    $sql = "SELECT uname FROM register LIMIT 1"; // Assuming you want to fetch the first username
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['uname'];
    } else {
        $name = "Guest"; // Default name if no username is found
    }

    mysqli_free_result($result);
} else {
    echo "Connection Failed: " . mysqli_connect_error();
    $name = "Guest"; // Default name if connection fails
}

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin view</title>
</head>
<center><body>
<h1 class="text-center">Welcome Sir ! <br>You have successfully logged in as Admin</h1><br>

<?php include('index.php'); ?>
</body></center>
</html>
