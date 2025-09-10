<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    echo 'true';  // User is logged in
} else {
    echo 'false'; // User is NOT logged in
}
?>
