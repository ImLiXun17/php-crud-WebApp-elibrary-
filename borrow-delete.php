<?php
     
     require "config/config.php";
     require "config/db.php";

     if(isset($_GET['borrow_id'])){
        $borrow_id = $_GET['borrow_id'];
        $delete = mysqli_query($conn, "DELETE FROM borrow WHERE borrow_id =$borrow_id");
        header("Location: borrow.php");
     }
    
     
     $query = "SELECT * FROM borrow";
     $result = mysqli_query($conn, $query);
?>