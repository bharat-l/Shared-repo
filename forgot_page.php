<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <link rel="icon" type="image/x-icon" href="Amazon_icon.png">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 350px;
            height: 350px;
            background-color: lightgray;
            position: relative;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .content {
            margin: 10px;
            padding: 10px;
        }

        h2 {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 19px;
            color: rgb(20, 53, 240);
            border-bottom: 1px solid black;
        }

        #mailinput {
            width: 95%;
            margin: 10px 2px 10px 2px;
            padding: 9px;
            border-radius: 6px;
            border: none;
        }

        button {
            margin: 10px 0 10px 0;
            padding: 10px;
            background-color: aqua;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        #back {
            float: right;
        }

        button a {
            text-decoration: none;
        }

        p a {
            font-size: 12px;
            color: rgb(230, 11, 238);
            text-decoration: none;
        }

        p a b:hover {
            text-decoration: underline;
            color: #61045f;
        }

        .popupv {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
            border-radius: 8px;
        }

        .popup {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
            border-radius: 8px;
        }

        .overlay {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 500;
        }

        .warning-icon {
            color: green;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .warning-icons {
            color: #df1212;
            font-size: 24px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content" id="myForm">
            <h2> Forgot Password </h2>
            <label> Enter Your Email: </label>
            <input type="text" name="email" placeholder="Enter Your Email or Username" id="mailinput" required>

            <button type="submit" name="submit" id="submit">SUBMIT</button>
            <button type="button" value="back" name="back" id="back"><a href="login_page.php"> BACK </a></button>
            <p><a href="login_page.php"> Remember Password?<b>Click here</b></a></p>
            <div class="overlay" id="overlay"></div>
            <div class="popupv" id="popupv">
                <i class="fas fa-exclamation-triangle warning-icons"></i>
                <p id="popupMessagev"></p>
                <button onclick="closePopupv()">Close</button>
            </div>
            <div class="popup" id="popup">
                <i class="fas fa-exclamation-triangle warning-icon"></i>
                <p>Password reset link was sent to your E-mail id:</p>
                <p id="popupMessage"></p>
                <button onclick="closePopup()">Close</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#submit').on('click', function (event) {
                event.preventDefault();
                let data = $('#mailinput').val().trim();
                if (data === '') {
                    $('#popupMessagev').text('Please enter your email address.'); // Display an error message if empty
                    $('#popupv').show(); // Show the popup
                    $('#overlay').show(); // Show the overlay
                    $('#mailinput').focus(); // Focus on the input field
                } else {
                    showPopup(); // Call the showPopup function if email is entered
                }
            });
        });

        function showPopup() {
            const inputValue = document.getElementById('mailinput').value;
            document.getElementById('popupMessage').textContent = inputValue;
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('popup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        }

        function closePopupv() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('popupv').style.display = 'none';
        }
    </script>

</body>

</html>
