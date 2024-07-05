<?php


// echo $id;

session_start();

include 'connection.php';

if(!isset($_SESSION['userid'])){
    echo "<script> 
        alert('Please login to buy product');
        window.location.href = 'login.php';
        </script>";

    exit();
}   

error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];
$userid = $_SESSION['userid'];

$sql = "SELECT * FROM `product_table` WHERE `product_id`=$id";
$result = mysqli_query($conn,$sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div{
            border: 2px solid black;
            padding: 10px 20px;
            display: inline-block;
        }
        button{
            background-color: green;
            padding: 10px 20px;
            width: 100%;
            margin: auto;
        }
        button:hover{
            background-color: aquamarine;
        }
    </style>
</head>
<body>

<?php

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){


        echo "<div>";
        echo "<h4>Name:" . $row['product_name'] . "</h4>";
        echo "<p>Price: " . $row['product_price'] . "</p>";
        echo "<a href='buy.php?id=" . $id . "'><img src='" . $row['product_pic'] . "' alt='Product Image' style='width: 300px; height: 300px;'></a>";
        echo "</br>";
        echo "<a href= 'inquiry.php?id=$id&uid=$userid'> <button> BUY NOW </button></a>";
        echo "</div>";

    }
}



?>
    
</body>
</html>