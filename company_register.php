<?php
session_start();

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "placement");
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $details = $_POST['details'];

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM companies WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        echo "<script>alert('Email already registered');</script>";
    } else {
        $sql = "INSERT INTO companies (name, email, password, details) 
                VALUES ('$name','$email','$password','$details')";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Company registered successfully');</script>";
        } else {
            echo "<script>alert('Error: Could not register');</script>";
        }
    }
}
?>

<html>
<head><title>Company Registration</title></head>
<body>
<h2>Company Registration</h2>
<form method="POST" action="">
Company Name:<br>
<input type="text" name="name" required><br><br>

Email:<br>
<input type="email" name="email" required><br><br>

Password:<br>
<input type="password" name="password" required><br><br>

Details:<br>
<textarea name="details" rows="5" cols="40" required></textarea><br><br>

<input type="submit" name="submit" value="Register">
</form>
</body>
</html>
