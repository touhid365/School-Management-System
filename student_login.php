<?php
// Start session
session_start();

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

$common_id = '';
function generateId() {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 40);
}
$common_id = generateId();

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_number = mysqli_real_escape_string($conn, $_POST['roll_no']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the user exists and is verified
    $sql = "SELECT * FROM reg_students WHERE roll_number='$roll_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $row = $result->fetch_assoc();

        // Verify the password and check if the account is verified
        if (password_verify($password, $row['password'])) {
            if ($row['is_verified'] == 1) {
                // Store user information in session and redirect to a protected page
                $_SESSION['user'] = $row;
                $_SESSION['student_id'] = $row['id'];
                // $_SESSION['user_id'] = $row['id'];
                $message = '<div class="alert alert-success">Login successful! Redirecting to dashboard...</div>';
                header("refresh:1;url=/School-Manegment-System/Students/index.php?home=" . $common_id ." "); // Redirect after 60 seconds
                exit();
            } else {
                $message = '<div class="alert alert-danger">Your account is not verified. Please verify your email.</div>';
            }
        } else {
            $message = '<div class="alert alert-danger">Invalid roll number or password.</div>';
        }
    } else {
        $message = '<div class="alert alert-danger">Invalid roll number or password.</div>';
    }

    // If there is a message, trigger the modal to pop up
   
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login</title>
  <!--------fontawsome-cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <!---css of bootstrap-->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <!----js of bootstrap-->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <!-- <link rel="icon" href="images/permission.png" style="width: 10rem; height: 10rem; " type="image/png"> -->
 <link rel="icon" href="images/mortarboard.png" style="width: 100%; height: 100%; " type="image/jpeg">

  <!-- <link rel="stylesheet" href="css/styles.css"> -->
  <style>
    body {
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
    }

    .container-logs {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .image-section {
      width: 100%;
      max-width: 450px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-right: 20px;
    }
    .image-section img {
      width: 100%;
      border-radius: 10px;
      
      
    }
    .login-section {
      max-width: 400px;
      width: 100%;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-form h2 {
      text-align: center;
      margin-bottom: 20px;
      color: coral;
      font-size: 20px;
    }

    .input-group {
      margin-bottom: 15px;
    }

    .input-group label {
      font-size: 14px;
      margin-bottom: 5px;
      color: #555;
    }

    .input-group input {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 2px solid #ccc;
      outline-style: none;
    }
    .input-group input:hover {
     border: 2px solid coral;
   }

    .login-form button {
      width: 100%;
      padding: 10px;
      background-color: coral;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
      outline-style: none;
    }

    .login-form button:hover {
      background-color: #218838;
    }

    .login-form p {
      text-align: center;
      margin-top: 10px;
      text-decoration: underline #218838;
    }

    .login-form a {
      color: #28a745;
      text-decoration: none;
    }
    
  /* Responsive Design */
  @media (max-width: 880px) {
    .container-logs {
      flex-direction: column;
      width: 100%;
      height: auto;
    }
  
    .image-section {
      width: 100%;
      height: 200px;
      margin-left: 20px;
    }
  
    .image-section img {
      width: 100%;
      height: 100%;
      
    }
  
    
  
    .login-form {
      width: 100%;
      max-width: none;
    }
    .input-group input
    {
        width: 100%;
 
    }
   
  }
  
  </style>
</head>
<body>
  <div class="container-logs">
    <div class="image-section">
      <img src="images/rs=h_175,m (15).webp" alt="Image">
    </div>
    <div class="login-section">
      <form class="login-form" action="" method="post">
      <?php if (!empty($message)) echo $message; ?>
        <h2><i class="fas fa-user"></i> Student Login</h2>
        <div class="input-group">
          <label for="roll_no">Roll No.</label>
          <input type="text" id="roll_no" name="roll_no" placeholder="Enter Roll No" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter Password" required>
        </div>
        <p><a href="registration.php?signup=<?= isset($common_id) ? $common_id : '' ?>">Don't have an account? Create one</a></p>
        <button type="submit">Login now</button>
      </form>
    </div>
  </div>
</body>
</html>
