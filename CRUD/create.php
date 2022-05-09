<?php
/*include "header.php";*/
require_once "config_demo.php";

//Define variables and initialize with empty values
$task = $start_time = $end_time = "";
$task_err = $start_time_err = $end_time_err = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Validate task
    $input_task = trim($_POST["task"]);
    if (empty($input_task)) {
        $task_err = "Please enter your task";
        echo "Please enter your task.";
    } elseif (!filter_var($input_task, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))){
        $task_err = "Please enter a valid task";
    }else{
        $task = $input_task;
    }


    if(empty($task_err) && empty($start_time_err)&& empty($end_time_err)){
// Prepare an insert statement
        $sql = "INSERT INTO task (task, start_time, end_time) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $task, $start_time, $end_time);

            // Set parameters
            $task = trim($_POST['task']);
            $start_time = trim($_POST['start_time']);
            $end_time = trim($_POST['end_time']);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: retrieve.php");
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }

// Close statement
        mysqli_stmt_close($stmt);

// Close connection
        mysqli_close($conn);
    }
}
?>


    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <title>Form</title>
    </head>
    <body>
    <a href="retrieve.php">List</a>
    <form action="create.php" method="post">
        <!--Task : <input type="text" placeholder="Enter your task here" name="task"> <br>
        Start time: <input type="time" placeholder="Enter the time you want to start" name="start_time"> <br>
        End time: <input type="time" placeholder="Enter the time you want to end" name="end_time"> <br>
        <input type="submit" value="Submit">-->
    </form>
    <form>
        <body class="text-center">
        <!--<nav class="navbar navbar-dark bg-dark">-->
            <div class="container-fluid">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Task</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Start time</label>
            <input type="time" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">End time</label>
            <input type="time" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    </body>

    </html>
