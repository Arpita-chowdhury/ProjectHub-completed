<?php
session_start();
session_destroy(); // Destroy the session data
header("Location: ../login.php"); // Redirect the user to the login page
exit();
?>
