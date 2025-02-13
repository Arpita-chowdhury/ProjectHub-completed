<?php
$isValid = false;
 $authenticationErr = "";
    if(isset($_POST["adminLog"])){
        $sql = "SELECT *
                FROM supervisor WHERE 
                email = '$_POST[email]' 
                AND password = md5('$_POST[password]') ";
            
        $login = mysqli_query($conn,$sql);
        
        while($varification = mysqli_fetch_array($login)){
            $_SESSION["supervisor"] = $varification["initial"];
            $isValid = true;
        }

        if ($isValid) {
            header("Location: supervisor_dashboard.php");
            exit();
        }else{
            $authenticationErr = "Invalid email or Password !";
        }
    } 
    
?>