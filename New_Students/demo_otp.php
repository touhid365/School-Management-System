<?php
session_start();
$otpMessage = '';

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = $_POST['otp'];
    $students_id = $_SESSION['students_id'];

    // Verify the OTP
    $sql_otp = "SELECT otp, otp_expiry FROM students WHERE id = ?";
    $stmt_otp = $conn->prepare($sql_otp);
    $stmt_otp->bind_param("i", $students_id);
    $stmt_otp->execute();
    $result_otp = $stmt_otp->get_result();
    $otp_data = $result_otp->fetch_assoc();

    if ($otp_data && $otp_data['otp'] === $entered_otp && strtotime($otp_data['otp_expiry']) > time()) {
        $otpMessage = '<div class="alert alert-success">OTP verified successfully! Welcome to your dashboard.</div>';
        // Clear the OTP after successful verification
        $sql_clear_otp = "UPDATE students SET otp = NULL, otp_expiry = NULL WHERE id = ?";
        $stmt_clear = $conn->prepare($sql_clear_otp);
        $stmt_clear->bind_param("i", $students_id);
        $stmt_clear->execute();
        
        // Redirect to dashboard or home page
        header("Location: dashboard.php");
        exit;
    } else {
        $otpMessage = '<div class="alert alert-danger">Invalid or expired OTP. Please try again.</div>';
    }

    $stmt_otp->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP Verification</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container-logs">
    <div class="login-section">
      <form class="otp-form" action="" method="post">
        <h2><i class="fas fa-key"></i> Enter OTP</h2>
        <?php if (!empty($otpMessage)) echo $otpMessage; ?>
        <div class="input-group">
          <label for="otp">OTP</label>
          <input type="text" id="otp" name="otp" style="border-radius: 5px; height: 43px;" placeholder="Enter OTP" required>
        </div>
        <button type="submit" name="verify_otp">Verify OTP</button>
      </form>
    </div>
  </div>
</body>
</html>
