<?php
//define initial and error variables to empty
$teamEmail = $id = $name = $email = $phone = $pass = $conPass = "";
$teamEmailErr = $idErr = $nameErr = $emailErr = $phoneErr = $passErr = $conPassErr = "";

// initially set as false valid flags for each field 
$vteamEmail = $vid = $vname = $vemail = $vphone = $vpass = $vconpass = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamEmail = ($_POST["teamEmail"]);
    $pass = ($_POST["regPass"]);
    $conPass = ($_POST["regConPass"]);

    //team email
    $ValidEmail = preg_match("/^\\S+@\\S+\\.\\S+$/", $teamEmail);
    if (empty($teamEmail)) {
        $teamEmailErr = "A team Email is required";
    } else if(!$ValidEmail){
        $teamEmailErr = "Provide a valid email address";
    }else{
        $vteamEmail = true;
    }

    for ($a = 0; $a < count($_POST["name"]); $a++){
        
        // define variables
        $id = ($_POST["id"][$a]);
        $name = ($_POST["name"][$a]);
        $email = ($_POST["email"][$a]);
        $phone = ($_POST["phone"][$a]);
        
        //valid inputs using regex
        $isValidSid = preg_match("/^\d{10}$/", $id);
        $isValidName = preg_match("/^[a-zA-Z]+ [a-zA-Z]+$/", $name);
        $isValidEmail = preg_match("/^\\S+@\\S+\\.\\S+$/", $email);
        $isValidPhone = preg_match("/^\+?(88)?0?1[3456789][0-9]{8}\b/", $phone);

        //id
        if (empty($id)) {
            $idErr = "ID is required";
        } else if(!$isValidSid){
            $idErr = "Provide a valid student ID";
        }else{
            $vid = true;
        } 
        
        //name
        if (empty($name)) {
            $nameErr = "Name is required";
        } else if(!$isValidName){
            $nameErr = "Provide first name & last name.";
        }else{
            $vname = true;
        }

        //email
        if (empty($email)) {
            $emailErr = "Email is required";
        } else if(!$isValidEmail){
            $emailErr = "Provide a valid email address";
        }else{
            $vemail = true;
        }
    
        //phone
        if (empty($phone)) {
            $phoneErr = "Phone number is required";
        } else if(!$isValidPhone){
            $phoneErr = "Provide a valid phone number";
        }else{
            $vphone = true;
        }
    }


    //pass
    if (empty($pass)) {
        $passErr = "Password is required";
    } else if(strlen($pass) < 8){
        $passErr = "Password should be at least 8 characters.";
    }else{
        $vpass = true;
    }

    //con pass
    if (empty($conPass)) {
        $conPassErr = "Please confirm your password";
    } else if($pass !== $conPass){
        $conPassErr = "Passwords doesn't match";
    }else{
        $vconpass = true;
    }
    
   
}

//upload on db only after each field is validated
if($vteamEmail && $vid && $vname && $vemail && $vphone && $vpass && $vconpass == true){
    //insert into db
    //assign each field into an variable
    if (isset($_POST["submitReg"])){
        $team_name = $_POST["teamName"];
        $team_email = $_POST["teamEmail"];
        $team_id = $teamID;
        $password = $_POST["regConPass"];
        //encypt password
        $hashedPassword = md5($password);

        //inserted into table ---> team 
        //team id/email and pass will be used for team varification
        $sql = "INSERT INTO team( serial , team_id , team_name ,team_email , password, status) 
        VALUES ('' , '$team_id', '$team_name' , '$team_email' , '$hashedPassword' , 'not varified')";
        $team = mysqli_query($conn, $sql);
        
        //inserted into table ----> user
        //each members details with similar team id for each team
        for ($a = 0; $a < count($_POST["name"]); $a++){
            $sql = "INSERT INTO user (serial , team_id , std_id , name , email , phone )
            VALUES('' , '$team_id' ,
             '" . $_POST["id"][$a] . "' , 
             '" . $_POST["name"][$a] . "' ,
            '". $_POST["email"][$a] ."' , 
            '". $_POST["phone"][$a] ."' )";
            
            $user = mysqli_query($conn, $sql);
        }

        //verify team email by sending otp
        include('../smtp/PHPMailerAutoload.php');

        $to_email = $team_email;
        $sub = "Varify your Team email";
        $otp = random_int(100000,999999);
        $message = "<p>Hello, $team_name</p>
                    <p>Your OTP for email verification is: <strong>$otp</strong></p><br><br>
                    <p>Thank you for registering !</p> 
                    <p>Best regards</p>
                    <p>ProjectHub Team</p>";
        
        //upload the otp into otp table
        $sql_otp = "INSERT INTO otp (serial , email , otp)
        VALUES ('' , '$team_email' , $otp) ";
        $result_otp = mysqli_query($conn, $sql_otp);
                
        function smtp_mailer($to,$subject, $msg){
            $mail = new PHPMailer(); 

            //SMTP configuration
            $mail->IsSMTP(); 
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; 
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';

            //sender details
            $mail->Username = "projecthub.lu@gmail.com";
            $mail->Password = "huyjbmyfhjjggipt";
            $mail->SetFrom("projecthub.lu@gmail.com");

            //email details
            $mail->Subject = $subject;
            $mail->Body = $msg;

            //recipient
            $mail->AddAddress($to);

            //SMTP option settings
            $mail->SMTPOptions=array('ssl'=>array(
                'verify_peer'=>false,
                'verify_peer_name'=>false,
                'allow_self_signed'=>false
            ));
            

            if(!$mail->Send()){
                echo $mail->ErrorInfo;
            }else{
                return 'Sent';
            }
        }

        $sent_mail = smtp_mailer($to_email, $sub, $message);
        


           
    }

    //confirmation alart
    if($team && $user){
        echo "<script>
        window.location.href='../team/varify_otp.php?mail=$team_email';
        </script>";
        exit();
    }else{
        echo ("Something went wrong");
    } 
}

?>