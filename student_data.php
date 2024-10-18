<?php
// Start the session
session_start();

if ($_SESSION['user_id'] == '') {
    header('Location: login_page.php');
}

?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Students Data</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="phps.png">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <link rel="stylesheet" href="jscsspage.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <style>
        /* Custom styling for header and footer */
        .form-container {
            padding: 20px;
            box-shadow: 0 14px 20px rgba(0, 0, 0, 0.2);
            margin-top: 15px;
            background-color: white;
            border-radius: 8px;
            overflow-y: auto;

        }

        .inner-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            width: 95%;
        }

        .form-group {
            margin: 5px 0;
            padding: 12px 20px;
            border-radius: 8px;
            display: flex;
            flex-wrap: wrap;
            width: 33.33%;
            justify-content: space-between;
            border-radius: 28px;
            border: none;
        }

        .form-group input {
            border-radius: 8px;
            padding: 12px 20px;
            background-color: transparent;
            margin-top: 8px;
            box-shadow: 0 15px 20px rgba(107, 104, 104, 0.1);
            border-color: lightcyan;
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            outline: none;
            transition: box-shadow 0.3s ease-in-out;

        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: white;
            font-size: 18px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .submit-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
            gap: 25px;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            width: 100%;
            bottom: 0;
            left: 0;
            position: relative;
        }

        .footer a {
            color: #f8f9fa;
            text-decoration: none;
        }

        .footer a:hover {
            color: #dcdcdc;
        }

        .footer .social-icons a {
            margin-right: 15px;
            font-size: 20px;
        }

        .footer p {
            margin-bottom: 0;
        }

        .pagination {
            display: inline-flex;
            justify-content: center;
            align-items: right;
            margin: 3px;
            padding: 5px;
            margin-top: 6px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #007bff;
            border-radius: 3px;
        }

        .pagination strong {
            margin: 0 5px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border-radius: 3px;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }

        /* Profile icon styling */
        #uname {
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            text-align: center;
            line-height: 40px;
            font-weight: bold;
            font-size: 15px;
            text-transform: uppercase;
            position: relative;
            cursor: pointer;
        }

        /* Dropdown for username */
        .profile-dropdown {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 158, 0.1);
            padding: 10px;
            border-radius: 5px;
            top: 50px;
            right: 0;
            z-index: 100;
            white-space: nowrap;
        }

        /* Show the dropdown on hover */
        #uname:hover .profile-dropdown {
            display: block;
        }

        /* Styling for the dropdown text */
        .profile-dropdown p {
            margin: 0;
            color: #343a40;
            font-size: 14px;
            font-weight: normal;
        }

        #myInput {
            background-image: url('searchicon.webp');
            background-position: 10px 12px;
            background-repeat: no-repeat;
            width: 20%;
            font-size: 16px;
            padding: 10px 15px 10px 20px;
            border: 1px solid #ddd;
            margin-top: 30px;
            outline: none;

        }

        #preview {
            margin-top: 15px;
            padding: 5px;
            float: right;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Student Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item" id="uname">
                        <?php
                        $username = $_SESSION['user_name'];
                        $initials = strtoupper($username[0]); // To get the first letter as initials
                        echo $initials;
                        ?>
                        <div class="profile-dropdown">
                            <p><?php echo htmlspecialchars($username); ?></p>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="container mt-5">
            <!-- <h1>Welcome, <?php echo htmlspecialchars(strtoupper($username)); ?>!</h1> -->
            <?php
            // Database connection details
            $conn = mysqli_connect("localhost", "root", "", "student_data");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Set the number of rows per page
            $perPage = 10;

            // Get the current page number from the URL, default to page 1 if not set
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // Calculate the offset for the SQL LIMIT clause
            $startAt = $perPage * ($page - 1);

            // Get the total number of rows in the table
            $totalQuery = "SELECT COUNT(*) as total FROM student_info WHERE student_name != '' AND status = 1";
            $totalResult = mysqli_query($conn, $totalQuery);
            $totalRow = mysqli_fetch_assoc($totalResult);
            $totalRows = $totalRow['total'];

            // Calculate the total number of pages
            $totalPages = ceil($totalRows / $perPage);

            // Fetch the current page results
            $query = "SELECT * FROM student_info WHERE student_name != '' AND status = 1 ORDER BY id DESC LIMIT $startAt, $perPage";
            $result = mysqli_query($conn, $query);
            ?>

            <form action="submitform.php" method="POST" id="textForm" name="formList" autocomplete="off" enctype="multipart/form-data">
                <h2>STUDENT DATA</h2>
                <div class="form-container">
                    <div class="inner-container">


                        <div class="form-group">
                            <label for="studentName">Student name</label>
                            <input type="text" class="form-control" name="StudentName" maxlength="30" pattern="[A-Za-z\s]+" placeholder="Enter full name" required>
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father name</label>
                            <input type="text" class="form-control" name="FatherName" maxlength="30" pattern="[A-Za-z\s]+" placeholder="Enter father name" required>
                        </div>
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <input type="text" class="form-control" name="Address" placeholder="Enter full address" required>
                        </div>
                        <div class="form-group">
                            <label for="Phnumber">Phone number</label>
                            <input type="tel" class="form-control" name="Phnumber" placeholder="Enter phone number" maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label for="Marks">Marks</label>
                            <input type="number" class="form-control" name="Marks" placeholder="Enter your marks" maxlength="3" required>
                        </div>
                        <div class="form-group">
                            <form id="uploadForm" enctype="multipart/form-data">
                                <label for="Email">Email address</label>
                                <input type="email" class="form-control" name="Email" id="mailing" placeholder="Enter mail address" required>
                            </form>
                        </div>
                        <div class="form-group">
                            <form id="uploadForm" enctype="multipart/form-data">
                                <label for="document"> Upload </label>
                                <input type="file" id="imageInput" name="filename" class="form-control" accept="image/*" onchange="uploadImage()">
                                <div id="preview">
                                    <!-- The image preview will be displayed here -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="submit-btn mt-3">
                        <button type="submit" value="submit" name="submit" class="btn btn-primary px-4">SUBMIT</button>
                        <button type="reset" name="clear" class="btn btn-secondary px-4">CLEAR</button>

                    </div>
                </div>
                <?php
                if (isset($_FILES["filename"])) {
                    // Display the uploaded image
                    echo '<img src="uploads/' . htmlspecialchars(basename($_FILES["filename"]["name"])) . '" alt="Uploaded Image" style="max-width: 200px;">';
                }
                ?>


            </form>



            <script>
                function uploadImage() {
                    var formData = new FormData(document.getElementById("uploadForm"));
                    var xhr = new XMLHttpRequest();

                    xhr.open("POST", "upload.php", true);

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // console.log(xhr);
                            // If upload is successful, show the image preview
                            document.getElementById("preview").innerHTML = '<img src="' + xhr.responseText + '" alt="Image Preview" width="300"/>';
                        } else {
                            alert("Image upload failed!");
                        }
                    };

                    xhr.send(formData);
                }
            </script>
        </div>

        <!-- searching here -->
        <div class="search">
            <label> Search records : </label>
            <input type="text" id="myInput" onkeyup="mySearch()" placeholder="Search here">
        </div>

        <div class="tab mt-5">
            <div class="tab-data">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Student name</th>
                            <th>Father name</th>
                            <th>Address</th>
                            <th>Phone number</th>
                            <th>Marks</th>
                            <th>Email address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['student_name']) ?></td>
                                <td><?= htmlspecialchars($row['Father_name']) ?></td>
                                <td><?= htmlspecialchars($row['address']) ?></td>
                                <td><?= htmlspecialchars($row['phone_number']) ?></td>
                                <td><?= htmlspecialchars($row['marks']) ?></td>
                                <td><?= htmlspecialchars($row['email_address']) ?></td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-info text-white">Edit</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteId(<?= $row['id'] ?>)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Initialize DataTable -->
                <script>
                    $(document).ready(function() {
                        $('#example').DataTable({
                            "pagingType": "full_numbers", // Enable pagination buttons
                            "lengthChange": true, // Allow changing number of records per page
                            "searching": true, // Enable search feature
                            "ordering": true, // Enable column ordering
                            "info": true, // Show table information
                            "autoWidth": false, // Disable automatic column width calculation
                        });
                    });
                </script>
            </div>
        </div>

        <div class="entries-box mt-4">
            <?php
            // Display the total number of records
            echo "<p>Total Records: $totalRows</p>";
            ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == $page): ?>
                        <strong><?= $i ?></strong> <!-- Current page highlighted -->
                    <?php else: ?>
                        <a href="?page=<?= $i ?>"> <?= $i ?></a> <!-- Other pages as clickable links -->
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        </form>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="text-center">
            <div class="row">
                <div class="col-md-6">
                    <p>© 2024 Student Portal. All rights reserved.</p>
                </div>
                <div class="col-md-6 social-icons">
                    <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://x.com/?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/accounts/login/" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>



    <script>
        let deleteId = null;

        function setDeleteId(id) {
            deleteId = id;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteId) {
                window.location.href = "delete.php?id=" + deleteId;
            }
        });

        function mySearch() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("formData");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        // Function to load data via AJAX
        function loadPage(pageNumber) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch_data.php?page=" + pageNumber, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Update the table body with the fetched data
                    document.getElementById('formData').innerHTML = xhr.responseText;
                    document.getElementById('pagination').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
        
        // Handle pagination link clicks
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('pagination-link')) {
                e.preventDefault();
                var page = e.target.getAttribute('data-page');
                loadPage(page);
            }
        });
        // Load the first page on initial load
        loadPage(1);
    </script>
</body>

</html>