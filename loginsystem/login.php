

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "loginsystem";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $username = $conn->real_escape_string(trim($_POST['username']));
        $password = $conn->real_escape_string(trim($_POST['password']));

        $sql = "SELECT id FROM login_st WHERE username = '$username' and password = '$password' ";
        $result = mysqli_query($conn, $sql) or die("Query Failed");

        if(mysqli_num_rows($result)>0){
           
            while($row = mysqli_fetch_assoc($result)){

                session_start();
                $_SESSION['username'] = $_POST['username'];
                header("location: home.php");
            }
        }
        else{
            echo "<script>alert('Invalid username and password')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        *{
            box-sizing: 0;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 20px;
        }
        .container{
            background-color: #d5def5;
            width: 50%;
            height: 50%;
            padding: 10px;
            box-shadow: 10px 15px 20px solid red;
            border-radius: 1rem;
        }
        .btn{
            background-color: #0092ca; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            width: 50%;
            box-shadow: 1px 2px 5px solid #0092ca;
        }
        .container input , label{
            width: 60%;
        }
        .btnn{
            background-color: #4ef037; 
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 25px;
            text-decoration: none;
        }
        input{
            border-radius: 1rem;
            border: none;
            padding: 10px;
            border-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form acton="login.php" method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" rerquired placeholder="Username"><br><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required placeholder="Password"><br><br>
            <button class="btn" type="submit" name="submit">Login</button><br><br>
            <label for="text">Forgotten password?</label><br><br><br>
            <a class="btnn" href="signup.php">Create new account</a>
        </form>
    </div>
</body>
</html>