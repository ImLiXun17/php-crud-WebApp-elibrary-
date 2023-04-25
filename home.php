
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
    <title>Homepage E-Library</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
</head>

<body>
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
                    <div class="row">
                         <div class="col-md-6">
                             <div class="card">
                             <div class="header">
                                <h4 class="title"style="text-align: center;">Top 10 Most Borrowed Books</h4>
                                  <p class="category" style="text-align: center;">Books</p>
                                </div>
                            <div class="content" style="padding-right: 15px;">
                        <canvas id="myChartTopFive"></canvas>
                      <?php
                        require "config/config.php";
                        require "config/db.php";
                        $query02 = "SELECT book.book_name as 'Book Name', book.book_isbn, COUNT(DISTINCT student_id) as 'Borrow Count'
                        FROM borrow
                        INNER JOIN book ON book.book_isbn = borrow.book_isbn
                        GROUP BY book.book_isbn
                        ORDER BY `Borrow Count` DESC
                        LIMIT 10";
                    $result02 = mysqli_query($conn, $query02);
                    if (mysqli_num_rows($result02) > 0) {
                        $count_book = array();
                        $label_chart = array();
                        while ($row = mysqli_fetch_array($result02)) {
                            $count_book[] = $row['Borrow Count'];
                            $label_chart[] = $row['Book Name'];
                        }
                        mysqli_free_result($result02);
                    }else {
                        echo "No records matching your query were found.";
                    }

                        ?>
                <div class="footer">
             <hr>
         <div class="stats" style="text-align: center;">
            <i class="fa fa-clock-o"></i> Update Automatically
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-md-6">
            <div class="card ">
                 <div class="header ">
                     <h4 class="title" style="text-align: center;">Top Colleges</h4>
                        <p class="category" style="text-align: center;">Colleges</p>
                            </div>
                                <div class="content"style="padding-right: 15px;">
                                <canvas id="collegeChartTopFive"></canvas>
                                <?php
                                $query = "SELECT college.college_name as 'College Name', COUNT(DISTINCT student_id) as 'Total Count'
                                FROM borrow
                                INNER JOIN college ON college.id = borrow.coll_id
                                GROUP BY college.id
                                ORDER BY `Total Count` DESC ";
                      $result = mysqli_query($conn, $query);
                      
                      $count_college = array();
                      $lab_chart = array();
                      
                      if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_array($result)) {
                              $count_college[] = $row['Total Count'];
                              $lab_chart[] = $row['College Name'];
                          }
                      } else {
                          echo "No records matching your query were found.";
                      }
                      mysqli_free_result($result);
                      ?>
                        <div class="footer">
                        <hr>
                                     <div class="stats"style="text-align: center;">
                                        <i class="fa fa-clock-o"></i> Update Automatically
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                 <div class="card ">
                 <div class="header ">
                     <h4 class="title" style="text-align: center;">Student By College in Library</h4>
                        <p class="category" style="text-align: center;">Colleges Enrolled in Library</p>
                            </div>
                        <div class="content"style="padding-right: 15px;">
                        <center><canvas id="mycollegeChartTopFive"></canvas></center>
                        <?php
                        $myquery = "SELECT college.college_name as 'myCollege Name', COUNT(DISTINCT sid) as 'myTotal Count'
                        FROM student
                        INNER JOIN college ON college.id = student.college_id
                        GROUP BY student.college_id
                        ORDER BY `myTotal Count` DESC ";
                        $myresult = mysqli_query($conn, $myquery);
                      
                      // Step 2: Create arrays to store the data
                      $count_mycollege = array();
                      $lab_mychart = array();
                      
                      // Step 3: Loop through the result set and populate the arrays
                      if (mysqli_num_rows($myresult) > 0) {
                          while ($myrow = mysqli_fetch_array($myresult)) {
                              $count_mycollege[] = $myrow['myTotal Count'];
                              $lab_mychart[] = $myrow['myCollege Name'];
                          }
                      } else {
                          echo "No records matching your query were found.";
                      }
                      mysqli_free_result($myresult);
                      ?>
                        <div class="footer">
                        <hr>
                                     <div class="stats"style="text-align: center;">
                                        <i class="fa fa-clock-o"></i> Update Automatically
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
         <div class="col-md-6">
             <div class="card ">
                 <div class="header ">
                     <h4 class="title" style="text-align: center;">Top Fines</h4>
                        <p class="category" style="text-align: center;">Borrow fines Category</p>
                            </div>
                                <div class="content"style="padding-right: 15px;">
                                <canvas id="studentChartTopfines"></canvas>
                                <?php
                                $queryf = "SELECT student.student_name as 'Student Name', SUM(borrow.fines) as 'Total Fines'
                                FROM student
                                INNER JOIN borrow ON student.sid = borrow.student_id
                                GROUP BY student.student_name
                                ORDER BY `Total Fines` DESC LIMIT 10";
                                $resultf = mysqli_query($conn, $queryf);

                                $count_fines = array();
                                $fines_chart = array();

                                if (mysqli_num_rows($resultf) > 0) {
                                    while ($rowf = mysqli_fetch_array($resultf)) {
                                        $count_fines[] = $rowf['Total Fines'];
                                        $fines_chart[] = $rowf['Student Name'];
                                    }
                                } else {
                                    echo "No records matching your query were found.";
                                }
                                mysqli_free_result($resultf);
                                ?>

                        <div class="footer">
                        <hr>
                                     <div class="stats"style="text-align: center;">
                                        <i class="fa fa-clock-o"></i> Update Automatically
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                 <div class="card ">
                 <div class="header ">
                     <h4 class="title" style="text-align: center;">No. Students Who Borrow per Month</h4>
                        <p class="category" style="text-align: center;">Borrow Count Category</p>
                            </div>
                                <div class="content"style="padding-right: 15px;">
                                <canvas id="studentChartTopmonths"></canvas>
                                <?php
                                // Retrieve the data
                                $querym = "SELECT Month(borrow.time_borrow) as 'Months', count(DISTINCT student_id) as 'Total Students'
                                        FROM borrow
                                        GROUP BY Month(borrow.time_borrow)
                                        ORDER BY Month(borrow.time_borrow)";
                                $resultm = mysqli_query($conn, $querym);

                                // Initialize arrays for the chart data
                                $count_students = array();
                                $student_chart = array();

                                if (mysqli_num_rows($resultm) > 0) {
                                    while ($rowm = mysqli_fetch_assoc($resultm)) {
                                        $count_students[] = $rowm['Total Students'];
                                        $student_chart[] = date("F", mktime(0, 0, 0, $rowm['Months'], 1));
                                    }
                                } else {
                                    echo "No records matching your query were found.";
                                }

                                // Free the result set
                                mysqli_free_result($resultm);
                                ?>

                        <div class="footer">
                        <hr>
                                     <div class="stats"style="text-align: center;">
                                        <i class="fa fa-clock-o"></i> Update Automatically
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                          <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title" style="text-align: center;">Top 5 Recent Students</h4>
                                    <p class="card-category" style="text-align: center;">Recently added</p>
                                </div>
                                <div class="card-body ">
                                    <br>
                                        <table border="2" style=" margin: 0 auto; width: 80%;
                                        height: 200px;text-align: ceneter;">
                                          <tr>
                                            <th>Student Name</th>
                                            <th>College Name</th>
                                          </tr>
                                          <style>
                                            tr, td, th{
                                                text-align: center;
                                                
                                            }
                                           
                                            th{
                                                background-color: #1AA7EC;
                                                color: #fff;
                                            }
                                            tr:nth-child(even) {
                                                background-color: #f2f2f2;
                                            }
                                            tr:nth-child(odd) {
                                                background-color: rgba(4, 71, 255, 0.08);
                                            }
                                            </style>
                                    <?php
                                            $sql = "SELECT student_name, college_name 
                                                    FROM student 
                                                    INNER JOIN college ON student.college_id = college.id 
                                                    ORDER BY date_add DESC 
                                                    LIMIT 5";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row["student_name"] . "</td>";
                                                    echo "<td>" . $row["college_name"] . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='2'>No results found.</td></tr>";
                                            }
                                          ?>
                                        </table>
                                    <hr>
                                    <div class="stats"style="text-align: center;">
                                        <i class="fa fa-clock-o"></i> Report Update Automatically
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
<style>
#mycollegeChartTopFive {
  width: 400px;
  height: 400px;
}
</style>

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
   <script>
var data = {
  labels: <?php echo json_encode($label_chart); ?>,
  datasets: [{
    label: 'No. of Students who Borrowed Book',
    data: <?php echo json_encode($count_book); ?>,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(255, 206, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(255, 0, 132, 0.2)',
      'rgba(0, 227, 255, 0.2)',
      'rgba(255, 166, 0, 0.2)',
      'rgba(168, 255, 0, 0.2)',
      'rgba(236, 0, 255, 0.2)'

    ],
    borderColor: [
      'rgba(255, 99, 132, 1)',
      'rgba(54, 162, 235, 1)',
      'rgba(255, 206, 86, 1)',
      'rgba(75, 192, 192, 1)',
      'rgba(153, 102, 255, 1)',
      'rgba(255, 0, 132, 1)',
      'rgba(0, 227, 255, 1)',
      'rgba(255, 166, 0, 1)',
      'rgba(168, 255, 0, 1)',
      'rgba(236, 0, 255, 1)'
    ],
    borderWidth: 1
  }]
};

// Create the chart
var ctx = document.getElementById('myChartTopFive').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script>
var data = {
  labels: <?php echo json_encode($lab_chart); ?>,
  datasets: [{
    label: 'No. of Student in College Borrowed',
    data: <?php echo json_encode($count_college); ?>,
    backgroundColor: [
      'rgba(0, 255, 0, 0.2)',
      'rgba(255, 0, 0, 0.2)',
      'rgba(0, 29, 242, 0.2)',
      'rgba(252, 6, 240, 0.2)',
      'rgba(254, 255, 101, 0.2)',
      'rgb(220,20,60, 0.2)',
      'rgba(255, 88, 1, 0.2)',
      'rgba(42, 202, 255, 0.2)',
      'rgba(255, 180, 52, 0.2)'
    ],
    borderColor: [
      'rgba(0, 255, 0, 1)',
      'rgba(255, 0, 0, 1)',
      'rgba(0, 29, 242, 1)',
      'rgba(252, 6, 240, 1)',
      'rgba(254, 255, 101, 1)',
      'rgb(220,20,60, 1)',
      'rgba(255, 88, 1, 1)',
      'rgba(42, 202, 255, 1)',
      'rgba(255, 180, 52, 1)'
    ],
    borderWidth: 1
  }]
};

// Create the chart
var ctx = document.getElementById('collegeChartTopFive').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script>
var data = {
  labels: <?php echo json_encode($lab_mychart); ?>,
  datasets: [{
    label: 'No. of Student in College Borrowed',
    data: <?php echo json_encode($count_mycollege); ?>,
    backgroundColor: [
      'rgba(0, 255, 0, 0.2)',
      'rgba(255, 0, 0, 0.2)',
      'rgba(0, 29, 242, 0.2)',
      'rgba(252, 6, 240, 0.2)',
      'rgba(254, 255, 101, 0.2)',
      'rgb(220,20,60, 0.2)',
      'rgba(255, 88, 1, 0.2)',
      'rgba(255, 180, 52, 0.2)',
      'rgba(0, 255, 225, 0.2)'
      
    ],
    borderColor: [
      'rgba(0, 255, 0, 1)',
      'rgba(255, 0, 0, 1)',
      'rgba(0, 29, 242, 1)',
      'rgba(252, 6, 240, 1)',
      'rgba(254, 255, 101, 1)',
      'rgb(220,20,60, 1)',
      'rgba(255, 88, 1, 1)',
      'rgba(255, 180, 52, 1)',
      'rgba(0, 255, 225, 1)'
    ],
    borderWidth: 1
  }]
};

// Create the chart
var ctx = document.getElementById('mycollegeChartTopFive').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: {
        responsive: false,
    maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script>
var data = {
  labels: <?php echo json_encode($fines_chart); ?>,
  datasets: [{
    label: 'Top 10 highest fines ',
    data: <?php echo json_encode($count_fines); ?>,
    backgroundColor: [
      'rgba(0, 255, 0, 0.2)',
      'rgba(255, 0, 0, 0.2)',
      'rgba(0, 29, 242, 0.2)',
      'rgba(252, 6, 240, 0.2)',
      'rgba(254, 255, 101, 0.2)',
      'rgb(220,20,60, 0.2)',
      'rgba(255, 88, 1, 0.2)',
      'rgba(42, 202, 255, 0.2)',
      'rgba(255, 180, 52, 0.2)'
    ],
    borderColor: [
      'rgba(0, 255, 0, 1)',
      'rgba(255, 0, 0, 1)',
      'rgba(0, 29, 242, 1)',
      'rgba(252, 6, 240, 1)',
      'rgba(254, 255, 101, 1)',
      'rgb(220,20,60, 1)',
      'rgba(255, 88, 1, 1)',
      'rgba(42, 202, 255, 1)',
      'rgba(255, 180, 52, 1)'
    ],
    borderWidth: 1
  }]
};

// Create the chart
var ctx = document.getElementById('studentChartTopfines').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {

        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script>
var data = {
  labels: <?php echo json_encode($student_chart); ?>,
  datasets: [{
    label: 'Top 10 highest fines ',
    data: <?php echo json_encode($count_months); ?>,
    backgroundColor: [
      'rgba(0, 255, 0, 0.2)',
      'rgba(255, 0, 0, 0.2)',
      'rgba(0, 29, 242, 0.2)',
      'rgba(252, 6, 240, 0.2)',
      'rgba(254, 255, 101, 0.2)',
      'rgb(220,20,60, 0.2)',
      'rgba(255, 88, 1, 0.2)',
      'rgba(42, 202, 255, 0.2)',
      'rgba(255, 180, 52, 0.2)'
    ],
    borderColor: [
      'rgba(0, 255, 0, 1)',
      'rgba(255, 0, 0, 1)',
      'rgba(0, 29, 242, 1)',
      'rgba(252, 6, 240, 1)',
      'rgba(254, 255, 101, 1)',
      'rgb(220,20,60, 1)',
      'rgba(255, 88, 1, 1)',
      'rgba(42, 202, 255, 1)',
      'rgba(255, 180, 52, 1)'
    ],
    borderWidth: 1
  }]
};

// Create the chart
var ctx = document.getElementById('studentChartTopmonths').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {

        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script>
    var ctx = document.getElementById('studentChartTopmonths').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo '"' . implode('", "', $student_chart) . '"'; ?>],
            datasets: [{
                label: 'Number of Students',
                data: [<?php echo implode(', ', $count_students); ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

</html>
