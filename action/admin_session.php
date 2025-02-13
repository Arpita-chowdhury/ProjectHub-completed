<?php
// Check if the admin is logged in
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php"); // Redirect to login page if not logged in
    exit();
}
?>