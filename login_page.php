<?php
session_start();
$login_error = false;
if (isset($_SESSION['login_error']) && $_SESSION['login_error'] == true) {
    $login_error = true;
    // Unset the error after displaying it once
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Amazon_icon.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <form action="login.php" method="POST" id="forms" autocomplete="off">
            <h1 id="heading">Login</h1>
            <div class="content">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="username" class="bottom" placeholder="👤 Type your username" required>
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" name="password" id="myInput" class="bottom" placeholder="🔒 Type your password" required>
                    <input type="checkbox" id="check" onclick="showPass()"> Show Password
                </div>
            </div>
            <div class="forget">
                <p><a href="forgot_page.php">Forgot password?</a></p>
            </div>
            <div class="loginbtn">
                <button type="submit"> LOGIN </button>
            </div>
            <div class="signup">
                <p>Or Sign up using</p>
                <button type="button" id="signup"><a href="registration_page.php">SIGN UP</a></button>
            </div>

            <!-- Modal -->

            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="max-width: 500px; margin: auto;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Invalid username or password. Please try again.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>
    <?php if ($login_error): ?>
        <script>
            $(document).ready(function() {
                $('#errorModal').modal('show');
            });
        </script>
    <?php endif; ?>

    <script>
        function showPass() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>