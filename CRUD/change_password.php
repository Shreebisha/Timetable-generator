<?php
session_start();
require_once "config.php";
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $sql = "SELECT * FROM users WHERE id=?";
    if($stmt= mysqli_prepare($conn,$sql)) {
        mysqli_stmt_bind_param($stmt,"i",$param_id);
        $param_id=$_SESSION['id'];
        if(mysqli_stmt_execute($stmt)) {

            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);
            print_r($row);
        }
    }
}
?>

    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <title>Password Change</title>
    </head>
    <body class="text-center">
    <style>
        form {border: 3px solid #444444;}
    </style>
    <body>
    <h3>CHANGE PASSWORD</h3>
    <a href="logout.php">Logout</a>
    <form method="post" action="">
        Current Password:<br>
        <input type="password" name="currentPassword">
        <br>
        New Password:<br>
        <input type="password" name="newPassword">
        <br>
        Confirm Password:<br>
        <input type="password" name="confirmPassword">
        <br><br>
        <input type="submit">
    </form>
    <br>
    <br>
    </body>
    </html>
