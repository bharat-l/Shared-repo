<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "student_data");

// Check if the 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the student data based on the ID
    $result = mysqli_query($conn, "SELECT * FROM student_info WHERE id = $id");
    $student = mysqli_fetch_assoc($result);
    if (!$student) {
        echo "Student not found!";
        exit;
    }
} else {
    echo "No student ID provided!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Students Data</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="phps.png">
    <link rel="stylesheet" href="jscsspage.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</head>

<body>
    <div class="container">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "student_data");
        $result = mysqli_query($conn, "SELECT * FROM student_info WHERE student_name != '' AND status = 1");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        ?>
        <form action="#" method="POST" id="textForm" name="formList" autocomplete="off">
            <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">
            <h2>STUDENT DATA</h2>
            <div class="form-container">
                <div class="form-group">
                    <label for="studentName">Student name</label>
                    <input type="text" id="textfields" name="StudentName" value="<?= htmlspecialchars($student['student_name']) ?>" maxlength="30" pattern="[A-Za-z\s]+"
                        placeholder="Enter full name" required>
                </div>
                <div class="form-group">
                    <label for="fatherName">Father name</label>
                    <input type="text" id="textfields" name="FatherName" value="<?= htmlspecialchars($student['Father_name']) ?>" maxlength="30" pattern="[A-Za-z\s]+"
                        placeholder="Enter father name" required>
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" name="Address" value="<?= htmlspecialchars($student['address']) ?>" placeholder="Enter full address" required>
                </div>
                <div class="form-group">
                    <label for="Phnumber">Phone number</label>
                    <input type="tel" name="Phnumber" value="<?= htmlspecialchars($student['phone_number']) ?>" id="digits" placeholder="Enter phone number" maxlength="10"
                        required>
                </div>
                <div class="form-group">
                    <label for="Marks">Marks</label>
                    <input type="number" name="Marks" id="digits" value="<?= htmlspecialchars($student['marks']) ?>" placeholder="Enter your marks" maxlength="3" required>
                </div>
                <div class="form-group">
                    <label for="Email">Email address</label>
                    <input type="email" name="Email" id="mailing" value="<?= htmlspecialchars($student['email_address']) ?>" placeholder="Enter mail address" required>
                </div>
                <div class="submit-btn">
                    <button type="submit" value="update" name="update" class="btn1" id="displayButton"> UPDATE </button>
                    <button type="reset" name="clear" class="btn1"><a href="student_data.php"> CANCEL </a></button>
                </div>
        </form>

        <?php
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "student_data");

        // Check if the form was submitted
        if (isset($_POST['update'])) {
            // Get the form data
            $id = $_POST['id'];
            $studentName = $_POST['StudentName'];
            $fatherName = $_POST['FatherName'];
            $address = $_POST['Address'];
            $phoneNumber = $_POST['Phnumber'];
            $marks = $_POST['Marks'];
            $email = $_POST['Email'];

            // Update the student data in the database
            $sql = "UPDATE student_info 
            SET student_name = '$studentName', Father_name = '$fatherName', address = '$address', 
                phone_number = '$phoneNumber', marks = '$marks', email_address = '$email' 
            WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                // Redirect back to the main page or show a success message
                header("Location: student_data.php");
                exit;
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
        ?>

</body>

</html>