<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "student_data"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// print_r($_POST); echo "</pre>"; die;
// Get data from the form using POST method
$student_name = $_POST['StudentName'];
$father_name = $_POST['FatherName'];
$address = $_POST['Address'];
$phone_number = $_POST['Phnumber'];
$marks = $_POST['Marks'];
$email_address = $_POST['Email'];

// Sanitize inputs to avoid SQL injection
$student_name = $conn->real_escape_string($student_name);
$father_name = $conn->real_escape_string($father_name);
$address = $conn->real_escape_string($address);
$phone_number = $conn->real_escape_string($phone_number);
$marks = $conn->real_escape_string($marks);
$email_address = $conn->real_escape_string($email_address);

// Insert the data into the database
if ($student_name != '' && !empty($student_name)) {
  $sql = "INSERT INTO student_info (student_name, father_name, address, phone_number, marks, email_address) 
  VALUES ('$student_name', '$father_name', '$address', '$phone_number', '$marks', '$email_address')";
  $insert = mysqli_query($conn, $sql);
} else {
  if ($student_name != '') {
    $mes = 'Enter student name';
  }
  header("location: http://localhost/my_projects/projects/student_data.php", $msg);
}
mysqli_close($conn);
if ($insert) {

  header("location: http://localhost/my_projects/projects/student_data.php");
  // echo "Student info successfully added!";
} else {
  echo "Error" . mysqli_error($conn);
}

?>