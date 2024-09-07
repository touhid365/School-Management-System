<?php
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database connection (update with your own DB details)
    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "students_db";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        $message = '<div class="alert alert-danger" role="alert">Connection failed: ' . $conn->connect_error . '</div>';
    } else {
        $sql = "SELECT id FROM admins WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $message = '<div class="alert alert-danger" role="alert"> This email Id is already exists! please use another one.</div>'; // Email already exists
        } else {
        // Insert into database
        $sql = "INSERT INTO admins (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $message = '<div class="alert alert-success" role="alert"> Admin registered successfully</div>';
        } else {
            $message = '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }

        $conn->close();
    }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/permission.png" type="image/x-icon">
    <style>
        body {
            background-color: #f0f0f0;
            font-family: sans-serif, 'nunito';
        }
        .registration-card {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .registration-card input
        {
            border: 2px solid #ccc;
        }
        .registration-card input:hover
        {
            border: 2px solid coral;
        }
        .btn
        {
            background: coral;
            border: none;
        }
        input::placeholder
        {
            color: #777;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="registration-card">
        <h3 class="text-center">Admin Registration</h3>
        
        <!-- Message Display -->
        <div id="messageBox"></div>
        <?php if (!empty($message)) echo $message; ?>

        <form id="registrationForm" method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile no" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div id="passwordHelpBlock" class="form-text">
                Your password must be at least 8 characters long.
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            var messageBox = document.getElementById('messageBox');
            messageBox.innerHTML = ''; // Clear previous messages
            messageBox.className = ''; // Clear previous classes
            
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            var passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@#$%^&+=!]).{8,}$/;

            var errors = [];

            if (!emailPattern.test(email)) {
                errors.push('Please enter a valid email address.');
            }

            if (!passwordPattern.test(password)) {
                errors.push('Password must be at least 8 characters long, contain [(A-Z)(a-z){@#$}(0-9)] or[Password@123].');
            }

            if (errors.length > 0) {
                event.preventDefault(); // Prevent form submission
                
                var errorMessage = '<div class="alert alert-danger" role="alert">';
                errorMessage += errors.join('<br>');
                errorMessage += '</div>';
                
                messageBox.innerHTML = errorMessage;
                return false;
            }
        });
    </script>
</body>
</html>
