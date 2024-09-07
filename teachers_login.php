
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$common_id = '';
function generateId() {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 40);
}
$common_id = generateId();

$message = '';

if (isset($_POST['login'])) {
    $teacher_id = mysqli_real_escape_string($conn, $_POST['teacher_id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM teachers WHERE teacher_id = '$teacher_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['password']) {// Use password_verify() if passwords are hashed
            $_SESSION['teacher_id'] = $teacher_id;
            // $_SESSION['teachers_id'] = $row['id']; // Store the teacher's unique ID in session
            header("Location: /School-Manegment-System/Teachers/welcome.php?home=" . $common_id .""); // Redirect to dashboard
            exit();
        } else {
            $message = '<div class="alert alert-danger">Invalid password!</div>';
        }
    } else {
        $message = '<div class="alert alert-danger">Teacher ID not found!</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teachers Login</title>
  <!--------fontawsome-cdn-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="css/styles.css">
 <link rel="icon" href="images/mortarboard.png" style="width: 100%; height: 100%; " type="image/jpeg">
</head>
<body>
  <div class="container-logs">
    <div class="image-section">
      <img src="images/touhid09.png" alt="Image">
    </div>
    <div class="login-section">
      <form method="POST" action="" class="login-form">
      <?php if (!empty($message)) echo $message; ?>
        <h2> <i class=" fas fa-user"></i> Teacher's Login</h2>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="text" id="teacher_id" name="teacher_id"  style="border-radius: 5px; height: 43px; font-size: 15px; " placeholder="Enter your ID" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password"  style="border-radius: 5px; height: 43px; font-size: 15px; " placeholder="Enter Password" required>
        </div>
        <!-- <p><a href="registration.html">don't have an account? create</a></p> -->
        <button type="submit" name="login">Login now</button>
      </form>
    </div>
  </div>
</body>
</html>