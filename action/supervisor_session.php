<?php
// Check if logged in
if (!isset($_SESSION["supervisor"])) {
    header("Location: supervisor_login.php"); // Redirect to login page if not logged in
    exit();
}
?>