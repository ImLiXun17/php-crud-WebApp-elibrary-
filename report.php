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
    <title>Report Section E-Library</title>
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

        date_default_timezone_set("Asia/Manila");
        $start = time();

    ?>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-6.jpg">

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
                    <div class="form-control"><center><p>Summary Report: This report shows the percentage of colleges for borrowing books<p></center>
                </div><br>
                    <div class="row">
                    <div class="col-md-4">
                          <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title" style="text-align: center;">College of Arts and Humanities (CAH)</h4>
                                    <p class="card-category" style="text-align: center;">College Book Borrowed</p>
                                </div>
                                <div class="card-body ">
                                    <div class="org-logo"style= "display: flex;justify-content: center; 
                                     align-items: center;"><img src="assets/img/cah.jpg" alt="cah" height="120" width="120"></div>
                                    <br>
                                    <?php
                                        // Query the database to count the number of students in the college
                                        $result = $conn->query("SELECT COUNT(*) as total FROM (SELECT COUNT(DISTINCT borrow_id) FROM borrow WHERE coll_id = 132 GROUP BY student_id) as total_borrows");
                                        $row = $result->fetch_assoc();
                                        $total_borrow = $row['total'];
                                        

                                        // Query the database to count the total number of students
                                        $result = $conn->query("SELECT COUNT(*) as total_students FROM student ");
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_students'];

                                        // Calculate the percentage of students in the college
                                        $percentage = ($total_borrow / $total) * 100;

                                        // Format the percentage with 2 decimal places
                                        $percentage_formatted = number_format($percentage, 2);

                                        echo '<div class="percent"style="color: #fff; padding: 5px; background-color:#009e60;border-radius: 5px; text-align: center;">';
                                        echo "<b>Borrowed Books: " . $percentage_formatted . "%</b>";
                                        echo '</div>';      
                                    ?>
                                    <style>
                                    .percent{
                                        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                    }
                                    </style>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Report Update Automatically
                                    </div>         
                               </div>
                         </div>
                     </div>
                          <div class="col-md-4">
                                <div class="card ">
                                      <div class="card-header ">
                                           <h4 class="card-title"style="text-align: center;">College of Business and Accountancy (CBA)</h4>
                                             <p class="card-category"style="text-align: center;">College Book Borrowed</p>
                                      </div>
                                 <div class="card-body ">
                                 <div class="org-logo"style= "display: flex;justify-content: center; 
                                     align-items: center;"><img src="assets/img/cba.png" alt="cba" height="120" width="120"></div>
                                 <br>
                                 <?php
                                        // Query the database to count the number of students in the college
                                        $result = $conn->query("SELECT COUNT(*) as total FROM (SELECT COUNT(DISTINCT borrow_id) FROM borrow WHERE coll_id = 133 GROUP BY student_id) as total_borrows");
                                        $row = $result->fetch_assoc();
                                        $total_borrow = $row['total'];

                                        // Query the database to count the total number of students
                                        $result = $conn->query("SELECT COUNT(*) as total_students FROM student ");
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_students'];

                                        // Calculate the percentage of students in the college
                                        $percentage = ($total_borrow / $total) * 100;

                                        // Format the percentage with 2 decimal places
                                        $percentage_formatted = number_format($percentage, 2);

                                        echo '<div class="percent"style="color: #fff; padding: 5px; background-color:#009e60;border-radius: 5px; text-align: center;">';
                                        echo "<b>Borrowed Books: " . $percentage_formatted . "%</b>";
                                        echo '</div>';      
                                    ?>
                            <hr>
                         <div class="stats">
                       <i class="fa fa-clock-o"></i> Report Update Automatically
                     </div>           
             </div>
        </div>

    </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title"style="text-align: center;">College of Crriminal Justice Education (CCJE)</h4>
                        <p class="card-category"style="text-align: center;">College Books Borrowed</p>
                            </div>
                             <div class="card-body ">
                             <div class="org-logo"style= "display: flex;justify-content: center; 
                                     align-items: center;"><img src="assets/img/ccje.png" alt="ccje" height="120" width="120"></div>
                             <br>
                             <?php
                                        // Query the database to count the number of students in the college
                                        $result = $conn->query("SELECT COUNT(*) as total FROM (SELECT COUNT(DISTINCT borrow_id) FROM borrow WHERE coll_id = 134 GROUP BY student_id) as total_borrows");
                                        $row = $result->fetch_assoc();
                                        $total_borrow = $row['total'];

                                        // Query the database to count the total number of students
                                        $result = $conn->query("SELECT COUNT(*) as total_students FROM student ");
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_students'];

                                        // Calculate the percentage of students in the college
                                        $percentage = ($total_borrow / $total) * 100;

                                        // Format the percentage with 2 decimal places
                                        $percentage_formatted = number_format($percentage, 2);

                                        echo '<div class="percent"style="color: #fff; padding: 5px; background-color:#009e60;border-radius: 5px; text-align: center;">';
                                        echo "<b>Borrowed Books: " . $percentage_formatted . "%</b>";
                                        echo '</div>';      
                                    ?>
                            <hr>
                         <div class="stats">
                       <i class="fa fa-clock-o"></i> Report Update Automatically
                     </div>           
             </div>
        </div>
    </div>
         <div class="col-md-4">
                          <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title"style="text-align: center;">College of Engineering, Architecture & Technology</h4>
                                    <p class="card-category"style="text-align: center;">College Books Borrowed</p>
                                </div>
                                <div class="card-body ">
                                <div class="org-logo"style= "display: flex;justify-content: center; 
                                     align-items: center;"><img src="assets/img/ceat2.jpg" alt="ceat" height="120" width="120"></div>
                                <br>
                                <?php
                                        // Query the database to count the number of students in the college
                                        $result = $conn->query("SELECT COUNT(*) as total FROM (SELECT COUNT(DISTINCT borrow_id) FROM borrow WHERE coll_id = 135 GROUP BY student_id) as total_borrows");
                                        $row = $result->fetch_assoc();
                                        $total_borrow = $row['total'];

                                        // Query the database to count the total number of students
                                        $result = $conn->query("SELECT COUNT(*) as total_students FROM student ");
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_students'];

                                        // Calculate the percentage of students in the college
                                        $percentage = ($total_borrow / $total) * 100;

                                        // Format the percentage with 2 decimal places
                                        $percentage_formatted = number_format($percentage, 2);

                                        echo '<div class="percent"style="color: #fff; padding: 5px; background-color:#009e60;border-radius: 5px; text-align: center;">';
                                        echo "<b>Borrowed Books: " . $percentage_formatted . "%</b>";
                                        echo '</div>';      
                                    ?>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Report Update Automatically
                                    </div>         
                               </div>
                         </div>
                     </div>
                          <div class="col-md-4">
                                <div class="card ">
                                      <div class="card-header ">
                                           <h4 class="card-title" style="text-align: center;">College of Hospitality and Tourism Management(CHTM)</h4>
                                             <p class="card-category"style="text-align: center;">College Books Borrowed</p>
                                      </div>
                                 <div class="card-body ">
                                 <div class="org-logo"style= "display: flex;justify-content: center; 
                                     align-items: center;"><img src="assets/img/chtm.jpg" alt="chtm" height="120" width="120"></div>
                                 <br>
                                 <?php
                                        // Query the database to count the number of students in the college
                                        $result = $conn->query("SELECT COUNT(*) as total FROM (SELECT COUNT(DISTINCT borrow_id) FROM borrow WHERE coll_id = 136 GROUP BY student_id) as total_borrows");
                                        $row = $result->fetch_assoc();
                                        $total_borrow = $row['total'];

                                        // Query the database to count the total number of students
                                        $result = $conn->query("SELECT COUNT(*) as total_students FROM student ");
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_students'];

                                        // Calculate the percentage of students in the college
                                        $percentage = ($total_borrow / $total) * 100;

                                        // Format the percentage with 2 decimal places
                                        $percentage_formatted = number_format($percentage, 2);

                                        echo '<div class="percent"style="color: #fff; padding: 5px; background-color:#009e60;border-radius: 5px; text-align: center;">';
                                        echo "<b>Borrowed Books: " . $percentage_formatted . "%</b>";
                                        echo '</div>';      
                                    ?>
                            <hr>
                         <div class="stats">
                       <i class="fa fa-clock-o"></i> Report Update Automatically
                     </div>           
             </div>
        </div>
    </div>
        <div class="col-md-4">
                                <div class="card ">
                                      <div class="card-header ">
                                           <h4 class="card-title"style="text-align: center;">College of Nursing and Health Sciences (CNHS)</h4>
                                             <p class="card-category"style="text-align: center;">College Books Borrowed</p>
                                      </div>
                                 <div class="card-body ">
                                 <div class="org-logo"style= "display: flex;justify-content: center; 
                                     align-items: center;"><img src="assets/img/cnhs.jpg" alt="cah" height="120" width="120"></div>
                                 <br>
                                 <?php
                                        // Query the database to count the number of students in the college who borrowed
                                        $result = $conn->query("SELECT COUNT(*) as total FROM (SELECT COUNT(DISTINCT borrow_id) FROM borrow WHERE coll_id = 137 GROUP BY student_id) as total_borrows");
                                        $row = $result->fetch_assoc();
                                        $total_borrow = $row['total'];
                                        

                                        // Query the database to count the total number of students
                                        $result = $conn->query("SELECT COUNT(*) as total_students FROM student ");
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_students'];

                                        // Calculate the percentage of students in the college
                                        $percentage = ($total_borrow / $total) * 100;

                                        // Format the percentage with 2 decimal places
                                        $percentage_formatted = number_format($percentage, 2);

                                        echo '<div class="percent"style="color: #fff; padding: 5px; background-color:#009e60;border-radius: 5px; text-align: center;">';
                                        echo "<b>Borrowed Books: " . $percentage_formatted . "%</b>";
                                        echo '</div>';      
                                    ?>
                            <hr>
                         <div class="stats">
                       <i class="fa fa-clock-o"></i> Report Update Automatically
                     </div>           
             </div>
        </div>
    </div>
    <div class="col-md-4">
                          <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title"style="text-align: center;">College of Sciences (CS)</h4>
                                    <p class="card-category"style="text-align: center;">College Books Borrowed</p>

                                </div>
                                <br>
                                <div class="card-body ">
                                <div class="org-logo" style= "display: flex;justify-content: center; 
                                     align-items: center;"><img src="assets/img/cs2.jpg" alt="cah" height="120" width="120"></div>
                                <br>
                                <?php
                                        // Query the database to count the number of students in the college
                                        $result = $conn->query("SELECT COUNT(*) as total FROM (SELECT COUNT(DISTINCT borrow_id) FROM borrow WHERE coll_id = 138 GROUP BY student_id) as total_borrows");
                                        $row = $result->fetch_assoc();
                                        $total_borrow = $row['total'];

                                        // Query the database to count the total number of students
                                        $result = $conn->query("SELECT COUNT(*) as total_students FROM student ");
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_students'];

                                        // Calculate the percentage of students in the college
                                        $percentage = ($total_borrow / $total) * 100;

                                        // Format the percentage with 2 decimal places
                                        $percentage_formatted = number_format($percentage, 2);

                                        echo '<div class="percent"style="color: #fff; padding: 5px; background-color:#009e60;border-radius: 5px; text-align: center;">';
                                        echo "<b>Borrowed Books: " . $percentage_formatted . "%</b>";
                                        echo '</div>';      
                                    ?>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Report Update Automatically
                                    </div>         
                               </div>
                         </div>
                     </div>
                          <div class="col-md-4">
                                <div class="card ">
                                      <div class="card-header ">
                                           <h4 class="card-title" style="text-align: center;">College of Teacher Education (CTE)</h4>
                                             <p class="card-category" style="text-align: center;">College Books Borrowed</p>
                                      </div>
                                 <div class="card-body ">
                                 <div class="org-logo"style= "display: flex;justify-content: center; 
                                     align-items: center;"><img src="assets/img/cte.jpg" alt="cah" height="120" width="120"></div>
                                     <br>
                                     <?php
                                        // Query the database to count the number of students in the college
                                        $result = $conn->query("SELECT COUNT(*) as total FROM (SELECT COUNT(DISTINCT borrow_id) FROM borrow WHERE coll_id = 139 GROUP BY student_id) as total_borrows");
                                        $row = $result->fetch_assoc();
                                        $total_borrow = $row['total'];

                                        // Query the database to count the total number of students
                                        $result = $conn->query("SELECT COUNT(*) as total_students FROM student ");
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_students'];

                                        // Calculate the percentage of students in the college
                                        $percentage = ($total_borrow / $total) * 100;

                                        // Format the percentage with 2 decimal places
                                        $percentage_formatted = number_format($percentage, 2);

                                        echo '<div class="percent"style="color: #fff; padding: 5px; background-color:#009e60;border-radius: 5px; text-align: center;">';
                                        echo "<b>Borrowed Books: " . $percentage_formatted . "%</b>";
                                        echo '</div>';      
                                    ?>
                            <hr>
                         <div class="stats">
                       <i class="fa fa-clock-o"></i> Report Update Automatically
                     </div>           
             </div>
        </div>
    </div>
        <div class="col-md-4">
                                <div class="card ">
                                      <div class="card-header ">
                                           <h4 class="card-title"style="text-align: center;">Laboratory Senior High School(LSHS)</h4>
                                             <p class="card-category"style="text-align: center;">College Book Borrowed</p>
                                      </div>
                                 <div class="card-body ">
                                 <div class="org-logo"style= "display: flex;justify-content: center; 
                                     align-items: center;"><img src="assets/img/lshs.jpg" alt="cah" height="120" width="120"></div>
                                       <br>
                                       <?php
                                        // Query the database to count the number of students in the college
                                        $result = $conn->query("SELECT COUNT(*) as total FROM (SELECT COUNT(DISTINCT borrow_id) FROM borrow WHERE coll_id = 140 GROUP BY student_id) as total_borrows");
                                        $row = $result->fetch_assoc();
                                        $total_borrow = $row['total'];

                                        // Query the database to count the total number of students
                                        $result = $conn->query("SELECT COUNT(*) as total_students FROM student ");
                                        $row = $result->fetch_assoc();
                                        $total = $row['total_students'];

                                        // Calculate the percentage of students in the college
                                        $percentage = ($total_borrow / $total) * 100;

                                        // Format the percentage with 2 decimal places
                                        $percentage_formatted = number_format($percentage, 2);

                                        echo '<div class="percent"style="color: #fff; padding: 5px; background-color:#009e60;border-radius: 5px; text-align: center;">';
                                        echo "<b>Borrowed Books: " . $percentage_formatted . "%</b>";
                                        echo '</div>';      
                                    ?>
                            <hr>
                         <div class="stats">
                       <i class="fa fa-clock-o"></i> Report Update Automatically
                     </div>           
             </div>
            </div>
            </div>
            </div>
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


