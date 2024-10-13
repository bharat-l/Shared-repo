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
        $result = mysqli_query($conn, "SELECT * FROM student_info WHERE student_name != '' AND status = 1 order by id desc");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        ?>
        <form action="submitform.php" method="POST" id="textForm" name="formList" autocomplete="off">
            <h2>STUDENT DATA</h2>
            <div class="form-container">
                <div class="form-group">
                    <label for="studentName">Student name</label>
                    <input type="text" id="textfields" name="StudentName" maxlength="30" pattern="[A-Za-z\s]+"
                        placeholder="Enter full name" required>
                </div>
                <div class="form-group">
                    <label for="fatherName">Father name</label>
                    <input type="text" id="textfields" name="FatherName" maxlength="30" pattern="[A-Za-z\s]+"
                        placeholder="Enter father name" required>
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" name="Address" placeholder="Enter full address" required>
                </div>
                <div class="form-group">
                    <label for="Phnumber">Phone number</label>
                    <input type="tel" name="Phnumber" id="digits" placeholder="Enter phone number" maxlength="10"
                        required>
                </div>
                <div class="form-group">
                    <label for="Marks">Marks</label>
                    <input type="number" name="Marks" id="digits" placeholder="Enter your marks" maxlength="3" required>
                </div>
                <div class="form-group">
                    <label for="Email">Email address</label>
                    <input type="email" name="Email" id="mailing" placeholder="Enter mail address" required>
                </div>
                <div class="submit-btn">
                    <button type="submit" value="submit" name="submit" class="btn1" id="displayButton"
                        onclick="myFunction()"> SUBMIT </button>
                    <button type="reset" name="clear" class="btn1">CLEAR</button>
                </div>
                <div class="tab">
                    <div class="tab-data">
                        <table width="100%" class="table-content">
                            <thead>
                                <tr>
                                    <th> Student name</th>
                                    <th> Father name</th>
                                    <th> Address </th>
                                    <th> Phone number</th>
                                    <th> Marks </th>
                                    <th> Email address </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody id="formData">
                                <?php foreach ($data as $row):  ?>
                                    <tr>
                                        <td> <?= htmlspecialchars($row['student_name']) ?></td>
                                        <td> <?= htmlspecialchars($row['Father_name']) ?></td>
                                        <td> <?= htmlspecialchars($row['address']) ?></td>
                                        <td> <?= htmlspecialchars($row['phone_number']) ?></td>
                                        <td> <?= htmlspecialchars($row['marks']) ?></td>
                                        <td> <?= htmlspecialchars($row['email_address']) ?></td>
                                        <td>
                                            <div class="flex">
                                                <button id="edit"><a href="edit.php?id=<?= $row['id'] ?>"> EDIT </a></button><button id="delete"><a href="delete.php?id=<?= $row['id'] ?>">DELETE</a></button>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

        </form>
        <button type="button"><a href="Login_page.html"> Logout </a></button>

    </div>

    <?php
    // Database connection details
    $servername = "localhost";
    $user = "root";
    $password = "";
    $dbname = "student_data";

    // Create a connection
    $conn = new mysqli($servername, $user, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set the number of rows per page
    $perPage = 10;

    // Get the current page number from the URL, default to page 1 if not set
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calculate the offset for the SQL LIMIT clause
    $startAt = $perPage * ($page - 1);

    // Get the total number of rows in the table
    $totalQuery = "SELECT COUNT(*) as total FROM redirect WHERE user_id = ?";
    $stmt = $conn->prepare($totalQuery);
    $stmt->bind_param("i", $_SESSION['user_id']); // Bind user_id from session
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $totalRows = $row['total'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRows / $perPage);

    // Query to get the current page results
    $query = "SELECT * FROM redirect WHERE user_id = ? ORDER BY timestamp DESC LIMIT ?, ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $_SESSION['user_id'], $startAt, $perPage); // Bind user_id, startAt, and perPage
    $stmt->execute();
    $result = $stmt->get_result();


    // Pagination links
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $page) {
            echo "<strong>$i</strong> "; // Highlight the current page
        } else {
            echo "<a href='?page=$i'>Page $i</a> ";
        }
    }
    echo "</div>";

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>



    <script>
        // Form validation code
        function validate() {
            if (document.formList.StudentName.value == "") {
                alert("Please enter your name!");
                document.formList.StudentName.focus();
                return false;
            }

            if (document.formList.FatherName.value == "") {
                alert("Please enter your father name!");
                document.formList.FatherName.focus();
                return false;
            }
            if (document.formList.Address.value == "") {
                alert("Please enter your address!");
                document.formList.Address.focus();
                return false;
            }
            if (document.formList.Phnumber.value == "" || isNaN(document.formList.Phnumber.value) ||
                document.formList.Phnumber.value.length != 10) {
                alert("Please enter Phone number in the format (0-9) Digits only.");
                document.formList.Phnumber.focus();
                return false;
            }
            if (document.formList.Marks.value == "" || isNaN(document.formList.Marks.value)) {
                alert("Please enter your Marks!");
                document.formList.Marks.focus();
                return false;
            }
            if (document.formList.Email.value == "") {
                alert("Please enter your Email ID!");
                document.formList.Email.focus();
                return false;

            }

            return true;
        }

        function myToast(isUpdate = false) {
            let toastMessage = isUpdate ? "Student details updated successfully!" : "Student details added successfully!";
            Toastify({
                text: toastMessage,
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, blue, green)",
                    borderRadius: "10px",
                },
                onClick: function() {} // Callback after click
            }).showToast();
        }
    </script>

</body>

</html>