<?php
session_start();
$error = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'students_db');

    // Check if the admin email exists and verify the password
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        // Generate OTP
        $otp = rand(100000, 999999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime('+1 minutes'));

        // Save OTP and expiry time in the database
        $stmt = $conn->prepare("UPDATE admins SET otp = ?, otp_expiry = ? WHERE email = ?");
        $stmt->bind_param("sss", $otp, $otp_expiry, $email);
        $stmt->execute();

        // Send OTP to email (you can use PHPMailer for better email handling)
        $to = $email;
        $subject = "Your OTP Code";
        $message = "Your OTP code is $otp. It expires in 1 minute.";
        $headers = "From: noreply@yourdomain.com";

        mail($to, $subject, $message, $headers);

        // Redirect to OTP verification page with a success message
        $_SESSION['email'] = $email;
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: verify_otp.php?status=success&email=" . urlencode($email));
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <!--------fontawsome-cdn-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" href="images/mortarboard.png" style="width: 400px; height: 400px; " type="image/jpeg">
</head>
<body>
  <div class="container-logs">
    <div class="image-section">
      <img src="images/istockphoto-1312058235-170667a.jpg" alt="Image">
    </div>
    <div class="login-section">
      <form action="" method="post" class="login-form">
         <?php if ($error): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <h2> <i class=" fas fa-user"></i> Admin Login</h2>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" style="border-radius: 5px; height: 43px; " placeholder="Enter Email" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" style="border-radius: 5px; height: 43px; " placeholder="Enter Password" required>
        </div>
        <!-- <p><a href="registration.html">don't have an account? create</a></p> -->
        <button type="submit">Login now</button>
      </form>
    </div>
  </div>
</body>
</html>