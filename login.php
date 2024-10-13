<?php
session_start(); // Start the session

// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = "";     // Your database password
$dbname = "student_data"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_username = trim($_POST['username']);  // Retrieve entered username or email
    $input_password = $_POST['password'];        // Retrieve entered password
    $hashed_password = md5($input_password);

    // Check if username or password is empty
    if (empty($input_username) || empty($input_password)) {
        echo "Username or password cannot be empty.";
        exit;
    }

    // Prepare SQL query to prevent SQL Injection
    $stmt = $conn->prepare("SELECT id,user_name, password, email_address FROM register_user WHERE user_name = ? OR email_address = ?");
    $stmt->bind_param("ss", $input_username, $input_username);
    $stmt->execute();
    $result = $stmt->get_result();
    // print_r($result->fetch_assoc()); die;

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        // Verify password (assuming you are storing passwords using password_hash)
        if ($hashed_password == $row['password']) {
            // Set session variables for logged-in user
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_id'] = $row['id'];
            // Redirect to a dashboard or protected page
            header("Location: student_data.php");
            exit;
        } else {
            echo "Entered wrong password!";
        }
    } else {
        $_SESSION['login_error'] = true;
        header('Location: login_page.php');
        exit();
    }

    $stmt->close();
}

$conn->close();
?>