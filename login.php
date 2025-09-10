<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EZfinance";

// Database Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Handle Login Form Submission
if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $pas = $_POST['pas'];

    // Use prepared statement for better security
    $query = "SELECT * FROM Register WHERE uname = ? AND pas = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $uname, $pas);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['user_id'] = $row['id'];         
        $_SESSION['username'] = $row['uname'];     
        
        if ($uname === 'admin') {
            echo "<script>alert('Succesfully Login as Admin');</script>";
            echo "<script>window.location.href = 'admin.php?login=success';</script>";
        } else {
            echo "<script>window.location.href = 'index.html?login=success';</script>";  // Redirect to homepage with success indicator
        }
        exit;

    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EZfinance : Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            background-color: #fff;
            padding: 20px;
            margin: 50px;
            border-radius: 20px;
            position: relative;
        }

        .title {
            font-size: 28px;
            color: royalblue;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
        }

        .title::before, .title::after {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 0;
            background-color: royalblue;
        }

        .title::before {
            width: 18px;
            height: 18px;
            background-color: royalblue;
        }

        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }

        .message, .signin {
            color: rgba(88, 87, 87, 0.822);
            font-size: 14px;
        }

        .signin {
            text-align: center;
        }

        .signin a {
            color: royalblue;
        }

        .signin a:hover {
            text-decoration: underline royalblue;
        }

        .flex {
            display: flex;
            width: 100%;
            gap: 6px;
        }

        .form label {
            position: relative;
        }

        .form label .input {
            width: 100%;
            padding: 10px 10px 20px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }

        .form label .input + span {
            position: absolute;
            left: 10px;
            top: 15px;
            color: grey;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown + span {
            top: 15px;
            font-size: 0.9em;
        }

        .form label .input:focus + span, .form label .input:valid + span {
            top: 30px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .form label .input:valid + span {
            color: green;
        }

        .submit {
            border: none;
            outline: none;
            background-color: royalblue;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .submit:hover {
            background-color: rgb(56, 90, 194);
        }

        @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }

            to {
                transform: scale(1.8);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <br><br><br>
    <center>
        <h2><b>Register</b> or <b>Log-in</b></h2>
        <p>And Get the full access of <b class="EZ">EZ</b><i>f</i>inance.</p>
    </center>
    <center>
        <form class="form" action="" method="POST">
            <p class="title">Log-in</p>
            <p class="message">Log-in now and get full access to our app.</p>
            <label>
                <input required placeholder="" type="text" class="input" name="uname" id="uname">
                <span>Username</span>
            </label>
            <label>
                <input required placeholder="" type="password" class="input" name="pas" id="pas">
                <span>Password</span>
            </label>
            <button type="submit" class="submit" name="login">Submit</button>
            <p class="signin">Don't have an account? <a href="http://localhost/PHP/form.php">Register</a></p>
        </form>
    </center>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="chatbot.js"></script>
    <script src="toast.js"></script>
    <script src="authCheck.js"></script>


</body>
</html>
