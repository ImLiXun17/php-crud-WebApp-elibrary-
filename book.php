<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" sizes="any" href="assets/img/icon4.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Book Section  E-Library</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <?php
        require('config/config.php');
        require('config/db.php');

        $result_per_page = 20;

        $query_01 = "SELECT * FROM book ";
    
        $result_01 = mysqli_query($conn, $query_01);
    
        $resultRows = mysqli_num_rows($result_01);
    
    
        $number_of_page = ceil($resultRows / $result_per_page);
    
        if(!isset($_GET['page'])){
            $page = 1;
        }else{
            $page = $_GET['page'];
    
        }
         $first_page_number = ($page - 1) * $result_per_page;
         //create query search
        $query = "SELECT * FROM book ORDER BY book_name ASC LIMIT $first_page_number,$result_per_page";
        if(isset($_GET['submit'])){
           $search = $_GET['search'];
           if (strlen($search) > 0 ){
               $query = "SELECT * FROM book WHERE book_name LIKE '%".$search."%'or year_published LIKE '%".$search."%' ";
            }
            else{
              $query  = "SELECT * FROM book ORDER BY book_name ASC";
            }
           }

        //get the result
        $result = mysqli_query($conn, $query);

        //fetch the data
        $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

        //free result
        mysqli_free_result($result);

    ?>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
               <?php include('includes/sidebar.php');?>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <?php include('includes/navbar.php');?>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                            </br>
                            <div class="col-md-4">
                                <form action="<?php $_SERVER['PHP_SELF'];?>" method="GET">
                                    <input type="text" name="search" class="form-control" placeholder="Search here"style="margin-bottom: 8px"/>
                                    <input type="submit" name ="submit" value="Search" class ="btn btn-info btn-fill" />
                                </form>
                            </div>
                            <div class="col-md-12">
                                <a href="book-add.php">
                                    <button type="submit"class="btn btn-info btn-fill pull-right">Add New Book</button>
                                </a>
                            </div>
                                <div class="card-header ">
                                    <h4 class="card-title">Books</h4>
                                    <p class="card-category">Here is the list of books availale</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Book ISBN</th>
                                            <th>Book Title</th>
                                            <th>Book Author</th>
                                            <th>Year Published</th>
                                            <th>Book Available</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($books as $book): ?>
                                            <tr>
                                                <td><?php echo $book['book_isbn'];?></td>
                                                <td><?php echo $book['book_name'];?></td>
                                                <td><?php echo $book['book_author'];?></td>
                                                <td><?php echo $book['year_published'];?></td>
                                                <td><?php echo $book['quantity'];?></td>
                                                <td>
                                                <a href="book-edit.php?bid=<?php echo $book['bid']; ?>">
                                                    <button type="submit" class ="btn btn-warning btn-fill pull-right">Edit</button>
                                                    </a>
                                                </td>
                                                <td>
                                                <a href="book-delete.php?bid=<?php echo $book['bid']; ?>">
                                                    <button type="submit" class ="btn btn-danger btn-fill pull-right">Delete</button>
                                                    </a>
                                                </td>
                                               
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                                for($page=1; $page <= $number_of_page; $page++){
                                    echo '<a href="book.php?page='.$page.'" style="margin: right 5px; padding: 5px;">'. $page. ' </a>';
                                }
                            ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="home.php">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="http://psulibrary.palawan.edu.ph/home/">
                                    Company
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Developers<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                <li><a href="https://github.com/ImLiXun17">Maurene Llado</a></li>
                                <li><a href="https://github.com/SeanHarvy">Sean Orga</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script>
const start = new Date();
// update the time every second
setInterval(() => {
  const now = new Date();
  const elapsed = Math.floor((now - start) / 1000);
  
  // get the weekday name from the current date
  const weekdayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  const weekdayIndex = now.getDay();
  const weekdayName = weekdayNames[weekdayIndex];
  
  // get the month name, day, and year from the current date
  const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  const monthIndex = now.getMonth();
  const monthName = monthNames[monthIndex];
  const day = now.getDate();
  const year = now.getFullYear();
  
  // format the time string
  let hours = now.getHours();
  const minutes = now.getMinutes().toString().padStart(2, "0");
  const seconds = now.getSeconds().toString().padStart(2, "0");
  const ampm = hours >= 12 ? "pm" : "am";
  hours %= 12;
  hours = hours ? hours : 12; // convert 0 to 12
  
  const timeString = hours + ":" + minutes + ":" + seconds + " " + ampm;
  
  // construct the final date string
  const dateString = weekdayName + ", " + monthName + " " + day + ", " + year;
  document.getElementById("clock").innerHTML = dateString + " " + timeString;
}, 1000);

    </script>

</html>
