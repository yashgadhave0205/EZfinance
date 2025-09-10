<?php
session_start();

// Destroy the session to log the user out
session_unset();
session_destroy();

// Redirect to homepage with logout success parameter
header("Location: index.html?logout=success");
exit();
?>
