<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';


if (!isset($_SESSION['admin_login'])) {

    echo "<script> 
        alert('Unauthorized access of admin panel');
        window.location.href = 'login.php';
        </script>";

    exit();

}



// for user table
$sql = "SELECT * FROM `user` ";
$result = mysqli_query($conn, $sql);




// for inquiry table
$sql2 = "SELECT * FROM `inquiry` ";
$result2 = mysqli_query($conn, $sql2);



// for logout
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['logout'])) {
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
    <title>Admin Panel</title>
    <style>
        button {
            margin: auto;
            font-weight: 900;
            height: 2rem;
        }

        table{
            margin: 1rem 0;
        }

        button:hover {
            background-color: yellow;
            cursor: pointer;
            border-radius: 10%;
        }

        tr>td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th style="text-align:center" colspan="7">USER LISTS</th>
            </tr>
            <tr>
                <th>User_id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone_No</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    echo "<tr>
                <td>$row[user_id]</td>
                <td>$row[name]</td>
                <td>$row[address]</td>
                <td>$row[email]</td>
                <td>$row[phone_no]</td>
                <td>$row[username]</td>
                <td>$row[password]</td>
            </tr>";

                }
            }

            ?>
        </tbody>
    </table>


    <br>
    <br>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th style="text-align:center" colspan="5">INQUIRY LISTS</th>
            </tr>
            <tr>
                <th>Product_Name</th>
                <th>UserName</th>
                <th>Email</th>
                <th>Phone_No</th>
                <th>Product_Pic</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if (mysqli_num_rows($result2) > 0) {

                while ($row = mysqli_fetch_assoc($result2)) {

                    echo "<tr>
                <td>$row[product_name]</td>
                <td>$row[username]</td>
                <td>$row[email]</td>
                <td>$row[phone_no]</td>
                <td><img src = '$row[product_pic]' height='100px' width='100px'></td>
              
            </tr>";

                }
            }





            ?>
        </tbody>
    </table>


    <form action="" method="POST">
        <span>Want to logout? </span>
        <button name="logout" id="logout">Logout</button>
    </form>



</body>

</html>