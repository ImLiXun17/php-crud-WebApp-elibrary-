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
    <title>Add Student Section - E-Library</title>
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
<?php
        require "config/config.php";
        require "config/db.php";
        $query_college = "SELECT id, college_name FROM college";
        $query = "SELECT sid,student_name  From student";

        $college = mysqli_query($conn, $query_college);
        $student = mysqli_query($conn, $query);

        $college_ = mysqli_fetch_all($college, MYSQLI_ASSOC);

        if(isset($_POST['submit'])){
            $student_number = mysqli_real_escape_string($conn, $_POST['student_number']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $college_id = mysqli_real_escape_string($conn, $_POST['college_id']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);

            $query_insert = "INSERT INTO student(sid, student_name, corporate_email, college_id, address, date_add) values('$student_number', '$name', '$email','$college_id', '$address', now())";
            if(mysqli_query($conn, $query_insert)){
                header("Location: http://localhost/elibrary/student-add.php");
            }else{
                echo "ERROR: " . mysqli_error($conn); 
            }
            mysqli_free_result($college);
            mysqli_close($conn);
            
        }

    ?>

<body>
    <div class="wrapper">
        <div class="sidebar"data-color="blue" data-image="assets/img/sidebar-2.jpg">
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
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Student</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Student Number</label>
                                                    <input type="number" class="form-control" name= "student_number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Full Namae</label>
                                                    <input type="text" class="form-control" placeholder="e.g. Delacruz, Juan C." name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Corporate Email</label>
                                                    <input type="email" class="form-control" name="email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label>College</label>
                                                    <select class="form-control" name="college_id">
                                                        <option>Select</option>
                                                        <?php foreach($college_ as $colleges):?>
                                                            <option value="<?php echo $colleges['id'];?>" >
                                                                <?php echo $colleges['college_name'];?>
                                                            </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" name="address"required>
                                                </div>
                                            </div>
                                        </div>
                                       <button type="submit" id="save-button" name="submit" class="btn btn-info btn-fill pull-right">Save</button>
                                       <div class="clearfix"></div>
                                </form>
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
    <!--   -->
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
    <script>
document.getElementById("save-button").addEventListener("click", function() {
  alert("Student added successfully!");
});
</script>
</html>
