<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            
        }
        th, td {
            border: 1px solid white;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #0d1b2a;
            color: white;
        }
        body
        {
            background-color: #0d1b2a;
            color: white;
        }
    </style>
</head>
<body>
    <h4>Data from Register Table</h4>
    <table>
        <tr>
            <th>username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Confirmed Password</th>
        </tr>
        <?php
        // Database configuration
        $servername = "localhost";
        $username = "root"; // Your database username
        $password = ""; // Your database password
        $dbname = "ezfinance"; // Your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to fetch data
        $sql = "SELECT  uname, em, pas, conpas FROM register";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["uname"]."</td>";
                echo "<td>".$row["em"]."</td>";
                echo "<td>".$row["pas"]."</td>";
                echo "<td>".$row["conpas"]."</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
