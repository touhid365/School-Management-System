<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "students_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    // Verify OTP
    $sql = "SELECT * FROM reg_students WHERE email='$email' AND otp='$otp'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // OTP is correct, update verification status
        $update_sql = "UPDATE reg_students SET is_verified=1 WHERE email='$email'";
        if ($conn->query($update_sql) === TRUE) {
            $message = '
            <div class="alert alert-success">
            Email verification successful. You can now <a href="student_login.php">login</a>.
            </div>
            ';
        } else {
            $message = '
            <div class="alert alert-danger">
            There was an error updating the verification status: ' . $conn->error . '
            </div>
            ';
        }
    } else {
        $message = '
        <div class="alert alert-danger">
        Invalid OTP. Please try again.
        </div>
        ';
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!---css of bootstrap-->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <!----js of bootstrap-->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <link rel="shortcut icon" href="/images/permission.png" type="image/x-icon">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
        }
        .card h2 {
            margin-top: 0;
            font-size: 24px;
            text-align: center;
        }
        .card form {
            display: flex;
            flex-direction: column;
        }
        .card input[type="text"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .card button {
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .card button:hover {
            background-color: #218838;
        }
        .alert {
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
            align-items: center;
        }
       
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .card a {
            color: #28a745;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="card">
    <h2>Enter OTP</h2>
    <form method="POST" action="">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>" required>
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit">Verify</button>
    </form>
    <!-- Display the message -->
    <?php echo $message; ?>
</div>

</body>
</html>
