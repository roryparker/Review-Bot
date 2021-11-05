<?php 
require 'config/config.php';

if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];  // Set username to 2
}
else {
    header("Location: register.php"); // Send back to Register page is not logged in.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Truth</title>

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/css/js/bootstrap.js"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>

    <div class="top_bar">
        <div class="logo">
            <a href="index.php"> KWORKR </a> 
            <!-- img src="assets/images/logo" -->
        </div>

        <nav>
            <a href="#"> <i class="fa-solid fa-house"></i> </a>
            <a href="#"> <i class="fa-solid fa-user-group"></i> </a>
            <a href="#"> <i class="fa-solid fa-comment"></i> </a>
            <a href="#"> <i class="fa-solid fa-people-arrows-left-right"></i> </a>
            <a href="#"> <i class="fa-regular fa-face-pouting"></i> </a>
        </nav>
    </div>

    <div class="wrapper">