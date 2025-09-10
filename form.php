<?php
// Database Connection Code (Top of the file)
$servername = "localhost";
$user = "root";
$password = "";
$dbname = "EZfinance";

$conn = mysqli_connect($servername, $user, $password, $dbname);

if (!$conn) {
    echo "Connection Failed: " . mysqli_connect_error();
    exit();
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EZfinance : Register</title>
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

.title::before,.title::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
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

.form label .input:focus + span,.form label .input:valid + span {
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
  transform: .3s ease;
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
.toast-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #4CAF50;
    color: #fff;
    padding: 15px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@keyframes fadein {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes fadeout {
    from {opacity: 1;}
    to {opacity: 0;}
}

    </style>
   
</head>
<body>
  
    <br><br><br>
    <center><h2><b>Register</b> or <b>Sign-in</b></h2>
    <p>And Get the full access of <b class="EZ">EZ</b><i>f</i>inance.</p></center>
    <center><form class="form" action="#" method="POST">
        <p class="title">Register</p>
        <p class="message">Register now and get full access to our app. </p>
            <div class="flex">
            <label>
                <input required="" placeholder="" type="text" class="input" name="uname" id="uname">
                <span>username</span>
            </label>
    
        </div>  
                
        <label>
            <input required="" placeholder="" type="email" class="input" name="em" id="em">
            <span>Email</span>
        </label> 
            
        <label>
            <input required="" placeholder="" type="password" class="input" name="pas" id="pas">
            <span>Password</span>
        </label>
        <label>
            <input required="" placeholder="" type="password" class="input" name="conpas" id="conpas">
            <span>Confirm password</span>
        </label>
        <input type="submit" value="Register " class="submit" name="register">
        <p class="signin">Already have an acount ? <a href="http://localhost/PHP/login.php?#"> Log-in </a> </p>
    </form></center>
    <?php
// Registration Logic Code (Body of the file)
if(isset($_POST['register'])) {
    $uname = $_POST['uname'];
    $em = $_POST['em'];
    $pas = $_POST['pas'];
    $conpas = $_POST['conpas'];

    // Validate email
    if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    // Check if passwords match
    if ($pas !== $conpas) {
        echo "<script>alert('Passwords do not match');</script>";
        exit();
    }

    // Check for duplicate username or email
    $check_query = "SELECT * FROM Register WHERE uname='$uname' OR em='$em'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['uname'] === $uname) {
            echo "<script>alert('Username already taken');</script>";
        } elseif ($row['em'] === $em) {
            echo "<script>alert('Email already taken');</script>";
        }
    } else {
        // Hash the password (recommended for security)
        // $pas = password_hash($pas, PASSWORD_DEFAULT);

        $query = "INSERT INTO Register (uname, em, pas, conpas) VALUES ('$uname', '$em', '$pas', '$conpas')";
        $data = mysqli_query($conn, $query);

        if ($data) {
            echo "<script>
                alert('Registration successful, please login with registered credentials');
                window.location.href = 'http://localhost/PHP/login.php';
            </script>";
        } else {
            echo "<script>alert('Registration Failed: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="chatbot.js"></script>
    <script src="toast.js"></script>
    <div id="toast" class="toast-container" style="display:none;">
    <div class="toast-content">
        <span id="toast-message"></span>
    </div>
</div>

</body>
</html>