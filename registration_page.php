<!DOCTYPE html>
<html lang="en">
<head>
    <title> Registration page </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link rel="icon" type="image/x-icon" href="Amazon_icon.png">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="register_user.php" method="POST" autocomplete="off">
            <h2> Registration </h2>

            <!-- Display error or success messages -->
            <?php if (isset($_GET['error'])): ?>
                <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php elseif (isset($_GET['success'])): ?>
                <p style="color: green;"><?php echo htmlspecialchars($_GET['success']); ?></p>
            <?php endif; ?>

            <div class="content">
                <div class="form-group" id="form_creation">
                    <label for="fname">Full Name</label>
                    <input type="text" name="name" class="fullname" id="fname" placeholder="Enter Full Name" required>
                </div>
                <div class="form-group">
                    <label for="uname">User Name</label>
                    <input type="text" name="username" class="fullname" id="uname" placeholder="Enter User Name" required>
                </div>
                <div class="form-group">
                    <label for="emailid">Email</label>
                    <input type="email" name="email" class="fullname" id="emailid" placeholder="Enter your valid email address" required>
                </div>
                <div class="form-group">
                    <label for="phno">Phone Number</label>
                    <input type="tel" name="phnumber" class="fullname" id="phno" placeholder="Enter Your Phone Number" maxlength="10" required>
                </div>
                <div class="form-group">
                    <label for="passw">Password</label>
                    <input type="password" name="password" class="fullname" id="passw" placeholder="Enter New Password" required>
                </div>
                <div class="form-group">
                    <label for="conpass">Confirm Password</label>
                    <input type="password" name="confpass" class="fullname" id="confpass" placeholder="Confirm Your Password" required>
                </div>
            </div>
    
            <label class="gender-title">Gender</label>
            <div class="gender-selection">
                <input type="radio" name="gender" id="male" value="Male"> <label for="male"> Male </label>
                <input type="radio" name="gender" id="female" value="Female"> <label for="female"> Female </label>
                <input type="radio" name="gender" id="other" value="Other"> <label for="other"> Other </label>
            </div>
    
            <div class="para">
                <p> By clicking Sign Up, You agree to our <a href="#">Terms, </a><a href="#"> Privacy Policy</a> and<a href="#"> Cookies Policy</a>. You may receive SMS notifications from us and can opt out at any time. </p>
            </div>
            <div class="registerbtn">
                <button type="submit" id="registration"> Register </button>
            </div>
            <div class="backlink">
                <a href="login_page.php"> Already have an account?<b> Click here</b></a>
            </div>
        </form>
    </div>
    
    <script>
        $(document).ready(function () {
            $('#registration').on('click', function (event) {
                event.preventDefault(); // Prevent default form submission
    
                function validate() {
                    if ($('#fname').val().trim() === '') {
                        alert("Please enter your full name");
                        $('#fname').focus();
                        return false;
                    }
                    if ($('#uname').val().trim() === '') {
                        alert("Please enter your user name");
                        $('#uname').focus();
                        return false;
                    }
                    if ($('#emailid').val().trim() === '') {
                        alert("Please enter your email address");
                        $('#emailid').focus();
                        return false;
                    }
                    let phoneNumber = $('#phno').val().trim();
                    if (phoneNumber === '' || isNaN(phoneNumber) || phoneNumber.length !== 10) {
                        alert("Please enter a valid 10-digit phone number");
                        $('#phno').focus();
                        return false;
                    }
                    if ($('#passw').val().trim() === '') {
                        alert("Please enter your password");
                        $('#passw').focus();
                        return false;
                    }
                    if ($('#confpass').val().trim() === '') {
                        alert("Please confirm your password");
                        $('#confpass').focus();
                        return false;
                    }
                    if ($('#passw').val() !== $('#confpass').val()) {
                        alert("Passwords do not match");
                        $('#confpass').focus();
                        return false;
                    }
                    if (!$('input[name="gender"]:checked').val()) {
                        alert("Please select your gender");
                        return false;
                    }
    
                    return true;
                }
    
                if (validate()) {
                    // If validation passes, submit the form
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
</body>
</html>