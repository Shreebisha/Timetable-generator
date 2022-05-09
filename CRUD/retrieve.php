<?php
///* Attempt Mysql server connection. Assuming you are running MySQL server with default setting  (user 'root' with no password)*/
//$conn=mysqli_connect("localhost","root", "", "monthly_test");
//if($conn===false) {
//    die("ERROR: could not connect" . mysqli_connect_error());
//}
//
//$sql="SELECT * FROM task";
//if($result=mysqli_query($conn,$sql)){
//    if(mysqli_num_rows($result)>0){
//        echo '<a href="create.php">Add new+</a>';
//
//        echo"<table border='1'>";
//        echo"<tr>";
//        echo"<th>id</th>";
//        echo"<th>Task</th>";
//        echo"<th>Start_time</th>";
//        echo"<th>End_time</th>";
//        echo"<th>Edit</th>";
//        echo "<th>Delete</th>";
//
//        echo"</tr>";
//        foreach ($result as $row){
//            echo"<tr>";
//            echo"<td>".$row['id']."</td>";
//            echo"<td>".$row['task']."</td>";
//            echo"<td>".$row['start_time']."</td>";
//            echo"<td>".$row['end_time']."</td>";
//            echo '<td><a href="update.php?id=' . $row['id']. '">Edit</a></td>';
//            echo '<td><a href="delete_details.php? id=' . $row['id'] .'">Delete</a> </td>';
//            echo"</tr>";
//
//        }
//        echo"</table>";
//        //Free Result Set
//
//        mysqli_free_result($result);
//    }else{
//        echo"ERROR:Could not able to execute $sql.".mysqli_error($conn);
//    }
//    mysqli_close($conn);
//
//}
//?>
<?php
include "header.php";
/* Attempt Mysql server connection. Assuming you are running MySQL server with default setting  (user 'root' with no password)*/
$conn=mysqli_connect("localhost","root", "", "monthly_test");
if($conn===false) {
    die("ERROR: could not connect" . mysqli_connect_error());
}

$sql="SELECT * FROM task";
if($result=mysqli_query($conn,$sql)){
    if(mysqli_num_rows($result)>0){
        echo '<br><br><br><a href="create.php">Add new+</a>';
        echo"<table class='table table-striped'>";
        echo"<tr>";
        echo"<th>id</th>";
        echo"<th>Task</th>";
        echo"<th>Start_time</th>";
        echo"<th>End_time</th>";
        echo"<th>Edit</th>";
        echo "<th>Delete</th>";

        echo"</tr>";
        foreach ($result as $row){
            echo"<tr>";
            echo"<td>".$row['id']."</td>";
            echo"<td>".$row['task']."</td>";
            echo"<td>".$row['start_time']."</td>";
            echo"<td>".$row['end_time']."</td>";
            echo '<td><a href="update.php?id=' . $row['id']. '">Edit</a></td>';
            echo '<td><a href="delete_details.php? id=' . $row['id'] .'">Delete</a> </td>';
            echo"</tr>";

        }
        echo"</table>";
        //Free Result Set

        mysqli_free_result($result);
    }else{
        echo"ERROR:Could not able to execute $sql.".mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
