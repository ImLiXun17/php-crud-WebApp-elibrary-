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
    <title>Edit Section - E-Library</title>
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

            $sid = $_GET['sid'];
            $query_Id = "SELECT * FROM student WHERE sid = $sid";
            $result_Id = mysqli_query($conn, $query_Id);

            $query = "SELECT  id, college_name From  college";
            $college = mysqli_query($conn, $query);

        if(count(array($result_Id))==1){
           $student = mysqli_fetch_array($result_Id);
           $student_name  =$student['student_name'];
           $email = $student['corporate_email'];
           $college_id = $student['college_id'];
           $address = $student['address'];
        }


 mysqli_free_result($result_Id);

//check if submitted
if(isset($_POST['submit'])){
    //get the data
   $student_name = mysqli_real_escape_string($conn,$_POST['student_name']);
   $email= mysqli_real_escape_string($conn,$_POST['corporate_email']);
   $college_id = mysqli_real_escape_string($conn,$_POST['college_id']);
   $address = mysqli_real_escape_string($conn,$_POST['address']);

//create insert query 
$update_query= "UPDATE student SET student_name = '$student_name', corporate_email = '$email', college_id = '$college_id', address ='$address'
WHERE sid = $sid";
// execute query 
if(mysqli_query($conn, $update_query)){
header("Location: http://localhost/elibrary/student.php");
}else{
    echo 'ERROR: '.mysqli_error($conn);


}
}

?>
<body>
    <div class="wrapper">
        <div class="sidebar"data-color="blue" data-image="assets/img/sidebar-2.jpg">
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
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Book</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" name= "student_name"value="<?php echo $student_name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Corporate Email</label>
                                                    <input type="email" class="form-control" name ="corporate_email"value="<?php echo $email; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>College</label>
                                                    <select class="form-control" name="college_id">
                                                        <option>Select</option>
                                                        <?php while($college_row = mysqli_fetch_assoc($college)):?>
                                                            <?php if($college_row['id'] == $college_id):?>
                                                                <option value="<?php echo $college_row['id']; ?>" selected>
                                                                    <?php echo $college_row['college_name']; ?>
                                                                </option>  
                                                            <?php else:?>
                                                                <option value="<?php echo $college_row['id']; ?>">
                                                                    <?php echo $college_row['college_name']; ?>
                                                                </option>
                                                            <?php endif?>
                                                        <?php endwhile;?>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <input type="text" class="form-control" name="address"value="<?php echo $address; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" id = "save-button" name="submit" class="btn btn-info btn-fill pull-right">Save</button>
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
  alert("Student update successfully!");
});
</script>
</html>
