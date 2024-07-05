<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once 'connection.php';

$user_id = $_SESSION['userid'];

// var_dump($user_id);
// echo $user_id;



// for session checking
if (!isset($_SESSION['userid'])) {
    echo "<script> 
            alert('Unauthorized access');
            window.location.href = 'login.php';
          </script>";
    exit();
}





// for product uploading

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {


    $product_price = $_POST['product_price'];
    $product_name = $_POST['product_name'];
    // $product_pic = $_POST['product_pic'];

    $target_dir = "upload/";
    $img_name = $_FILES["product_pic"]["name"];
    $target_file = $target_dir . $img_name;

    $sql = "INSERT INTO `product_table` (`product_name` , `product_price` , `product_pic`) VALUES ('$product_name' , '$product_price' , '$target_file')";

    $result = mysqli_query($conn, $sql);

    if ($_FILES["product_pic"]["error"] == 0 && $result) {

        move_uploaded_file($_FILES["product_pic"]["tmp_name"], $target_file);
        echo "<script> 
        alert('Product uploaded successfully');
        window.location.href = 'welcome.php';
        </script>";

    } else {
        echo "<script> 
        alert('Try again');
        window.location.href = 'welcome.php';
        </script>";

    }
}






// for logout
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['logout'])){
    session_destroy();
    header('Location: login.php'); 
    exit;
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div {
            padding: 15px 10px;
            border: 2px solid black;
            display: inline-block;
            margin: 20px;
        }

        span {
            padding: 5px;
            background-color: gold;
            margin: 3px;
        }

        input {
            padding: 5px;
            margin: 5px;
        }

        button {
            background-color: paleturquoise;
            padding: 5px 10px;
            border-radius: 10%;
        }

        button:hover {
            cursor: pointer;
            background-color: palegoldenrod;
        }

        .product {
            background-color: lightblue;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            border-radius: 1%;
        }

        .product>div{
            background-color: aliceblue;
            border: 2px double green;
        }

        div>a>img{
            border:5px dotted rebeccapurple;
        }
    </style>
</head>

<body>

    



    <h1> Welcome to the page !!! </h1>

    <div class="upload">
        <form action="" method="POST" enctype="multipart/form-data">

            <span>Upload the product img</span>
            <br>
            <input type="file" name="product_pic" required>
            <br>

            <input type="text" placeholder="Enter product name " name="product_name" required>
            <br>

            <input type="text" placeholder="Enter product price " name="product_price" required>
            <br>

            <button name="submit" class="submit">Upload</button>
        </form>
    </div>

    <form action="" method="POST">
        <span>Want to logout? </span>
        <button name="logout" id="logout">Logout</button>
    </form>


    <?php

    $sql = "SELECT * FROM `product_table`";
    $result = mysqli_query($conn, $sql);
    echo "<center>";
    echo "<h1>PRODUCTS</h1>";
    echo "</center>";
    echo "</br>";

    echo "<div class='product'>";
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['product_id'];
            echo "<div>";
            echo "<h4>Name : " . $row['product_name'] . "</h4>";
            echo "<p><b>Price : " . $row['product_price'] . "<b></p>";
            echo "<a href='buy.php?id=" . $id . "'><img src='" . $row['product_pic'] . "' alt='Product Image' style='width: 300px; height: 300px;'></a>";

            echo "</div>";


        }
    }
    echo "</div>";
    ?>


</body>

</html>