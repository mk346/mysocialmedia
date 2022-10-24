<?php
require 'config/config.php';
if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
} else {
    header("Location: register.php");
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/0fe3bc1f22.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>Home Page</title>
</head>

<body>
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">My Chat Space</a>
        </div>
        <nav>
            <a href="#">
                <?php echo $user['first_name'];?>
            </a>
            <a href="index.php"><i class="fa fa-home fa-lg"></i></a>
            <a href="#"><i class="fa fa-envelope fa-user fa-lg"></i></a>
            <a href="#"><i class="fa fa-bell-o fa-lg"></i></a>
            <a href="#"><i class="fa fa-users fa-lg"></i></a>
            <a href="#"><i class="fa fa-cog fa-lg"></i></a>


        </nav>
    </div>
    <div class="wrapper">