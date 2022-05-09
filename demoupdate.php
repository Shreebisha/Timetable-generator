<?php
// Include config file
require_once "config_demo.php";

//Define variables and initialize with empty values
$task = $start_time = $end_time = "";
$task_err = $start_time_err = $end_time_err = "";
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    //Validate task
    $input_task = trim($_POST["task"]);
    if (empty($input_task)) {
        $task_err = "Please enter your task";
        echo "Please enter your task.";
    } elseif (!filter_var($input_task, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))){
        $task_err = "Please enter a valid task";
        echo "Please enter a valid task";
    }else{
        $task = $input_task;
    }



    // Check input errors before inserting in database
    if(empty($task_err) && empty($start_time_err) && empty($end_time_err)){
        // Prepare an update statement
        $sql = "UPDATE task SET task=?, start_time=?, end_time=? WHERE id=?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_task, $param_start_time, $param_end_time , $param_id);

            // Set parameters
            $param_task = $task;
            $param_start_time = $start_time;
            $param_end_time = $end_time;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: retrieve.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM task WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result);

                    // Retrieve individual field value
                    $task = $row["task"];
                    $start_time = $row["start_time"];
                    $end_time = $row["end_time"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
    <html>
<head>
    <title>Edit Data</title>
</head>
<body>
<a href="CRUD/retrieve.php">Home</a>
<br><br>
<form method="post" action="">
    <input type="text" name="task" value="<?php echo $task; ?>"<br>
    <input type="time" name="Start time" value="<?php echo $start_time; ?>"<br>
    <input type="time" name="End time" value="<?php echo $end_time; ?>" <br>
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="submit" value="update">
</form>

</body>
    </html>
