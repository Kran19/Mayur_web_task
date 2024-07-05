<?php

error_reporting(E_ALL);

ini_set('display_errors',1);


include_once 'connection.php';

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']) ){

    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone_no = $_POST['phoneno'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `user` (`name` , `address` , `email` , `phone_no` , `username` , `password` ) VALUES ('$name' , '$address' , '$email' , '$phone_no' , '$username' , '$password' )"; 

    $result = mysqli_query($conn , $sql);

    if ($result) {

        echo "<script> 
        alert('Registration successful');
        window.location.href = 'login.php';
        </script>";
        exit();

    } else {
        echo "<script> 
        alert('Registration failed');
        window.location.href = 'registration.php';
        </script>";
        exit();
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
        }

        .submit:hover {
            background-color: green;
            cursor: pointer;
        }

        label {
            font-size: 30px;
        }

        h1{
            text-decoration: underline;
        }

       
    </style>
</head>

<body>

    <form action="" method="POST">
        <center>
            <h1>Register yourself</h1>
        </center>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" required>
        <br>

        <label for="name">Address:</label>
        <input type="text" name="address" id="address" placeholder="Enter your address" required>
        <br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
        <br>

        <label for="phoneno">Phone no:</label>
        <input type="text" name="phoneno" id="phoneno" placeholder="Enter your phone number" required>
        <br>

        <label for="username">username:</label>
        <input type="text" name="username" id="username" placeholder="Enter your username" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        <br>

        <input type="submit" class="submit" name="submit">
    </form>


    <div>
        <h3>Already have an account?</h3>
        <h2><a href="login.php">Login here!</a></h2>
    </div>



</body>

</html>

<?php

// var_dump(ini_get("session.gc_maxlifetime"));

?>