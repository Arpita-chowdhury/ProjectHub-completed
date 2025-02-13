<?php
session_start();
session_destroy(); // Destroy the session data
header("Location: admin_login.php"); // Redirect the to the login page
exit();
?>