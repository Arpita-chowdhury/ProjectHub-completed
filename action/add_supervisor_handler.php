<?php

//if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_supervisor'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $initial = $_POST['initial'];
    $designation = $_POST['designation'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //encypt password
    $hashedPassword = md5($password);

    // Insert into the database
    $query = "INSERT INTO supervisor (serial, name, initial, designation, email, password)
     VALUES ('', '$name', 'initial', '$designation', '$email', '$hashedPassword')";
    $result = mysqli_query($conn, $query);
    if ($result){
        echo "<script>
        alert('Supervisor added successfully');
        </script>";
        header("Location: all_supervisor.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    
}
?>