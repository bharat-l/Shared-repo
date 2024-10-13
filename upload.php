<?php
if ($_FILES['filename']['name']) {
    // Use a file system path, not a URL
    $targetDir = "C:/xampp/htdocs/my_projects/projects/uploads/";  // Corrected path
    $targetFile = $targetDir . basename($_FILES["filename"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is a real image
    $check = getimagesize($_FILES["filename"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB)
    if ($_FILES["filename"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // If everything is okay, try to upload the file
    if ($uploadOk == 1) {
        // This will move the file to the correct filesystem path
        if (move_uploaded_file($_FILES["filename"]["tmp_name"], $targetFile)) {
            // Return the file URL for preview
            $imageUrl = "http://localhost/my_projects/projects/uploads/" . basename($_FILES["filename"]["name"]);
            echo $imageUrl;  // Echo the URL for use in JavaScript to display the image
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
