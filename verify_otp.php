<?php
session_start();
$error = '';

$common_id = '';
function generateId() {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 40);
}
$common_id = generateId();

if (!isset($_SESSION['email'])) {
    header('Location: admin_login.php');
    exit;
}

$email = $_SESSION['email'];
$admin_id = $_SESSION['admin_id'];

$status = isset($_GET['status']) ? $_GET['status'] : null;
$otp_expiry = null;

$conn = new mysqli('localhost', 'root', '', 'students_db');

// Check if OTP needs to be verified or a new one needs to be sent
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['verify_otp'])) {
        // Handle OTP Verification
        $otp = $_POST['otp'];

        // Verify OTP
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? AND otp = ? AND otp_expiry >= ?");
        $current_time = date("Y-m-d H:i:s");
        $stmt->bind_param("sss", $email, $otp, $current_time);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // OTP is correct and within expiry time
            // Clear OTP
            $stmt = $conn->prepare("UPDATE admins SET otp = NULL, otp_expiry = NULL WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            // Redirect to the admin folder
            header('Location: /School-Manegment-System/admin/index.php?home='. $common_id .'');
           
            exit;
        } else {
            $error = "Invalid or expired OTP!";
        }
    } elseif (isset($_POST['resend_otp'])) {
        // Handle OTP Resend
        $new_otp = rand(100000, 999999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime('+1 minutes'));

        // Save new OTP and expiry time in the database
        $stmt = $conn->prepare("UPDATE admins SET otp = ?, otp_expiry = ? WHERE email = ?");
        $stmt->bind_param("sss", $new_otp, $otp_expiry, $email);
        $stmt->execute();

        // Send the new OTP to the user's email
        $to = $email;
        $subject = "Your New OTP Code";
        $message = "Your new OTP code is $new_otp. It expires in 1 minute.";
        $headers = "From: noreply@yourdomain.com";

        mail($to, $subject, $message, $headers);

        // Update status to show that the new OTP was sent
        $status = 'new_otp_sent';
    }
} else {
    // Get OTP expiry time from the database if not POST request
    $stmt = $conn->prepare("SELECT otp_expiry FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $otp_expiry = $row['otp_expiry'];
    }
}

// Calculate remaining time in seconds for the countdown
$remaining_time = strtotime($otp_expiry) - time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/encrypted-phone.png" type="image/x-icon">
    <style>
        .btn-group {
            display: flex;
            gap: 0.5rem; /* Space between buttons */
            justify-content: flex-start;
            align-items: center;
        }
        .timer {
            font-weight: bold;
            color: red;
        }
    </style>
    <title>OTP Verification</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card p-4 shadow-sm">
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <?php if ($status == 'success'): ?>
            <div class="alert alert-success">
                OTP sent successfully to your registered email ID: <strong><?php echo htmlspecialchars($email); ?></strong>.
            </div>
        <?php elseif ($status == 'new_otp_sent'): ?>
            <div class="alert alert-warning">
                A new OTP has been sent to your registered email ID: <strong><?php echo htmlspecialchars($email); ?></strong>.
            </div>
        <?php endif; ?>
        <h3 class="mb-3">Verify OTP</h3>
        
        <!-- OTP Verification Form -->
        <form method="POST" action="" class="d-inline">
            <div class="mb-3">
                <label for="otp" class="form-label">Enter 6 digits OTP to login your account.</label>
                <input type="text" class="form-control" name="otp" id="otp" required>
            </div>
            <div class="mb-3">
                <p>OTP expires in: <span id="timer" class="timer"><?php echo $remaining_time; ?></span> seconds</p>
            </div>
            <div class="btn-group">
                <button type="submit" style="border-radius: 5px;" class="btn btn-primary" name="verify_otp">Verify</button>
        </form>

        <!-- Separate Resend OTP Form -->
        <form method="POST" action="" class="d-inline">
            <input type="hidden" name="resend_otp" value="1">
            <button type="submit" style="border-radius: 5px;" class="btn btn-secondary" id="resendButton" disabled>Resend OTP</button>
        </form>
            </div>
    </div>

    <script>
        let timerElement = document.getElementById('timer');
        let resendButton = document.getElementById('resendButton');
        let timeLeft = <?php echo $remaining_time; ?>;

        const countdown = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(countdown);
                timerElement.textContent = '0';
                resendButton.disabled = false;
            } else {
                timerElement.textContent = timeLeft;
                timeLeft--;
            }
        }, 1000);
    </script>
</body>
</html>

