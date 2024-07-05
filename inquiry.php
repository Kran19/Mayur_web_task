<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

if(!isset($_SESSION['userid'])){
    echo "<script> 
        alert('Please login to inquiry ');
        window.location.href = 'login.php';
        </script>";

    exit();
}   

$user_id = $_SESSION['userid'];
$id = $_GET['id'];


// for user data
$sql1 = "SELECT * FROM `user` WHERE `user_id`= $user_id";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

$name = $row1['name'];
$email = $row1['email'];
$address = $row1['address'];
$phoneno = $row1['phone_no'];



// for product data
$sql3 = "SELECT * FROM `product_table` WHERE `product_id`=$id";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$product_name= $row3['product_name'];
$product_pic = $row3['product_pic'];




// for inquiry table data 

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone_no = $_POST['phoneno'];


    $sql2 = "INSERT INTO `inquiry` (`product_name` , `username` , `address` , `email` , `phone_no` , `product_pic`  ) VALUES ('$product_name' , '$name' , '$address' , '$email' , '$phone_no' , '$product_pic')";

    $result2 = mysqli_query($conn, $sql2);

    if ($result2) {

        echo "<script> 
        alert('Thank you for showing interest !!! Admin will contact you soon...');
        window.location.href = 'welcome.php';
        </script>";

    } else {
        echo "<script> 
        alert('Sorry there is an error try again letter...');
        window.location.href = 'welcome.php';
        </script>";
    }
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
            margin: 5px;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 25px;
            margin-bottom: 10px;
        }

        form {
            border: 2px solid black;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-left: 35%;
        }

        .submit {
            width: 100%;
            margin: auto;
            font-weight: 900;
        }

        .submit:hover {
            background-color: green;
        }

        label {
            font-size: 30px;
        }

        h1 {
            text-decoration: underline;
        }

        div {
            margin-left: 35%;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <center>
            <h1>Inquiry Form</h1>
        </center>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" value=<?php echo $name ?>>
        <br>

        <label for="name">Address:</label>
        <input type="text" name="address" id="address" placeholder="Enter your address" value=<?php echo $address ?>>
        <br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" value=<?php echo $email ?>>
        <br>

        <label for="phoneno">Phone no:</label>
        <input type="text" name="phoneno" id="phoneno" placeholder="Enter your phone number" value=<?php echo $phoneno ?>>
        <br>

        <input type="submit" class="submit" name="submit">
    </form>
</body>

</html>