<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $sql = "SELECT `password`,`user_id` FROM `user` WHERE `username` = '$username' ";

    $result = mysqli_query($conn, $sql);

    if ($_POST['password'] == null || $_POST['username'] == null) {
        echo "<script>
        alert('Please fill up the details ');
        window.location.href = 'login.php';
        </script>";
        exit();

    } 
    
    
    // FOR ADMIN LOGIN 
    else if ($usertype == "admin" && $username == "admin" && $password == "admin@123") {

        $_SESSION['admin_login'] = true; //session variable

        echo "<script>
            alert('Admin login successful');
            window.location.href = 'admin_panel.php'; 
            </script>";
    } 
    
    
    // FOR USER LOGIN 
    else if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['password'] == $password) {


            $_SESSION['userid'] = $row['user_id']; //session variable

            echo "<script>
            alert('Login successful');
            window.location.href = 'welcome.php'; 
            </script>";
        } else {
            echo "<script>
            alert('Invalid username or password');
            window.location.href = 'login.php';
            </script>";
        }
    } 
    
    
    
    
    else {
        echo "<script>
        alert('Invalid username or password');
        window.location.href = 'login.php';
        </script>";
    }

    mysqli_close($conn);
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         input {
            margin: 0.5rem;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            font-size: 1.5rem;
            margin-bottom: 0.6rem;
        }

        form {
            border: 2px solid black;
            padding: 0.5rem 2rem;
            border-radius: 5px;
            display: inline-block;
            margin: 0.5rem;
        }

        .submit {
            width: 100%;
            margin: auto;
            font-weight: 900;
            height: 2rem;
        }

        .submit:hover {
            background-color: yellow;
            cursor: pointer;
        }

        label {
            font-size: 2rem;
        }

        h1 {
            text-decoration: underline;
        }

       

        span,
        select {
            font-weight: 700;
            font-size: x-large;
            padding: 0.5rem;
            margin: 0.5rem;
        }
    </style>
</head>

<body>

    <form action="" method="POST">

        <center>
            <h1>Enter the credential</h1>
        </center>
        <label for="username">Username</label>
        <input type="text" placeholder="Enter your username" id="username" name="username">
        <br>

        <label for="password">Password</label>
        <input type="password" placeholder="Enter your password" id="password" name="password">
        <br>

        <span>Select usertype </span>
        <select name="usertype">
            <option value="user" selected>user</option>
            <option value="admin">admin</option>
        </select>

        <button name="submit" class="submit">Login</button>
    </form>

    <br>

    <span><a href="index.php">Go to registration page</a></span>
</body>

</html>