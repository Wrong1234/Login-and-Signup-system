<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login system</title>
    <style>

        *{
            box-sizing: 0;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container{
            height: 60%;
            width: 60%;
            background-color: #53a8b6;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .container a{
            text-decoration: none;
            font-size: 50px;
            font-weight: bolder;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .container a:hover{
            background-color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome my Website<h1> 
        <a href="login.php">Logout</a>
    </div>
</body>
</html>