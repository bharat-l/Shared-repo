<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "student_data");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$user_name = trim($_POST['username']);
$password = trim($_POST['password']);
$phone_number = trim($_POST['phnumber']);
$email = trim($_POST['email']); // Assuming you have an email field in the form

// Hash the password using MD5 (note: MD5 is not recommended for password hashing)
$hashed_password = md5($password);

// Initialize an array to hold error messages
$errors = [];

// Check if the username, phone number, or email already exists in a single query
if (!empty($user_name) && !empty($phone_number) && !empty($email)) {
    // Prepare the SQL query to check all three conditions at once
    $stmt = $conn->prepare("SELECT user_name, phone_number, email_address FROM register_user WHERE user_name = ? OR phone_number = ? OR email_address = ?");
    $stmt->bind_param("sss", $user_name, $phone_number, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the existing data to identify which field already exists
        $existing_user = $result->fetch_assoc(); // Fetch as associative array

        // Check which field exists and set the appropriate error message
        if (isset($existing_user['user_name']) && $existing_user['user_name'] == $user_name) {
            $errors[] = "Username already exists";
        }

        if (isset($existing_user['phone_number']) && $existing_user['phone_number'] == $phone_number) {
            $errors[] = "Phone number already exists";
        }

        if (isset($existing_user['email_address']) && $existing_user['email_address'] == $email) {
            $errors[] = "Email address already exists";
        }
    }

    $stmt->close();
}

// If there are any errors, redirect back to the form with the errors
if (!empty($errors)) {
    // Redirect with error messages
    $error_message = implode(", ", $errors);
    header("Location: http://localhost/my_projects/projects/registration_page.php?error=" . urlencode($error_message));
    exit();
}

// If no errors, insert the new user into the database
$stmt = $conn->prepare("INSERT INTO register_user (user_name, password, phone_number, email_address, status) VALUES (?, ?, ?, ?, ?)");
$status = 1;
$stmt->bind_param("ssssi", $user_name, $hashed_password, $phone_number, $email, $status);

// Execute the query
if ($stmt->execute()) {
    // Redirect to registration page after successful insertion
    header("Location: http://localhost/my_projects/projects/registration_page.php?success=Registration successful");
    exit();
} else {
    // If there's an error during insertion
    header("Location: http://localhost/my_projects/projects/registration_page.php?error=Error inserting data");
    exit();
}

// Close the prepared statement and connection
$stmt->close();
$conn->close();
?>
