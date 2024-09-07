
<?php

// session_start();
// // Database connection
// $servername = "localhost";
// $username = "root"; // Replace with your MySQL username
// $password = ""; // Replace with your MySQL password
// $dbname = "students_db";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Get the current user's ID from the session
// $student_ids = $_SESSION['students_id'];

// // Generate a new OTP
// $new_otp = rand(100000, 999999);
// $otp_expiry = date("Y-m-d H:i:s", strtotime("+5 minutes")); // Set OTP expiry to 5 minutes from now

// // Update the new OTP in the database
// $sql = "UPDATE students SET otp = ?, otp_expiry = ? WHERE id = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("ssi", $new_otp, $otp_expiry, $students_id);
// $stmt->execute();

// // Send the new OTP to the user's email (implement your email sending logic)
//     $conn = new mysqli('localhost', 'root', '', 'students_db');
//     $sql = mysqli_query($conn, "SELECT * FROM  `students` WHERE id = '$students_id'");
//     if(mysqli_num_rows($sql) > 0){
//     $row = mysqli_fetch_assoc($sql);
//     }
//     $email =  $row['email'];
//  // Retrieve the user's email from the database
// $subject = "Your OTP Code";
// $message = "Your new OTP code is: " . $new_otp;
// $headers = "From: your-email@example.com";

// // Use PHP mail function or an email library like PHPMailer to send the email
// mail($email, $subject, $message, $headers);

// $stmt->close();
// $conn->close();

// // Redirect back to the index page with a message
// header("Location: index.php?message=OTP resent successfully.");
// exit();
?>
<?php
session_start();

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

// Get student ID from session
$student_id = $_SESSION['students_id'];

// Generate new OTP
function generateOTP() {
    return rand(100000, 999999); // Generates a 6-digit OTP
}

$new_otp = generateOTP();
$otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP valid for 10 minutes

// Update the OTP in the database
$update_sql = "UPDATE students SET otp = ?, otp_expiry = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("ssi", $new_otp, $otp_expiry, $student_id);
$update_stmt->execute();

// Fetch user's email
$sql = "SELECT email, name FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $to = $user['email'];
    $subject = "Your New OTP for Verification";
    $message = "Dear " . $user['name'] . ",\n\nYour new OTP for login verification is: " . $new_otp . "\n\nThis OTP is valid for 10 minutes.";
    $headers = "From: no-reply@yourdomain.com";

    if (mail($to, $subject, $message, $headers)) {
        $message = '<div class="alert alert-success">New OTP sent to your registered email. Please check your email.</div>';
    } else {
        $message = '<div class="alert alert-danger">Failed to send OTP. Please try again later.</div>';
    }
} else {
    $message = '<div class="alert alert-danger">Failed to fetch user details. Please try again.</div>';
}

$conn->close();

// Redirect back to the index.php page
header("Location: /School-Manegment-System/New_Students/index.php");
exit();
?>
