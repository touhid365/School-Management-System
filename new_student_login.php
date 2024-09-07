<?php
session_start();
$loginMessage = '';
$otpSentMessage = '';
$common_id = '';

// Database connection (reusing the same database connection details)
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

function generateOTP() {
    return rand(100000, 999999); // Generates a 6-digit OTP
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration_id = $_POST['registration_id'];
    $password = $_POST['password'];

    // Query to fetch the user by registration ID
    $sql = "SELECT * FROM students WHERE registration_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $registration_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Generate OTP and store it in the database
            $otp = generateOTP();
            $otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP valid for 10 minutes

            // Update the OTP in the database
            $update_sql = "UPDATE students SET otp = ?, otp_expiry = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssi", $otp, $otp_expiry, $user['id']);
            $update_stmt->execute();

            // Send OTP to user's email
            $to = $user['email'];
            $subject = "Your OTP for Verification";
            $message = "Dear " . $user['name'] . ",\n\nYour OTP for login verification is: " . $otp . "\n\nThis OTP is valid for 10 minutes.";
            $headers = "From: no-reply@yourdomain.com";

            if (mail($to, $subject, $message, $headers)) {
                $otpSentMessage = '<div class="alert alert-success">OTP sent to your registered email. Please check your email.</div>';
            } else {
                $otpSentMessage = '<div class="alert alert-danger">Failed to send OTP. Please try again later.</div>';
            }

            // Store user ID in session and redirect to OTP verification page
            $_SESSION['students_id'] = $user['id'];
            $_SESSION['otp_verified'] = false; // Initially set to false
            header("Location: /School-Manegment-System/New_Students/index.php?home=". $common_id ."");
            exit();
        } else {
            $loginMessage = '<div class="alert alert-danger">Invalid password. Please try again.</div>';
        }
    } else {
        $loginMessage = '<div class="alert alert-danger">Invalid registration ID. Please try again.</div>';
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Applicants Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" href="images/mortarboard.png" style="width: 100%; height: 100%; " type="image/jpeg">
</head>
<body>
  <div class="container-logs">
    <div class="image-section">
      <img src="images/istockphoto-1288092444-170667a.jpg" alt="Image">
    </div>
    <div class="login-section">
      <form class="login-form" action="" method="post">
        <h2> <i class=" fas fa-user"></i> Student Login</h2>
        <?php if (!empty($loginMessage)) echo $loginMessage; ?>
        <?php if (!empty($otpSentMessage)) echo $otpSentMessage; ?>
        <div class="input-group">
          <label for="registration_id">Registration No</label>
          <input type="text" id="registration_id" name="registration_id" style="border-radius: 5px; height: 43px; " placeholder="Enter Register ID" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" style="border-radius: 5px; height: 43px;" placeholder="Enter Password" required>
        </div>
        <p><a href="reg_new_students.php?registration=<?= isset($common_id) ? $common_id : '' ?>">don't have an account? create</a></p>
        <button type="submit">Login now</button>
      </form>
    </div>
  </div>
</body>
</html>

