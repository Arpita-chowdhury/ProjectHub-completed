<?php
// Check if the user is logged in
if (!isset($_SESSION["team"])) {
    header("Location: team_login.php"); // Redirect to login page if not logged in
    exit();
}
?>