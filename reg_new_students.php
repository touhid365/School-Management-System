<?php
$messages = '';
$common_id = ''; // Initialize common_id
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "students_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function generateId() {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 40);
}
$common_id = generateId();
// Function to generate a 16-digit registration ID
// function generateRegistrationId() {
//     return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 16);
// }
// Function to generate a 16-digit registration ID with "IMIT" prefix
function generateRegistrationId() {
    $randomId = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
    return "IMIT40" . $randomId; // Prefix "IMIT" added
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $registration_id = generateRegistrationId();
   

      // Check if email already exists
      $email_check_query = "SELECT * FROM students WHERE email = ?";
      $stmt = $conn->prepare($email_check_query);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $messages = '<div class="alert alert-danger">Email is already registered!</div>';
          
          
      } else {

    // Insert the data into the database
    $sql = "INSERT INTO students (registration_id, name, email, password) VALUES ('$registration_id', '$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Display popup with registration ID
        // $message ="<script>alert('Registration successful! Your registration ID is: $registration_id');</script>";
        $messages = '<div class="alert alert-success">Registration successful! Your registration ID is:  ' . $registration_id . ' login now</div>';

        // Send email to the user
        $to = $email;
        $subject = "Student Registration Successful";
        $message = "Dear $name,\n\nThank you for registering. Your registration ID is: $registration_id\n\nBest regards,\nLearnDash Academy";
        $headers = "From: noreply@yourschool.com";

        mail($to, $subject, $message, $headers);

        // Redirect to a success page (optional)
        // header("Location: success.php");
    } else {
        // $messages ="Error: " . $sql . "<br>" . $conn->error;
        $messages = "<div class='alert alert-danger'>'Error: ' . $sql . '<br>' . $conn->error;</div>";
    }

    $conn->close();
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> New Student Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="images/mortarboard.png" style="width: 100%; height: 100%; " type="image/jpeg">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .registration-container {
            display: flex;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px #0000001f;
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        .form-image {
            background-size: cover;
            background-position: center;
            border-radius: 10px 0 0 10px;
            flex: 1;
        }
        .form-content {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-content h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #343a40;
        }
        .form-group label {
            color: #495057;
        }
        .form-control {
            border-radius: 20px;
            border: 2px solid #ced4da;
            padding: 15px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: coral;
            box-shadow: none;
        }
        .form-control:hover {
            border-color: coral;
        }
        .btn-primary {
            border-radius: 20px;
            padding: 10px;
            font-size: 16px;
            background-color: coral;
            border-color: coral;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #218838;
        }
        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 70%;
            transform: translateY(-50%);
            color: #7d868f;
            transition: color 0.3s;
        }
        .toggle-password:hover {
            color: #777;
        }
        .toggle-password i {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="registration-container">
            <!-- Side Image -->
            <div class="form-image d-none d-md-block" style="background-image: url('images/pexels-olly-3762800.jpg');"></div>
            
            <!-- Registration Form -->
            <div class="form-content">
                <h2>Student Registration</h2>
                <?php if (!empty($messages)) echo $messages; ?>
                <form action="" method="POST" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group position-relative">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        <span class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>

                    <a href="new_student_login.php?login=<?= isset($common_id) ? $common_id : '' ?>"  class="">already register login now</a>

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>


    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var passwordFieldType = passwordField.type;
            var toggleIcon = document.getElementById("toggleIcon");

            if (passwordFieldType === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }

        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>

