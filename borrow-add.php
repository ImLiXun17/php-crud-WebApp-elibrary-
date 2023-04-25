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
    <title>Add Borrow Section - E-Library</title>
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
      
      $query_student = "SELECT sid, student_name FROM student ORDER BY student_name ASC";
      $query = "SELECT bid, book_name, book_isbn FROM book ORDER BY book_name ASC";
      $query_college = "SELECT id, college_name FROM college ORDER BY college_name ASC";
  
      $student = mysqli_query($conn, $query_student);
      $book = mysqli_query($conn, $query);
      $college = mysqli_query($conn, $query_college);
  
      $students_ = mysqli_fetch_all($student, MYSQLI_ASSOC);
      $books_ = mysqli_fetch_all($book, MYSQLI_ASSOC);
      $college_ = mysqli_fetch_all($college, MYSQLI_ASSOC);
  
      if(isset($_POST['submit'])){
          $student_number = mysqli_real_escape_string($conn,$_POST['student_number']);
          $college_id = mysqli_real_escape_string($conn,$_POST['college_id']);
          $book_isbn = mysqli_real_escape_string($conn,$_POST['book_isbn']);
          $time_borrow = mysqli_real_escape_string($conn,$_POST['time_borrow']);
          $time_return = mysqli_real_escape_string($conn,$_POST['time_return']);
          $fines = mysqli_real_escape_string($conn,$_POST['fines']);
          $action = mysqli_real_escape_string($conn,$_POST['action']);
          $query_insert = "INSERT INTO borrow (student_id, coll_id, book_isbn, time_borrow, time_return, fines, action) VALUES('$student_number','$college_id','$book_isbn',
          '$time_borrow','$time_return','$fines','$action')"; 
            
                    // get current quantity of books available

                $sql = "SELECT quantity FROM book WHERE book_isbn = $book_isbn";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $current_quantity = $row['quantity'];

                // calculate new quantity of books available
                $new_quantity = $current_quantity - 1;

                // display message if books still available
                if ($new_quantity >= 0) {
                       // update book table with new quantity of books available
                             $sql = "UPDATE book SET quantity = '$new_quantity' WHERE book_isbn = $book_isbn";
                                mysqli_query($conn, $sql);
                          if(mysqli_query($conn, $query_insert)){
                          header("Location: http://localhost/elibrary/borrow.php");
                      }else{
                          echo "ERROR: " . $query_insert;
                      }
                }else {
                // display new quantity of books notavailable to user
                $error[] = 'No Book Available';
    }
    }
  
      mysqli_free_result($student);
      mysqli_free_result($book);
  
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
                                <?php
                                        if(isset($error)){
                                            foreach($error as $error){
                                            echo '<center><span class = "error-mess" style="padding: 10px; width: auto; color: white; background-color: #FF5C5C; border-radius:  5px;">'.$error.'</span></center>';
                                            };
                                        };
                                    ?>
                                    <h4 class="card-title">Add Borrow</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Student Number</label>
                                                    <input type="number" id = "student_number" class="form-control" onblur="getStudentName()" name = "student_number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pl-1">
                                                <div class="form-group">
                                                    <label>Student Name</label>
                                                    <input type="text" id = "student_name" class="form-control" name = "student_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pl-1">
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
                                            <div class="col-md-3 pl-1">
                                                <div class="form-group">
                                                    <label>Book ISBN</label>
                                                    <input type="number" id = "book_isbn" class="form-control" name = "book_isbn" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Time Borrow</label>
                                                    <input type="datetime-local" id = "time_borrow" class="form-control" name = "time_borrow">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Time Return</label>
                                                    <input type="datetime-local" id = "time-return" class="form-control" name = "time_return">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Fines</label>
                                                    <input type="number" id = "fines" class="form-control" name = "fines">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Action</label>
                                                    <select class="form-control" name="action" id="action">
                                                        <option>Select</option>
                                                        <option value="Paid">Paid</option>
                                                        <option value="Not Paid">Not Paid</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                       <button type="submit" id= "save-button" name="submit" class="btn btn-info btn-fill pull-right">Save</button>
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
<script> function getStudentName(){
    var student_number = document.getElementById("student_number").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == "No data found"){
                document.getElementById("student_name").value = "No Data found";
            } else{
            document.getElementById("student_name").value = this.responseText;
            }
        }
    };
    xhttp.open("Get", "get_student_name.php?student_number="+ student_number, true);
    xhttp.send();
}   
</script>
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
  alert("Student Borrow successfully!");
});
</script>
</html>
