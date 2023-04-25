<?php
     
     require "config/config.php";
     require "config/db.php";

     if(isset($_GET['sid'])){
        $sid = $_GET['sid'];
        $delete = mysqli_query($conn, "DELETE FROM student WHERE sid =$sid");
        header("Location: student.php");
     }
    
     
     $query = "SELECT * FROM student";
     $result = mysqli_query($conn, $query);
?>