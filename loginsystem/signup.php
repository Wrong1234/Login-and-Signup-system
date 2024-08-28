<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginsystem";

$emailErr = $usernameErr = $passErr = $Err = $corr = $suc = $inv = "";
$cnt = 0;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize form inputs
 
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $username = $conn->real_escape_string(trim($_POST['username']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $conn->real_escape_string(trim($_POST['password']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Email are not validate";
        $cnt++;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
        $usernameErr = "Only letters and white space allowed";
        $cnt++;
    }

    if(empty($password)){
        $passErr = "Password are Required";
        $cnt++;
    }  
    else{
        if (strlen($password) < 8) {
            $passErr =  "Password must be at least 8 characters long.";
            $cnt++;
        }
        else{
        
            if (!preg_match('/[A-Z]/', $password)) {
                $passErr = "Password must contain at least one uppercase letter.";
                $cnt++;
            }
            
            if (!preg_match('/[a-z]/', $password)) {
                $passErr =  "Password must contain at least one lowercase letter.";
                $cnt++;
            }
            
            if (!preg_match('/\d/', $password)) {
                $passErr =  "Password must contain at least one digit.";
                $cnt++;
            }
            
            if (!preg_match('/[\W_]/', $password)) {
                $passErr =  "Password must contain at least one special character.";
                $cnt++;
            }
        }
    }


    $sql = "SELECT id FROM login_st WHERE username = '$username' or email = '$email' ";
    $result = mysqli_query($conn, $sql);
    // echo "$result";
    if ($result->num_rows > 0) $cnt++;
    else if($cnt == 0){ 
        $sql = "INSERT INTO login_st (username, email, password) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn , $sql); 
        echo "<script>alert('Signup Successfully')</script>";
        header("location:login.php");
     }
}
// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title> 
    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 20px;
        }
        .container{
            background-color: #d5def5;
            width: 60%;
            height: 60%;
            padding: 10px;
            border-radius: 1rem;
        }
        .btn{
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 25px;
            border-radius: 1rem;
            background-color: #42b883;
            width: 50%;
        }
        .container input , label{
            width: 60%;
        }
        input{
          border-radius: 1rem;
          border: none;  
          padding: 10px;
          border-left: 5px;
        }
    </style>
</head>
<body>
        <div class="container">
        <?php if($cnt>0) echo "<span style='color:red'>Invalid username and password</span>";?>

            <h1>Create Account</h1>
            <form action="signup.php" method="post">

                <label for="username">Username</label><br>
                <input type="text" id="username" name="username" required placeholder="Username"><br>
                <span style="color:red"><?php echo "$usernameErr";?></span><br>

                <label for="email">Email</label><br>
                <input id="email" name="email" required placeholder="Email"><br>
                <span style="color:red"><?php echo "$emailErr";?></span><br>

                <label type="password">Password</label><br>
                <input type="password" id="password" name="password" required placeholder="Password"><br>
                <span style="color:red"><?php echo "$passErr";?></span><br>

                <button class="btn" type="submit" name="submit">Sign up</button><br>
            </form>
        </div>
</body>
</html>