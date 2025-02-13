<?php
$isValid = false;
 $authenticationErr = "";
    if(isset($_POST["login"])){
        $sql = "SELECT email, password 
                FROM admin WHERE 
                email = '" . $_POST["email"]. "' 
                && password ='$_POST[password]' ";
            
        $login = mysqli_query($conn,$sql);
        
        while($varification = mysqli_fetch_assoc($login)){
            $_SESSION["admin"] = $varification["email"];
            $isValid = true;
        }

        if ($isValid) {
            $email = $varification["email"];
            header("Location: admin_dashboard.php");
            exit();
        }else{
            $authenticationErr = "Invalid email or Password !";
        }
        
            
        
        
    } 
    
?>