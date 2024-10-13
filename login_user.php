<?php
session_start(); // Start a session for the user

// Database connection
$conn = mysqli_connect("localhost", "root", "", "student_data");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Check if both username and password are provided
if (!empty($username) && !empty($password)) {
    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT id, password FROM register_user WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    
    // Execute the query
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // If the user exists, fetch the hashed password
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        
        // Verify the entered password with the hashed password
        if (password_verify($password, $hashed_password)) {
            // Password matches, create a session for the user
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            
            // Redirect to the welcome or dashboard page
            header("Location: student_data.php");
            exit();
        } else {
            // If the password doesn't match
            header("Location: login_page.php?error=Incorrect password");
            exit();
        }
    } else {
        // If the username doesn't exist in the database
        header("Location: login_page.php?error=User does not exist");
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    // If any field is empty, redirect back with an error
    header("Location: login_page.php?error=Please fill in all fields");
    exit();
}

// Close the connection
$conn->close();
?>
