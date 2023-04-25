<?php
     
     require "config/config.php";
     require "config/db.php";

     if(isset($_GET['bid'])){
        $bid = $_GET['bid'];
        $delete = mysqli_query($conn, "DELETE FROM book WHERE bid =$bid");
        header("Location: book.php");
     }
    
     
     $query = "SELECT * FROM book";
     $result = mysqli_query($conn, $query);
?>