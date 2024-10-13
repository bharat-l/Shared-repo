<?php
// Start output buffering to prevent premature output
ob_start();

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "student_data");

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Cast the ID to an integer for safety

    // Prepare the query to update the status of the row instead of deleting it
    $query = "UPDATE student_info SET status = 0 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); // Bind the ID as an integer

    if ($stmt->execute()) {
        // Success: Redirect back to the main page with a success message
        // Here, ensure that the redirect is to the correct page (index.php or student_data.php, as needed)
        header("Location: student_data.php");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        // Failure: Display an error message
        echo "Error updating record status: " . $conn->error;
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}

// End output buffering and send output to the browser
ob_end_flush();
