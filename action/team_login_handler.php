<?php

$isValid = false;
$authenticationErr = "";

if (isset($_POST["submitLog"])) {
    $sql = "SELECT team_id, password 
        FROM team 
        WHERE team_id = '{$_POST["team_identifier"]}' 
        OR team_email = '{$_POST["team_identifier"]}' 
        AND password = md5('{$_POST["logPass"]}') 
        AND status = 'varified' ";
    $login = mysqli_query($conn, $sql);

    while ($varification = mysqli_fetch_array($login)) {
        $_SESSION["team"] = $varification["team_id"];
        $isValid = true;
    }

    if ($isValid) {
        $team_id = $_POST["team_identifier"];
        header("Location: team_dashboard.php");
        exit();
    } else {
        $authenticationErr = "Invalid Team-ID or Password!";
    }
}
?>
