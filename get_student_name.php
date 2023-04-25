<?php

require "config/config.php";
require "config/db.php";

// Get student number from GET request
$student_number = $_GET["student_number"];

// Prepare SQL statement
$stmt = $conn->prepare("SELECT student_name FROM student WHERE sid = ?");
$stmt->bind_param("s", $student_number);

// Execute SQL statement
$stmt->execute();

// Bind result variables
$stmt->bind_result($student_name);

// Fetch results
if ($stmt->fetch()) {
    // If result found, output student name
    echo $student_name;
} else {
    // If no result found, output "No data found"
    echo "No data found";
}

// Close statement and connection
$stmt->close();
$conn->close();


?>